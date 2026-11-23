<?php

namespace App\Services;

use App\Models\Application;
use App\Services\DocumentVerification\DocumentVerifierStrategyInterface;
use App\Services\DocumentVerification\GeminiVisionVerifier;
use App\Services\DocumentVerification\LocalOcrDocumentVerifier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class DocumentAiVerifierService
{
    protected string $configuredMode;
    protected GeminiVisionVerifier $geminiVerifier;
    protected LocalOcrDocumentVerifier $localVerifier;

    public function __construct(
        GeminiVisionVerifier $geminiVerifier,
        LocalOcrDocumentVerifier $localVerifier
    ) {
        $this->configuredMode = config('services.ai_verifier.mode', env('AI_VERIFIER_MODE', 'auto'));
        $this->geminiVerifier = $geminiVerifier;
        $this->localVerifier = $localVerifier;
    }

    /**
     * Get active verifier mode code ('vision_api', 'local_ocr', or 'auto').
     */
    public function getConfiguredMode(): string
    {
        return $this->configuredMode;
    }

    /**
     * Get active mode display label for UI Badge / Pill.
     */
    public function getActiveModeLabel(): string
    {
        if ($this->configuredMode === 'api') {
            return 'Mode: Vision API (Gemini)';
        }

        if ($this->configuredMode === 'local') {
            return 'Mode: Local OCR Engine';
        }

        // Auto mode
        if ($this->geminiVerifier->hasValidKey()) {
            return 'Mode: Vision API (Auto)';
        }

        return 'Mode: Local OCR Engine (Auto Fallback)';
    }

    /**
     * Get active mode short code for frontend.
     */
    public function getActiveModeCode(): string
    {
        if ($this->configuredMode === 'api') {
            return 'vision_api';
        }

        if ($this->configuredMode === 'local') {
            return 'local_ocr';
        }

        return $this->geminiVerifier->hasValidKey() ? 'vision_api' : 'local_ocr';
    }

    /**
     * Verify document using Strategy Pattern based on configuration.
     *
     * @param UploadedFile $file
     * @param string $documentType ('kk', 'ijazah', 'pas_foto', 'ktp')
     * @param Application $application
     * @param bool $forceReject
     * @return array
     */
    public function verifyDocument(UploadedFile $file, string $documentType, Application $application, bool $forceReject = false): array
    {
        $mode = strtolower(trim($this->configuredMode));

        // Mode 1: Forced API
        if ($mode === 'api') {
            try {
                return $this->geminiVerifier->verify($file, $documentType, $application, $forceReject);
            } catch (\Throwable $e) {
                Log::error('Gemini Vision API mode failed: ' . $e->getMessage());
                return [
                    'is_valid' => false,
                    'verifier_mode' => 'vision_api',
                    'status_label' => 'DOKUMEN DITOLAK / API ERROR',
                    'alasan_penolakan' => 'Layanan Gemini Vision API sedang tidak dapat dijangkau: ' . $e->getMessage(),
                    'yang_harus_diperbaiki' => [
                        'Pastikan koneksi internet terhubung.',
                        'Periksa kembali GEMINI_API_KEY di file .env.'
                    ],
                    'hasil_ekstraksi' => 'Gagal memanggil Gemini Vision API.',
                    'accuracy' => '0.0%',
                    'notes' => 'Pemeriksaan via Mode API gagal.'
                ];
            }
        }

        // Mode 2: Forced Local
        if ($mode === 'local') {
            return $this->localVerifier->verify($file, $documentType, $application, $forceReject);
        }

        // Mode 3: Auto (Tries API first if key available; falls back to local on failure or offline)
        if ($this->geminiVerifier->hasValidKey()) {
            try {
                $apiResult = $this->geminiVerifier->verify($file, $documentType, $application, $forceReject);
                if (is_array($apiResult) && isset($apiResult['is_valid'])) {
                    return $apiResult;
                }
            } catch (\Throwable $e) {
                Log::warning('Auto mode: Gemini Vision API error (' . $e->getMessage() . '). Seamlessly falling back to Local OCR Engine.');
            }
        }

        // Local OCR Fallback
        return $this->localVerifier->verify($file, $documentType, $application, $forceReject);
    }
}
