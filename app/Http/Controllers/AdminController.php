<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Mail\RegistrationCardMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Admin PMB Dashboard.
     */
    public function dashboard(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $prodi = $request->query('prodi');
        $selectedId = $request->query('selected');

        $query = Application::with(['user', 'documents'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($prodi && $prodi !== 'all') {
            $query->where('study_program', 'like', "%{$prodi}%");
        }

        $applicants = $query->paginate(10)->withQueryString();

        // Statistical computations
        $totalApplicants = Application::count();
        $verifiedAiCount = Application::whereHas('documents', function ($q) {
            $q->where('is_valid', true);
        })->where('status', '!=', 'rejected')->count();

        $rejectedAiCount = Application::where(function ($q) {
            $q->where('status', 'rejected')
              ->orWhereHas('documents', function ($dq) {
                  $dq->where('is_valid', false);
              });
        })->count();

        $under17Count = Application::where('is_under_17', true)->count();

        // Selected applicant for evaluation panel (default to first or selected)
        $selectedApplicant = null;
        if ($selectedId) {
            $selectedApplicant = Application::with(['user', 'documents'])->find($selectedId);
        }
        if (!$selectedApplicant && $applicants->isNotEmpty()) {
            $selectedApplicant = $applicants->first();
        }

        $initialSelectedData = $selectedApplicant ? [
            'id' => $selectedApplicant->id,
            'reg' => $selectedApplicant->registration_number,
            'name' => $selectedApplicant->full_name,
            'email' => $selectedApplicant->user?->email,
            'whatsapp' => $selectedApplicant->whatsapp,
            'prodi' => $selectedApplicant->study_program,
            'faculty' => $selectedApplicant->faculty,
            'nik' => $selectedApplicant->nik,
            'nisn' => $selectedApplicant->nisn,
            'school' => $selectedApplicant->school_name,
            'age_formatted' => $selectedApplicant->age_formatted,
            'is_under_17' => (bool)$selectedApplicant->is_under_17,
            'status' => $selectedApplicant->status,
            'documents' => $selectedApplicant->documents->map(fn($d) => [
                'id' => $d->id,
                'type' => $d->document_type,
                'type_label' => $d->document_type_label,
                'filename' => $d->original_filename,
                'file_url' => Storage::url($d->file_path),
                'is_valid' => (bool)$d->is_valid,
                'feedback' => $d->ai_feedback_json
            ])
        ] : null;

        // List of all study programs for filter dropdown
        $studyPrograms = [
            'S1 Informatika (Akreditasi Unggul)',
            'S1 Sistem Informasi',
            'S1 Keperawatan',
            'S1 Manajemen',
            'S1 Akuntansi',
            'S1 Pendidikan Bahasa Inggris',
        ];

        $aiVerifier = app(\App\Services\DocumentAiVerifierService::class);
        $activeVerifierLabel = $aiVerifier->getActiveModeLabel();

        return view('admin.dashboard', compact(
            'applicants',
            'totalApplicants',
            'verifiedAiCount',
            'rejectedAiCount',
            'under17Count',
            'selectedApplicant',
            'initialSelectedData',
            'studyPrograms',
            'search',
            'status',
            'prodi',
            'activeVerifierLabel'
        ));
    }

    /**
     * Get single applicant details (JSON for reactive panel).
     */
    public function getApplicantDetail($id)
    {
        $applicant = Application::with(['user', 'documents'])->findOrFail($id);

        $docsFormatted = $applicant->documents->map(function ($doc) {
            return [
                'id' => $doc->id,
                'document_type' => $doc->document_type,
                'document_type_label' => $doc->document_type_label,
                'original_filename' => $doc->original_filename,
                'file_url' => Storage::url($doc->file_path),
                'is_valid' => (bool)$doc->is_valid,
                'ai_feedback' => $doc->ai_feedback_json,
            ];
        });

        return response()->json([
            'id' => $applicant->id,
            'registration_number' => $applicant->registration_number,
            'full_name' => $applicant->full_name,
            'email' => $applicant->user?->email,
            'whatsapp' => $applicant->whatsapp,
            'nik' => $applicant->nik,
            'birth_date' => $applicant->birth_date?->format('d F Y'),
            'age_formatted' => $applicant->age_formatted,
            'is_under_17' => $applicant->is_under_17,
            'school_name' => $applicant->school_name,
            'nisn' => $applicant->nisn,
            'faculty' => $applicant->faculty,
            'study_program' => $applicant->study_program,
            'status' => $applicant->status,
            'documents' => $docsFormatted,
        ]);
    }

    /**
     * Approve applicant registration.
     */
    public function approve(Request $request, $id)
    {
        $applicant = Application::with(['user', 'documents'])->findOrFail($id);
        $applicant->update(['status' => 'approved']);

        // Send approval notification email
        if ($applicant->user && $applicant->user->email) {
            try {
                Mail::to($applicant->user->email)->send(new RegistrationCardMail($applicant));
            } catch (\Throwable $e) {
                Log::error('Admin approve email failed: ' . $e->getMessage());
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'status' => 'approved', 'message' => 'Pendaftaran berhasil disetujui (Approved).']);
        }

        return back()->with('success', "Pendaftaran {$applicant->full_name} ({$applicant->registration_number}) berhasil DISETUJUI. Notifikasi email dikirim ke {$applicant->user?->email}.");
    }

    /**
     * Reject applicant registration.
     */
    public function reject(Request $request, $id)
    {
        $applicant = Application::with(['user', 'documents'])->findOrFail($id);
        $applicant->update(['status' => 'rejected']);

        // Send rejection notification email
        if ($applicant->user && $applicant->user->email) {
            try {
                Mail::to($applicant->user->email)->send(new RegistrationCardMail($applicant));
            } catch (\Throwable $e) {
                Log::error('Admin reject email failed: ' . $e->getMessage());
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'status' => 'rejected', 'message' => 'Pendaftaran telah ditolak (Rejected).']);
        }

        return back()->with('error', "Pendaftaran {$applicant->full_name} ({$applicant->registration_number}) telah DITOLAK. Notifikasi email dikirim ke {$applicant->user?->email}.");
    }
}
