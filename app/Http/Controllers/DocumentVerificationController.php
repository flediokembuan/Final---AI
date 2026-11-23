<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Services\DocumentAiVerifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentVerificationController extends Controller
{
    protected DocumentAiVerifierService $aiVerifier;

    public function __construct(DocumentAiVerifierService $aiVerifier)
    {
        $this->aiVerifier = $aiVerifier;
    }

    /**
     * Handle AJAX upload and AI Document Verification.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'document_file' => 'required|file|mimes:jpeg,png,jpg,pdf,webp|max:10240',
            'document_type' => 'required|in:kk,ijazah,pas_foto,ktp',
            'simulate_reject' => 'nullable|boolean',
        ], [
            'document_file.required' => 'Silakan pilih berkas dokumen yang ingin diunggah.',
            'document_file.mimes' => 'Format berkas harus berupa JPG, PNG, atau PDF.',
            'document_file.max' => 'Ukuran berkas maksimal adalah 10 MB.',
        ]);

        $user = Auth::user();
        $application = Application::firstOrCreate(
            ['user_id' => $user->id],
            ['status' => 'draft', 'full_name' => $user->name]
        );

        $file = $request->file('document_file');
        $documentType = $request->input('document_type');
        $simulateReject = $request->boolean('simulate_reject');

        // Store file in storage/app/public/documents/{application_id}
        $storedPath = $file->store("documents/{$application->id}", 'public');

        // Run AI Document Verification
        $aiResult = $this->aiVerifier->verifyDocument($file, $documentType, $application, $simulateReject);

        $isValid = (bool)($aiResult['is_valid'] ?? false);

        // Save or update document record in database
        $document = ApplicationDocument::updateOrCreate(
            [
                'application_id' => $application->id,
                'document_type' => $documentType,
            ],
            [
                'file_path' => $storedPath,
                'original_filename' => $file->getClientOriginalName(),
                'is_valid' => $isValid,
                'ai_feedback_json' => $aiResult,
            ]
        );

        // Check if all required documents are now valid
        $application->refresh();
        $allRequiredValid = $application->areRequiredDocumentsValid();

        return response()->json([
            'success' => true,
            'is_valid' => $isValid,
            'verifier_mode' => $aiResult['verifier_mode'] ?? $this->aiVerifier->getActiveModeCode(),
            'status_label' => $aiResult['status_label'] ?? ($isValid ? 'Terverifikasi AI ✓' : 'DOKUMEN INVALID / DOKUMEN DITOLAK'),
            'alasan_penolakan' => $aiResult['alasan_penolakan'] ?? null,
            'yang_harus_diperbaiki' => $aiResult['yang_harus_diperbaiki'] ?? [],
            'hasil_ekstraksi' => $aiResult['hasil_ekstraksi'] ?? '',
            'accuracy' => $aiResult['accuracy'] ?? ($isValid ? '99.0%' : '30.0%'),
            'notes' => $aiResult['notes'] ?? '',
            'original_filename' => $file->getClientOriginalName(),
            'file_url' => Storage::url($storedPath),
            'document_type' => $documentType,
            'all_required_valid' => $allRequiredValid,
        ]);
    }

    /**
     * Remove / reset a document.
     */
    public function remove(Request $request, string $type)
    {
        $user = Auth::user();
        $application = Application::where('user_id', $user->id)->firstOrFail();

        $doc = ApplicationDocument::where('application_id', $application->id)
            ->where('document_type', $type)
            ->first();

        if ($doc) {
            Storage::disk('public')->delete($doc->file_path);
            $doc->delete();
        }

        return response()->json([
            'success' => true,
            'all_required_valid' => $application->refresh()->areRequiredDocumentsValid(),
        ]);
    }
}
