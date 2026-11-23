<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PmbPortalTest extends TestCase
{
    public function test_landing_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('PMB UNIVERSITAS KLABAT');
    }

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Masuk Portal PMB UNKLAB');
    }

    public function test_applicant_email_auto_creates_account_and_redirects_to_biodata()
    {
        $response = $this->post('/login', [
            'email' => 'maba_baru@gmail.com',
            'password' => null,
        ]);

        $response->assertRedirect('/pmb/biodata');
        $this->assertDatabaseHas('users', [
            'email' => 'maba_baru@gmail.com',
            'role' => 'applicant',
        ]);
    }

    public function test_admin_unklab_email_requires_valid_password_and_redirects_to_admin_dashboard()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@unklab.ac.id'],
            [
                'name' => 'Administrator PMB UNKLAB',
                'password' => Hash::make('unklab1965'),
                'role' => 'admin',
            ]
        );
        $admin->update(['password' => Hash::make('unklab1965')]);

        // Invalid password
        $failResponse = $this->post('/login', [
            'email' => 'admin@unklab.ac.id',
            'password' => 'wrongpass',
        ]);
        $failResponse->assertSessionHasErrors('email');

        // Valid password
        $successResponse = $this->post('/login', [
            'email' => 'admin@unklab.ac.id',
            'password' => 'unklab1965',
        ]);
        $successResponse->assertRedirect('/admin/dashboard');
    }

    public function test_biodata_submission_detects_under_17_age_correctly()
    {
        $user = User::factory()->create(['role' => 'applicant']);
        $this->actingAs($user);

        // In 2026, born in 2010 -> Age 16 (< 17 years old)
        $response = $this->post('/pmb/biodata', [
            'full_name' => 'Gabriel Julian Mamahit',
            'nik' => '7102012408080003',
            'birth_place' => 'Airmadidi',
            'birth_date' => '2010-08-24',
            'gender' => 'Laki-laki',
            'whatsapp' => '+62 821-9876-5432',
            'address' => 'Jl. Arnold Mononutu No. 45, Airmadidi',
            'school_name' => 'SMA Negeri 1 Airmadidi',
            'nisn' => '0084592011',
            'graduation_year' => '2026',
            'faculty' => 'Fakultas Ilmu Komputer (FIK)',
            'study_program' => 'S1 Informatika (Akreditasi Unggul)',
            'action' => 'next',
        ]);

        $response->assertRedirect('/pmb/dokumen');
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'is_under_17' => true,
        ]);
    }

    public function test_documents_page_is_accessible()
    {
        $user = User::factory()->create(['role' => 'applicant']);
        Application::create([
            'user_id' => $user->id,
            'full_name' => 'Test Applicant',
            'birth_date' => '2008-08-24',
            'is_under_17' => true,
        ]);
        $this->actingAs($user);

        $response = $this->get('/pmb/dokumen');
        $response->assertStatus(200);
        $response->assertSee('Langkah 2: Unggah Berkas');
    }

    public function test_ai_document_verifier_returns_valid_json_for_normal_document()
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'applicant']);
        $this->actingAs($user);

        $fakeFile = UploadedFile::fake()->create('Kartu_Keluarga_Resmi.pdf', 500, 'application/pdf');

        $response = $this->postJson('/pmb/dokumen/verify', [
            'document_file' => $fakeFile,
            'document_type' => 'kk',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_valid' => true,
            'status_label' => 'Terverifikasi AI ✓',
        ]);
    }

    public function test_ai_document_verifier_returns_invalid_json_for_rejected_simulation()
    {
        Storage::fake('public');
        $user = User::factory()->create(['role' => 'applicant']);
        $this->actingAs($user);

        $fakeFile = UploadedFile::fake()->create('Rapor_Semester_1.pdf', 500, 'application/pdf');

        $response = $this->postJson('/pmb/dokumen/verify', [
            'document_file' => $fakeFile,
            'document_type' => 'ijazah',
            'simulate_reject' => true,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_valid' => false,
        ]);
        $this->assertNotEmpty($response->json('yang_harus_diperbaiki'));
    }

    public function test_admin_can_approve_and_reject_applicant()
    {
        $admin = User::where('email', 'panitia@unklab.ac.id')->first();
        $this->actingAs($admin);

        $app = Application::first();

        // Test approve
        $resApprove = $this->post("/admin/applicant/{$app->id}/approve");
        $resApprove->assertSessionHas('success');
        $this->assertEquals('approved', $app->fresh()->status);

        // Test reject
        $resReject = $this->post("/admin/applicant/{$app->id}/reject");
        $resReject->assertSessionHas('error');
        $this->assertEquals('rejected', $app->fresh()->status);
    }
}
