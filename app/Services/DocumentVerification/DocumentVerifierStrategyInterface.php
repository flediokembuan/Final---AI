<?php

namespace App\Services\DocumentVerification;

use App\Models\Application;
use Illuminate\Http\UploadedFile;

interface DocumentVerifierStrategyInterface
{
    /**
     * Verify the uploaded document according to the strategy.
     *
     * @param UploadedFile $file
     * @param string $documentType ('kk', 'ijazah', 'pas_foto', 'ktp')
     * @param Application $application
     * @param bool $forceReject
     * @return array
     */
    public function verify(UploadedFile $file, string $documentType, Application $application, bool $forceReject = false): array;

    /**
     * Get unique identifier for the verifier mode ('vision_api' or 'local_ocr').
     */
    public function getMode(): string;

    /**
     * Get user-friendly display label ('Vision API (Gemini)' or 'Local OCR Engine').
     */
    public function getModeLabel(): string;
}
