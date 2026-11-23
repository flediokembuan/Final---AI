@extends('layouts.app')

@section('title', 'Langkah 2: Unggah & Verifikasi Berkas AI - PMB UNKLAB')

@section('content')
<!-- Top Navbar -->
<header class="bg-white border-b border-slate-200 sticky top-0 z-40">
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

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" 
      x-data="documentVerifier({
          isUnder17: {{ $application->is_under_17 ? 'true' : 'false' }},
          applicantName: '{{ addslashes($application->full_name ?? auth()->user()->name) }}',
          birthDateFormatted: '{{ $application->birth_date?->format('d F Y') ?? '-' }}',
          ageFormatted: '{{ $application->age_formatted }}',
          allRequiredValid: {{ $allRequiredValid ? 'true' : 'false' }},
          initialDocs: {{ Js::from($initialDocs) }}
      })">

    <!-- Stepper Bar (Single content stepper) -->
    <div class="bg-white rounded-2xl p-4 mb-6 border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2 sm:gap-3 text-xs font-bold overflow-x-auto w-full sm:w-auto">
            <!-- Step 1 (Completed) -->
            <a href="{{ route('pmb.biodata') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-100 transition-colors flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>1. Biodata & Program Studi</span>
            </a>
            <span class="text-slate-300">&rarr;</span>

            <!-- Step 2 (Active) -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-unklab-navy text-white shadow-sm flex-shrink-0">
                <span class="w-5 h-5 rounded-full bg-white text-unklab-navy flex items-center justify-center text-[10px] font-black">2</span>
                <div>
                    <span>Verifikasi Berkas AI</span>
                    <span class="hidden md:inline text-[10px] text-unklab-lavender font-normal"> &bull; Pemeriksaan Dokumen Otomatis</span>
                </div>
            </div>
            <span class="text-slate-300">&rarr;</span>

            <!-- Step 3 (Pending) -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-400 flex-shrink-0">
                <span class="w-5 h-5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[10px]">3</span>
                <span>Finalisasi & Bukti Pendaftaran</span>
            </div>
        </div>

        <div class="flex items-center gap-2 text-xs font-medium text-slate-600 bg-slate-50 px-3 py-1 rounded-full border border-slate-200 flex-shrink-0 self-end sm:self-center">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span>Pendaftar: <strong class="text-unklab-black font-semibold">{{ auth()->user()->email }}</strong></span>
        </div>
    </div>

    <!-- Header Section & Counter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="inline-flex flex-wrap items-center gap-2 text-xs font-bold uppercase tracking-wider mb-1">
                <span class="bg-unklab-lavender/30 text-unklab-navy px-2.5 py-0.5 rounded-md font-extrabold">TAHAP 2 DARI 3</span>
                <span class="text-slate-300">&bull;</span>
                <!-- Dual-Mode AI Verifier Active Indicator -->
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold shadow-sm {{ str_contains($activeVerifierMode ?? '', 'vision') ? 'bg-indigo-50 text-indigo-900 border border-indigo-200' : 'bg-emerald-50 text-emerald-900 border border-emerald-200' }}">
                    <span class="w-2 h-2 rounded-full {{ str_contains($activeVerifierMode ?? '', 'vision') ? 'bg-indigo-600' : 'bg-emerald-600' }} animate-pulse"></span>
                    <span>{{ $activeVerifierLabel ?? 'Mode: Local OCR Engine' }}</span>
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-unklab-black tracking-tight">
                Langkah 2: Unggah Berkas & Pemeriksaan Otomatis AI
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-3xl">
                Sistem cerdas PMB UNKLAB memeriksa validitas dokumen, kejelasan cap/legalisir, dan kesesuaian data secara instan demi mempercepat konfirmasi kelulusan berkas Anda.
            </p>
        </div>

        <!-- Kelengkapan Ring Widget -->
        <div class="bg-white rounded-xl border border-slate-200 p-3 shadow-sm flex items-center gap-3 flex-shrink-0 self-start md:self-center">
            <div class="relative w-12 h-12 flex items-center justify-center">
                <svg class="w-12 h-12 transform -rotate-90">
                    <circle cx="24" cy="24" r="18" stroke="currentColor" stroke-width="4" class="text-slate-100" fill="transparent" />
                    <circle cx="24" cy="24" r="18" stroke="currentColor" stroke-width="4" class="text-unklab-periwinkle" fill="transparent"
                            :stroke-dasharray="113.1"
                            :stroke-dashoffset="113.1 - (113.1 * (validCount / totalRequired))" />
                </svg>
                <span class="absolute text-[11px] font-black text-unklab-navy" x-text="Math.round((validCount / totalRequired) * 100) + '%'"></span>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-wider">KELENGKAPAN</span>
                <span class="block text-sm font-extrabold text-unklab-black">
                    <span x-text="validCount"></span> / <span x-text="totalRequired"></span> Wajib
                </span>
            </div>
        </div>
    </div>

    <!-- Special Banner for Under 17 Years Old (KTP Opsional) -->
    <template x-if="isUnder17">
        <div class="mb-6 p-4 rounded-2xl bg-[#EBE2F5] border border-unklab-lavender/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-unklab-navy shadow-sm">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-unklab-navy text-white flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-unklab-lavender" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <span class="font-bold text-unklab-black">Perhatian Khusus Usia &lt; 17 Tahun:</span>
                    <span class="text-slate-700 ml-1">Unggah KTP bersifat <strong class="text-unklab-navy font-bold">OPSIONAL</strong> bagi pendaftar di bawah usia 17 tahun. Anda cukup memastikan Kartu Keluarga telah diverifikasi secara valid oleh sistem.</span>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-unklab-navy text-white text-[11px] font-bold self-start sm:self-auto flex-shrink-0 shadow-sm">
                <svg class="w-3.5 h-3.5 text-unklab-lavender" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Status: Bebas Syarat e-KTP
            </span>
        </div>
    </template>

    <!-- 4 Slots Grid (2x2) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- SLOT 1: KARTU KELUARGA (KK) [WAJIB] -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6 flex flex-col justify-between transition-all"
             :class="docs.kk?.is_valid ? 'ring-1 ring-emerald-500/30' : (docs.kk?.is_uploaded && !docs.kk?.is_valid ? 'ring-1 ring-rose-500/30' : '')">
            <div>
                <!-- Slot Header -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="bg-unklab-navy text-white text-[10px] font-bold px-2.5 py-0.5 rounded uppercase tracking-wider">WAJIB</span>
                        <h2 class="text-base font-bold text-unklab-black">Kartu Keluarga (KK)</h2>
                    </div>

                    <!-- Status Badge -->
                    <template x-if="docs.kk?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Terverifikasi AI ✓
                        </span>
                    </template>
                    <template x-if="docs.kk?.is_uploaded && !docs.kk?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-rose-700 bg-rose-50 border border-rose-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Dokumen Ditolak AI
                        </span>
                    </template>
                    <template x-if="!docs.kk?.is_uploaded">
                        <span class="text-[11px] font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                            Siap Diunggah
                        </span>
                    </template>
                </div>

                <!-- STATE: Valid Uploaded KK -->
                <template x-if="docs.kk?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-[#FCF9EC] rounded-xl p-3.5 border border-amber-200/60 flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-emerald-100 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-unklab-black truncate" x-text="docs.kk.filename"></div>
                                <div class="text-[10px] text-slate-500">Akurasi AI: <span class="font-bold text-emerald-600" x-text="docs.kk.feedback?.accuracy || '99.4%'"></span></div>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 text-xs space-y-1">
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">HASIL EKSTRAKSI AI</div>
                            <pre class="font-sans text-[11px] text-slate-700 whitespace-pre-wrap leading-relaxed" x-text="docs.kk.feedback?.hasil_ekstraksi || 'Data KK Lengkap dan Tervalidasi'"></pre>
                            <div class="text-[10px] font-bold text-emerald-700 flex items-center gap-1 pt-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Cap Disdukcapil & QR Barcode Valid</span>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- STATE: Rejected KK -->
                <template x-if="docs.kk?.is_uploaded && !docs.kk?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-rose-50 border border-rose-200 rounded-xl p-3.5 text-xs text-rose-800">
                            <div class="font-bold flex items-center gap-1.5 mb-1">
                                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <span>Peringatan: Berkas Belum Memenuhi Syarat</span>
                            </div>
                            <p class="text-[11px] leading-relaxed" x-text="docs.kk.feedback?.alasan_penolakan || 'Dokumen tidak terbaca dengan jelas.'"></p>
                        </div>
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span class="truncate font-mono text-[11px]" x-text="docs.kk.filename"></span>
                            <span class="text-rose-600 font-bold text-[10px]">Gagal Validasi</span>
                        </div>
                    </div>
                </template>

                <!-- STATE: Dropzone / Upload Box -->
                <template x-if="!docs.kk?.is_valid && (!docs.kk?.is_uploaded || currentSlotEditing === 'kk')">
                    <div>
                        <p class="text-xs text-slate-600 mb-3 leading-relaxed">
                            Pindai atau foto lembar Kartu Keluarga secara utuh. AI akan memverifikasi nomor KK, nama kepala keluarga, dan nama calon mahasiswa.
                        </p>
                        <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:border-unklab-periwinkle transition-colors cursor-pointer bg-slate-50/50"
                             @click="$refs.file_kk.click()">
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span class="text-xs font-bold text-unklab-black block">Tarik berkas KK ke sini atau Klik untuk Telusuri</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Format JPG, JPEG, PNG, atau PDF (Maks. 10 MB)</span>
                        </div>
                        <input type="file" x-ref="file_kk" class="hidden" accept=".jpg,.jpeg,.png,.pdf" @change="handleFileSelect($event, 'kk')">

                        <!-- Selected File Preview & Verification Action -->
                        <template x-if="selectedFiles.kk">
                            <div class="mt-3 bg-slate-100 rounded-xl p-3 flex flex-col gap-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-unklab-black truncate" x-text="selectedFiles.kk.name"></span>
                                    <span class="text-[10px] text-slate-500 font-mono" x-text="(selectedFiles.kk.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" :id="'sim_kk'" x-model="simulateReject.kk" class="rounded text-rose-600 text-xs">
                                    <label :for="'sim_kk'" class="text-[10px] text-rose-600 font-semibold cursor-pointer">Simulasikan Gagal AI (Test Rejection)</label>
                                </div>
                                <button type="button" @click="uploadAndVerify('kk')" :disabled="loading.kk"
                                        class="w-full py-2 px-3 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs font-bold rounded-lg transition-all shadow-sm flex items-center justify-center gap-2">
                                    <span x-show="!loading.kk">Periksa Berkas dengan AI</span>
                                    <span x-show="loading.kk" class="flex items-center gap-2">
                                        <svg class="animate-spin w-3.5 h-3.5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        Sedang Menganalisis Dokumen...
                                    </span>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Card Bottom Action -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <template x-if="docs.kk?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Diverifikasi Sistem PMB UNKLAB</span>
                        <button type="button" @click="currentSlotEditing = 'kk'" class="text-unklab-periwinkle font-semibold hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Ganti Berkas
                        </button>
                    </div>
                </template>
                <template x-if="docs.kk?.is_uploaded && !docs.kk?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Panduan Legalisir Dokumen</span>
                        <button type="button" @click="openRejectionModal('kk')" class="text-rose-700 bg-rose-100 hover:bg-rose-200 px-3 py-1.5 rounded-lg font-bold flex items-center gap-1 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat Alasan Penolakan & Unggah Ulang
                        </button>
                    </div>
                </template>
                <template x-if="!docs.kk?.is_uploaded">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Format: JPG, PNG, PDF</span>
                        <button type="button" @click="$refs.file_kk.click()" class="bg-unklab-navy text-white text-[11px] font-bold px-3 py-1.5 rounded-lg hover:bg-unklab-periwinkle transition-colors">
                            Pilih Berkas KK
                        </button>
                    </div>
                </template>
            </div>
        </div>


        <!-- SLOT 2: IJAZAH / SKL LEGALISIR [WAJIB] -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6 flex flex-col justify-between transition-all"
             :class="docs.ijazah?.is_valid ? 'ring-1 ring-emerald-500/30' : (docs.ijazah?.is_uploaded && !docs.ijazah?.is_valid ? 'ring-1 ring-rose-500/30' : '')">
            <div>
                <!-- Slot Header -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="bg-unklab-navy text-white text-[10px] font-bold px-2.5 py-0.5 rounded uppercase tracking-wider">WAJIB</span>
                        <h2 class="text-base font-bold text-unklab-black">Ijazah / SKL Legalisir</h2>
                    </div>

                    <!-- Status Badge -->
                    <template x-if="docs.ijazah?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Terverifikasi AI ✓
                        </span>
                    </template>
                    <template x-if="docs.ijazah?.is_uploaded && !docs.ijazah?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-rose-700 bg-rose-50 border border-rose-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Dokumen Ditolak AI
                        </span>
                    </template>
                    <template x-if="!docs.ijazah?.is_uploaded">
                        <span class="text-[11px] font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                            Siap Diunggah
                        </span>
                    </template>
                </div>

                <!-- STATE: Valid Ijazah -->
                <template x-if="docs.ijazah?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-[#FCF9EC] rounded-xl p-3.5 border border-amber-200/60 flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-emerald-100 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-unklab-black truncate" x-text="docs.ijazah.filename"></div>
                                <div class="text-[10px] text-slate-500">Akurasi AI: <span class="font-bold text-emerald-600" x-text="docs.ijazah.feedback?.accuracy || '98.8%'"></span></div>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 text-xs space-y-1">
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">HASIL EKSTRAKSI AI</div>
                            <pre class="font-sans text-[11px] text-slate-700 whitespace-pre-wrap leading-relaxed" x-text="docs.ijazah.feedback?.hasil_ekstraksi || 'Ijazah Legalisir Tervalidasi'"></pre>
                            <div class="text-[10px] font-bold text-emerald-700 flex items-center gap-1 pt-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Stempel Basah & Nomor Seri Ijazah Valid</span>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- STATE: Rejected Ijazah (Matches image 5!) -->
                <template x-if="docs.ijazah?.is_uploaded && !docs.ijazah?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-rose-50 border border-rose-200 rounded-xl p-3.5 text-xs text-rose-800">
                            <div class="font-bold flex items-center gap-1.5 mb-1 text-rose-900">
                                <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <span>Peringatan: Jenis berkas terdeteksi salah & resolusi buram.</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-slate-700">
                                Berkas yang Anda lampirkan terbaca sebagai <strong class="text-rose-700">"Rapor Semester 1"</strong> dan bukan <strong class="text-unklab-navy">Ijazah/Surat Keterangan Lulus (SKL)</strong>. Selain itu stempel basah kepala sekolah tidak terdeteksi jelas (resolusi &lt; 150 DPI).
                            </p>
                            <div class="mt-2 pt-2 border-t border-rose-200/60 space-y-0.5 text-[10px] text-rose-700 font-semibold">
                                <div>&bull; Tingkat Keyakinan Dokumen: Rendah (21%)</div>
                                <div>&bull; Nomor Registrasi Ijazah: Tidak Terbaca</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs text-slate-500 bg-slate-50 p-2.5 rounded-xl border border-slate-200">
                            <div class="flex items-center gap-2 truncate">
                                <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="truncate font-mono text-[11px] text-unklab-black" x-text="docs.ijazah.filename"></span>
                            </div>
                            <span class="text-rose-600 font-bold text-[10px] bg-rose-100 px-2 py-0.5 rounded">Gagal Validasi</span>
                        </div>
                    </div>
                </template>

                <!-- STATE: Dropzone -->
                <template x-if="!docs.ijazah?.is_valid && (!docs.ijazah?.is_uploaded || currentSlotEditing === 'ijazah')">
                    <div>
                        <p class="text-xs text-slate-600 mb-3 leading-relaxed">
                            Unggah Ijazah asli atau Surat Keterangan Lulus (SKL) yang telah dilegalisir basah. AI akan memeriksa stempel sekolah dan nomor seri ijazah.
                        </p>
                        <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:border-unklab-periwinkle transition-colors cursor-pointer bg-slate-50/50"
                             @click="$refs.file_ijazah.click()">
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span class="text-xs font-bold text-unklab-black block">Tarik berkas Ijazah ke sini atau Klik untuk Telusuri</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Format JPG, JPEG, PNG, atau PDF (Maks. 10 MB)</span>
                        </div>
                        <input type="file" x-ref="file_ijazah" class="hidden" accept=".jpg,.jpeg,.png,.pdf" @change="handleFileSelect($event, 'ijazah')">

                        <template x-if="selectedFiles.ijazah">
                            <div class="mt-3 bg-slate-100 rounded-xl p-3 flex flex-col gap-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-unklab-black truncate" x-text="selectedFiles.ijazah.name"></span>
                                    <span class="text-[10px] text-slate-500 font-mono" x-text="(selectedFiles.ijazah.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" :id="'sim_ijazah'" x-model="simulateReject.ijazah" class="rounded text-rose-600 text-xs">
                                    <label :for="'sim_ijazah'" class="text-[10px] text-rose-600 font-semibold cursor-pointer">Simulasikan Gagal AI (Test Rejection)</label>
                                </div>
                                <button type="button" @click="uploadAndVerify('ijazah')" :disabled="loading.ijazah"
                                        class="w-full py-2 px-3 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs font-bold rounded-lg transition-all shadow-sm flex items-center justify-center gap-2">
                                    <span x-show="!loading.ijazah">Periksa Berkas dengan AI</span>
                                    <span x-show="loading.ijazah" class="flex items-center gap-2">
                                        <svg class="animate-spin w-3.5 h-3.5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        Sedang Menganalisis Dokumen...
                                    </span>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Bottom Action -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <template x-if="docs.ijazah?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Diverifikasi Sistem PMB UNKLAB</span>
                        <button type="button" @click="currentSlotEditing = 'ijazah'" class="text-unklab-periwinkle font-semibold hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Ganti Berkas
                        </button>
                    </div>
                </template>
                <template x-if="docs.ijazah?.is_uploaded && !docs.ijazah?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Panduan Legalisir</span>
                        <button type="button" @click="openRejectionModal('ijazah')" class="text-rose-700 bg-rose-100 hover:bg-rose-200 px-3 py-1.5 rounded-lg font-bold flex items-center gap-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat Alasan Penolakan & Unggah Ulang
                        </button>
                    </div>
                </template>
                <template x-if="!docs.ijazah?.is_uploaded">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Format: JPG, PNG, PDF</span>
                        <button type="button" @click="$refs.file_ijazah.click()" class="bg-unklab-navy text-white text-[11px] font-bold px-3 py-1.5 rounded-lg hover:bg-unklab-periwinkle transition-colors">
                            Pilih Berkas Ijazah
                        </button>
                    </div>
                </template>
            </div>
        </div>


        <!-- SLOT 3: PAS FOTO FORMAL [WAJIB] -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6 flex flex-col justify-between transition-all"
             :class="docs.pas_foto?.is_valid ? 'ring-1 ring-emerald-500/30' : (docs.pas_foto?.is_uploaded && !docs.pas_foto?.is_valid ? 'ring-1 ring-rose-500/30' : '')">
            <div>
                <!-- Slot Header -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="bg-unklab-navy text-white text-[10px] font-bold px-2.5 py-0.5 rounded uppercase tracking-wider">WAJIB</span>
                        <h2 class="text-base font-bold text-unklab-black">Pas Foto Formal (Latar Merah/Biru)</h2>
                    </div>

                    <template x-if="docs.pas_foto?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Terverifikasi AI ✓
                        </span>
                    </template>
                    <template x-if="docs.pas_foto?.is_uploaded && !docs.pas_foto?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-rose-700 bg-rose-50 border border-rose-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Dokumen Ditolak AI
                        </span>
                    </template>
                    <template x-if="!docs.pas_foto?.is_uploaded">
                        <span class="text-[11px] font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                            Siap Diunggah
                        </span>
                    </template>
                </div>

                <!-- STATE: Valid Pas Foto -->
                <template x-if="docs.pas_foto?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-[#FCF9EC] rounded-xl p-3.5 border border-amber-200/60 flex items-center gap-3">
                            <div class="w-12 h-14 rounded-lg bg-emerald-100 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0 overflow-hidden">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-unklab-black truncate" x-text="docs.pas_foto.filename"></div>
                                <div class="text-[10px] text-slate-500">Kesesuaian Wajah AI: <span class="font-bold text-emerald-600" x-text="docs.pas_foto.feedback?.accuracy || '99.1%'"></span></div>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 text-xs space-y-1">
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">HASIL EKSTRAKSI AI</div>
                            <pre class="font-sans text-[11px] text-slate-700 whitespace-pre-wrap leading-relaxed" x-text="docs.pas_foto.feedback?.hasil_ekstraksi || 'Foto formal tervalidasi'"></pre>
                            <div class="text-[10px] font-bold text-emerald-700 flex items-center gap-1 pt-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Rasio Wajah & Pose Standar Dikti Terpenuhi</span>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- STATE: Rejected Pas Foto -->
                <template x-if="docs.pas_foto?.is_uploaded && !docs.pas_foto?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-rose-50 border border-rose-200 rounded-xl p-3.5 text-xs text-rose-800">
                            <div class="font-bold flex items-center gap-1.5 mb-1">
                                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <span>Peringatan: Pose / Latar Belakang Tidak Sesuai</span>
                            </div>
                            <p class="text-[11px] leading-relaxed" x-text="docs.pas_foto.feedback?.alasan_penolakan || 'Foto tidak memenuhi standar foto formal.'"></p>
                        </div>
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span class="truncate font-mono text-[11px]" x-text="docs.pas_foto.filename"></span>
                            <span class="text-rose-600 font-bold text-[10px]">Gagal Validasi</span>
                        </div>
                    </div>
                </template>

                <!-- STATE: Dropzone -->
                <template x-if="!docs.pas_foto?.is_valid && (!docs.pas_foto?.is_uploaded || currentSlotEditing === 'pas_foto')">
                    <div>
                        <p class="text-xs text-slate-600 mb-3 leading-relaxed">
                            AI akan memverifikasi kesesuaian dokumen pas foto, pose wajah tegak, pakaian berkerah, dan latar belakang solid polos.
                        </p>
                        <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:border-unklab-periwinkle transition-colors cursor-pointer bg-slate-50/50"
                             @click="$refs.file_pas_foto.click()">
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-xs font-bold text-unklab-black block">Tarik berkas pas foto ke sini atau Klik untuk Telusuri</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Format JPG, JPEG, atau PNG (Ukuran maks. 2.0 MB, rasio 3:4 atau 4:6)</span>
                        </div>
                        <input type="file" x-ref="file_pas_foto" class="hidden" accept=".jpg,.jpeg,.png" @change="handleFileSelect($event, 'pas_foto')">

                        <template x-if="selectedFiles.pas_foto">
                            <div class="mt-3 bg-slate-100 rounded-xl p-3 flex flex-col gap-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-unklab-black truncate" x-text="selectedFiles.pas_foto.name"></span>
                                    <span class="text-[10px] text-slate-500 font-mono" x-text="(selectedFiles.pas_foto.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" :id="'sim_pas_foto'" x-model="simulateReject.pas_foto" class="rounded text-rose-600 text-xs">
                                    <label :for="'sim_pas_foto'" class="text-[10px] text-rose-600 font-semibold cursor-pointer">Simulasikan Gagal AI (Test Rejection)</label>
                                </div>
                                <button type="button" @click="uploadAndVerify('pas_foto')" :disabled="loading.pas_foto"
                                        class="w-full py-2 px-3 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs font-bold rounded-lg transition-all shadow-sm flex items-center justify-center gap-2">
                                    <span x-show="!loading.pas_foto">Periksa Berkas dengan AI</span>
                                    <span x-show="loading.pas_foto" class="flex items-center gap-2">
                                        <svg class="animate-spin w-3.5 h-3.5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        Sedang Menganalisis Foto...
                                    </span>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Bottom Action -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <template x-if="docs.pas_foto?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Diverifikasi Sistem PMB UNKLAB</span>
                        <button type="button" @click="currentSlotEditing = 'pas_foto'" class="text-unklab-periwinkle font-semibold hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Ganti Berkas
                        </button>
                    </div>
                </template>
                <template x-if="docs.pas_foto?.is_uploaded && !docs.pas_foto?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Standar Foto Dikti</span>
                        <button type="button" @click="openRejectionModal('pas_foto')" class="text-rose-700 bg-rose-100 hover:bg-rose-200 px-3 py-1.5 rounded-lg font-bold flex items-center gap-1 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat Alasan Penolakan & Unggah Ulang
                        </button>
                    </div>
                </template>
                <template x-if="!docs.pas_foto?.is_uploaded">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Format: JPG, JPEG, PNG</span>
                        <button type="button" @click="$refs.file_pas_foto.click()" class="bg-unklab-navy text-white text-[11px] font-bold px-3 py-1.5 rounded-lg hover:bg-unklab-periwinkle transition-colors">
                            Pilih Berkas Foto
                        </button>
                    </div>
                </template>
            </div>
        </div>


        <!-- SLOT 4: KARTU TANDA PENDUDUK (KTP) [OPSIONAL (< 17 Thn)] -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6 flex flex-col justify-between transition-all"
             :class="docs.ktp?.is_valid ? 'ring-1 ring-emerald-500/30' : ''">
            <div>
                <!-- Slot Header -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <template x-if="isUnder17">
                            <span class="bg-[#C9B5E0] text-unklab-navy text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">
                                OPSIONAL (&lt; 17 Tahun)
                            </span>
                        </template>
                        <template x-if="!isUnder17">
                            <span class="bg-unklab-navy text-white text-[10px] font-bold px-2.5 py-0.5 rounded uppercase tracking-wider">
                                WAJIB
                            </span>
                        </template>
                        <h2 class="text-base font-bold text-unklab-black">Kartu Tanda Penduduk (KTP)</h2>
                    </div>

                    <template x-if="isUnder17 && !forceUploadKtp && !docs.ktp?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                            Dilewati Otomatis
                        </span>
                    </template>
                    <template x-if="docs.ktp?.is_valid">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Terverifikasi AI ✓
                        </span>
                    </template>
                </div>

                <!-- STATE: Under 17 Auto-Exempt Card (Matches Image 5!) -->
                <template x-if="isUnder17 && !forceUploadKtp && !docs.ktp?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <div class="flex items-center gap-2.5 text-xs font-bold text-unklab-black mb-1.5">
                                <div class="w-7 h-7 rounded-lg bg-unklab-lavender/40 text-unklab-navy flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                </div>
                                <span>Kandidat Terdaftar di Bawah Batas Usia Wajib KTP</span>
                            </div>
                            <p class="text-[11px] text-slate-600 leading-relaxed">
                                Berdasarkan tanggal lahir pada formulir biodata (<strong x-text="birthDateFormatted"></strong>), usia pendaftar terhitung <strong x-text="ageFormatted"></strong>. Persyaratan e-KTP dinonaktifkan secara otomatis oleh sistem PMB UNKLAB tanpa memengaruhi status kelulusan berkas.
                            </p>
                        </div>

                        <div class="p-3 bg-white rounded-xl border border-slate-200 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <div>
                                    <span class="font-bold text-unklab-black block text-[11px]">e-KTP Asli / KIA Siswa</span>
                                    <span class="text-[10px] text-slate-500">Tidak diperlukan untuk calon berstatus SMA aktif</span>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                ✓ Valid by KK
                            </span>
                        </div>
                    </div>
                </template>

                <!-- STATE: KTP is Uploaded & Valid -->
                <template x-if="docs.ktp?.is_valid">
                    <div class="space-y-3">
                        <div class="bg-[#FCF9EC] rounded-xl p-3.5 border border-amber-200/60 flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-emerald-100 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-unklab-black truncate" x-text="docs.ktp.filename"></div>
                                <div class="text-[10px] text-slate-500">Akurasi AI: <span class="font-bold text-emerald-600" x-text="docs.ktp.feedback?.accuracy || '99.6%'"></span></div>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 text-xs space-y-1">
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">HASIL EKSTRAKSI AI</div>
                            <pre class="font-sans text-[11px] text-slate-700 whitespace-pre-wrap leading-relaxed" x-text="docs.ktp.feedback?.hasil_ekstraksi || 'e-KTP Valid'"></pre>
                        </div>
                    </div>
                </template>

                <!-- STATE: Force Upload KTP Dropzone (or age >= 17) -->
                <template x-if="(!isUnder17 || forceUploadKtp) && !docs.ktp?.is_valid">
                    <div>
                        <p class="text-xs text-slate-600 mb-3 leading-relaxed">
                            Foto e-KTP asli secara jelas tanpa pantulan flash. AI akan mencocokkan NIK 16 digit dan nama pendaftar.
                        </p>
                        <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:border-unklab-periwinkle transition-colors cursor-pointer bg-slate-50/50"
                             @click="$refs.file_ktp.click()">
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span class="text-xs font-bold text-unklab-black block">Tarik berkas KTP ke sini atau Klik untuk Telusuri</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Format JPG, JPEG, PNG, atau PDF (Maks. 10 MB)</span>
                        </div>
                        <input type="file" x-ref="file_ktp" class="hidden" accept=".jpg,.jpeg,.png,.pdf" @change="handleFileSelect($event, 'ktp')">

                        <template x-if="selectedFiles.ktp">
                            <div class="mt-3 bg-slate-100 rounded-xl p-3 flex flex-col gap-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-unklab-black truncate" x-text="selectedFiles.ktp.name"></span>
                                    <span class="text-[10px] text-slate-500 font-mono" x-text="(selectedFiles.ktp.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" :id="'sim_ktp'" x-model="simulateReject.ktp" class="rounded text-rose-600 text-xs">
                                    <label :for="'sim_ktp'" class="text-[10px] text-rose-600 font-semibold cursor-pointer">Simulasikan Gagal AI (Test Rejection)</label>
                                </div>
                                <button type="button" @click="uploadAndVerify('ktp')" :disabled="loading.ktp"
                                        class="w-full py-2 px-3 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs font-bold rounded-lg transition-all shadow-sm flex items-center justify-center gap-2">
                                    <span x-show="!loading.ktp">Periksa Berkas dengan AI</span>
                                    <span x-show="loading.ktp" class="flex items-center gap-2">
                                        <svg class="animate-spin w-3.5 h-3.5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        Sedang Menganalisis KTP...
                                    </span>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Bottom Action for KTP -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <template x-if="isUnder17 && !forceUploadKtp && !docs.ktp?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Memiliki e-KTP lebih awal?</span>
                        <button type="button" @click="forceUploadKtp = true" class="text-unklab-periwinkle font-bold hover:underline flex items-center gap-1">
                            + Tetap Unggah KTP jika Ada
                        </button>
                    </div>
                </template>
                <template x-if="docs.ktp?.is_valid">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Diverifikasi Sistem PMB UNKLAB</span>
                        <button type="button" @click="forceUploadKtp = true; currentSlotEditing = 'ktp'" class="text-unklab-periwinkle font-semibold hover:underline">
                            Ganti Berkas
                        </button>
                    </div>
                </template>
                <template x-if="!isUnder17 && !docs.ktp?.is_uploaded">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-[10px] text-slate-400">Format: JPG, PNG, PDF</span>
                        <button type="button" @click="$refs.file_ktp.click()" class="bg-unklab-navy text-white text-[11px] font-bold px-3 py-1.5 rounded-lg hover:bg-unklab-periwinkle transition-colors">
                            Pilih Berkas KTP
                        </button>
                    </div>
                </template>
            </div>
        </div>

    </div>

    <!-- Ringkasan Validasi Sistem KlabatAI Card -->
    <div class="mt-8 bg-white rounded-2xl border border-slate-200/90 shadow-sm p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-unklab-navy text-white flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-unklab-lavender" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-unklab-black">Ringkasan Validasi Sistem KlabatAI</h3>
                <p class="text-xs text-slate-600 mt-0.5">
                    <span x-text="summaryText"></span>
                </p>
            </div>
        </div>

        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold self-start sm:self-auto flex-shrink-0"
              :class="allRequiredValid ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-amber-100 text-amber-800 border border-amber-300'">
            <span class="w-2 h-2 rounded-full" :class="allRequiredValid ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse'"></span>
            <span x-text="allRequiredValid ? 'Seluruh Berkas Wajib Lolos AI ✓' : ('Menunggu ' + remainingRequired + ' Dokumen')"></span>
        </span>
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('pmb.biodata') }}" class="px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-unklab-navy font-bold text-xs sm:text-sm transition-all shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>

        <div class="text-[11px] text-slate-400 hidden sm:flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            <span>Pemeriksaan dokumen dilindungi enkripsi dokumen TLS 1.3 UNKLAB</span>
        </div>

        <form action="{{ route('pmb.finalisasi') }}" method="POST">
            @csrf
            <button type="submit" 
                    :disabled="!allRequiredValid"
                    class="w-full sm:w-auto px-6 py-3 rounded-xl text-white font-bold text-xs sm:text-sm transition-all shadow-md inline-flex items-center justify-center gap-2 group"
                    :class="allRequiredValid ? 'bg-unklab-navy hover:bg-unklab-periwinkle cursor-pointer' : 'bg-slate-300 cursor-not-allowed text-slate-500 shadow-none'">
                <span>Lanjut ke Bukti Pendaftaran</span>
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>


    <!-- ======================================================== -->
    <!-- CENTER MODAL PENOLAKAN DOKUMEN INVALID (MATCHES IMAGE 4)  -->
    <!-- ======================================================== -->
    <div x-show="rejectionModal.open" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all animate-fadeIn"
         @keydown.escape.window="rejectionModal.open = false">
        
        <!-- Modal Card -->
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative border border-slate-200 transform transition-all"
             @click.away="rejectionModal.open = false">
            
            <!-- Close Button (Top Right) -->
            <button type="button" @click="rejectionModal.open = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 bg-slate-100 hover:bg-slate-200 w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <!-- Center Big Red Circle with Cross 'X' -->
            <div class="text-center mb-5">
                <div class="w-16 h-16 rounded-full bg-rose-100 border-4 border-rose-200 text-rose-600 mx-auto flex items-center justify-center mb-3.5 shadow-inner">
                    <svg class="w-8 h-8 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                
                <!-- Main Modal Title -->
                <h3 class="text-xl font-extrabold text-unklab-black tracking-tight uppercase">
                    DOKUMEN INVALID / DOKUMEN DITOLAK
                </h3>
                <p class="text-xs text-slate-600 mt-1" x-text="rejectionModal.subtitle || 'Berkas belum memenuhi standar verifikasi pendaftaran Universitas Klabat.'"></p>
            </div>

            <!-- Callout Note Box from AI PMB -->
            <div class="bg-[#FCF9EC] border border-amber-200 rounded-2xl p-4 sm:p-5 mb-5 text-xs text-slate-800">
                <div class="font-extrabold text-unklab-navy flex items-center gap-1.5 mb-2.5 text-xs">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"/></svg>
                    <span>Catatan Pemeriksaan & Kekurangan dari AI PMB:</span>
                </div>

                <ul class="space-y-2 text-[11px] text-slate-700 leading-relaxed">
                    <template x-for="(point, idx) in rejectionModal.points" :key="idx">
                        <li class="flex items-start gap-1.5">
                            <span class="text-rose-500 font-bold">&bull;</span>
                            <span x-text="point"></span>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Rejected File Badge Bar -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 flex items-center justify-between mb-6">
                <div class="flex items-center gap-2.5 truncate">
                    <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="truncate">
                        <span class="block text-xs font-bold text-unklab-black truncate" x-text="rejectionModal.filename"></span>
                        <span class="block text-[10px] text-slate-500 font-mono">Skor Validasi AI: <span class="text-rose-600 font-bold" x-text="rejectionModal.accuracy || '31.2%'"></span></span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <span class="inline-block text-[10px] font-bold text-rose-700 bg-rose-100 px-2 py-0.5 rounded">
                        Ditolak AI
                    </span>
                    <span class="block text-[9px] text-slate-400 mt-0.5" x-text="rejectionModal.verifier_mode === 'vision_api' ? 'Vision API' : 'Local OCR'"></span>
                </div>
            </div>

            <!-- CTA: Perbaiki & Unggah Ulang Berkas -->
            <button type="button" 
                    @click="fixAndReupload(rejectionModal.slot)"
                    class="w-full py-3.5 px-4 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs sm:text-sm font-bold rounded-xl transition-all shadow-md flex items-center justify-center gap-2 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <span>Perbaiki & Unggah Ulang Berkas</span>
            </button>
        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
