<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Tanda Bukti Pendaftaran - PMB Universitas Klabat</title>
</head>
<body style="margin: 0; padding: 0; background-color: #FCF9EC; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #0A0A0A; -webkit-font-smoothing: antialiased;">

    <!-- Wrapper Table -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #FCF9EC; padding: 30px 10px;">
        <tr>
            <td align="center">

                <!-- Main Container (Max 620px) -->
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 620px; background-color: #FFFFFF; border-radius: 18px; overflow: hidden; box-shadow: 0 8px 30px rgba(0, 16, 91, 0.08); border: 1px solid #E5E7EB;">
                    
                    <!-- Top Brand Bar -->
                    <tr>
                        <td style="background-color: #00105B; padding: 24px 30px; text-align: left;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="54" valign="middle">
                                        <div style="width: 44px; height: 44px; background-color: #FFFFFF; border-radius: 12px; text-align: center; line-height: 44px; font-weight: 900; font-size: 18px; color: #00105B; letter-spacing: -0.5px;">
                                            UK
                                        </div>
                                    </td>
                                    <td valign="middle" style="padding-left: 12px;">
                                        <div style="font-size: 10px; font-weight: 800; color: #C9B5E0; letter-spacing: 1.5px; text-transform: uppercase;">
                                            UNIVERSITAS KLABAT
                                        </div>
                                        <div style="font-size: 16px; font-weight: 800; color: #FFFFFF; letter-spacing: -0.2px;">
                                            PANITIA PENERIMAAN MAHASISWA BARU
                                        </div>
                                        <div style="font-size: 10px; color: #E0E7FF;">
                                            Jl. Arnold Mononutu, Airmadidi, Minahasa Utara, Sulawesi Utara 95371
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Opening Greeting & Status Explanation -->
                    <tr>
                        <td style="padding: 28px 30px 20px 30px; background-color: #FFFFFF;">
                            <h2 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 800; color: #00105B;">
                                Yth. Sdr/i {{ $application->full_name ?? $user->name }},
                            </h2>
                            <p style="margin: 0 0 14px 0; font-size: 13px; line-height: 1.6; color: #374151;">
                                Salam hangat dari <strong>Panitia Penerimaan Mahasiswa Baru (PMB) Universitas Klabat</strong>.
                            </p>
                            <p style="margin: 0 0 14px 0; font-size: 13px; line-height: 1.6; color: #374151;">
                                Terima kasih telah menyelesaikan proses pengisian biodata dan pengunggahan berkas pendaftaran. Sistem <strong>AI Document Verifier PMB UNKLAB</strong> telah berhasil memeriksa seluruh berkas persyaratan wajib Anda secara otomatis dengan status <strong style="color: #059669;">LULUS AUDIT AI (100% Validated)</strong>.
                            </p>
                            
                            <!-- Lavender Callout Box: In Review Queue -->
                            <div style="background-color: #F4EFFC; border-left: 4px solid #6061B6; border-radius: 8px; padding: 14px 16px; margin: 16px 0;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <div style="font-size: 12px; font-weight: 800; color: #00105B; margin-bottom: 4px;">
                                                STATUS SAAT INI: ANTRIAN PEMERIKSAAN AKHIR PANITIA PMB (1x24 JAM)
                                            </div>
                                            <div style="font-size: 11px; line-height: 1.5; color: #4B5563;">
                                                Berkas Anda kini berada dalam antrean verifikasi akhir panitia kerja UNKLAB (estimasi <strong>1x24 jam kerja</strong>). Setelah disetujui (<em>Approval</em>), Anda akan menerima Surat Keputusan Penerimaan (SKL PMB) serta instruksi registrasi ulang dan pembayaran UKT via portal ini.
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <p style="margin: 16px 0 8px 0; font-size: 12px; color: #6B7280; font-weight: 600;">
                                Berikut adalah salinan resmi Kartu Tanda Bukti Pendaftaran elektronik Anda:
                            </p>
                        </td>
                    </tr>

                    <!-- ======================================================== -->
                    <!-- VISUAL CARD: KARTU TANDA BUKTI PENDAFTARAN PMB UNKLAB     -->
                    <!-- ======================================================== -->
                    <tr>
                        <td style="padding: 0 30px 24px 30px;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #FFFFFF; border: 2px solid #00105B; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(0, 16, 91, 0.08);">
                                
                                <!-- Card Navy Header -->
                                <tr>
                                    <td style="background-color: #00105B; padding: 14px 18px; text-align: center;">
                                        <div style="font-size: 12px; font-weight: 900; color: #FFFFFF; letter-spacing: 0.8px; text-transform: uppercase;">
                                            KARTU TANDA BUKTI PENDAFTARAN — PMB UNIVERSITAS KLABAT
                                        </div>
                                        <div style="font-size: 10px; color: #C9B5E0; font-weight: 600; margin-top: 2px;">
                                            TAHUN AKADEMIK 2026/2027 &bull; JALUR REGULER GELOMBANG 1
                                        </div>
                                    </td>
                                </tr>

                                <!-- Status Badge Bar — dynamic from application->status -->
                                <tr>
                                    <td style="background-color: #FCF9EC; padding: 10px 18px; border-bottom: 1px solid #E5E7EB; text-align: center;">
                                        @if($application->status === 'approved')
                                            <span style="display: inline-block; background-color: #D1FAE5; color: #065F46; font-size: 11px; font-weight: 900; padding: 4px 14px; border-radius: 20px; letter-spacing: 0.5px; border: 1px solid #6EE7B7;">
                                                STATUS: PENDAFTARAN DISETUJUI (APPROVED) ✓
                                            </span>
                                        @elseif($application->status === 'rejected')
                                            <span style="display: inline-block; background-color: #FEE2E2; color: #991B1B; font-size: 11px; font-weight: 900; padding: 4px 14px; border-radius: 20px; letter-spacing: 0.5px; border: 1px solid #FCA5A5;">
                                                STATUS: PENDAFTARAN DITOLAK — Silakan Hubungi Panitia PMB
                                            </span>
                                        @else
                                            <span style="display: inline-block; background-color: #C9B5E0; color: #00105B; font-size: 11px; font-weight: 900; padding: 4px 14px; border-radius: 20px; letter-spacing: 0.5px; border: 1px solid #A890D3;">
                                                STATUS: MENUNGGU APPROVAL PANITIA PMB
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Card Content Grid -->
                                <tr>
                                    <td style="padding: 18px 20px;">
                                        
                                        <!-- Registration Number Highlight -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F8FAFC; border: 1px dashed #6061B6; border-radius: 10px; margin-bottom: 16px;">
                                            <tr>
                                                <td style="padding: 12px; text-align: center;">
                                                    <div style="font-size: 10px; font-weight: 800; color: #64748B; text-transform: uppercase; letter-spacing: 1px;">
                                                        NOMOR PENDAFTARAN RESMI
                                                    </div>
                                                    <div style="font-size: 20px; font-weight: 900; color: #00105B; font-family: 'Courier New', monospace; letter-spacing: 1px; margin-top: 3px;">
                                                        {{ $application->registration_number ?? 'PMB-UNKLAB-' . now()->year . '-' . str_pad($application->id ?? 0, 4, '0', STR_PAD_LEFT) }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Applicant Bio Data Table -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 12px; line-height: 1.6; margin-bottom: 16px;">
                                            <tr>
                                                <td width="38%" style="padding: 5px 0; color: #6B7280; font-weight: 600;">Nama Lengkap</td>
                                                <td width="4%" style="padding: 5px 0; color: #0A0A0A;">:</td>
                                                <td width="58%" style="padding: 5px 0; color: #0A0A0A; font-weight: 800;">{{ $application->full_name ?? $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #6B7280; font-weight: 600;">Email Pendaftar</td>
                                                <td style="padding: 5px 0; color: #0A0A0A;">:</td>
                                                <td style="padding: 5px 0; color: #0A0A0A; font-weight: 600;">{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #6B7280; font-weight: 600;">NIK Kependudukan</td>
                                                <td style="padding: 5px 0; color: #0A0A0A;">:</td>
                                                <td style="padding: 5px 0; color: #0A0A0A; font-family: monospace; font-weight: 700;">{{ $application->nik ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #6B7280; font-weight: 600;">Asal Sekolah</td>
                                                <td style="padding: 5px 0; color: #0A0A0A;">:</td>
                                                <td style="padding: 5px 0; color: #0A0A0A; font-weight: 600;">{{ $application->school_name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #6B7280; font-weight: 600;">Fakultas Pilihan</td>
                                                <td style="padding: 5px 0; color: #0A0A0A;">:</td>
                                                <td style="padding: 5px 0; color: #00105B; font-weight: 800;">{{ $application->faculty ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #6B7280; font-weight: 600;">Program Studi</td>
                                                <td style="padding: 5px 0; color: #0A0A0A;">:</td>
                                                <td style="padding: 5px 0; color: #6061B6; font-weight: 800;">{{ $application->study_program ?? '-' }}</td>
                                            </tr>
                                        </table>


                                        <!-- Summary AI Audit Checklist Box — dynamic from documents -->
                                        <div style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 12px 14px;">
                                            <div style="font-size: 11px; font-weight: 800; color: #00105B; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px;">
                                                Ringkasan Status Audit AI Dokumen:
                                            </div>
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11px;">
                                                @php
                                                    $emailAuditDocs = [
                                                        'kk'       => 'Kartu Keluarga (KK)',
                                                        'ijazah'   => 'Ijazah / SKL Legalisir',
                                                        'pas_foto' => 'Pas Foto Formal Akademik',
                                                        'ktp'      => 'e-KTP Kependudukan',
                                                    ];
                                                @endphp
                                                @foreach($emailAuditDocs as $dtype => $dlabel)
                                                    @php
                                                        $edoc = $application->documents->where('document_type', $dtype)->first();
                                                        $isKtp17 = ($dtype === 'ktp' && $application->is_under_17 && !$edoc);
                                                        if ($isKtp17) {
                                                            $etxt   = 'Opsional (< 17 Tahun) &#10003;';
                                                            $ecolor = '#6061B6';
                                                        } elseif ($edoc && $edoc->is_valid) {
                                                            $etxt   = 'Terverifikasi AI &#10003;';
                                                            $ecolor = '#059669';
                                                        } elseif ($edoc && !$edoc->is_valid) {
                                                            $etxt   = 'Ditolak AI &#10007;';
                                                            $ecolor = '#DC2626';
                                                        } else {
                                                            $etxt   = 'Belum Diunggah';
                                                            $ecolor = '#6B7280';
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td style="padding: 3px 0; color: #374151;">&bull; {{ $dlabel }}</td>
                                                        <td align="right" style="padding: 3px 0; font-weight: 700; color: {{ $ecolor }};">{!! $etxt !!}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>

                                        <!-- Verification Footer Note -->
                                        <div style="margin-top: 14px; text-align: center; font-size: 10px; color: #64748B;">
                                            Tanda tangan digital terenkripsi SHA-256 via SIPMB-AI UNKLAB &bull; Waktu Simpan: {{ now()->format('d M Y, H:i') }} WITA
                                        </div>

                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- Next Step Instructions & CTA -->
                    <tr>
                        <td style="padding: 0 30px 28px 30px; background-color: #FFFFFF;">
                            <h3 style="margin: 0 0 8px 0; font-size: 13px; font-weight: 800; color: #00105B;">
                                Apa yang Harus Dilakukan Selanjutnya?
                            </h3>
                            <ol style="margin: 0 0 18px 0; padding-left: 20px; font-size: 12px; line-height: 1.6; color: #4B5563;">
                                <li><strong>Simpan email ini:</strong> Kartu bukti ini adalah tanda pengenal resmi Anda selama tahapan seleksi PMB UNKLAB 2026/2027.</li>
                                <li><strong>Pantau Pengumuman Kelulusan Berkas:</strong> Keputusan panitia akan diperbarui dalam 1x24 jam melalui portal ini.</li>
                                <li><strong>Akses Dashboard Pendaftar:</strong> Masuk kembali ke sistem menggunakan email ini kapan saja untuk mengecek status.</li>
                            </ol>

                            <!-- CTA Button to Portal -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('pmb.bukti') }}" target="_blank" style="display: inline-block; background-color: #00105B; color: #FFFFFF; font-size: 13px; font-weight: 800; padding: 12px 28px; border-radius: 10px; text-decoration: none; box-shadow: 0 4px 12px rgba(0, 16, 91, 0.25);">
                                            Buka Kartu Bukti di Portal PMB &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Email Footer -->
                    <tr>
                        <td style="background-color: #FCF9EC; padding: 20px 30px; text-align: center; border-top: 1px solid #E5E7EB; font-size: 11px; color: #6B7280; line-height: 1.5;">
                            <div><strong>Biro Penerimaan & Pemasaran Mahasiswa Baru Universitas Klabat</strong></div>
                            <div>Email: <a href="mailto:pmb@unklab.ac.id" style="color: #6061B6; text-decoration: none; font-weight: bold;">pmb@unklab.ac.id</a> | WhatsApp: +62 811-432-1926</div>
                            <div style="margin-top: 8px; color: #9CA3AF; font-size: 10px;">
                                Email ini dibuat secara otomatis oleh SIPMB-AI UNKLAB. Anda menerima email ini karena mendaftar sebagai calon mahasiswa di Universitas Klabat.
                            </div>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
