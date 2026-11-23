@extends('layouts.app')

@section('title', 'PMB Universitas Klabat — Portal Pendaftaran & Verifikasi Dokumen AI')

@section('content')
<!-- Header Navbar -->
<header class="bg-unklab-navy text-white sticky top-0 z-40 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo & Title -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-white text-unklab-navy flex items-center justify-center font-bold text-lg shadow-sm">
                UK
            </div>
            <div>
                <span class="block text-base sm:text-lg font-bold tracking-tight uppercase leading-tight">PMB UNIVERSITAS KLABAT</span>
                <span class="block text-[10px] sm:text-xs text-unklab-lavender font-medium tracking-wider">SMART ADMISSION PORTAL</span>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-200">
            <a href="{{ route('home') }}" class="text-white hover:text-unklab-lavender transition-colors">Beranda</a>
            <a href="#alur-pendaftaran" class="hover:text-unklab-lavender transition-colors">Alur Pendaftaran</a>
            <a href="#keunggulan" class="hover:text-unklab-lavender transition-colors">Keunggulan AI</a>
            <a href="#kontak" class="hover:text-unklab-lavender transition-colors">Pusat Bantuan</a>
        </nav>

        <!-- CTA Button -->
        <div class="flex items-center gap-3">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-unklab-periwinkle hover:bg-opacity-90 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        <span>Dashboard Admin</span>
                    </a>
                @else
                    <a href="{{ route('pmb.biodata') }}" class="inline-flex items-center gap-2 bg-unklab-periwinkle hover:bg-opacity-90 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Portal Pendaftar</span>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white text-unklab-navy hover:bg-slate-100 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all shadow-sm">
                    <span>Masuk Portal PMB</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                </a>
            @endauth
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="relative pt-12 pb-16 lg:pt-20 lg:pb-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Column: Copy & Actions -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <!-- Academic Year Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#EBE2F5] border border-unklab-lavender/50 text-unklab-navy text-xs font-bold tracking-wide uppercase">
                    <svg class="w-3.5 h-3.5 text-unklab-periwinkle" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>TAHUN AKADEMIK {{ now()->year }}/{{ now()->year + 1 }} • SISTEM PMB CERDAS</span>
                </div>

                <!-- Main Title -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-unklab-black tracking-tight leading-tight">
                    Pendaftaran Mahasiswa Baru Universitas Klabat — Cepat & Terverifikasi AI
                </h1>

                <!-- Subtitle / Pitch -->
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl leading-relaxed">
                    Tidak perlu registrasi rumit. Masuk langsung dengan email pribadi Anda untuk mendaftar, atau email <span class="font-semibold text-unklab-navy">@unklab.ac.id</span> untuk Panitia PMB. Pemeriksaan berkas otomatis dan instan oleh AI.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-unklab-navy hover:bg-unklab-periwinkle text-white font-bold rounded-xl transition-all shadow-md group">
                        <span>Mulai Pendaftaran</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#alur-pendaftaran" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white hover:bg-slate-50 text-unklab-navy font-bold rounded-xl border border-slate-300 transition-all shadow-sm">
                        <svg class="w-4 h-4 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        <span>Pelajari Alur Seleksi</span>
                    </a>
                </div>

                <!-- Feature Pills -->
                <div class="pt-4 grid grid-cols-1 sm:grid-cols-3 gap-3 border-t border-slate-200">
                    <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-700 bg-white/70 py-2 px-3 rounded-lg border border-slate-200/80">
                        <svg class="w-4 h-4 text-unklab-periwinkle flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>Tanpa Biaya Akun</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-700 bg-white/70 py-2 px-3 rounded-lg border border-slate-200/80">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"/></svg>
                        <span>Verifikasi &lt; 10 Detik</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-700 bg-white/70 py-2 px-3 rounded-lg border border-slate-200/80">
                        <svg class="w-4 h-4 text-unklab-periwinkle flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                        <span>KTP Opsional (&lt; 17 Thn)</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive AI Simulation Card -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xl overflow-hidden">
                    <!-- Top Bar of Card -->
                    <div class="bg-slate-50 px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-xs font-bold text-slate-700">Simulasi Pemeriksaan Dokumen AI</span>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Terverifikasi
                        </span>
                    </div>

                    <!-- Inner Card Content -->
                    <div class="p-5 space-y-4">
                        <!-- File item simulation -->
                        <div class="bg-[#FCF9EC] border border-amber-100 rounded-xl p-3.5">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-unklab-navy/10 text-unklab-navy flex items-center justify-center font-bold text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-unklab-black">Kartu_Keluarga.pdf</div>
                                        <div class="text-[10px] text-slate-500">Dokumen Terunggah</div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100/80 px-2 py-0.5 rounded">Terverifikasi AI</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="w-full bg-slate-200 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-emerald-500 h-1.5 rounded-full w-full"></div>
                            </div>
                        </div>

                        <!-- Extraction Result Box -->
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-3">Hasil Ekstraksi Dokumen</div>
                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div>
                                    <span class="block text-[11px] text-slate-500">Nama Lengkap</span>
                                    <span class="font-bold text-unklab-black">Gabriel J. Mamahit</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] text-slate-500">NIK Siswa</span>
                                    <span class="font-bold text-unklab-black">7102012408080003</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] text-slate-500">Tanggal Lahir</span>
                                    <span class="font-semibold text-slate-700">24 Agustus 2008</span>
                                </div>
                                <div>
                                    <span class="block text-[11px] text-slate-500">Status Usia</span>
                                    <span class="font-bold text-unklab-periwinkle">16 Tahun (&lt; 17 Thn)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Age Alert in Card -->
                        <div class="bg-[#EBE2F5] rounded-xl p-3 flex items-start gap-2.5 border border-unklab-lavender/40 text-xs text-unklab-navy">
                            <svg class="w-4 h-4 text-unklab-periwinkle flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="leading-relaxed text-[11px]">
                                <strong>KTP Opsional:</strong> Usia di bawah 17 tahun terdeteksi secara otomatis. Calon mahasiswa cukup menyertakan Kartu Keluarga.
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section: Alur Pendaftaran 3 Langkah Mudah -->
<section id="alur-pendaftaran" class="py-16 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-unklab-periwinkle/10 text-unklab-periwinkle text-xs font-bold uppercase tracking-wider mb-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                PROSES ADMISI PRAKTIS
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-unklab-black tracking-tight">
                Alur Pendaftaran 3 Langkah Mudah
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-2">
                Proses seleksi transparan, cepat, dan terintegrasi AI tanpa hambatan birokrasi manual.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Step 1 Card -->
            <div class="bg-unklab-cream rounded-2xl p-6 border border-amber-200/50 shadow-sm hover:shadow-md transition-shadow relative flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-unklab-periwinkle text-white text-xs font-bold px-3 py-1 rounded-md">Langkah 01</span>
                        <div class="w-8 h-8 rounded-full bg-white text-unklab-periwinkle flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-unklab-black mb-2">Masuk Email Pribadi & Isi Biodata</h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Masuk langsung menggunakan email pribadi tanpa form pendaftaran manual yang rumit. Lengkapi data diri dan pilihan program studi.
                    </p>
                </div>
                <div class="pt-4 border-t border-amber-200/60 flex items-center justify-between text-xs text-slate-500 font-medium">
                    <span>Otentikasi Mandiri</span>
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
            </div>

            <!-- Step 2 Card -->
            <div class="bg-unklab-cream rounded-2xl p-6 border border-amber-200/50 shadow-sm hover:shadow-md transition-shadow relative flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-unklab-periwinkle text-white text-xs font-bold px-3 py-1 rounded-md">Langkah 02</span>
                        <div class="w-8 h-8 rounded-full bg-white text-unklab-periwinkle flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-unklab-black mb-2">Unggah Berkas & Cek AI</h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Unggah file KK, Ijazah atau Rapor, dan Pas Foto. AI langsung membaca dan mengekstrak identitas serta memeriksa kelengkapan berkas.
                    </p>
                </div>
                <div class="pt-4 border-t border-amber-200/60 flex items-center justify-between text-xs text-slate-500 font-medium">
                    <span>Ekstraksi Otomatis AI</span>
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
            </div>

            <!-- Step 3 Card -->
            <div class="bg-unklab-cream rounded-2xl p-6 border border-amber-200/50 shadow-sm hover:shadow-md transition-shadow relative flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-unklab-periwinkle text-white text-xs font-bold px-3 py-1 rounded-md">Langkah 03</span>
                        <div class="w-8 h-8 rounded-full bg-white text-unklab-periwinkle flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-unklab-black mb-2">Cetak Bukti & Tunggu Approval Admin</h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Unduh bukti pendaftaran digital dan pantau persetujuan resmi dari Panitia PMB UNKLAB langsung dari dashboard pendaftar.
                    </p>
                </div>
                <div class="pt-4 border-t border-amber-200/60 flex items-center justify-between text-xs text-slate-500 font-medium">
                    <span>Verifikasi Akhir Admin</span>
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Mengapa PMB Universitas Klabat Berbeda? -->
<section id="keunggulan" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-unklab-navy rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold text-unklab-lavender tracking-wider uppercase">KEUNGGULAN TEKNOLOGI</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-1">Mengapa PMB Universitas Klabat Berbeda?</h2>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 text-xs font-semibold text-unklab-lavender border border-white/15 self-start">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Kampus Unggulan Airmadidi
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Point 1 -->
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-unklab-lavender">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Pemeriksaan Berkas Otomatis AI</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Sistem cerdas mengekstrak data dari dokumen pendaftaran seperti Kartu Keluarga dan ijazah secara instan tanpa input manual berulang.
                    </p>
                </div>

                <!-- Point 2 -->
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-unklab-lavender">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Aturan KTP Opsional (&lt; 17 Tahun)</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Calon mahasiswa muda yang belum berusia 17 tahun dibebaskan dari syarat KTP. Verifikasi identitas cukup menggunakan Kartu Keluarga.
                    </p>
                </div>

                <!-- Point 3 -->
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-unklab-lavender">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Approval Cepat oleh Panitia UNKLAB</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Panitia PMB memvalidasi hasil verifikasi AI melalui dashboard admin untuk penerbitan persetujuan pendaftaran secara transparan dan teratur.
                    </p>
                </div>
            </div>

            <!-- Bottom Sub-bar -->
            <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-slate-300 gap-3">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span>Kampus Pelopor Pendidikan Berkarakter & Berteknologi Tinggi di Sulawesi Utara</span>
                </div>
                <a href="{{ route('login') }}" class="text-unklab-lavender hover:text-white font-semibold inline-flex items-center gap-1">
                    <span>Mulai Pendaftaran Sekarang</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="kontak" class="bg-unklab-navy text-white pt-12 pb-8 border-t border-unklab-navy-dark mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pb-8 border-b border-white/10">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-lg bg-white text-unklab-navy font-bold flex items-center justify-center">UK</div>
                    <span class="text-lg font-bold tracking-tight">UNIVERSITAS KLABAT</span>
                </div>
                <p class="text-xs text-slate-300 max-w-sm leading-relaxed">
                    Sistem Penerimaan Mahasiswa Baru cerdas terintegrasi verifikasi dokumen presisi AI. Memudahkan proses admisi mahasiswa dari seluruh Indonesia.
                </p>
            </div>
            <div class="md:text-right">
                <div class="text-sm font-bold text-unklab-lavender mb-2">Kampus Pusat & Kontak</div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Jl. Arnold Mononutu, Airmadidi, Minahasa Utara, Sulawesi Utara 95371<br>
                    Telepon: +62 431 891035 | Email: <a href="mailto:pmb@unklab.ac.id" class="underline text-unklab-lavender">pmb@unklab.ac.id</a>
                </p>
            </div>
        </div>
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 gap-2">
            <div>&copy; {{ now()->year }} Universitas Klabat. Seluruh Hak Cipta Dilindungi.</div>
            <div>Penerimaan Mahasiswa Baru (PMB) Berbasis AI</div>
        </div>
    </div>
</footer>
@endsection
