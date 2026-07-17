<!DOCTYPE html>
<html lang="id" data-theme="winter">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="BengTix — Masuk atau daftar untuk mulai booking tiket event favorit kamu.">
  <title>{{ $title ?? 'BengTix — Beli Tiket, Auto Asik' }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css"/>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="font-family: 'Plus Jakarta Sans', sans-serif;"
      class="antialiased min-h-screen flex items-center justify-center px-4 py-10">

  {{-- Animated background --}}
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900"></div>
    <div class="absolute inset-0 dot-mesh opacity-30"></div>
    <div class="absolute -top-40 -left-40 h-[500px] w-[500px] rounded-full bg-blue-700/20 blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 h-[400px] w-[400px] rounded-full bg-indigo-700/15 blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-96 w-96 rounded-full bg-blue-800/10 blur-3xl"></div>
  </div>

  <div class="w-full max-w-5xl">
    {{-- Logo pill --}}
    <div class="mb-8 flex justify-center">
      <a href="/" class="inline-flex items-center gap-3 rounded-2xl border border-white/15 bg-white/10 px-5 py-2.5 backdrop-blur-md transition hover:bg-white/15">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-blue-700 to-slate-900 shadow-md">
          <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-5 w-5">
        </div>
        <span class="text-lg font-bold text-white">Beng<span class="text-blue-300">Tix</span></span>
      </a>
    </div>

    {{-- Card --}}
    <div class="overflow-hidden rounded-[2rem] border border-white/15 bg-white/95 shadow-2xl shadow-slate-950/50 backdrop-blur-xl">
      <div class="grid lg:grid-cols-[1fr_1.05fr]">

        {{-- LEFT: Illustration panel --}}
        <div class="relative hidden overflow-hidden rounded-[1.75rem] lg:flex lg:flex-col lg:justify-between p-8 text-white"
             style="background: linear-gradient(145deg, #0f172a 0%, #1e40af 55%, #2563eb 100%);">

          {{-- Decoration --}}
          <div class="absolute inset-0 dot-mesh opacity-25 rounded-[1.75rem]"></div>
          <div class="absolute -top-20 -right-20 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
          <div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-indigo-600/15 blur-3xl"></div>

          <div class="relative">
            <div class="mb-5 inline-flex rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-sm font-medium backdrop-blur">
              ✦ Premium Access
            </div>
            <h2 class="text-3xl font-black leading-tight">
              Masuk untuk menikmati<br>pengalaman booking yang lebih nyaman.
            </h2>
            <p class="mt-4 text-sm leading-relaxed text-blue-200">
              Akses cepat ke tiket favoritmu, riwayat pembelian, dan berbagai event eksklusif yang menanti.
            </p>
          </div>

          {{-- Stats --}}
          <div class="relative mt-8 grid grid-cols-2 gap-3">
            <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
              <p class="text-2xl font-black text-white">10k+</p>
              <p class="mt-0.5 text-xs text-blue-200">Tiket terjual/bulan</p>
            </div>
            <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
              <p class="text-2xl font-black text-white">500+</p>
              <p class="mt-0.5 text-xs text-blue-200">Event tersedia</p>
            </div>
          </div>
        </div>

        {{-- RIGHT: Form slot --}}
        <div class="rounded-r-[1.75rem] bg-white p-8 sm:p-10 lg:p-12">
          {{ $slot }}
        </div>

      </div>
    </div>

    <p class="mt-6 text-center text-xs text-slate-400">
      © {{ date('Y') }} BengTix. Beli tiket, auto asik.
    </p>
  </div>

</body>
</html>
