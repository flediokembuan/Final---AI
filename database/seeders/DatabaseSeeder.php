<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Panitia PMB Default
        User::updateOrCreate(
            ['email' => 'admin@unklab.ac.id'],
            [
                'name' => 'Administrator PMB UNKLAB',
                'password' => Hash::make('unklab1965'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'panitia@unklab.ac.id'],
            [
                'name' => 'Panitia Penerimaan UNKLAB',
                'password' => Hash::make('unklab1965'),
                'role' => 'admin',
            ]
        );

        // 2. Applicant Utama: Gabriel Julian Mamahit (< 17 Tahun, Menunggu Approval)
        $gabrielUser = User::updateOrCreate(
            ['email' => 'gabriel.mamahit@gmail.com'],
            [
                'name' => 'Gabriel Julian Mamahit',
                'password' => Hash::make('password123'),
                'role' => 'applicant',
            ]
        );

        $gabrielApp = Application::updateOrCreate(
            ['user_id' => $gabrielUser->id],
            [
                'registration_number' => 'PMB-UNKLAB-2026-0042',
                'full_name' => 'Gabriel Julian Mamahit',
                'nik' => '7102012408080003',
                'birth_place' => 'Airmadidi',
                'birth_date' => '2008-08-24', // Usia < 17 tahun
                'gender' => 'Laki-laki',
                'whatsapp' => '+62 821-9876-5432',
                'address' => 'Jl. Arnold Mononutu No. 45, Airmadidi Atas, Minahasa Utara, Sulawesi Utara',
                'school_name' => 'SMA Negeri 1 Airmadidi',
                'nisn' => '0084592011',
                'graduation_year' => '2026',
                'faculty' => 'Fakultas Ilmu Komputer (FIK)',
                'study_program' => 'S1 Informatika (Akreditasi Unggul)',
                'is_under_17' => true,
                'status' => 'submitted',
            ]
        );

        // Dokumen Gabriel (KK valid, Ijazah valid, Pas Foto valid, KTP opsional lewat)
        ApplicationDocument::updateOrCreate(
            ['application_id' => $gabrielApp->id, 'document_type' => 'kk'],
            [
                'file_path' => 'demo/kk_gabriel.jpg',
                'original_filename' => 'KK_Mamahit.pdf',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'alasan_penolakan' => null,
                    'yang_harus_diperbaiki' => [],
                    'hasil_ekstraksi' => "No. KK: 7102012408080003\nKepala Keluarga: Dr. Ronny Mamahit\nStatus Calon: ANAK KANDUNG (GABRIEL)",
                    'accuracy' => '99.4%',
                    'notes' => 'Cap Disdukcapil & QR Barcode Valid. Terverifikasi kependudukan resmi.'
                ],
            ]
        );

        ApplicationDocument::updateOrCreate(
            ['application_id' => $gabrielApp->id, 'document_type' => 'ijazah'],
            [
                'file_path' => 'demo/ijazah_gabriel.jpg',
                'original_filename' => 'Ijazah_SKL_Legalized.pdf',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'alasan_penolakan' => null,
                    'yang_harus_diperbaiki' => [],
                    'hasil_ekstraksi' => "Nomor Seri Ijazah: DN-01/M-SMA/2026/08921\nNISN: 0084592011\nRata-rata Nilai: 91.80 (IPA)",
                    'accuracy' => '98.8%',
                    'notes' => 'Stempel basah legalisir kepala sekolah terdeteksi jelas dan valid.'
                ],
            ]
        );

        ApplicationDocument::updateOrCreate(
            ['application_id' => $gabrielApp->id, 'document_type' => 'pas_foto'],
            [
                'file_path' => 'demo/pasfoto_gabriel.jpg',
                'original_filename' => 'Pas_Foto_3x4_Resmi.jpg',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'alasan_penolakan' => null,
                    'yang_harus_diperbaiki' => [],
                    'hasil_ekstraksi' => "Kesesuaian Wajah: 99.1%\nLatar Belakang: Polos Solid Sesuai Standar\nPakaian: Kemeja Putih Formal Berkerah",
                    'accuracy' => '99.1%',
                    'notes' => 'Rasio wajah dan pose standar Dikti terpenuhi.'
                ],
            ]
        );

        // 3. Applicant Angelica Kalesaran (Disetujui)
        $angelicaUser = User::updateOrCreate(
            ['email' => 'angelica.k@gmail.com'],
            ['name' => 'Angelica Kalesaran', 'password' => Hash::make('password123'), 'role' => 'applicant']
        );
        $angelicaApp = Application::updateOrCreate(
            ['user_id' => $angelicaUser->id],
            [
                'registration_number' => 'PMB-UNKLAB-2026-0041',
                'full_name' => 'Angelica Kalesaran',
                'nik' => '7102025605060002',
                'birth_place' => 'Manado',
                'birth_date' => '2006-05-16',
                'gender' => 'Perempuan',
                'whatsapp' => '+62 813-4455-6677',
                'address' => 'Jl. Sam Ratulangi No. 12, Manado',
                'school_name' => 'SMA Katolik Rex Mundi Manado',
                'nisn' => '0061234567',
                'graduation_year' => '2025',
                'faculty' => 'Fakultas Keperawatan',
                'study_program' => 'S1 Keperawatan',
                'is_under_17' => false,
                'status' => 'approved',
            ]
        );

        ApplicationDocument::updateOrCreate(
            ['application_id' => $angelicaApp->id, 'document_type' => 'kk'],
            [
                'file_path' => 'demo/kk_sample.jpg',
                'original_filename' => 'KK_Kalesaran.pdf',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'accuracy' => '99.2%',
                    'hasil_ekstraksi' => 'Data KK Lengkap dan Tervalidasi',
                ],
            ]
        );
        ApplicationDocument::updateOrCreate(
            ['application_id' => $angelicaApp->id, 'document_type' => 'ijazah'],
            [
                'file_path' => 'demo/ijazah_sample.jpg',
                'original_filename' => 'Ijazah_Angelica.pdf',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'accuracy' => '98.5%',
                    'hasil_ekstraksi' => 'Ijazah Asli terlegalisir tervalidasi.',
                ],
            ]
        );
        ApplicationDocument::updateOrCreate(
            ['application_id' => $angelicaApp->id, 'document_type' => 'pas_foto'],
            [
                'file_path' => 'demo/foto_sample_f.jpg',
                'original_filename' => 'Pasfoto_Angelica.jpg',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'accuracy' => '99.0%',
                    'hasil_ekstraksi' => 'Foto formal tervalidasi.',
                ],
            ]
        );
        ApplicationDocument::updateOrCreate(
            ['application_id' => $angelicaApp->id, 'document_type' => 'ktp'],
            [
                'file_path' => 'demo/ktp_sample.jpg',
                'original_filename' => 'eKTP_Angelica.jpg',
                'is_valid' => true,
                'ai_feedback_json' => [
                    'is_valid' => true,
                    'status_label' => 'Terverifikasi AI ✓',
                    'accuracy' => '99.5%',
                    'hasil_ekstraksi' => 'NIK 7102025605060002 cocok dengan data biodata.',
                ],
            ]
        );

        // 4. Applicant David Lumintang (Ditolak / Perlu Revisi)
        $davidUser = User::updateOrCreate(
            ['email' => 'david.l@gmail.com'],
            ['name' => 'David Lumintang', 'password' => Hash::make('password123'), 'role' => 'applicant']
        );
        $davidApp = Application::updateOrCreate(
            ['user_id' => $davidUser->id],
            [
                'registration_number' => 'PMB-UNKLAB-2026-0040',
                'full_name' => 'David Lumintang',
                'nik' => '7171031201050004',
                'birth_place' => 'Tomohon',
                'birth_date' => '2005-01-12',
                'gender' => 'Laki-laki',
                'whatsapp' => '+62 852-9988-7766',
                'address' => 'Kel. Kakaskasen Dua, Tomohon Utara',
                'school_name' => 'SMA Kristen 1 Tomohon',
                'nisn' => '0059876543',
                'graduation_year' => '2024',
                'faculty' => 'Fakultas Ekonomi dan Bisnis',
                'study_program' => 'S1 Manajemen',
                'is_under_17' => false,
                'status' => 'rejected',
            ]
        );
        ApplicationDocument::updateOrCreate(
            ['application_id' => $davidApp->id, 'document_type' => 'ijazah'],
            [
                'file_path' => 'demo/ijazah_buram.jpg',
                'original_filename' => 'scan_dokumen_sekolah_david_rev.jpg',
                'is_valid' => false,
                'ai_feedback_json' => [
                    'is_valid' => false,
                    'status_label' => 'Dokumen Ditolak AI',
                    'alasan_penolakan' => 'Jenis berkas terdeteksi salah & resolusi buram. Berkas yang Anda lampirkan terbaca sebagai Rapor Semester 1 dan bukan Ijazah / SKL.',
                    'yang_harus_diperbaiki' => [
                        'Jenis berkas tidak sesuai: File terdeteksi sebagai Rapor, bukan Ijazah / SKL.',
                        'Kualitas gambar: Tulisan nomor seri ijazah dan NISN di bagian bawah buram/terpotong.',
                        'Yang harus diperbaiki: Unggah foto/scan penuh Ijazah atau SKL asli dengan pencahayaan jelas.',
                    ],
                    'hasil_ekstraksi' => 'Rapor Semester 1 (Bukan Ijazah). Nomor seri tidak terbaca.',
                    'accuracy' => '31.2%',
                ],
            ]
        );

        // 5. Applicant Stephanie Palit (Disetujui)
        $stephUser = User::updateOrCreate(
            ['email' => 'steph.palit@yahoo.com'],
            ['name' => 'Stephanie Palit', 'password' => Hash::make('password123'), 'role' => 'applicant']
        );
        $stephApp = Application::updateOrCreate(
            ['user_id' => $stephUser->id],
            [
                'registration_number' => 'PMB-UNKLAB-2026-0039',
                'full_name' => 'Stephanie Palit',
                'nik' => '7102034509060001',
                'birth_place' => 'Airmadidi',
                'birth_date' => '2006-09-05',
                'gender' => 'Perempuan',
                'whatsapp' => '+62 811-2233-4455',
                'address' => 'Sukur, Airmadidi, Minahasa Utara',
                'school_name' => 'SMA Unklab Airmadidi',
                'nisn' => '0069988776',
                'graduation_year' => '2025',
                'faculty' => 'Fakultas Ilmu Komputer (FIK)',
                'study_program' => 'S1 Sistem Informasi',
                'is_under_17' => false,
                'status' => 'approved',
            ]
        );

        // Tambahkan beberapa calon mahasiswa lagi untuk melengkapi variasi statistik
        $extraApplicants = [
            ['name' => 'Clint Jonathan Sompie', 'email' => 'clint.sompie@gmail.com', 'prodi' => 'S1 Informatika (Akreditasi Unggul)', 'fac' => 'Fakultas Ilmu Komputer (FIK)', 'status' => 'submitted', 'under_17' => false, 'reg' => 'PMB-UNKLAB-2026-0038'],
            ['name' => 'Nathania Wenas', 'email' => 'nathania.w@gmail.com', 'prodi' => 'S1 Keperawatan', 'fac' => 'Fakultas Keperawatan', 'status' => 'submitted', 'under_17' => true, 'reg' => 'PMB-UNKLAB-2026-0037'],
            ['name' => 'Reinaldo Runtu', 'email' => 'reinaldo.r@gmail.com', 'prodi' => 'S1 Akuntansi', 'fac' => 'Fakultas Ekonomi dan Bisnis', 'status' => 'approved', 'under_17' => false, 'reg' => 'PMB-UNKLAB-2026-0036'],
            ['name' => 'Fabiola Mandey', 'email' => 'fabiola.m@gmail.com', 'prodi' => 'S1 Sistem Informasi', 'fac' => 'Fakultas Ilmu Komputer (FIK)', 'status' => 'rejected', 'under_17' => false, 'reg' => 'PMB-UNKLAB-2026-0035'],
            ['name' => 'Brian Tielung', 'email' => 'brian.t@gmail.com', 'prodi' => 'S1 Pendidikan Bahasa Inggris', 'fac' => 'Fakultas Keguruan dan Ilmu Pendidikan', 'status' => 'submitted', 'under_17' => true, 'reg' => 'PMB-UNKLAB-2026-0034'],
        ];

        foreach ($extraApplicants as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                ['name' => $item['name'], 'password' => Hash::make('password123'), 'role' => 'applicant']
            );
            $app = Application::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'registration_number' => $item['reg'],
                    'full_name' => $item['name'],
                    'nik' => '7102' . rand(100000000000, 999999999999),
                    'birth_place' => 'Manado',
                    'birth_date' => $item['under_17'] ? '2008-09-10' : '2006-03-15',
                    'gender' => rand(0, 1) ? 'Laki-laki' : 'Perempuan',
                    'whatsapp' => '+62 812-' . rand(1000, 9999) . '-' . rand(1000, 9999),
                    'address' => 'Minahasa Utara, Sulawesi Utara',
                    'school_name' => 'SMA Negeri 1 Manado',
                    'nisn' => '00' . rand(10000000, 99999999),
                    'graduation_year' => '2026',
                    'faculty' => $item['fac'],
                    'study_program' => $item['prodi'],
                    'is_under_17' => $item['under_17'],
                    'status' => $item['status'],
                ]
            );

            // Dokumen sample
            ApplicationDocument::updateOrCreate(
                ['application_id' => $app->id, 'document_type' => 'kk'],
                [
                    'file_path' => 'demo/kk_sample.jpg',
                    'original_filename' => 'KK_Dokumen.pdf',
                    'is_valid' => true,
                    'ai_feedback_json' => [
                        'is_valid' => true,
                        'status_label' => 'Terverifikasi AI ✓',
                        'accuracy' => '99.0%',
                        'hasil_ekstraksi' => 'Data KK Valid & Terbaca',
                    ],
                ]
            );

            ApplicationDocument::updateOrCreate(
                ['application_id' => $app->id, 'document_type' => 'ijazah'],
                [
                    'file_path' => 'demo/ijazah_sample.jpg',
                    'original_filename' => 'Ijazah_Dokumen.pdf',
                    'is_valid' => $item['status'] !== 'rejected',
                    'ai_feedback_json' => [
                        'is_valid' => $item['status'] !== 'rejected',
                        'status_label' => $item['status'] !== 'rejected' ? 'Terverifikasi AI ✓' : 'Dokumen Ditolak AI',
                        'accuracy' => $item['status'] !== 'rejected' ? '98.5%' : '35.0%',
                        'alasan_penolakan' => $item['status'] !== 'rejected' ? null : 'Ijazah belum dilegalisir basah.',
                        'yang_harus_diperbaiki' => $item['status'] !== 'rejected' ? [] : ['Harap unggah ijazah berstempel basah legalisir.'],
                        'hasil_ekstraksi' => 'Ijazah Sekolah Menengah Atas',
                    ],
                ]
            );

            ApplicationDocument::updateOrCreate(
                ['application_id' => $app->id, 'document_type' => 'pas_foto'],
                [
                    'file_path' => 'demo/foto_sample_m.jpg',
                    'original_filename' => 'Pasfoto_Resmi.jpg',
                    'is_valid' => true,
                    'ai_feedback_json' => [
                        'is_valid' => true,
                        'status_label' => 'Terverifikasi AI ✓',
                        'accuracy' => '98.9%',
                        'hasil_ekstraksi' => 'Pas Foto 3x4 Latar Solid',
                    ],
                ]
            );
        }
    }
}
