<!DOCTYPE html>
<html lang="id" data-theme="winter">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'BengTix - Beli Tiket Auto Asik' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" style="font-family: 'Figtree', sans-serif;">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.18),_transparent_30%),linear-gradient(135deg,_#0f172a_0%,_#1d4ed8_45%,_#2563eb_100%)] px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto flex min-h-screen max-w-7xl flex-col items-center justify-center">
            <a href="/" class="mb-6 flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-4 py-2 backdrop-blur">
                <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-10 w-10">
                <span class="text-xl font-bold text-white">BengTix</span>
            </a>

            <div class="w-full overflow-hidden rounded-[32px] border border-white/20 bg-white/95 p-2 shadow-[0_25px_80px_-25px_rgba(15,23,42,0.65)] backdrop-blur sm:max-w-5xl">
                <div class="grid lg:grid-cols-[0.95fr_1.05fr]">
                    <div class="hidden rounded-[26px] bg-gradient-to-br from-blue-950 via-blue-800 to-sky-600 p-8 text-white lg:flex lg:flex-col lg:justify-between">
                        <div>
                            <div class="mb-4 inline-flex rounded-full border border-white/20 bg-white/10 px-3 py-1 text-sm font-medium backdrop-blur">Premium Access</div>
                            <h2 class="text-3xl font-black leading-tight">Masuk untuk menikmati pengalaman booking event yang lebih nyaman.</h2>
                            <p class="mt-4 max-w-md text-sm leading-relaxed text-blue-100">Nikmati akses cepat ke tiket favoritmu, riwayat pembelian, dan berbagai event eksklusif.</p>
                        </div>
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 text-sm text-blue-50 backdrop-blur">
                            <div class="font-semibold text-white">BengTix</div>
                            <div class="mt-1">Beli tiket, auto asik.</div>
                        </div>
                    </div>

                    <div class="rounded-[26px] bg-white p-6 sm:p-8 lg:p-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <p class="mt-6 text-xs text-white/70">&copy; {{ date('Y') }} BengTix. Beli tiket, auto asik.</p>
        </div>
    </div>
</body>

</html>
