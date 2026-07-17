<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin') · BengTix</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css"/>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen antialiased bg-slate-50 text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">

  <div class="flex min-h-screen" x-data="{ sidebarOpen: true }">

    {{-- ══════════════════════════════════
         SIDEBAR
    ══════════════════════════════════ --}}
    <aside class="hidden lg:flex w-64 shrink-0 flex-col relative overflow-hidden bg-slate-900 border-r border-slate-800 shadow-xl shadow-slate-900/10">

      {{-- Sidebar bg decorations --}}
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 pointer-events-none"></div>
      <div class="absolute -top-32 -right-32 h-64 w-64 rounded-full bg-blue-600/10 blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 h-48 w-48 rounded-full bg-indigo-600/10 blur-3xl pointer-events-none"></div>

      {{-- Logo --}}
      <div class="relative border-b border-white/10 px-5 py-5">
        <div class="flex items-center gap-3">
          <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 shadow-lg shadow-black/20 backdrop-blur">
            <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-6 w-6">
          </div>
          <div>
            <p class="text-base font-bold text-white leading-tight">BengTix</p>
            <p class="text-[10px] font-semibold uppercase tracking-widest text-blue-300/70">Admin Center</p>
          </div>
        </div>
      </div>

      {{-- Nav --}}
      <nav class="relative flex-1 px-3 py-4 space-y-1">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}">
          <span class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors
                       {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:bg-slate-700 group-hover:text-slate-200' }}">
            <svg class="h-4.5 w-4.5" style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
          </span>
          Dashboard
        </a>

        {{-- Label --}}
        <p class="px-3 pt-5 pb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">Manajemen</p>

        {{-- Events --}}
        <a href="{{ route('admin.events.index') }}"
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('admin.events.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}">
          <span class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors
                       {{ request()->routeIs('admin.events.*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:bg-slate-700 group-hover:text-slate-200' }}">
            <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </span>
          Event
        </a>

        {{-- Categories --}}
        <a href="{{ route('categories.index') }}"
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}">
          <span class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors
                       {{ request()->routeIs('categories.*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:bg-slate-700 group-hover:text-slate-200' }}">
            <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 106 0 3 3 0 00-6 0"/>
            </svg>
          </span>
          Kategori
        </a>

        {{-- Lokasi --}}
        <a href="{{ route('admin.lokasis.index') }}"
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('admin.lokasis.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}">
          <span class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors
                       {{ request()->routeIs('admin.lokasis.*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:bg-slate-700 group-hover:text-slate-200' }}">
            <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </span>
          Lokasi
        </a>

        {{-- Transactions --}}
        <a href="{{ route('admin.transactions.index') }}"
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('admin.transactions.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' }}">
          <span class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors
                       {{ request()->routeIs('admin.transactions.*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:bg-slate-700 group-hover:text-slate-200' }}">
            <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
          </span>
          Data Transaksi
        </a>

        {{-- Divider --}}
        <div class="my-4 mx-3 h-px bg-slate-800/60"></div>

        {{-- Back to site --}}
        <a href="{{ route('home') }}"
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-400 transition-all duration-200 hover:bg-slate-800/50 hover:text-slate-200">
          <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-800/50 text-slate-400 group-hover:text-slate-200">
            <svg style="width:18px;height:18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
          </span>
          Kembali ke Beranda
        </a>
      </nav>

      {{-- User footer --}}
      <div class="relative border-t border-white/10 p-4">
        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/8 p-3 backdrop-blur">
          <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-slate-800 text-sm font-bold text-white">
            {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
          </div>
          <div class="min-w-0 flex-1">
            <p class="truncate text-sm font-semibold text-white">{{ auth()->user()?->name }}</p>
            <div class="mt-0.5 flex items-center gap-2 text-xs text-white/50">
              <a href="{{ route('profile.edit') }}" class="transition hover:text-white">Profil</a>
              <span>·</span>
              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="transition hover:text-rose-400">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </aside>

    {{-- ══════════════════════════════════
         MAIN CONTENT AREA
    ══════════════════════════════════ --}}
    <div class="flex min-w-0 flex-1 flex-col">

      {{-- Top Header --}}
      <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/80 backdrop-blur-xl">
        <div class="flex items-center justify-between px-6 py-4 lg:px-8">
          <div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Control Panel</p>
            <h1 class="mt-0.5 text-xl font-bold tracking-tight text-slate-900">
              @yield('title', 'Dashboard')
            </h1>
          </div>
          <div class="flex items-center gap-3">
            {{-- Mobile back to site --}}
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-600 transition hover:border-blue-300 hover:text-blue-700 lg:hidden">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
              </svg>
              Beranda
            </a>

            {{-- Mobile user avatar --}}
            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-slate-800 text-xs font-bold text-white lg:hidden">
              {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
            </div>
          </div>
        </div>
      </header>

      {{-- Content --}}
      <main class="flex-1 overflow-y-auto">
        <div class="mx-auto max-w-7xl px-6 py-8 lg:px-8">
          @yield('content')
        </div>
      </main>
    </div>
  </div>

  {{-- Toast notifications --}}
  @if(session('success'))
    <div id="adminToast"
         class="fixed right-5 top-5 z-50 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-white px-5 py-4 shadow-xl shadow-emerald-900/15"
         style="animation: slideInRight 0.4s cubic-bezier(0.22,1,0.36,1) both;">
      <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">Berhasil</p>
        <p class="text-sm font-medium text-slate-800">{{ session('success') }}</p>
      </div>
    </div>
    <script>
      setTimeout(() => {
        const t = document.getElementById('adminToast');
        if (t) { t.style.opacity='0'; t.style.transform='translateX(16px)'; t.style.transition='all 0.35s ease'; setTimeout(()=>t.remove(),400); }
      }, 3500);
    </script>
  @endif

  @if(session('error'))
    <div id="adminToastErr"
         class="fixed right-5 top-5 z-50 flex items-center gap-3 rounded-2xl border border-rose-200 bg-white px-5 py-4 shadow-xl shadow-rose-900/15"
         style="animation: slideInRight 0.4s cubic-bezier(0.22,1,0.36,1) both;">
      <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-rose-600">Error</p>
        <p class="text-sm font-medium text-slate-800">{{ session('error') }}</p>
      </div>
    </div>
    <script>
      setTimeout(() => {
        const t = document.getElementById('adminToastErr');
        if (t) { t.style.opacity='0'; t.style.transform='translateX(16px)'; t.style.transition='all 0.35s ease'; setTimeout(()=>t.remove(),400); }
      }, 3500);
    </script>
  @endif

</body>
</html>
