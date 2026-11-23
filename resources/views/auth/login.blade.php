@extends('layouts.app')

@section('title', 'Masuk Portal PMB UNKLAB')

@section('content')
<div class="min-h-screen w-full flex flex-col lg:flex-row bg-[#F8FAFC]">
    
    <!-- Left Hero Column: Brand & Catchy AI Header with Building Background -->
    <div class="w-full lg:w-1/2 text-white p-8 sm:p-12 lg:p-16 flex flex-col justify-between relative overflow-hidden"
         style="background: linear-gradient(to bottom right, rgba(0,16,91,0.88) 0%, rgba(8,58,156,0.82) 50%, rgba(11,87,208,0.80) 100%);">
        
        <!-- Building Background Image -->
        <div class="absolute inset-0 z-0" style="background-image: url('{{ asset('images/gedung-unklab.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"></div>
        <!-- Dark Gradient Overlay -->
        <div class="absolute inset-0 z-0" style="background: linear-gradient(135deg, rgba(0,16,91,0.88) 0%, rgba(8,58,156,0.78) 40%, rgba(11,87,208,0.72) 100%);"></div>

        <!-- Subtle Watermark Background Pattern -->
        <div class="absolute -right-12 -bottom-16 text-9xl font-black text-white/5 select-none pointer-events-none tracking-widest z-10">
            UNKLAB
        </div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-white/5 blur-3xl pointer-events-none z-10"></div>

        <!-- Top Section: Education Squircle Icon -->
        <div class="relative" style="z-index:20;">
            <div class="w-14 h-14 rounded-2xl bg-amber-400 text-[#00105B] flex items-center justify-center shadow-lg mb-8 sm:mb-12">
                <!-- Graduation Cap Icon -->
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 3L1 9L12 15L21 10.09V17H23V9M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z"/>
                </svg>
            </div>

            <!-- Headline & Subtitle matching Reference 2 -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-[1.15] text-white max-w-xl" style="text-shadow: 0 2px 12px rgba(0,0,0,0.3);">
                Daftar, verifikasi berkas, dan raih masa depan di Universitas Klabat.
            </h1>
            <p class="text-blue-100/90 text-xs sm:text-sm lg:text-base leading-relaxed mt-4 sm:mt-5 max-w-lg">
                Unggah dokumen persyaratan, dapatkan verifikasi otomatis dari <strong>AI Document Verifier</strong> secara instan, dan pantau kelulusan pendaftaran secara transparan.
            </p>
        </div>

        <!-- Bottom Feature / Badge Tag -->
        <div class="relative mt-10 pt-6 border-t border-white/20 flex items-center gap-2 text-xs font-semibold text-amber-300" style="z-index:20;">
            <svg class="w-4 h-4 text-amber-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <span>Ditenagai Google Gemini AI Vision & Local OCR Engine</span>
        </div>

    </div>

    <!-- Right Form Column: Clean Modern Login Area (Reference Image 2) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-16">
        <div class="w-full max-w-md space-y-6">

            <!-- Top Pill Tab Switcher -->
            <div class="bg-slate-200/70 p-1 rounded-xl flex items-center">
                <button type="button" class="flex-1 py-2 text-xs sm:text-sm font-bold text-unklab-navy bg-white rounded-lg shadow-sm transition-all text-center">
                    Masuk
                </button>
                <a href="{{ route('home') }}#alur-pendaftaran" class="flex-1 py-2 text-xs sm:text-sm font-semibold text-slate-600 hover:text-unklab-navy rounded-lg transition-all text-center">
                    Alur Pendaftaran
                </a>
            </div>

            <!-- Main Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4" x-data="{ showPass: false, email: '{{ old('email') }}' }">
                @csrf

                <!-- Username atau Email Field -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                        Username atau email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        x-model="email"
                        required 
                        placeholder="admin@unklab.ac.id atau nama@gmail.com" 
                        class="w-full text-xs sm:text-sm px-4 py-3 rounded-xl border border-slate-300 bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B57D0] focus:border-transparent transition-all shadow-sm"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-slate-700">
                            Password
                        </label>
                        <a href="javascript:void(0)" class="text-[11px] font-semibold text-[#0B57D0] hover:underline">
                            Lupa password?
                        </a>
                    </div>
                    <div class="relative">
                        <input 
                            :type="showPass ? 'text' : 'password'" 
                            name="password" 
                            id="password" 
                            placeholder="••••••••••••" 
                            class="w-full text-xs sm:text-sm px-4 py-3 pr-10 rounded-xl border border-slate-300 bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B57D0] focus:border-transparent transition-all shadow-sm"
                        >
                        <button 
                            type="button" 
                            @click="showPass = !showPass" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                            aria-label="Tampilkan / Sembunyikan Password"
                        >
                            <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPass" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                    <span class="block text-[10px] text-slate-400 mt-1">
                        Panitia Admin PMB: login dengan akun resmi UNKLAB. Pendaftar baru bebas tanpa password awal.
                    </span>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        class="h-4 w-4 rounded border-slate-300 text-[#0B57D0] focus:ring-[#0B57D0]"
                    >
                    <label for="remember" class="ml-2 text-xs text-slate-600">Ingat sesi perangkat ini</label>
                </div>

                <!-- Submit CTA Button (Blue Wide Button matching Image 2) -->
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-[#0B57D0] hover:bg-[#0047C4] text-white text-sm font-bold rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 mt-2"
                >
                    <span>Masuk</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    <span class="bg-[#F8FAFC] px-3">atau masuk lebih cepat</span>
                </div>
            </div>

            <!-- Fast Google Login Button (Google OAuth) -->
            <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center gap-3 py-2.5 px-4 bg-white hover:bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-700 transition-all shadow-sm group">
                <svg class="w-4 h-4 transition-transform group-hover:scale-110 flex-shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Masuk Cepat dengan Akun Google</span>
            </a>

            <!-- Helper Notice & Back to Home Link -->
            <div class="text-center pt-2 space-y-2">
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    Calon mahasiswa baru dapat langsung masuk menggunakan akun Google atau email pribadi tanpa form registrasi terpisah.
                </p>
                <div>
                    <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-[#0B57D0] font-semibold inline-flex items-center gap-1.5 transition-colors">
                        <span>&larr; Kembali ke Beranda PMB UNKLAB</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