function documentVerifier(config) {
    return {
        isUnder17: config.isUnder17,
        applicantName: config.applicantName,
        birthDateFormatted: config.birthDateFormatted,
        ageFormatted: config.ageFormatted,
        allRequiredValid: config.allRequiredValid,
        forceUploadKtp: false,
        currentSlotEditing: null,
        docs: config.initialDocs,
        selectedFiles: {
            kk: null,
            ijazah: null,
            pas_foto: null,
            ktp: null
        },
        simulateReject: {
            kk: false,
            ijazah: false,
            pas_foto: false,
            ktp: false
        },
        loading: {
            kk: false,
            ijazah: false,
            pas_foto: false,
            ktp: false
        },
        rejectionModal: {
            open: false,
            slot: 'ijazah',
            title: 'DOKUMEN INVALID / DOKUMEN DITOLAK',
            subtitle: '',
            points: [],
            filename: '',
            accuracy: '31.2%'
        },

        get totalRequired() {
            return this.isUnder17 ? 3 : 4;
        },

        get validCount() {
            let count = 0;
            if (this.docs.kk?.is_valid) count++;
            if (this.docs.ijazah?.is_valid) count++;
            if (this.docs.pas_foto?.is_valid) count++;
            if (!this.isUnder17 && this.docs.ktp?.is_valid) count++;
            return count;
        },

        get remainingRequired() {
            return Math.max(0, this.totalRequired - this.validCount);
        },

        get summaryText() {
            let valid = this.validCount;
            let rejected = 0;
            if (this.docs.kk?.is_uploaded && !this.docs.kk?.is_valid) rejected++;
            if (this.docs.ijazah?.is_uploaded && !this.docs.ijazah?.is_valid) rejected++;
            if (this.docs.pas_foto?.is_uploaded && !this.docs.pas_foto?.is_valid) rejected++;
            if (this.docs.ktp?.is_uploaded && !this.docs.ktp?.is_valid) rejected++;

            let remaining = this.remainingRequired;

            let parts = [];
            if (valid > 0) parts.push(`${valid} berkas telah disetujui`);
            if (rejected > 0) parts.push(`${rejected} berkas membutuhkan unggah ulang`);
            if (remaining > 0) parts.push(`${remaining} berkas wajib belum dikirim`);

            if (parts.length === 0) return 'Silakan unggah dokumen wajib Anda untuk diperiksa oleh AI.';
            return parts.join(', ') + '. Perbaiki dokumen yang ditolak agar tombol finalisasi dapat aktif.';
        },

        handleFileSelect(event, slot) {
            const file = event.target.files[0];
            if (file) {
                this.selectedFiles[slot] = file;
            }
        },

        async uploadAndVerify(slot) {
            const file = this.selectedFiles[slot];
            if (!file) return;

            this.loading[slot] = true;
            const formData = new FormData();
            formData.append('document_file', file);
            formData.append('document_type', slot);
            if (this.simulateReject[slot]) {
                formData.append('simulate_reject', '1');
            }

            try {
                const response = await fetch("{{ route('pmb.dokumen.verify') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();
                this.loading[slot] = false;

                if (data.success) {
                    this.docs[slot] = {
                        is_uploaded: true,
                        is_valid: data.is_valid,
                        filename: data.original_filename,
                        url: data.file_url,
                        feedback: {
                            is_valid: data.is_valid,
                            status_label: data.status_label,
                            alasan_penolakan: data.alasan_penolakan,
                            yang_harus_diperbaiki: data.yang_harus_diperbaiki,
                            hasil_ekstraksi: data.hasil_ekstraksi,
                            accuracy: data.accuracy,
                            notes: data.notes
                        }
                    };

                    this.allRequiredValid = data.all_required_valid;
                    this.selectedFiles[slot] = null;
                    this.currentSlotEditing = null;

                    // If invalid: trigger Center Rejection Modal immediately!
                    if (!data.is_valid) {
                        this.openRejectionModal(slot);
                    }
                } else {
                    alert(data.message || 'Gagal memproses dokumen.');
                }
            } catch (err) {
                this.loading[slot] = false;
                alert('Terjadi kesalahan jaringan saat mengunggah berkas.');
            }
        },

        openRejectionModal(slot) {
            const doc = this.docs[slot];
            const feedback = doc?.feedback || {};

            const slotLabels = {
                'kk': 'Kartu Keluarga (KK)',
                'ijazah': 'Ijazah / SKL',
                'pas_foto': 'Pas Foto Formal',
                'ktp': 'Kartu Tanda Penduduk (KTP)'
            };

            this.rejectionModal.slot = slot;
            this.rejectionModal.verifier_mode = feedback.verifier_mode || '{{ $activeVerifierMode ?? "local_ocr" }}';
            this.rejectionModal.title = 'DOKUMEN INVALID / DOKUMEN DITOLAK';
            this.rejectionModal.subtitle = `Berkas ${slotLabels[slot] || 'Dokumen'} belum memenuhi standar verifikasi pendaftaran Universitas Klabat.`;
            this.rejectionModal.filename = doc?.filename || 'dokumen_terlampir.pdf';
            this.rejectionModal.accuracy = feedback.accuracy || '31.2%';
            this.rejectionModal.points = feedback.yang_harus_diperbaiki && feedback.yang_harus_diperbaiki.length > 0 
                ? feedback.yang_harus_diperbaiki 
                : [
                    'Jenis berkas tidak sesuai: Dokumen tidak cocok dengan spesifikasi slot pendaftaran.',
                    'Kualitas gambar: Resolusi buram atau terdapat pemotongan sudut dokumen penting.',
                    'Yang harus diperbaiki: Unggah foto/scan penuh dokumen asli dengan pencahayaan terang merata.'
                ];
            this.rejectionModal.open = true;
        },

        fixAndReupload(slot) {
            this.rejectionModal.open = false;
            this.currentSlotEditing = slot;
            if (this.$refs['file_' + slot]) {
                setTimeout(() => {
                    this.$refs['file_' + slot].click();
                }, 200);
            }
        }
    };
}
</script>
@endpush
