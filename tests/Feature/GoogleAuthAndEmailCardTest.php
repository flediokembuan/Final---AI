<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Mail\RegistrationCardMail;
use App\Services\DocumentAiVerifierService;
use App\Services\DocumentVerification\GeminiVisionVerifier;
use App\Services\DocumentVerification\LocalOcrDocumentVerifier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class GoogleAuthAndEmailCardTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_google_oauth_redirect_initiates_socialite()
    {
        // When client_id is set
        config(['services.google.client_id' => 'mock-client-id']);
        config(['services.google.client_secret' => 'mock-client-secret']);

        $response = $this->get('/auth/google');
        // Socialite redirects to accounts.google.com
        $this->assertTrue($response->isRedirection());
        $this->assertStringContainsString('accounts.google.com', $response->headers->get('Location'));
    }

    public function test_google_oauth_callback_for_personal_email_routes_to_applicant_biodata()
    {
        $testEmail = 'gabriel_' . uniqid() . '@gmail.com';
        $mockUser = Mockery::mock(SocialiteUser::class);
        $mockUser->shouldReceive('getId')->andReturn('google_' . uniqid());
        $mockUser->shouldReceive('getName')->andReturn('Gabriel Julian Mamahit');
        $mockUser->shouldReceive('getNickname')->andReturn(null);
        $mockUser->shouldReceive('getEmail')->andReturn($testEmail);
        $mockUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/a/avatar123');

        $provider = Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class);
        $provider->shouldReceive('user')->andReturn($mockUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/pmb/biodata');

        $this->assertDatabaseHas('users', [
            'email' => $testEmail,
            'role' => 'applicant',
        ]);

        $createdUser = User::where('email', $testEmail)->first();
        $this->assertNotNull($createdUser->application);
    }

    public function test_google_oauth_callback_for_unklab_email_routes_to_admin_dashboard()
    {
        $adminEmail = 'panitia_' . uniqid() . '@unklab.ac.id';
        $mockUser = Mockery::mock(SocialiteUser::class);
        $mockUser->shouldReceive('getId')->andReturn('google_' . uniqid());
        $mockUser->shouldReceive('getName')->andReturn('Panitia PMB UNKLAB');
        $mockUser->shouldReceive('getNickname')->andReturn(null);
        $mockUser->shouldReceive('getEmail')->andReturn($adminEmail);
        $mockUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/a/admin_avatar');

        $provider = Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class);
        $provider->shouldReceive('user')->andReturn($mockUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/admin/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => $adminEmail,
            'role' => 'admin',
        ]);
    }

    public function test_finalize_application_sends_html_email_card_and_sets_timestamp()
    {
        Mail::fake();
        Storage::fake('public');

        $testEmail = 'calon_' . uniqid() . '@gmail.com';
        $user = User::factory()->create(['email' => $testEmail, 'role' => 'applicant']);
        $application = Application::create([
            'user_id' => $user->id,
            'full_name' => 'Calon Mahasiswa Unggul',
            'nik' => '7102012408080003',
            'school_name' => 'SMA Katolik Rex Mundi Manado',
            'faculty' => 'Fakultas Ilmu Komputer (FIK)',
            'study_program' => 'S1 Informatika (Akreditasi Unggul)',
            'is_under_17' => true,
            'status' => 'draft',
        ]);

        // Create valid required documents
        ApplicationDocument::create([
            'application_id' => $application->id,
            'document_type' => 'kk',
            'file_path' => 'demo/kk.jpg',
            'original_filename' => 'kk.jpg',
            'is_valid' => true,
        ]);
        ApplicationDocument::create([
            'application_id' => $application->id,
            'document_type' => 'ijazah',
            'file_path' => 'demo/ijazah.jpg',
            'original_filename' => 'ijazah.jpg',
            'is_valid' => true,
        ]);
        ApplicationDocument::create([
            'application_id' => $application->id,
            'document_type' => 'pas_foto',
            'file_path' => 'demo/pas_foto.jpg',
            'original_filename' => 'pas_foto.jpg',
            'is_valid' => true,
        ]);

        $this->actingAs($user);

        // Finalize
        $response = $this->post('/pmb/finalisasi');

        $response->assertRedirect('/pmb/bukti-pendaftaran');

        $application->refresh();
        $this->assertEquals('submitted', $application->status);
        $this->assertNotNull($application->registration_number);
        $this->assertNotNull($application->confirmation_email_sent_at);

        // Verify Mail sent without PDF attachment (pure HTML email card)
        Mail::assertSent(RegistrationCardMail::class, function ($mail) use ($testEmail) {
            return $mail->hasTo($testEmail) && empty($mail->attachments);
        });

        // Ensure duplicate finalize does NOT resend mail
        Mail::fake();
        $this->post('/pmb/finalisasi');
        Mail::assertNothingSent();
    }

    public function test_dual_mode_ai_verifier_uniform_contract_and_local_ocr_fallback()
    {
        Storage::fake('public');

        $service = app(DocumentAiVerifierService::class);
        $user = User::factory()->create(['role' => 'applicant']);
        $application = Application::create([
            'user_id' => $user->id,
            'full_name' => 'Gabriel Julian Mamahit',
            'nik' => '7102012408080003',
        ]);

        $file = UploadedFile::fake()->image('ijazah_resmi_sma.jpg', 600, 400);

        $result = $service->verifyDocument($file, 'ijazah', $application, false);

        // Assert uniform output structure
        $this->assertArrayHasKey('is_valid', $result);
        $this->assertArrayHasKey('verifier_mode', $result);
        $this->assertArrayHasKey('status_label', $result);
        $this->assertArrayHasKey('alasan_penolakan', $result);
        $this->assertArrayHasKey('yang_harus_diperbaiki', $result);
        $this->assertArrayHasKey('hasil_ekstraksi', $result);

        // Assert rejection structure on invalid file
        $rejectedFile = UploadedFile::fake()->image('rapor_semester_1_blur.jpg', 600, 400);
        $rejectedResult = $service->verifyDocument($rejectedFile, 'ijazah', $application, true);

        $this->assertFalse($rejectedResult['is_valid']);
        $this->assertNotEmpty($rejectedResult['alasan_penolakan']);
        $this->assertIsArray($rejectedResult['yang_harus_diperbaiki']);
        $this->assertNotEmpty($rejectedResult['yang_harus_diperbaiki']);
    }

    public function test_resend_email_card_endpoint()
    {
        Mail::fake();

        $resendEmail = 'resend_' . uniqid() . '@gmail.com';
        $user = User::factory()->create(['email' => $resendEmail, 'role' => 'applicant']);
        $application = Application::create([
            'user_id' => $user->id,
            'full_name' => 'Student Resend',
            'registration_number' => 'PMB-UNKLAB-2026-' . rand(10000, 99999),
            'status' => 'submitted',
        ]);

        $this->actingAs($user);

        $response = $this->post('/pmb/resend-card-email');
        $response->assertSessionHas('success');

        Mail::assertSent(RegistrationCardMail::class, function ($mail) use ($resendEmail) {
            return $mail->hasTo($resendEmail);
        });
    }
}
