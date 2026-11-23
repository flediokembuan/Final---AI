<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Mail\RegistrationCardMail;
use App\Services\DocumentAiVerifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PmbController extends Controller
{
    /**
     * Get or create the applicant's application.
     */
    protected function getApplicantApplication(): Application
    {
        $user = Auth::user();
        return Application::firstOrCreate(
            ['user_id' => $user->id],
            [
                'status' => 'draft',
                'full_name' => $user->name,
            ]
        );
    }

    /**
     * Step 1: Biodata & Program Studi Form.
     */
    public function biodata()
    {
        $application = $this->getApplicantApplication();
        return view('pmb.biodata', compact('application'));
    }

    /**
     * Store or update Biodata and calculate age.
     */
    public function storeBiodata(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'whatsapp' => 'required|string|max:30',
            'address' => 'required|string',
            'school_name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20',
            'graduation_year' => 'required|string|max:10',
            'faculty' => 'required|string|max:150',
            'study_program' => 'required|string|max:150',
        ], [
            'nik.size' => 'NIK Kependudukan harus terdiri dari 16 digit angka.',
            'birth_date.required' => 'Tanggal lahir wajib diisi untuk verifikasi usia calon mahasiswa.',
        ]);

        $application = $this->getApplicantApplication();

        // Calculate age
        $birthDate = Carbon::parse($request->birth_date);
        $age = $birthDate->age;
        $isUnder17 = ($age < 17);

        $application->update([
            'full_name' => $request->full_name,
            'nik' => $request->nik,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'school_name' => $request->school_name,
            'nisn' => $request->nisn,
            'graduation_year' => $request->graduation_year,
            'faculty' => $request->faculty,
            'study_program' => $request->study_program,
            'is_under_17' => $isUnder17,
        ]);

        // If user also wants to update the user name
        $user = Auth::user();
        if ($user && $user->name !== $request->full_name) {
            $user->update(['name' => $request->full_name]);
        }

        if ($request->input('action') === 'draft') {
            return back()->with('success', 'Biodata berhasil disimpan sebagai draft.');
        }

        return redirect()->route('pmb.dokumen')->with('success', 'Biodata tersimpan. Silakan lanjutkan ke verifikasi berkas AI.');
    }

    /**
     * Step 2: Upload Documents & AI Verification.
     */
    public function dokumen()
    {
        $application = $this->getApplicantApplication();
        $application->load('documents');

        $documents = [
            'kk' => $application->getDocument('kk'),
            'ijazah' => $application->getDocument('ijazah'),
            'pas_foto' => $application->getDocument('pas_foto'),
            'ktp' => $application->getDocument('ktp'),
        ];

        $allRequiredValid = $application->areRequiredDocumentsValid();

        $initialDocs = [];
        foreach (['kk', 'ijazah', 'pas_foto', 'ktp'] as $type) {
            $doc = $documents[$type];
            $initialDocs[$type] = $doc ? [
                'is_uploaded' => true,
                'is_valid' => (bool)$doc->is_valid,
                'filename' => $doc->original_filename,
                'url' => \Illuminate\Support\Facades\Storage::url($doc->file_path),
                'feedback' => $doc->ai_feedback_json
            ] : null;
        }

        $aiVerifier = app(DocumentAiVerifierService::class);
        $activeVerifierLabel = $aiVerifier->getActiveModeLabel();
        $activeVerifierMode = $aiVerifier->getActiveModeCode();

        return view('pmb.dokumen', compact('application', 'documents', 'allRequiredValid', 'initialDocs', 'activeVerifierLabel', 'activeVerifierMode'));
    }

    /**
     * Safely generate and assign a unique registration number.
     */
    protected function assignRegistrationNumber(Application $application): void
    {
        if (!$application->registration_number) {
            $padNumber = str_pad($application->id, 4, '0', STR_PAD_LEFT);
            $regNumber = "PMB-UNKLAB-2026-{$padNumber}";
            if (Application::where('registration_number', $regNumber)->where('id', '!=', $application->id)->exists()) {
                $regNumber = "PMB-UNKLAB-2026-{$padNumber}-" . strtoupper(substr(uniqid(), -4));
            }
            $application->registration_number = $regNumber;
        }
    }

    /**
     * Finalize application and lock for admin approval.
     */
    public function finalize()
    {
        $application = $this->getApplicantApplication();
        $application->load('documents');

        if (!$application->areRequiredDocumentsValid()) {
            return redirect()->route('pmb.dokumen')->with('error', 'Semua berkas wajib harus terverifikasi valid oleh AI sebelum finalisasi.');
        }

        $this->assignRegistrationNumber($application);

        if ($application->status === 'draft') {
            $application->status = 'submitted';
        }

        // Send confirmation email (with visual HTML card) on first-time finalization
        $emailSent = false;
        if (empty($application->confirmation_email_sent_at) && $application->user && $application->user->email) {
            try {
                Mail::to($application->user->email)->send(new RegistrationCardMail($application));
                $application->confirmation_email_sent_at = Carbon::now();
                $emailSent = true;
            } catch (\Throwable $e) {
                Log::error('Failed sending registration confirmation email: ' . $e->getMessage());
            }
        }

        $application->save();

        $message = 'Pendaftaran Anda berhasil disubmit dan menunggu approval Admin PMB.';
        if ($emailSent) {
            $message .= ' Kartu bukti pendaftaran resmi telah dikirim ke email ' . $application->user->email . '.';
        }

        return redirect()->route('pmb.bukti')->with('success', $message);
    }

    /**
     * Resend registration card email (for demo in front of lecturer).
     */
    public function resendCardEmail(Request $request)
    {
        $application = $this->getApplicantApplication();
        $application->load('documents', 'user');

        $this->assignRegistrationNumber($application);
        $application->save();

        if ($application->user && $application->user->email) {
            try {
                Mail::to($application->user->email)->send(new RegistrationCardMail($application));
                $application->confirmation_email_sent_at = Carbon::now();
                $application->save();

                return back()->with('success', "Kartu bukti pendaftaran berhasil dikirim ulang ke alamat email: {$application->user->email}.");
            } catch (\Throwable $e) {
                Log::error('Failed resending registration confirmation email: ' . $e->getMessage());
                return back()->with('error', "Gagal mengirim email: {$e->getMessage()}. Silakan periksa konfigurasi MAIL di .env.");
            }
        }

        return back()->with('error', 'Alamat email pendaftar tidak valid.');
    }

    /**
     * Step 3: Registration Confirmation / Bukti Pendaftaran.
     */
    public function bukti()
    {
        $application = $this->getApplicantApplication();
        $application->load('documents');

        $this->assignRegistrationNumber($application);
        if ($application->status === 'draft') {
            $application->status = 'submitted';
        }
        $application->save();

        return view('pmb.bukti', compact('application'));
    }
}
