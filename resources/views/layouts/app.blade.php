<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PMB Universitas Klabat - AI Document Verifier')</title>

    <!-- Google Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with Custom Palette -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'unklab': {
                            'navy': '#00105B',
                            'navy-dark': '#000a3d',
                            'periwinkle': '#6061B6',
                            'lavender': '#C9B5E0',
                            'cream': '#FCF9EC',
                            'black': '#0A0A0A',
                            'white': '#FFFFFF',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FCF9EC;
            color: #0A0A0A;
            -webkit-font-smoothing: antialiased;
        }

        /* Print styles for Bukti Pendaftaran */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
            }
            .print-card {
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-unklab-cream text-unklab-black flex flex-col antialiased selection:bg-unklab-lavender selection:text-unklab-navy">

    <!-- Global Toast / Flash Messages -->
    <div class="fixed top-5 right-5 z-50 flex flex-col gap-2 max-w-md w-full px-4 no-print" x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition>
        @if(session('success'))
            <div class="bg-emerald-600 text-white px-4 py-3 rounded-xl shadow-lg flex items-center justify-between text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-200 hover:text-white">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-600 text-white px-4 py-3 rounded-xl shadow-lg flex items-center justify-between text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-rose-200 hover:text-white">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-600 text-white px-4 py-3 rounded-xl shadow-lg text-sm">
                <div class="font-semibold mb-1">Periksa kembali data Anda:</div>
                <ul class="list-disc list-inside text-xs space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    @yield('content')

    @stack('scripts')
</body>
</html>
