@extends('layouts.app')

@section('title', 'Bukti Pendaftaran PMB Universitas Klabat')

@section('content')
<!-- Top Navbar -->
<header class="bg-white border-b border-slate-200 sticky top-0 z-40 no-print">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-unklab-navy text-white flex items-center justify-center font-bold text-sm shadow-sm">
                UK
            </div>
            <div>
                <span class="block text-sm sm:text-base font-extrabold text-unklab-navy uppercase tracking-tight">Universitas Klabat</span>
                <span class="block text-[10px] text-unklab-periwinkle font-bold tracking-wider">SMART PMB ADMISSION</span>
            </div>
        </a>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-xs font-bold text-unklab-black">{{ auth()->user()->name }}</div>
                <div class="text-[10px] text-slate-500">{{ auth()->user()->email }}</div>
            </div>
            <div class="w-8 h-8 rounded-full bg-unklab-navy text-white flex items-center justify-center font-bold text-xs">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-slate-100 transition-colors" title="Keluar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Stepper (Single Content Stepper) -->
    <div class="bg-white rounded-2xl p-4 mb-6 border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
        <div class="flex items-center gap-2 sm:gap-3 text-xs font-bold overflow-x-auto w-full sm:w-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>1. Biodata & Prodi</span>
            </span>
            <span class="text-slate-300">&rarr;</span>

            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>2. Verifikasi AI</span>
            </span>
            <span class="text-slate-300">&rarr;</span>

            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-unklab-navy text-white shadow-sm flex-shrink-0">
                <span class="w-5 h-5 rounded-full bg-white text-unklab-navy flex items-center justify-center text-[10px] font-black">3</span>
                <span>3. Finalisasi & Kartu</span>
            </div>
        </div>

        <div class="flex items-center gap-2 text-xs font-semibold text-slate-700 bg-slate-50 px-3 py-1 rounded-full border border-slate-200">
            <span>Nomor Registrasi: <strong class="text-unklab-navy font-mono">{{ $application->registration_number }}</strong></span>
        </div>
    </div>

    <!-- Email Confirmation Notification Banner -->
    @if($application->confirmation_email_sent_at)
        <div class="mb-6 bg-[#FCF9EC] border border-unklab-periwinkle/30 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm no-print">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-unklab-navy text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-5 h-5 text-unklab-lavender" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs sm:text-sm font-extrabold text-unklab-navy">Kartu Bukti Pendaftaran Terkirim ke Email</span>
                        <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full">Email Otomatis Terkirim</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-0.5">
                        Salinan resmi dalam format <strong>HTML Email Card</strong> telah dikirim ke <strong class="text-unklab-black font-semibold">{{ $application->user?->email }}</strong> pada {{ $application->confirmation_email_sent_at->format('d M Y, H:i') }} WITA.
                    </p>
                </div>
            </div>

            <form action="{{ route('pmb.resend_card_email') }}" method="POST" class="flex-shrink-0">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white hover:bg-slate-50 border border-unklab-periwinkle/50 text-unklab-navy text-xs font-bold transition-all shadow-sm">
                    <svg class="w-4 h-4 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Kirim Ulang Kartu ke Email</span>
                </button>
            </form>
        </div>
    @endif
    <div class="mb-6 bg-white rounded-2xl border-l-4 border-emerald-500 border-y border-r border-slate-200 shadow-sm p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 no-print">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-sm sm:text-base font-extrabold text-unklab-black">Seluruh Berkas Wajib Telah Lolos Verifikasi AI!</h2>
                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full">100% Validated</span>
                </div>
                <p class="text-xs text-slate-600 mt-0.5">
                    Data pendaftaran Anda telah tersimpan secara permanen dan siap diproses oleh Tim Penerimaan Mahasiswa Baru Universitas Klabat.
                </p>
            </div>
        </div>

        <!-- Approval Status Pill -->
        @if($application->status === 'approved')
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-300 self-start sm:self-auto flex-shrink-0">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>PENDAFTARAN DISETUJUI (APPROVED)</span>
            </span>
        @elseif($application->status === 'rejected')
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-rose-100 text-rose-800 text-xs font-bold border border-rose-300 self-start sm:self-auto flex-shrink-0">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                <span>PENDAFTARAN DITOLAK (REJECTED)</span>
            </span>
        @else
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#EBE2F5] text-unklab-navy text-xs font-bold border border-unklab-lavender self-start sm:self-auto flex-shrink-0">
                <span class="w-2 h-2 rounded-full bg-unklab-periwinkle animate-pulse"></span>
                <span>MENUNGGU APPROVAL ADMIN PMB</span>
            </span>
        @endif
    </div>

    <!-- ======================================================== -->
    <!-- FORMAL ADMISSION REGISTRATION PROOF CARD (MATCHES IMAGE 6)-->
    <!-- ======================================================== -->
    <div class="print-card bg-white rounded-3xl border border-slate-200/90 shadow-xl overflow-hidden mb-8">
        
        <!-- Blue Card Header Banner -->
        <div class="bg-unklab-navy text-white p-6 sm:p-8 relative overflow-hidden">
            <!-- Subtle Watermark text -->
            <div class="absolute right-4 -bottom-6 text-7xl font-black text-white/5 select-none pointer-events-none tracking-widest">
                UNKLAB
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Left: Branding -->
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-xl bg-white text-unklab-navy flex items-center justify-center font-bold text-lg shadow-sm flex-shrink-0">
                        UK
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-unklab-lavender">PENERIMAAN MAHASISWA BARU (PMB)</div>
                        <h2 class="text-xl sm:text-2xl font-black tracking-tight leading-tight">UNIVERSITAS KLABAT</h2>
                        <div class="text-[10px] text-slate-300">Jl. Arnold Mononutu, Airmadidi, Minahasa Utara, Sulawesi Utara 95371</div>
                    </div>
                </div>

                <!-- Right: Title of Document -->
                <div class="md:text-right">
                    <div class="inline-block bg-white/10 text-unklab-lavender text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wider mb-1">
                        TAHUN AKADEMIK {{ now()->year }} / {{ now()->year + 1 }}
                    </div>
                    <div class="text-lg sm:text-xl font-black tracking-tight text-white uppercase">KARTU TANDA BUKTI PENDAFTARAN</div>
                    <div class="text-[10px] text-emerald-300 font-medium">Dokumen Resmi Elektronik Terverifikasi</div>
                </div>
            </div>
        </div>

        <!-- Meta Bar -->
        <div class="bg-slate-50 px-6 sm:px-8 py-3 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-slate-600 gap-2">
            <div>
                <strong>Kategori:</strong> Sarjana (S1) &bull; <strong>Semester:</strong> Ganjil {{ now()->year }}/{{ now()->year + 1 }}
            </div>
            <div class="flex items-center gap-1.5 text-[11px] text-unklab-periwinkle font-semibold">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span>Terenkripsi SHA-256 via Smart Engine UNKLAB</span>
            </div>
        </div>

        <!-- Card Body (3-Column Layout) -->
        <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-12 gap-8">
            
            <!-- Column 1: Photo & Registration Code (3 cols) -->
            <div class="md:col-span-3 flex flex-col items-center text-center">
                <div class="w-36 h-48 rounded-2xl bg-slate-100 border-2 border-unklab-navy/20 overflow-hidden relative shadow-md flex items-center justify-center">
                    @php
                        $pasFoto = $application->getDocument('pas_foto');
                    @endphp
                    @if($pasFoto && Storage::disk('public')->exists($pasFoto->file_path))
                        <img src="{{ Storage::url($pasFoto->file_path) }}" alt="Foto Calon Mahasiswa" class="w-full h-full object-cover">
                    @else
                        <!-- Realistic portrait avatar silhouette -->
                        <div class="w-full h-full bg-slate-800 flex flex-col items-center justify-center text-white relative">
                            <svg class="w-20 h-20 text-slate-400 mt-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            <span class="text-[9px] text-slate-400 uppercase tracking-widest mt-1">PMB UNKLAB {{ now()->year }}</span>
                        </div>
                    @endif
                    <!-- Blue Overlay Badge -->
                    <div class="absolute top-2 left-2 bg-unklab-navy text-white text-[9px] font-black px-1.5 py-0.5 rounded tracking-wider">
                        UNKLAB
                    </div>
                    <div class="absolute top-2 right-2 bg-emerald-600 text-white text-[9px] font-black px-1.5 py-0.5 rounded tracking-wider">
                        VERIFIED
                    </div>
                </div>

                <div class="mt-4 w-full bg-slate-50 rounded-xl p-3 border border-slate-100 text-center">
                    <span class="block text-[10px] uppercase font-bold text-slate-400">NOMOR PENDAFTARAN</span>
                    <span class="block text-sm sm:text-base font-black font-mono text-unklab-navy tracking-tight mt-0.5">
                        {{ $application->registration_number }}
                    </span>
                    <div class="mt-2 pt-2 border-t border-slate-200 text-[10px] text-slate-500">
                        <div>Tanggal: <strong>{{ $application->created_at?->format('d M Y, H:i') }} WITA</strong></div>
                        <div class="mt-0.5">Jalur: <span class="bg-unklab-periwinkle/15 text-unklab-navy font-bold px-1.5 py-0.5 rounded text-[9px]">Jalur Reguler Gelombang 1</span></div>
                    </div>
                </div>
            </div>

            <!-- Column 2: Data Calon Mahasiswa (6 cols) -->
            <div class="md:col-span-6 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <h3 class="text-xs font-bold text-unklab-navy uppercase tracking-wider">Data Calon Mahasiswa</h3>
                    </div>
                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                        IDENTITAS RESMI
                    </span>
                </div>

                <!-- Full Name -->
                <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                    <span class="block text-[10px] text-slate-400 font-semibold uppercase">Nama Lengkap</span>
                    <span class="block text-lg font-black text-unklab-black mt-0.5">
                        {{ $application->full_name }}
                    </span>
                </div>

                <!-- Grid Data -->
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <span class="block text-[10px] text-slate-400 font-semibold uppercase">NIK (Kependudukan)</span>
                        <span class="block font-bold font-mono text-unklab-black mt-0.5">{{ $application->nik }}</span>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <span class="block text-[10px] text-slate-400 font-semibold uppercase">Asal Sekolah</span>
                        <span class="block font-bold text-unklab-black mt-0.5 truncate">{{ $application->school_name }}</span>
                    </div>

                    <div class="col-span-2 bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <span class="block text-[10px] text-slate-400 font-semibold uppercase">Email Terdaftar</span>
                        <span class="block font-bold text-unklab-black mt-0.5">{{ $application->user?->email }}</span>
                    </div>
                </div>

                <!-- Program Studi Box -->
                <div class="bg-gradient-to-r from-unklab-navy/5 to-unklab-periwinkle/10 rounded-2xl p-4 border border-unklab-periwinkle/30">
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-unklab-periwinkle">FAKULTAS & PROGRAM STUDI PILIHAN:</span>
                    <span class="block text-base font-extrabold text-unklab-navy mt-1">
                        {{ $application->faculty }}
                    </span>
                    <span class="block text-sm font-bold text-slate-700">
                        &bull; {{ $application->study_program }}
                    </span>
                </div>

                <!-- Status Usia & KTP Notice -->
                <div class="bg-[#EBE2F5] rounded-xl p-3 border border-unklab-lavender/60 flex items-center gap-2.5 text-xs text-unklab-navy">
                    <svg class="w-4 h-4 text-unklab-periwinkle flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>
                        <strong>Status Usia:</strong> {{ $application->age_formatted }} 
                        @if($application->is_under_17)
                            (KTP Opsional &mdash; Terverifikasi via Kartu Keluarga)
                        @else
                            (e-KTP & Kartu Keluarga Terverifikasi)
                        @endif
                    </span>
                </div>
            </div>

            <!-- Column 3: AI Audit & QR Code (3 cols) -->
            <div class="md:col-span-3 flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100 mb-3">
                        <span class="text-xs font-bold text-unklab-navy uppercase tracking-wider">Audit AI</span>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Lulus Engine</span>
                    </div>

                    <!-- Checklist Audit Berkas — dynamic from application_documents -->
                    <div class="space-y-2 text-xs">
                        @php
                            $auditDocs = [
                                'kk'       => 'Kartu Keluarga (KK)',
                                'ijazah'   => 'Ijazah / SKL',
                                'pas_foto' => 'Pas Foto Formal',
                                'ktp'      => 'KTP Pendaftar',
                            ];
                        @endphp
                        @foreach($auditDocs as $docType => $docLabel)
                            @php
                                $doc = $application->getDocument($docType);
                                $isKtp = ($docType === 'ktp');
                                $isUnder17 = $application->is_under_17;
                                if ($isKtp && $isUnder17 && !$doc) {
                                    $badgeText  = 'Opsional (< 17 Thn)';
                                    $badgeClass = 'text-unklab-navy bg-unklab-lavender/40';
                                } elseif ($doc && $doc->is_valid) {
                                    $badgeText  = 'Valid ✓';
                                    $badgeClass = 'text-emerald-700 bg-emerald-100';
                                } elseif ($doc && !$doc->is_valid) {
                                    $badgeText  = 'Ditolak AI';
                                    $badgeClass = 'text-rose-700 bg-rose-100';
                                } else {
                                    $badgeText  = 'Belum Diunggah';
                                    $badgeClass = 'text-slate-500 bg-slate-100';
                                }
                            @endphp
                            <div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <span class="text-[11px] font-semibold text-slate-700">{{ $docLabel }}</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $badgeClass }}">{{ $badgeText }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Authentic QR Code Generator (SVG) -->
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-center flex flex-col items-center">
                    <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400 mb-2">KODE KEABSAHAN DOKUMEN</span>
                    <div class="w-28 h-28 bg-white p-2 rounded-xl shadow-sm border border-slate-200 flex items-center justify-center">
                        <!-- Precise SVG QR Code representation -->
                        <svg class="w-full h-full text-unklab-navy" viewBox="0 0 100 100" fill="currentColor">
                            <!-- Corners -->
                            <rect x="5" y="5" width="28" height="28" fill="none" stroke="currentColor" stroke-width="6"/>
                            <rect x="13" y="13" width="12" height="12"/>
                            
                            <rect x="67" y="5" width="28" height="28" fill="none" stroke="currentColor" stroke-width="6"/>
                            <rect x="75" y="13" width="12" height="12"/>

                            <rect x="5" y="67" width="28" height="28" fill="none" stroke="currentColor" stroke-width="6"/>
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
                    <span class="text-[9px] text-slate-500 mt-2 font-medium">Scan untuk Cek Keabsahan Panitia PMB UNKLAB</span>
                    <span class="text-[9px] text-unklab-navy font-mono font-bold mt-0.5">SIG: {{ strtoupper(substr(md5($application->registration_number ?? $application->id), 0, 4)) }}-UK-{{ now()->year }}-{{ strtoupper(substr(md5($application->registration_number ?? $application->id), 4, 4)) }}</span>
                </div>
            </div>

        </div>

        <!-- Card Footer -->
        <div class="bg-slate-50 px-6 sm:px-8 py-3 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between text-[11px] text-slate-500 gap-2">
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Dokumen ini diterbitkan sah secara sistem oleh Biro Administrasi Akademik & Penerimaan UNKLAB.</span>
            </div>
            <div class="font-mono text-slate-600 font-bold">
                KODE REGISTRASI: {{ $application->registration_number }}
            </div>
        </div>
    </div>

    <!-- Next Steps Card for Applicant -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-8 no-print">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 rounded-lg bg-unklab-navy/10 text-unklab-navy flex items-center justify-center font-bold text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="text-sm font-bold text-unklab-black">Langkah Selanjutnya Calon Mahasiswa</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                <span class="font-bold text-unklab-navy block mb-1">1. Simpan / Cetak Bukti Pendaftaran ini</span>
                <p class="text-slate-600 leading-relaxed text-[11px]">
                    Simpan dokumen PDF resmi ini atau cetak salinan fisik sebagai bukti sah pendaftaran Anda di Universitas Klabat.
                </p>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                <span class="font-bold text-unklab-navy block mb-1">2. Pantau Status Approval dari Panitia PMB UNKLAB</span>
                <p class="text-slate-600 leading-relaxed text-[11px]">
                    Proses verifikasi akhir panitia berlangsung dalam 1x24 jam kerja. Pemberitahuan kelulusan berkas akan dikirim melalui SMS & Email terdaftar.
                </p>
            </div>
        </div>
    </div>

    <!-- Bottom Action Bar (Cetak / Keluar) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
        <div class="flex items-center gap-2 text-xs text-slate-500">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span><strong>Pendaftaran Sukses & Terkunci</strong> &mdash; Kartu bukti ini dapat diunduh kapan saja melalui Portal Mahasiswa</span>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <form action="{{ route('pmb.resend_card_email') }}" method="POST" class="flex-1 sm:flex-none">
                @csrf
                <button type="submit" class="w-full px-4 py-3 rounded-xl border border-unklab-periwinkle/40 bg-white hover:bg-slate-50 text-unklab-navy font-bold text-xs sm:text-sm transition-all shadow-sm inline-flex items-center justify-center gap-1.5" title="Kirim Ulang Kartu ke Email Pendaftar">
                    <svg class="w-4 h-4 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Kirim Ulang ke Email</span>
                </button>
            </form>

            <form action="{{ route('logout') }}" method="POST" class="flex-1 sm:flex-none">
                @csrf
                <button type="submit" class="w-full px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs sm:text-sm transition-all shadow-sm">
                    Keluar
                </button>
            </form>

            <button type="button" 
                    onclick="window.print()" 
                    class="flex-1 sm:flex-none px-6 py-3 rounded-xl bg-unklab-navy hover:bg-unklab-periwinkle text-white font-bold text-xs sm:text-sm transition-all shadow-md inline-flex items-center justify-center gap-2 group">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak / Unduh Bukti Pendaftaran</span>
            </button>
        </div>
    </div>

</main>
@endsection
