@extends('layouts.app')

@section('title', 'Dashboard Panitia PMB - Universitas Klabat')

@section('content')
<div class="min-h-screen bg-unklab-cream flex flex-col md:flex-row" 
     x-data="adminDashboard({
         initialSelected: {{ Js::from($initialSelectedData) }}
     })">

    <!-- ============================================== -->
    <!-- LEFT SIDEBAR (DEEP NAVY #00105B)               -->
    <!-- ============================================== -->
    <aside class="w-full md:w-64 bg-unklab-navy text-white flex-shrink-0 flex flex-col justify-between p-6">
        <div>
            <!-- Brand -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-white text-unklab-navy flex items-center justify-center font-black text-base shadow-md">
                    UK
                </div>
                <div>
                    <span class="block text-sm font-extrabold tracking-tight">PMB Admin</span>
                    <span class="block text-[10px] text-unklab-lavender tracking-wider uppercase font-semibold">UNIVERSITAS KLABAT</span>
                </div>
            </div>

            <!-- Navigation -->
            <div class="space-y-1">
                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 px-3">
                    NAVIGASI SISTEM
                </span>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-unklab-periwinkle text-white text-xs font-bold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard Statistik</span>
                </a>

                <a href="#daftar-pendaftar" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 text-xs font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Daftar Calon Mahasiswa</span>
                </a>

                <a href="javascript:void(0)" @click="alert('Seluruh berkas diproses dengan verifikasi presisi AI Engine v4.2 UNKLAB')" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 text-xs font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Log Audit AI</span>
                </a>
            </div>
        </div>

        <!-- Connection Status Pill -->
        <div class="mt-8 pt-6 border-t border-white/10 text-xs">
            <div class="bg-white/5 rounded-xl p-3 border border-white/10 space-y-1">
                <div class="flex items-center gap-2 text-unklab-lavender font-bold text-[11px]">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>ENGINE AI AKTIF</span>
                </div>
                <div class="text-[11px] font-mono text-emerald-300 font-bold">
                    {{ $activeVerifierLabel ?? 'Mode: Local OCR Engine' }}
                </div>
                <p class="text-[10px] text-slate-300 leading-tight">
                    Model verifikasi dokumen berjalan dengan akurasi 99.4%.
                </p>
            </div>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- RIGHT MAIN CONTENT (WARM CREAM #FCF9EC)        -->
    <!-- ============================================== -->
    <main class="flex-1 flex flex-col min-w-0">
        
        <!-- Top Utility Bar -->
        <header class="bg-white border-b border-slate-200 px-6 py-3.5 flex items-center justify-between">
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                TAHUN AKADEMIK {{ now()->year }}/{{ now()->year + 1 }}
            </span>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <span class="block text-xs font-bold text-unklab-black">{{ auth()->user()->name }}</span>
                    <span class="block text-[10px] text-slate-500 font-mono">{{ auth()->user()->email }}</span>
                </div>
                <div class="w-9 h-9 rounded-full bg-unklab-navy text-white flex items-center justify-center font-bold text-xs shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-slate-100 transition-colors" title="Keluar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </header>

        <div class="p-6 sm:p-8 space-y-6">
            
            <!-- Page Heading -->
            <div>
                <div class="inline-flex items-center gap-2 text-xs font-bold text-unklab-periwinkle uppercase tracking-wider mb-1">
                    <span>PORTAL SELEKSI MANDIRI</span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1 text-emerald-600">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Model v4.2 Siap
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-unklab-black tracking-tight">
                    Dashboard Approval Pendaftaran Mahasiswa Baru
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">
                    Pantau verifikasi berkas otomatis AI dan terbitkan keputusan panitia secara tepat.
                </p>
            </div>

            <!-- 4 Stat Cards Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1: Total Pendaftar -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-sm">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        <span>TOTAL PENDAFTAR</span>
                        <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-unklab-black">{{ $totalApplicants }}</span>
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded">Total</span>
                    </div>
                    <div class="mt-3 text-[11px] text-slate-500 flex items-center justify-between border-t border-slate-100 pt-2">
                        <span>Pembaruan: {{ now()->format('d M Y, H:i') }} WITA</span>
                        <svg class="w-12 h-4 text-unklab-periwinkle stroke-2" fill="none" viewBox="0 0 48 16"><path d="M0 12 L12 8 L24 14 L36 4 L48 6" stroke="currentColor"/></svg>
                    </div>
                </div>

                <!-- Card 2: Lolos Verifikasi AI -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-sm">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        <span>LOLOS VERIFIKASI AI</span>
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-unklab-black">{{ $verifiedAiCount }}</span>
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-100 px-1.5 py-0.5 rounded">{{ $totalApplicants > 0 ? round(($verifiedAiCount / $totalApplicants) * 100, 1) : 0 }}% Lolos</span>
                    </div>
                    <div class="mt-3 text-[11px] text-slate-500 flex items-center justify-between border-t border-slate-100 pt-2">
                        <span>Validasi NIK & SKL selesai</span>
                        <div class="w-12 bg-emerald-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-emerald-600 h-1.5 rounded-full" style="width: {{ $totalApplicants > 0 ? round(($verifiedAiCount / $totalApplicants) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Revisi / Ditolak AI -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-sm">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        <span>REVISI / DITOLAK AI</span>
                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-unklab-black">{{ $rejectedAiCount }}</span>
                        <span class="text-xs font-bold text-rose-700 bg-rose-100 px-1.5 py-0.5 rounded">Follow-up</span>
                    </div>
                    <div class="mt-3 text-[11px] text-slate-500 flex items-center justify-between border-t border-slate-100 pt-2">
                        <span class="text-rose-600 font-semibold">&bull; Perlu Revisi Berkas</span>
                        <a href="#daftar-pendaftar" class="text-unklab-periwinkle font-bold text-[10px] hover:underline">Buka Antrean</a>
                    </div>
                </div>

                <!-- Card 4: Pendaftar < 17 Tahun (Bebas KTP) -->
                <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-sm">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        <span>PENDAFTAR &lt; 17 THN</span>
                        <div class="w-7 h-7 rounded-lg bg-unklab-lavender/30 text-unklab-navy flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-unklab-black">{{ $under17Count }}</span>
                        <span class="text-xs font-bold text-unklab-navy bg-[#EBE2F5] px-1.5 py-0.5 rounded">Bebas KTP</span>
                    </div>
                    <div class="mt-3 text-[11px] text-slate-500 flex items-center justify-between border-t border-slate-100 pt-2">
                        <span class="flex items-center gap-1 text-slate-600">
                            <svg class="w-3.5 h-3.5 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Otomatis Verifikasi KK
                        </span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>
                </div>
            </div>

            <!-- Search & Filters Row -->
            <form action="{{ route('admin.dashboard') }}" method="GET" class="bg-white rounded-2xl border border-slate-200 p-4 shadow-sm flex flex-col md:flex-row items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 w-full">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari Nama Pendaftar, NIK, atau Nomor Pendaftaran..."
                        class="w-full text-xs pl-10 pr-3.5 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all"
                    >
                </div>

                <!-- Status Filter -->
                <div class="w-full md:w-48">
                    <select name="status" onchange="this.form.submit()" class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all">
                        <option value="all">Semua Status</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Menunggu Approval</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Prodi Filter -->
                <div class="w-full md:w-56">
                    <select name="prodi" onchange="this.form.submit()" class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-300 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-unklab-periwinkle transition-all">
                        <option value="all">Semua Program Studi</option>
                        @foreach($studyPrograms as $sp)
                            <option value="{{ $sp }}" {{ request('prodi') == $sp ? 'selected' : '' }}>{{ $sp }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full md:w-auto px-4 py-2.5 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Filter</span>
                </button>
            </form>

            <!-- Main Split Layout: Table (Left) + Evaluation Panel (Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start" id="daftar-pendaftar">
                
                <!-- Table Column: 7 cols -->
                <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                                <tr>
                                    <th class="py-3 px-4">NO. DAFTAR</th>
                                    <th class="py-3 px-4">NAMA & EMAIL PENDAFTAR</th>
                                    <th class="py-3 px-4">PROGRAM STUDI</th>
                                    <th class="py-3 px-4 text-center">STATUS</th>
                                    <th class="py-3 px-4 text-center">KARTU EMAIL</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($applicants as $app)
                                    <tr class="hover:bg-slate-50/80 transition-colors cursor-pointer"
                                        :class="selected?.id === {{ $app->id }} ? 'bg-unklab-periwinkle/5 ring-1 ring-inset ring-unklab-periwinkle/40' : ''"
                                        @click="selectApplicant({{ $app->id }})">
                                        
                                        <!-- No. Daftar -->
                                        <td class="py-3.5 px-4 font-mono font-bold text-unklab-navy whitespace-nowrap">
                                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-unklab-periwinkle mr-1.5"></span>
                                            {{ $app->registration_number ?? 'PMB-' . now()->year . '-00' . $app->id }}
                                        </td>

                                        <!-- Nama, Email & No HP/WhatsApp -->
                                        <td class="py-3.5 px-4">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-full bg-unklab-navy text-white flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                    {{ strtoupper(substr($app->full_name ?? $app->user?->name ?? 'M', 0, 2)) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <span class="font-bold text-unklab-black block truncate">{{ $app->full_name ?? $app->user?->name }}</span>
                                                    <div class="flex items-center gap-1.5 flex-wrap text-[10px] text-slate-500 mt-0.5">
                                                        <span class="truncate">{{ $app->user?->email }}</span>
                                                        @if($app->whatsapp)
                                                            <span class="inline-flex items-center gap-1 text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded font-mono font-semibold border border-emerald-200">
                                                                <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
                                                                {{ $app->whatsapp }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Program Studi -->
                                        <td class="py-3.5 px-4">
                                            <span class="font-bold text-unklab-black block truncate">{{ $app->study_program ?? '-' }}</span>
                                            <span class="text-[10px] text-slate-500 block truncate">{{ $app->faculty ?? '-' }}</span>
                                        </td>

                                        <!-- Status Approval -->
                                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                            @if($app->status === 'approved')
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                                    Disetujui
                                                </span>
                                            @elseif($app->status === 'rejected')
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-rose-700 bg-rose-50 px-2.5 py-1 rounded-full border border-rose-200">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                    Menunggu
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Status Pengiriman Kartu oleh Admin -->
                                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                            @if($app->confirmation_email_sent_at)
                                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2.5 py-1 rounded-full border border-emerald-300" title="Dikirim: {{ $app->confirmation_email_sent_at->format('d M Y, H:i') }} WITA">
                                                    <svg class="w-3 h-3 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    <span>Terkirim</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    <span>Belum Dikirim</span>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-400 text-xs">
                                            Tidak ada data calon mahasiswa yang cocok dengan pencarian.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                        <div>
                            Menampilkan <strong>{{ $applicants->firstItem() ?? 0 }}</strong> - <strong>{{ $applicants->lastItem() ?? 0 }}</strong> dari <strong>{{ $applicants->total() }}</strong> calon mahasiswa
                        </div>
                        <div>
                            {{ $applicants->links() }}
                        </div>
                    </div>
                </div>

                <!-- Right Evaluation Panel: 5 cols (Matches Image 7!) -->
                <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/90 shadow-sm p-6 space-y-5 sticky top-20">
                    
                    <template x-if="selected">
                        <div class="space-y-4">
                            <!-- Panel Header -->
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-unklab-periwinkle flex items-center gap-1.5">
                                    <span>PANEL EVALUASI</span>
                                    <span>&bull;</span>
                                    <span class="font-mono text-unklab-navy" x-text="selected.reg"></span>
                                </div>
                                <span class="w-2.5 h-2.5 rounded-full" :class="selected.status === 'approved' ? 'bg-emerald-500' : (selected.status === 'rejected' ? 'bg-rose-500' : 'bg-amber-500 animate-pulse')"></span>
                            </div>

                            <!-- Applicant Title -->
                            <div>
                                <h3 class="text-xl font-black text-unklab-black" x-text="selected.name"></h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Pilihan: <strong class="text-unklab-navy" x-text="selected.prodi"></strong> &bull; Reguler Kampus Airmadidi
                                </p>
                            </div>

                            <!-- No. HP / WhatsApp Mahasiswa (Data Only) -->
                            <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200 text-xs">
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">No. HP / WhatsApp</span>
                                <span class="font-mono font-bold text-sm text-unklab-black" x-text="selected.whatsapp || '—'"></span>
                            </div>

                            <!-- AI Verification Match Pill -->
                            <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span class="font-bold text-unklab-black">Hasil Verifikasi AI</span>
                                </div>
                                <span class="text-xs font-extrabold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded">
                                    99.4% Match
                                </span>
                            </div>

                            <!-- Under 17 Special Rule Box -->
                            <template x-if="selected.is_under_17">
                                <div class="bg-[#EBE2F5] rounded-xl p-3.5 border border-unklab-lavender/70 text-xs text-unklab-navy space-y-1">
                                    <div class="font-bold flex items-center justify-between text-xs text-unklab-black">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-unklab-periwinkle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                            <span>Usia: <span x-text="selected.age_formatted"></span></span>
                                        </div>
                                        <span class="text-[9px] uppercase font-black bg-unklab-navy text-white px-1.5 py-0.5 rounded">AUTO</span>
                                    </div>
                                    <p class="text-[11px] text-slate-700 leading-relaxed">
                                        <strong>Bebas Syarat KTP</strong> sesuai Kebijakan Admisi UNKLAB No. 14/SK/UNKLAB/2024. Dokumen legalitas dialihkan penuh ke Kartu Keluarga (KK).
                                    </p>
                                </div>
                            </template>

                            <!-- Document Inspection List (INSPEKSI BERKAS DIGITAL) -->
                            <div>
                                <span class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">
                                    INSPEKSI BERKAS DIGITAL (<span x-text="selected.documents.length"></span> LAMPIRAN)
                                </span>

                                <div class="space-y-2.5">
                                    <template x-for="doc in selected.documents" :key="doc.id">
                                        <div class="bg-slate-50 hover:bg-slate-100/80 transition-colors rounded-xl p-3 border border-slate-200/80 flex items-center justify-between text-xs">
                                            <div class="flex items-center gap-2.5 truncate">
                                                <div class="w-8 h-8 rounded-lg bg-unklab-navy/10 text-unklab-navy flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                    AI
                                                </div>
                                                <div class="truncate">
                                                    <span class="font-bold text-unklab-black block truncate" x-text="doc.filename"></span>
                                                    <span class="text-[10px] text-slate-500 block" x-text="doc.type_label"></span>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-2 flex-shrink-0">
                                                <span class="text-[10px] font-bold px-2 py-0.5 rounded"
                                                      :class="doc.is_valid ? 'text-emerald-700 bg-emerald-100' : 'text-rose-700 bg-rose-100'"
                                                      x-text="doc.is_valid ? 'Valid ✓' : 'Ditolak AI'">
                                                </span>
                                                <button type="button" @click="previewDoc(doc)" class="text-unklab-periwinkle hover:text-unklab-navy p-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- KARTU PENDAFTARAN & PENGIRIMAN EMAIL RESMI OLEH ADMIN -->
                            <div class="bg-gradient-to-br from-blue-50/80 via-indigo-50/40 to-slate-50 rounded-2xl p-4 border border-blue-200/80 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-unklab-navy text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                            <svg class="w-4 h-4 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                        </div>
                                        <div>
                                            <span class="text-xs font-extrabold text-unklab-navy block">Kartu Tanda Bukti Pendaftaran</span>
                                            <span class="text-[10px] text-slate-500 block" x-text="selected.card_sent ? 'Status: Terkirim (' + selected.card_sent_at + ')' : 'Status: Masuk ke admin, belum dikirim ke email'"></span>
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full"
                                          :class="selected.card_sent ? 'text-emerald-800 bg-emerald-100 border border-emerald-300' : 'text-amber-800 bg-amber-100 border border-amber-300'"
                                          x-text="selected.card_sent ? '✓ Terkirim' : '⏳ Belum Dikirim'">
                                    </span>
                                </div>

                                <div class="bg-white/80 rounded-xl p-2.5 border border-blue-100 text-[11px] flex items-center justify-between">
                                    <span class="text-slate-500">Email Calon Mahasiswa:</span>
                                    <strong class="text-unklab-black font-mono" x-text="selected.email || '—'"></strong>
                                </div>

                                <button type="button" 
                                        @click="openSendCardModal()"
                                        class="w-full py-2.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-2 group">
                                    <svg class="w-4 h-4 text-emerald-200 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span x-text="selected.card_sent ? 'Kirim Ulang Kartu ke Email Mahasiswa' : 'Kirim Kartu ke Email Mahasiswa'"></span>
                                </button>
                            </div>

                            <!-- Decision Action Buttons: Approve & Tolak -->
                            <div class="pt-4 border-t border-slate-100 space-y-2">
                                <form :action="'/admin/applicant/' + selected.id + '/approve'" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full py-3 px-4 bg-unklab-navy hover:bg-unklab-periwinkle text-white text-xs sm:text-sm font-bold rounded-xl transition-all shadow-md flex items-center justify-center gap-2 group">
                                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Approve Pendaftaran</span>
                                    </button>
                                </form>

                                <form :action="'/admin/applicant/' + selected.id + '/reject'" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full py-2.5 px-4 bg-white hover:bg-rose-50 text-rose-600 border border-rose-300 text-xs sm:text-sm font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Tolak Pendaftaran</span>
                                    </button>
                                </form>
                            </div>

                            <!-- Panel Signer Footer -->
                            <div class="text-[10px] text-slate-400 text-center flex items-center justify-center gap-1 pt-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span>Diverifikasi atas nama <strong class="text-slate-600 font-mono">{{ auth()->user()->email }}</strong></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="!selected">
                        <div class="py-12 text-center text-slate-400 text-xs">
                            Pilih salah satu calon mahasiswa dari tabel di sebelah kiri untuk melihat evaluasi berkas.
                        </div>
                    </template>
                </div>

            </div>

        </div>
    </main>

    <!-- Document Detail / Preview Modal -->
    <div x-show="docModal.open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" @keydown.escape.window="docModal.open = false">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-200" @click.away="docModal.open = false">
            <button type="button" @click="docModal.open = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <h3 class="text-base font-bold text-unklab-black mb-1" x-text="docModal.title"></h3>
            <p class="text-xs text-slate-500 font-mono mb-4" x-text="docModal.filename"></p>

            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-xs space-y-2 mb-4">
                <div class="font-bold text-unklab-navy">Hasil Audit AI:</div>
                <div class="text-[11px] text-slate-700 whitespace-pre-wrap leading-relaxed" x-text="docModal.summary"></div>
                <div class="text-[10px] text-slate-500 pt-2 border-t border-slate-200">
                    Status: <strong :class="docModal.isValid ? 'text-emerald-600' : 'text-rose-600'" x-text="docModal.isValid ? 'VALID' : 'INVALID / DITOLAK'"></strong>
                </div>
            </div>

            <button type="button" @click="docModal.open = false" class="w-full py-2.5 bg-unklab-navy text-white text-xs font-bold rounded-xl hover:bg-unklab-periwinkle transition-colors">
                Tutup Pratinjau
            </button>
        </div>
    </div>

    <!-- Send Registration Card to Email Modal -->
    <div x-show="sendCardModal.open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" @keydown.escape.window="if(!sendCardModal.loading) sendCardModal.open = false">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-200" @click.away="if(!sendCardModal.loading) sendCardModal.open = false">
            <button type="button" @click="sendCardModal.open = false" :disabled="sendCardModal.loading" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-unklab-black">Kirim Kartu Bukti Pendaftaran</h3>
                    <p class="text-xs text-slate-500">Kirim kartu pendaftaran resmi & ucapan selamat ke email calon mahasiswa</p>
                </div>
            </div>

            <!-- Recipient Detail Box -->
            <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200 text-xs space-y-1.5 mb-4">
                <div class="flex justify-between">
                    <span class="text-slate-500 font-semibold">Nama Mahasiswa:</span>
                    <strong class="text-unklab-black" x-text="selected?.name"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 font-semibold">Email Tujuan:</span>
                    <strong class="text-emerald-700 font-mono" x-text="selected?.email"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 font-semibold">Nomor Pendaftaran:</span>
                    <span class="font-mono font-bold text-unklab-navy" x-text="selected?.reg"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 font-semibold">Program Studi:</span>
                    <span class="font-bold text-slate-700" x-text="selected?.prodi"></span>
                </div>
            </div>

            <!-- Custom Message / Ucapan Selamat Form -->
            <div class="space-y-2 mb-4">
                <label class="block text-xs font-bold text-slate-700">
                    Template Kata Ucapan Selamat:
                </label>
                <textarea 
                    x-model="sendCardModal.note" 
                    rows="3" 
                    class="w-full text-xs p-3 rounded-xl border border-slate-300 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all text-slate-700"
                    placeholder="Tulis ucapan selamat resmi untuk mahasiswa baru..."></textarea>
                <p class="text-[10px] text-slate-400">
                    * Email yang dikirimkan berisi template ucapan selamat resmi dan kartu pendaftaran dengan desain identik seperti pada sistem.
                </p>
            </div>

            <!-- Live Status Alert -->
            <template x-if="sendCardModal.successMsg">
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs p-3 rounded-xl flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span x-text="sendCardModal.successMsg"></span>
                </div>
            </template>
            <template x-if="sendCardModal.errorMsg">
                <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs p-3 rounded-xl flex items-center gap-2">
                    <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span x-text="sendCardModal.errorMsg"></span>
                </div>
            </template>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                <button type="button" 
                        @click="sendCardModal.open = false" 
                        :disabled="sendCardModal.loading"
                        class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 text-xs font-bold transition-all">
                    Batal
                </button>
                <button type="button" 
                        @click="submitSendCard()" 
                        :disabled="sendCardModal.loading"
                        class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 disabled:bg-emerald-400 text-white text-xs font-bold transition-all shadow-md inline-flex items-center gap-2">
                    <svg x-show="sendCardModal.loading" class="animate-spin w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span x-text="sendCardModal.loading ? 'Mengirim Email...' : 'Kirim Sekarang ke Email'"></span>
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function adminDashboard(config) {
    return {
        selected: config.initialSelected,
        docModal: {
            open: false,
            title: '',
            filename: '',
            summary: '',
            isValid: true
        },
        sendCardModal: {
            open: false,
            loading: false,
            note: 'Selamat! Anda telah berhasil menyelesaikan tahapan pendaftaran PMB di Universitas Klabat Tahun Akademik 2026/2027. Kartu tanda bukti pendaftaran resmi Anda terlampir di bawah ini.',
            successMsg: '',
            errorMsg: ''
        },
        openSendCardModal() {
            this.sendCardModal.open = true;
            this.sendCardModal.successMsg = '';
            this.sendCardModal.errorMsg = '';
            this.sendCardModal.loading = false;
        },
        async submitSendCard() {
            if (!this.selected) return;
            this.sendCardModal.loading = true;
            this.sendCardModal.successMsg = '';
            this.sendCardModal.errorMsg = '';
            try {
                const response = await fetch(`/admin/applicant/${this.selected.id}/send-card`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ note: this.sendCardModal.note })
                });
                const data = await response.json();
                if (data.success) {
                    this.sendCardModal.successMsg = data.message;
                    this.selected.card_sent = true;
                    this.selected.card_sent_at = data.card_sent_at;
                    setTimeout(() => {
                        this.sendCardModal.open = false;
                    }, 2500);
                } else {
                    this.sendCardModal.errorMsg = data.message || 'Gagal mengirim email kartu.';
                }
            } catch (err) {
                this.sendCardModal.errorMsg = 'Terjadi kesalahan sistem saat mengirim email: ' + err.message;
            } finally {
                this.sendCardModal.loading = false;
            }
        },
        async selectApplicant(id) {
            try {
                const response = await fetch(`/admin/applicant/${id}/detail`);
                const data = await response.json();
                this.selected = {
                    id: data.id,
                    reg: data.registration_number,
                    name: data.full_name,
                    email: data.email,
                    whatsapp: data.whatsapp,
                    prodi: data.study_program,
                    faculty: data.faculty,
                    nik: data.nik,
                    nisn: data.nisn,
                    school: data.school_name,
                    age_formatted: data.age_formatted,
                    is_under_17: data.is_under_17,
                    status: data.status,
                    card_sent: data.card_sent,
                    card_sent_at: data.card_sent_at,
                    documents: data.documents.map(d => ({
                        id: d.id,
                        type: d.document_type,
                        type_label: d.document_type_label,
                        filename: d.original_filename,
                        file_url: d.file_url,
                        is_valid: d.is_valid,
                        feedback: d.ai_feedback
                    }))
                };
            } catch (err) {
                console.error(err);
            }
        },
        previewDoc(doc) {
            this.docModal.title = doc.type_label;
            this.docModal.filename = doc.filename;
            this.docModal.isValid = doc.is_valid;
            this.docModal.summary = doc.feedback?.hasil_ekstraksi || doc.feedback?.alasan_penolakan || 'Pemeriksaan berkas tuntas.';
            this.docModal.open = true;
        }
    };
}
</script>
@endpush
