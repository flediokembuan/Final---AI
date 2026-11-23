@extends('layouts.app')

@section('title', 'Langkah 1: Biodata & Program Studi - PMB UNKLAB')

@section('content')
<!-- Top Navbar -->
<header class="bg-white border-b border-slate-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-unklab-navy text-white flex items-center justify-center font-bold text-sm shadow-sm">
                UK
            </div>
            <div>
                <span class="block text-sm sm:text-base font-extrabold text-unklab-navy uppercase tracking-tight">Universitas Klabat</span>
                <span class="block text-[10px] text-unklab-periwinkle font-bold tracking-wider">SMART PMB ADMISSION</span>
            </div>
        </a>

        <!-- User Info & Logout -->
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
      x-data="{
          birthDate: '{{ old('birth_date', $application->birth_date?->format('Y-m-d') ?? '') }}',
          faculty: '{{ old('faculty', $application->faculty ?? 'Fakultas Ilmu Komputer (FIK)') }}',
          studyProgram: '{{ old('study_program', $application->study_program ?? 'S1 Informatika (Akreditasi Unggul)') }}',
          gender: '{{ old('gender', $application->gender ?? 'Laki-laki') }}',
          get age() {
              if (!this.birthDate) return 18;
              const dob = new Date(this.birthDate);
              const diffMs = Date.now() - dob.getTime();
              const ageDt = new Date(diffMs);
              return Math.abs(ageDt.getUTCFullYear() - 1970);
          },
          get isUnder17() {
              return this.age < 17;
          },
          prodiOptions: {
              'Fakultas Ilmu Komputer (FIK)': [
                  'S1 Informatika (Akreditasi Unggul)',
                  'S1 Sistem Informasi',
                  'S1 Teknologi Informasi'
              ],
              'Fakultas Ekonomi dan Bisnis': [
                  'S1 Manajemen',
                  'S1 Akuntansi',
                  'D3 Sekretari'
              ],
              'Fakultas Keperawatan': [
                  'S1 Keperawatan',
                  'Profesi Ners'
              ],
              'Fakultas Keguruan dan Ilmu Pendidikan': [
                  'S1 Pendidikan Bahasa Inggris',
                  'S1 Pendidikan Agama',
                  'S1 Pendidikan Ekonomi'
              ],
              'Fakultas Filsafat': [
                  'S1 Ilmu Filsafat Agama'
              ]
          },
          updateProdi() {
              const list = this.prodiOptions[this.faculty] || [];
              if (list.length > 0 && !list.includes(this.studyProgram)) {
                  this.studyProgram = list[0];
              }
          }
      }">

    <!-- Single Content Progress Stepper -->
    <div class="bg-white rounded-2xl p-4 mb-6 border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2 sm:gap-3 text-xs font-bold overflow-x-auto w-full sm:w-auto">
            <!-- Step 1 (Active) -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-unklab-navy text-white shadow-sm flex-shrink-0">
                <span class="w-5 h-5 rounded-full bg-white text-unklab-navy flex items-center justify-center text-[10px] font-black">1</span>
                <span>Biodata & Prodi</span>
            </div>
            <span class="text-slate-300">&rarr;</span>

            <!-- Step 2 (Pending) -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-400 flex-shrink-0">
                <span class="w-5 h-5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[10px]">2</span>
                <span>Verifikasi Berkas AI</span>
            </div>
            <span class="text-slate-300">&rarr;</span>

            <!-- Step 3 (Pending) -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-400 flex-shrink-0">
                <span class="w-5 h-5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[10px]">3</span>
                <span>Finalisasi & Bukti</span>
            </div>
        </div>

        <!-- Account Pill -->
        <div class="flex items-center gap-2 text-xs font-medium text-slate-600 bg-slate-50 px-3 py-1 rounded-full border border-slate-200 flex-shrink-0 self-end sm:self-center">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span>Akun Aktif: <strong class="text-unklab-black font-semibold">{{ auth()->user()->email }}</strong></span>
        </div>
    </div>

    <!-- Page Header & Step Progress -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-unklab-periwinkle uppercase tracking-wider mb-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                PORTAL PMB TA {{ now()->year }}/{{ now()->year + 1 }}
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-unklab-black tracking-tight">
                Langkah 1: Pengisian Biodata & Pilihan Program Studi
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-3xl">
                Lengkapi data identitas kependudukan dan program studi tujuan Anda di Universitas Klabat. Data ini akan disinkronisasikan otomatis dengan model verifikasi AI berkas ijazah.
            </p>
        </div>

        <!-- Progress Widget -->
        <div class="bg-white rounded-xl border border-slate-200 p-3 shadow-sm flex items-center gap-3 flex-shrink-0 self-start md:self-center">
            <div class="w-10 h-10 rounded-full border-4 border-emerald-500 border-t-emerald-200 flex items-center justify-center text-xs font-extrabold text-emerald-700">
                1/3
            </div>
            <div>
                <span class="block text-xs font-bold text-unklab-black">Tahap 1 dari 3</span>
                <span class="block text-[11px] text-emerald-600 font-semibold">Pengisian Biodata</span>
            </div>
        </div>
    </div>

    <!-- Main Content Form & Sidebar -->
    <form action="{{ route('pmb.biodata.store') }}" method="POST" id="biodataForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Column: Forms (8 cols) -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Card 1: Data Pribadi Calon Mahasiswa -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-7">
                    <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-unklab-navy/10 text-unklab-navy flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-unklab-black">Data Pribadi Calon Mahasiswa</h2>
                                <p class="text-xs text-slate-500">Identitas primer kependudukan sesuai dokumen resmi negara</p>
                            </div>
                        </div>
                        <span class="bg-unklab-navy text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            WAJIB LENGKAP
                        </span>
                    </div>

                    <div class="space-y-4">
                        <!-- Nama Lengkap -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="full_name" class="block text-xs font-bold text-unklab-black">
                                    Nama Lengkap (sesuai Ijazah / KK) <span class="text-rose-500">*</span>
                                </label>
                                <span class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Terverifikasi Kependudukan
                                </span>
                            </div>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="full_name" 
                                    id="full_name" 
                                    required 
                                    value="{{ old('full_name', $application->full_name ?? auth()->user()->name) }}" 
                                    placeholder="Contoh: Gabriel Julian Mamahit"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                                >
                            </div>
                        </div>

                        <!-- Row: NIK & WhatsApp -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="nik" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    NIK Kependudukan (16 Digit) <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nik" 
                                    id="nik" 
                                    required 
                                    maxlength="16"
                                    value="{{ old('nik', $application->nik ?? '') }}" 
                                    placeholder="Contoh: 7102012408080003"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle font-mono transition-all"
                                >
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    Nomor WhatsApp / HP Aktif <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="whatsapp" 
                                    id="whatsapp" 
                                    required 
                                    value="{{ old('whatsapp', $application->whatsapp ?? '') }}" 
                                    placeholder="Contoh: +62 821-9876-5432"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                                >
                                <span class="block text-[10px] text-slate-400 mt-1">Digunakan untuk koordinasi Panitia PMB & pendataan grup mahasiswa baru (MABA)</span>
                            </div>
                        </div>

                        <!-- Row: Tempat Lahir & Tanggal Lahir -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="birth_place" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    Tempat Lahir <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="birth_place" 
                                    id="birth_place" 
                                    required 
                                    value="{{ old('birth_place', $application->birth_place ?? '') }}" 
                                    placeholder="Contoh: Airmadidi / Manado"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                                >
                            </div>

                            <div>
                                <label for="birth_date" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    Tanggal Lahir <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="birth_date" 
                                    id="birth_date" 
                                    required 
                                    x-model="birthDate"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                                >
                            </div>
                        </div>

                        <!-- Smart Auto-Detect AI Banner for < 17 Years Old -->
                        <div x-show="isUnder17" x-cloak class="p-3.5 rounded-xl bg-[#EBE2F5] border border-unklab-lavender/60 flex items-center justify-between text-xs text-unklab-navy transition-all animate-fadeIn">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-unklab-navy text-white flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-[10px] bg-unklab-navy text-white px-2 py-0.5 rounded-md uppercase tracking-wider mr-1">SMART AUTO-DETECT AI</span>
                                    <span class="text-xs">Usia terdeteksi <strong class="text-unklab-navy font-bold">&lt; 17 tahun</strong> &mdash; KTP bersifat <strong class="uppercase text-unklab-periwinkle">OPSIONAL</strong> pada tahap unggah berkas.</span>
                                </div>
                            </div>
                            <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-bold text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-300">
                                ✓ Aturan KK Aktif
                            </span>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-xs font-bold text-unklab-black mb-1.5">
                                Jenis Kelamin <span class="text-rose-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors" :class="gender === 'Laki-laki' ? 'border-unklab-periwinkle bg-unklab-periwinkle/5 ring-1 ring-unklab-periwinkle' : ''">
                                    <input type="radio" name="gender" value="Laki-laki" x-model="gender" class="text-unklab-navy focus:ring-unklab-periwinkle">
                                    <div>
                                        <div class="text-xs font-bold text-unklab-black">Laki-laki</div>
                                        <div class="text-[10px] text-slate-400">Sesuai akta kelahiran</div>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors" :class="gender === 'Perempuan' ? 'border-unklab-periwinkle bg-unklab-periwinkle/5 ring-1 ring-unklab-periwinkle' : ''">
                                    <input type="radio" name="gender" value="Perempuan" x-model="gender" class="text-unklab-navy focus:ring-unklab-periwinkle">
                                    <div>
                                        <div class="text-xs font-bold text-unklab-black">Perempuan</div>
                                        <div class="text-[10px] text-slate-400">Sesuai akta kelahiran</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Alamat Lengkap Domisili -->
                        <div>
                            <label for="address" class="block text-xs font-bold text-unklab-black mb-1.5">
                                Alamat Lengkap Domisili <span class="text-rose-500">*</span>
                            </label>
                            <textarea 
                                name="address" 
                                id="address" 
                                rows="3" 
                                required 
                                placeholder="Sertakan nama jalan, nomor rumah, RT/RW, dan kode pos jika tersedia"
                                class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                            >{{ old('address', $application->address ?? 'Jl. Arnold Mononutu No. 45, Airmadidi Atas, Minahasa Utara, Sulawesi Utara') }}</textarea>
                            <span class="block text-[10px] text-slate-400 mt-1">Sertakan nomor rumah, RT/RW, dan kode pos jika tersedia</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Data Pendidikan & Pilihan Program Studi UNKLAB -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-7">
                    <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-unklab-periwinkle/10 text-unklab-periwinkle flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-unklab-black">Data Pendidikan & Pilihan Program Studi UNKLAB</h2>
                                <p class="text-xs text-slate-500">Tentukan peminatan akademik di lingkungan kampus Universitas Klabat</p>
                            </div>
                        </div>
                        <span class="bg-unklab-periwinkle text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            PILIHAN UTAMA
                        </span>
                    </div>

                    <div class="space-y-4">
                        <!-- Row: Asal Sekolah & NISN -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="school_name" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    Asal Sekolah (SMA / SMK / MA) <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="school_name" 
                                    id="school_name" 
                                    required 
                                    value="{{ old('school_name', $application->school_name ?? '') }}" 
                                    placeholder="Contoh: SMA Negeri 1 Airmadidi"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                                >
                            </div>

                            <div>
                                <label for="nisn" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    NISN (Nomor Induk Siswa Nasional) <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nisn" 
                                    id="nisn" 
                                    required 
                                    value="{{ old('nisn', $application->nisn ?? '') }}" 
                                    placeholder="Contoh: 0084592011"
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle font-mono transition-all"
                                >
                            </div>
                        </div>

                        <!-- Row: Tahun Kelulusan & Jalur Pendaftaran -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="graduation_year" class="block text-xs font-bold text-unklab-black mb-1.5">
                                    Tahun Kelulusan <span class="text-rose-500">*</span>
                                </label>
                                <select 
                                    name="graduation_year" 
                                    id="graduation_year" 
                                    required 
                                    class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                                >
                                    <option value="2026" {{ old('graduation_year', $application->graduation_year ?? '2026') == '2026' ? 'selected' : '' }}>2026 (Tahun ini)</option>
                                    <option value="2025" {{ old('graduation_year', $application->graduation_year) == '2025' ? 'selected' : '' }}>2025</option>
                                    <option value="2024" {{ old('graduation_year', $application->graduation_year) == '2024' ? 'selected' : '' }}>2024</option>
                                    <option value="2023" {{ old('graduation_year', $application->graduation_year) == '2023' ? 'selected' : '' }}>2023 / Sebelumnya</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-unklab-black mb-1.5">
                                    Jalur Pendaftaran Terpilih
                                </label>
                                <div class="px-3.5 py-2.5 rounded-xl bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700 flex items-center justify-between">
                                    <span class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-unklab-periwinkle"></span>
                                        Jalur Reguler Gelombang 1
                                    </span>
                                    <span class="text-[10px] text-slate-500 font-mono">2026/2027</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pilihan Fakultas -->
                        <div>
                            <label for="faculty" class="block text-xs font-bold text-unklab-black mb-1.5">
                                Pilihan Fakultas <span class="text-rose-500">*</span>
                            </label>
                            <select 
                                name="faculty" 
                                id="faculty" 
                                required 
                                x-model="faculty"
                                @change="updateProdi()"
                                class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                            >
                                <option value="Fakultas Ilmu Komputer (FIK)">Fakultas Ilmu Komputer (FIK)</option>
                                <option value="Fakultas Ekonomi dan Bisnis">Fakultas Ekonomi dan Bisnis</option>
                                <option value="Fakultas Keperawatan">Fakultas Keperawatan</option>
                                <option value="Fakultas Keguruan dan Ilmu Pendidikan">Fakultas Keguruan dan Ilmu Pendidikan</option>
                                <option value="Fakultas Filsafat">Fakultas Filsafat</option>
                            </select>
                        </div>

                        <!-- Pilihan Program Studi Utama (Hanya 1 Pilihan Utama) -->
                        <div>
                            <label for="study_program" class="block text-xs font-bold text-unklab-black mb-1.5">
                                Pilihan Program Studi Utama <span class="text-rose-500">*</span>
                            </label>
                            <select 
                                name="study_program" 
                                id="study_program" 
                                required 
                                x-model="studyProgram"
                                class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                            >
                                <template x-for="item in prodiOptions[faculty] || []" :key="item">
                                    <option :value="item" x-text="item" :selected="item === studyProgram"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Notice Box for Faculty -->
                        <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200/80 flex items-start gap-2.5 text-xs text-slate-600">
                            <svg class="w-4 h-4 text-unklab-periwinkle flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="leading-relaxed text-[11px]">
                                Pendaftar FIK Universitas Klabat akan mengikuti tes penempatan logika komputasi dan matematika dasar setelah verifikasi berkas tuntas disetujui.
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: UNKLAB Info & Next Step Preview (4 cols) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Campus Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="h-36 bg-gradient-to-r from-unklab-navy via-unklab-navy-dark to-unklab-periwinkle relative p-4 flex flex-col justify-end text-white">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-unklab-lavender">FAKULTAS ILMU KOMPUTER</span>
                        <div class="text-base font-extrabold leading-tight">Pusat Keunggulan Teknologi UNKLAB</div>
                    </div>
                    <div class="p-4 space-y-3 text-xs">
                        <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                            <span class="text-slate-500">Kampus Utama</span>
                            <span class="font-bold text-unklab-black">Airmadidi, Minut</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                            <span class="text-slate-500">Metode Kuliah</span>
                            <span class="font-bold text-unklab-black">Full Tatap Muka (On-Campus)</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5">
                            <span class="text-slate-500">Akreditasi Institusi</span>
                            <span class="font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded text-[11px]">UNGGUL (BAN-PT)</span>
                        </div>
                    </div>
                </div>

                <!-- Next Step Preview Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-unklab-periwinkle/15 text-unklab-periwinkle font-black text-xs flex items-center justify-center">
                            2
                        </div>
                        <div>
                            <div class="text-xs font-bold text-unklab-black">Tahap Selanjutnya: AI Verification</div>
                            <div class="text-[10px] text-slate-500">Pratinjau berkas yang akan diunggah</div>
                        </div>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <span class="font-semibold text-slate-700">Kartu Keluarga (KK)</span>
                            <span class="text-[10px] font-bold text-unklab-navy bg-unklab-navy/10 px-2 py-0.5 rounded">Wajib</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <span class="font-semibold text-slate-700">Ijazah / SKL SMA</span>
                            <span class="text-[10px] font-bold text-unklab-navy bg-unklab-navy/10 px-2 py-0.5 rounded">Wajib</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <span class="font-semibold text-slate-700">Pas Foto Latar Belakang Biru</span>
                            <span class="text-[10px] font-bold text-unklab-navy bg-unklab-navy/10 px-2 py-0.5 rounded">Wajib</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between" :class="isUnder17 ? 'bg-amber-50/60 border-amber-200' : ''">
                            <span class="font-semibold text-slate-700">KTP Calon Mahasiswa</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded" :class="isUnder17 ? 'text-amber-800 bg-amber-100' : 'text-unklab-navy bg-unklab-navy/10'" x-text="isUnder17 ? 'Opsional (< 17 Thn)' : 'Wajib'"></span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-unklab-periwinkle flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>OCR cerdas akan membaca nama & nomor raport dalam 4 detik.</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Bottom Action Bar -->
        <div class="mt-8 pt-6 border-t border-slate-200/90 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-slate-500 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                <span>Tersimpan otomatis sebagai draft ({{ now()->format('H:i') }} WITA)</span>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button 
                    type="submit" 
                    name="action" 
                    value="draft" 
                    class="flex-1 sm:flex-none px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-unklab-navy font-bold text-xs sm:text-sm transition-all shadow-sm"
                >
                    Simpan Sementara
                </button>

                <button 
                    type="submit" 
                    name="action" 
                    value="next" 
                    class="flex-1 sm:flex-none px-6 py-3 rounded-xl bg-unklab-navy hover:bg-unklab-periwinkle text-white font-bold text-xs sm:text-sm transition-all shadow-md inline-flex items-center justify-center gap-2 group"
                >
                    <span>Simpan & Lanjut ke Unggah Berkas</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </div>

    </form>
</main>
@endsection
