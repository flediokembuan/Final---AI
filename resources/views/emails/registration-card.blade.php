<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Tanda Bukti Pendaftaran - PMB Universitas Klabat</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F1F5F9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #0A0A0A; -webkit-font-smoothing: antialiased;">

    <!-- Wrapper Table -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F1F5F9; padding: 32px 10px;">
        <tr>
            <td align="center">

                <!-- Main Container (Max 680px) -->
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 680px; background-color: #FFFFFF; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 40px rgba(0, 16, 91, 0.12); border: 1px solid #E2E8F0;">
                    
                    <!-- ===== TOP BRAND BAR ===== -->
                    <tr>
                        <td style="background-color: #00105B; padding: 20px 28px; text-align: left;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="52" valign="middle">
                                        <div style="width: 44px; height: 44px; background-color: #FFFFFF; border-radius: 12px; text-align: center; line-height: 44px; font-weight: 900; font-size: 18px; color: #00105B; letter-spacing: -0.5px;">
                                            UK
                                        </div>
                                    </td>
                                    <td valign="middle" style="padding-left: 12px;">
                                        <div style="font-size: 10px; font-weight: 800; color: #C9B5E0; letter-spacing: 2px; text-transform: uppercase;">
                                            PENERIMAAN MAHASISWA BARU (PMB)
                                        </div>
                                        <div style="font-size: 18px; font-weight: 900; color: #FFFFFF; letter-spacing: -0.3px; line-height: 1.2;">
                                            UNIVERSITAS KLABAT
                                        </div>
                                        <div style="font-size: 10px; color: #CBD5E1;">
                                            Jl. Arnold Mononutu, Airmadidi, Minahasa Utara, Sulawesi Utara 95371
                                        </div>
                                    </td>
                                    <td valign="middle" align="right">
                                        <div style="font-size: 10px; font-weight: 700; color: #A5B4FC; background-color: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 6px; white-space: nowrap;">
                                            TAHUN AKADEMIK {{ now()->year }}/{{ now()->year + 1 }}
                                        </div>
                                        <div style="font-size: 13px; font-weight: 900; color: #FFFFFF; text-transform: uppercase; margin-top: 4px; text-align: right;">
                                            KARTU TANDA BUKTI PENDAFTARAN
                                        </div>
                                        <div style="font-size: 10px; color: #6EE7B7; text-align: right;">
                                            Dokumen Resmi Elektronik Terverifikasi
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ===== GREETING SECTION ===== -->
                    <tr>
                        <td style="padding: 24px 28px 16px 28px; background-color: #FFFFFF;">
                            <h2 style="margin: 0 0 8px 0; font-size: 17px; font-weight: 800; color: #00105B;">
                                Yth. Sdr/i {{ $application->full_name ?? $user->name }},
                            </h2>
                            <p style="margin: 0 0 10px 0; font-size: 13px; line-height: 1.6; color: #374151;">
                                Salam hangat dari <strong>Panitia Penerimaan Mahasiswa Baru (PMB) Universitas Klabat</strong>.
                            </p>
                            <p style="margin: 0 0 10px 0; font-size: 13px; line-height: 1.6; color: #374151;">
                                Terima kasih telah menyelesaikan proses pengisian biodata dan pengunggahan berkas pendaftaran. Sistem <strong>AI Document Verifier PMB UNKLAB</strong> telah berhasil memeriksa seluruh berkas persyaratan wajib Anda secara otomatis dengan status <strong style="color: #059669;">LULUS AUDIT AI (100% Validated)</strong>.
                            </p>
                            
                            <!-- Status Notice Box -->
                            <div style="background-color: #F4EFFC; border-left: 4px solid #6061B6; border-radius: 8px; padding: 12px 16px; margin: 12px 0;">
                                <div style="font-size: 11px; font-weight: 800; color: #00105B; margin-bottom: 4px; text-transform: uppercase;">
                                    STATUS SAAT INI: ANTRIAN PEMERIKSAAN AKHIR PANITIA PMB (1x24 JAM)
                                </div>
                                <div style="font-size: 11px; line-height: 1.5; color: #4B5563;">
                                    Berkas Anda kini berada dalam antrean verifikasi akhir panitia kerja UNKLAB (estimasi <strong>1x24 jam kerja</strong>). Setelah disetujui, Anda akan menerima Surat Keputusan Penerimaan (SKL PMB) serta instruksi registrasi ulang dan pembayaran UKT via portal ini.
                                </div>
                            </div>

                            <p style="margin: 12px 0 4px 0; font-size: 12px; color: #6B7280; font-weight: 600;">
                                Berikut adalah salinan resmi Kartu Tanda Bukti Pendaftaran elektronik Anda:
                            </p>
                        </td>
                    </tr>

                    <!-- ===== VISUAL CARD: KARTU TANDA BUKTI PENDAFTARAN ===== -->
                    <tr>
                        <td style="padding: 0 24px 24px 24px;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 2px solid #00105B; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 16, 91, 0.1);">

                                <!-- Card Navy Header -->
                                <tr>
                                    <td style="background-color: #00105B; padding: 14px 20px; text-align: center;">
                                        <div style="font-size: 13px; font-weight: 900; color: #FFFFFF; letter-spacing: 0.8px; text-transform: uppercase;">
                                            KARTU TANDA BUKTI PENDAFTARAN — PMB UNIVERSITAS KLABAT
                                        </div>
                                        <div style="font-size: 10px; color: #C9B5E0; font-weight: 600; margin-top: 2px;">
                                            TAHUN AKADEMIK {{ now()->year }}/{{ now()->year + 1 }} &bull; JALUR REGULER GELOMBANG 1
                                        </div>
                                    </td>
                                </tr>

                                <!-- Status Badge Bar -->
                                <tr>
                                    <td style="background-color: #F8FAFC; padding: 10px 20px; border-bottom: 1px solid #E2E8F0; text-align: center;">
                                        @if($application->status === 'approved')
                                            <span style="display: inline-block; background-color: #D1FAE5; color: #065F46; font-size: 11px; font-weight: 900; padding: 5px 16px; border-radius: 20px; letter-spacing: 0.5px; border: 1px solid #6EE7B7;">
                                                &#9989; STATUS: PENDAFTARAN DISETUJUI (APPROVED)
                                            </span>
                                        @elseif($application->status === 'rejected')
                                            <span style="display: inline-block; background-color: #FEE2E2; color: #991B1B; font-size: 11px; font-weight: 900; padding: 5px 16px; border-radius: 20px; letter-spacing: 0.5px; border: 1px solid #FCA5A5;">
                                                STATUS: PENDAFTARAN DITOLAK — Silakan Hubungi Panitia PMB
                                            </span>
                                        @else
                                            <span style="display: inline-block; background-color: #EBE2F5; color: #00105B; font-size: 11px; font-weight: 900; padding: 5px 16px; border-radius: 20px; letter-spacing: 0.5px; border: 1px solid #A890D3;">
                                                &#9679; MENUNGGU APPROVAL PANITIA PMB
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Meta Bar -->
                                <tr>
                                    <td style="background-color: #F8FAFC; padding: 8px 20px; border-bottom: 1px solid #E2E8F0;">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="font-size: 11px; color: #64748B;">
                                                    <strong>Kategori:</strong> Sarjana (S1) &bull; <strong>Semester:</strong> Ganjil {{ now()->year }}/{{ now()->year + 1 }}
                                                </td>
                                                <td align="right" style="font-size: 11px; color: #6061B6; font-weight: 600;">
                                                    &#128274; Terenkripsi SHA-256 via Smart Engine UNKLAB
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Card Body: 3-Column Layout (mimics bukti.blade.php) -->
                                <tr>
                                    <td style="padding: 20px 20px; background-color: #FFFFFF;">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr valign="top">

                                                <!-- Column 1: Photo & Registration Code -->
                                                <td width="28%" style="padding-right: 14px; text-align: center;">
                                                    @php
                                                        $pasFoto = $application->documents->where('document_type', 'pas_foto')->first();
                                                    @endphp

                                                    <!-- Photo Box -->
                                                    <div style="width: 110px; height: 145px; border-radius: 12px; background-color: #1E293B; border: 2px solid rgba(0,16,91,0.2); overflow: hidden; display: inline-block; position: relative; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                                        @if($pasFoto && $pasFoto->file_path)
                                                            <img src="{{ url(Storage::url($pasFoto->file_path)) }}" alt="Foto Calon Mahasiswa" style="width: 110px; height: 145px; object-fit: cover; display: block;">
                                                        @else
                                                            <div style="width: 110px; height: 145px; background-color: #334155; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                                                                <div style="font-size: 36px; color: #64748B;">&#128100;</div>
                                                                <div style="font-size: 8px; color: #64748B; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">PMB UNKLAB</div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- UNKLAB / VERIFIED labels below photo -->
                                                    <div style="margin-top: 4px; font-size: 9px; font-weight: 900; color: #FFFFFF; background-color: #00105B; padding: 2px 8px; border-radius: 4px; display: inline-block;">UNKLAB</div>
                                                    <div style="margin-left: 4px; font-size: 9px; font-weight: 900; color: #FFFFFF; background-color: #059669; padding: 2px 8px; border-radius: 4px; display: inline-block;">VERIFIED</div>

                                                    <!-- Registration Number Box -->
                                                    <div style="margin-top: 10px; background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 10px 8px; text-align: center;">
                                                        <div style="font-size: 9px; font-weight: 800; color: #64748B; text-transform: uppercase; letter-spacing: 1px;">NOMOR PENDAFTARAN</div>
                                                        <div style="font-size: 12px; font-weight: 900; color: #00105B; font-family: 'Courier New', monospace; letter-spacing: 0.5px; margin-top: 3px; word-break: break-all;">
                                                            {{ $application->registration_number ?? 'PMB-UNKLAB-' . now()->year . '-' . str_pad($application->id ?? 0, 4, '0', STR_PAD_LEFT) }}
                                                        </div>
                                                        <div style="margin-top: 6px; padding-top: 6px; border-top: 1px solid #E2E8F0; font-size: 9px; color: #94A3B8;">
                                                            <div>Tanggal: <strong>{{ $application->created_at?->format('d M Y, H:i') }} WITA</strong></div>
                                                            <div style="margin-top: 3px; background-color: rgba(96,97,182,0.12); color: #00105B; font-size: 8px; font-weight: 700; padding: 2px 6px; border-radius: 4px; display: inline-block;">Jalur Reguler Gel. 1</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Column 2: Applicant Data (center) -->
                                                <td width="44%" style="padding-right: 14px;">
                                                    <div style="font-size: 10px; font-weight: 800; color: #00105B; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #E2E8F0; padding-bottom: 6px; margin-bottom: 10px;">
                                                        &#128100; Data Calon Mahasiswa
                                                        <span style="float: right; font-size: 9px; background-color: #F1F5F9; color: #64748B; padding: 2px 6px; border-radius: 4px; font-weight: 700;">IDENTITAS RESMI</span>
                                                    </div>

                                                    <!-- Full Name -->
                                                    <div style="background-color: #F8FAFC; border-radius: 10px; padding: 10px 12px; border: 1px solid #E2E8F0; margin-bottom: 8px;">
                                                        <div style="font-size: 9px; color: #94A3B8; font-weight: 700; text-transform: uppercase;">Nama Lengkap</div>
                                                        <div style="font-size: 15px; font-weight: 900; color: #0A0A0A; margin-top: 2px;">{{ $application->full_name ?? $user->name }}</div>
                                                    </div>

                                                    <!-- NIK & School -->
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 8px;">
                                                        <tr>
                                                            <td width="50%" style="padding-right: 4px;">
                                                                <div style="background-color: #F8FAFC; border-radius: 10px; padding: 8px 10px; border: 1px solid #E2E8F0;">
                                                                    <div style="font-size: 9px; color: #94A3B8; font-weight: 700; text-transform: uppercase;">NIK (Kependudukan)</div>
                                                                    <div style="font-size: 11px; font-weight: 800; color: #0A0A0A; font-family: 'Courier New', monospace; margin-top: 2px;">{{ $application->nik ?? '-' }}</div>
                                                                </div>
                                                            </td>
                                                            <td width="50%" style="padding-left: 4px;">
                                                                <div style="background-color: #F8FAFC; border-radius: 10px; padding: 8px 10px; border: 1px solid #E2E8F0;">
                                                                    <div style="font-size: 9px; color: #94A3B8; font-weight: 700; text-transform: uppercase;">Asal Sekolah</div>
                                                                    <div style="font-size: 11px; font-weight: 700; color: #0A0A0A; margin-top: 2px;">{{ $application->school_name ?? '-' }}</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <!-- Email -->
                                                    <div style="background-color: #F8FAFC; border-radius: 10px; padding: 8px 12px; border: 1px solid #E2E8F0; margin-bottom: 8px;">
                                                        <div style="font-size: 9px; color: #94A3B8; font-weight: 700; text-transform: uppercase;">Email Terdaftar</div>
                                                        <div style="font-size: 11px; font-weight: 700; color: #0A0A0A; margin-top: 2px;">{{ $user->email }}</div>
                                                    </div>

                                                    <!-- Faculty & Prodi -->
                                                    <div style="background: linear-gradient(135deg, rgba(0,16,91,0.06) 0%, rgba(96,97,182,0.1) 100%); border-radius: 12px; padding: 10px 12px; border: 1px solid rgba(96,97,182,0.25);">
                                                        <div style="font-size: 9px; font-weight: 800; color: #6061B6; text-transform: uppercase; letter-spacing: 0.5px;">FAKULTAS &amp; PROGRAM STUDI PILIHAN:</div>
                                                        <div style="font-size: 13px; font-weight: 900; color: #00105B; margin-top: 3px;">{{ $application->faculty ?? '-' }}</div>
                                                        <div style="font-size: 11px; font-weight: 700; color: #374151;">&#8226; {{ $application->study_program ?? '-' }}</div>
                                                    </div>

                                                    <!-- Age status note -->
                                                    <div style="background-color: #EBE2F5; border-radius: 10px; padding: 8px 12px; border: 1px solid rgba(160,144,211,0.4); margin-top: 8px; font-size: 10px; color: #00105B;">
                                                        <strong>Status Usia:</strong>
                                                        @if($application->is_under_17)
                                                            (KTP Opsional &mdash; Terverifikasi via Kartu Keluarga)
                                                        @else
                                                            (e-KTP &amp; Kartu Keluarga Terverifikasi)
                                                        @endif
                                                    </div>
                                                </td>

                                                <!-- Column 3: AI Audit & QR Code -->
                                                <td width="28%">
                                                    <div style="font-size: 10px; font-weight: 800; color: #00105B; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #E2E8F0; padding-bottom: 6px; margin-bottom: 10px;">
                                                        Audit AI
                                                        <span style="float: right; font-size: 9px; background-color: #D1FAE5; color: #065F46; padding: 2px 6px; border-radius: 4px; font-weight: 700; border: 1px solid #A7F3D0;">Lulus Engine</span>
                                                    </div>

                                                    <!-- AI Audit Checklist -->
                                                    @php
                                                        $emailAuditDocs = [
                                                            'kk'       => 'Kartu Keluarga (KK)',
                                                            'ijazah'   => 'Ijazah / SKL',
                                                            'pas_foto' => 'Pas Foto Formal',
                                                            'ktp'      => 'KTP Pendaftar',
                                                        ];
                                                    @endphp
                                                    @foreach($emailAuditDocs as $dtype => $dlabel)
                                                        @php
                                                            $edoc = $application->documents->where('document_type', $dtype)->first();
                                                            $isKtp17 = ($dtype === 'ktp' && $application->is_under_17 && !$edoc);
                                                            if ($isKtp17) {
                                                                $etxt   = 'Opsional (< 17 Thn)';
                                                                $ebg    = '#EBE2F5';
                                                                $ecolor = '#00105B';
                                                            } elseif ($edoc && $edoc->is_valid) {
                                                                $etxt   = 'Valid ✓';
                                                                $ebg    = '#D1FAE5';
                                                                $ecolor = '#065F46';
                                                            } elseif ($edoc && !$edoc->is_valid) {
                                                                $etxt   = 'Ditolak AI ✗';
                                                                $ebg    = '#FEE2E2';
                                                                $ecolor = '#991B1B';
                                                            } else {
                                                                $etxt   = 'Belum Diunggah';
                                                                $ebg    = '#F1F5F9';
                                                                $ecolor = '#64748B';
                                                            }
                                                        @endphp
                                                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 7px 10px; border-radius: 8px; background-color: #F8FAFC; border: 1px solid #E2E8F0; margin-bottom: 5px;">
                                                            <span style="font-size: 10px; font-weight: 600; color: #374151;">{{ $dlabel }}</span>
                                                            <span style="font-size: 9px; font-weight: 800; padding: 2px 6px; border-radius: 6px; background-color: {{ $ebg }}; color: {{ $ecolor }}; white-space: nowrap;">{{ $etxt }}</span>
                                                        </div>
                                                    @endforeach

                                                    <!-- QR Code Section -->
                                                    <div style="margin-top: 12px; padding: 12px 10px; background-color: #F8FAFC; border-radius: 12px; border: 1px solid #E2E8F0; text-align: center;">
                                                        <div style="font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94A3B8; margin-bottom: 8px;">KODE KEABSAHAN DOKUMEN</div>
                                                        <!-- SVG QR Code (decorative) -->
                                                        <div style="width: 80px; height: 80px; background-color: #FFFFFF; border-radius: 10px; border: 1px solid #E2E8F0; display: inline-block; padding: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
                                                            <svg viewBox="0 0 100 100" fill="#00105B" style="width: 68px; height: 68px;">
                                                                <!-- Corners -->
                                                                <rect x="5" y="5" width="28" height="28" fill="none" stroke="#00105B" stroke-width="6"/>
                                                                <rect x="13" y="13" width="12" height="12"/>
                                                                <rect x="67" y="5" width="28" height="28" fill="none" stroke="#00105B" stroke-width="6"/>
                                                                <rect x="75" y="13" width="12" height="12"/>
                                                                <rect x="5" y="67" width="28" height="28" fill="none" stroke="#00105B" stroke-width="6"/>
                                                                <rect x="13" y="75" width="12" height="12"/>
                                                                <!-- Matrix Dots -->
                                                                <rect x="42" y="8" width="6" height="6"/>
                                                                <rect x="52" y="8" width="6" height="6"/>
                                                                <rect x="42" y="20" width="6" height="6"/>
                                                                <rect x="42" y="32" width="6" height="6"/>
                                                                <rect x="10" y="42" width="6" height="6"/>
                                                                <rect x="22" y="42" width="6" height="6"/>
                                                                <rect x="34" y="42" width="6" height="6"/>
                                                                <rect x="46" y="42" width="8" height="8"/>
                                                                <rect x="58" y="42" width="6" height="6"/>
                                                                <rect x="70" y="42" width="6" height="6"/>
                                                                <rect x="82" y="42" width="6" height="6"/>
                                                                <rect x="42" y="56" width="6" height="6"/>
                                                                <rect x="54" y="56" width="6" height="6"/>
                                                                <rect x="68" y="56" width="8" height="8"/>
                                                                <rect x="80" y="56" width="6" height="6"/>
                                                                <rect x="42" y="72" width="6" height="6"/>
                                                                <rect x="54" y="72" width="8" height="8"/>
                                                                <rect x="70" y="72" width="6" height="6"/>
                                                                <rect x="82" y="72" width="6" height="6"/>
                                                                <rect x="42" y="86" width="6" height="6"/>
                                                                <rect x="60" y="86" width="6" height="6"/>
                                                                <rect x="74" y="86" width="6" height="6"/>
                                                            </svg>
                                                        </div>
                                                        <div style="font-size: 8px; color: #64748B; margin-top: 6px;">Scan untuk Cek Keabsahan<br>Panitia PMB UNKLAB</div>
                                                        <div style="font-size: 9px; color: #00105B; font-family: 'Courier New', monospace; font-weight: 800; margin-top: 3px;">
                                                            SIG: {{ strtoupper(substr(md5($application->registration_number ?? $application->id), 0, 4)) }}-UK-{{ now()->year }}-{{ strtoupper(substr(md5($application->registration_number ?? $application->id), 4, 4)) }}
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Card Footer -->
                                <tr>
                                    <td style="background-color: #F8FAFC; padding: 10px 20px; border-top: 1px solid #E2E8F0;">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="font-size: 10px; color: #64748B;">
                                                    &#9989; Dokumen ini diterbitkan sah secara sistem oleh Biro Administrasi Akademik &amp; Penerimaan UNKLAB.
                                                    &bull; Waktu: {{ now()->format('d M Y, H:i') }} WITA
                                                </td>
                                                <td align="right" style="font-size: 10px; font-weight: 700; color: #334155; font-family: 'Courier New', monospace; white-space: nowrap;">
                                                    KODE: {{ $application->registration_number ?? '-' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- ===== NEXT STEPS SECTION ===== -->
                    <tr>
                        <td style="padding: 0 28px 24px 28px; background-color: #FFFFFF;">
                            <h3 style="margin: 0 0 10px 0; font-size: 14px; font-weight: 800; color: #00105B;">
                                Langkah Selanjutnya Calon Mahasiswa
                            </h3>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="50%" style="padding-right: 6px; vertical-align: top;">
                                        <div style="background-color: #F8FAFC; border-radius: 10px; padding: 12px 14px; border: 1px solid #E2E8F0;">
                                            <div style="font-size: 11px; font-weight: 800; color: #00105B; margin-bottom: 4px;">1. Simpan / Cetak Bukti Pendaftaran ini</div>
                                            <div style="font-size: 11px; color: #64748B; line-height: 1.6;">Simpan dokumen resmi ini atau cetak salinan fisik sebagai bukti sah pendaftaran Anda di Universitas Klabat.</div>
                                        </div>
                                    </td>
                                    <td width="50%" style="padding-left: 6px; vertical-align: top;">
                                        <div style="background-color: #F8FAFC; border-radius: 10px; padding: 12px 14px; border: 1px solid #E2E8F0;">
                                            <div style="font-size: 11px; font-weight: 800; color: #00105B; margin-bottom: 4px;">2. Pantau Status Approval Panitia PMB</div>
                                            <div style="font-size: 11px; color: #64748B; line-height: 1.6;">Proses verifikasi akhir panitia berlangsung dalam 1x24 jam kerja. Pemberitahuan kelulusan berkas via Email.</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 18px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('pmb.bukti') }}" target="_blank" style="display: inline-block; background-color: #00105B; color: #FFFFFF; font-size: 13px; font-weight: 800; padding: 13px 32px; border-radius: 12px; text-decoration: none; box-shadow: 0 4px 14px rgba(0, 16, 91, 0.3); letter-spacing: 0.3px;">
                                            Buka Kartu Bukti di Portal PMB &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ===== EMAIL FOOTER ===== -->
                    <tr>
                        <td style="background-color: #F8FAFC; padding: 20px 28px; text-align: center; border-top: 1px solid #E2E8F0; font-size: 11px; color: #6B7280; line-height: 1.6;">
                            <div style="font-weight: 800; color: #374151;">Biro Penerimaan &amp; Pemasaran Mahasiswa Baru Universitas Klabat</div>
                            <div>Email: <a href="mailto:pmb@unklab.ac.id" style="color: #6061B6; text-decoration: none; font-weight: 700;">pmb@unklab.ac.id</a> &nbsp;|&nbsp; WhatsApp: +62 811-432-1926</div>
                            <div style="margin-top: 10px; color: #9CA3AF; font-size: 10px;">
                                Email ini dibuat secara otomatis oleh SIPMB-AI UNKLAB. Anda menerima email ini karena mendaftar sebagai calon mahasiswa di Universitas Klabat.<br>
                                &copy; {{ now()->year }} Universitas Klabat — Semua hak dilindungi.
                            </div>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
