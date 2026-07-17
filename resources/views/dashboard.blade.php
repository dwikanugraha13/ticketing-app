<x-app-layout>
  {{-- Header slot (for the app.blade.php header section if used) --}}
  @php
    $user = Auth::user();
  @endphp

  {{-- ══════════════════════════════════
       HERO STRIP
  ══════════════════════════════════ --}}
  <div class="relative overflow-hidden"
       style="background: linear-gradient(135deg, #0f172a 0%, #1e40af 55%, #2563eb 100%); min-height: 200px;">
    <div class="absolute inset-0 dot-mesh opacity-25 pointer-events-none"></div>
    <div class="absolute -top-20 right-20 h-64 w-64 rounded-full bg-blue-500/15 blur-3xl pointer-events-none"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-10 md:px-8">
      {{-- Breadcrumb / back --}}
      <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}"
         class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-1.5 text-sm font-medium text-white/90 backdrop-blur transition hover:bg-white/20">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
      </a>

      <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <p class="text-xs font-bold uppercase tracking-widest text-blue-300">Akun Saya</p>
          <h1 class="mt-1.5 text-2xl font-black text-white sm:text-3xl">
            Halo, {{ $user->name }} 👋
          </h1>
          <p class="mt-1 text-sm text-blue-200">{{ $user->email }}</p>
        </div>
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/15 text-2xl font-black text-white shadow-xl backdrop-blur">
          {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
      </div>
    </div>
  </div>

  {{-- ══════════════════════════════════
       CONTENT
  ══════════════════════════════════ --}}
  <div class="mx-auto max-w-7xl px-6 py-10 md:px-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

      {{-- Card: Status --}}
      <div class="admin-stat-card p-6">
        <div class="flex items-center justify-between">
          <p class="text-sm font-medium text-slate-500">Status Akun</p>
          <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
            <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </span>
        </div>
        <p class="mt-4 text-2xl font-black text-slate-900">Aktif</p>
        <p class="mt-1 text-xs text-slate-400">Akun kamu sudah terverifikasi</p>
      </div>

      {{-- Card: Role --}}
      <div class="admin-stat-card p-6">
        <div class="flex items-center justify-between">
          <p class="text-sm font-medium text-slate-500">Role</p>
          <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
            <svg class="h-5 w-5 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </span>
        </div>
        <p class="mt-4 text-2xl font-black capitalize text-slate-900">{{ $user->role ?? 'User' }}</p>
        <p class="mt-1 text-xs text-slate-400">Level akses kamu saat ini</p>
      </div>

      {{-- Card: Profil --}}
      <div class="admin-stat-card p-6">
        <div class="flex items-center justify-between">
          <p class="text-sm font-medium text-slate-500">Profil Saya</p>
          <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50">
            <svg class="h-5 w-5 text-violet-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
          </span>
        </div>
        <p class="mt-4 text-2xl font-black text-slate-900">Edit</p>
        <a href="{{ route('profile.edit') }}"
           class="mt-2 inline-flex items-center gap-1 text-xs font-semibold text-blue-700 hover:text-blue-900">
          Perbarui profil →
        </a>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mt-8">
      <h2 class="mb-4 text-lg font-bold text-slate-900">Akses Cepat</h2>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <a href="{{ route('home') }}"
           class="card-modern flex items-center gap-4 p-5 group">
          <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700 transition group-hover:bg-blue-600 group-hover:text-white">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
            </svg>
          </div>
          <div>
            <p class="font-bold text-slate-900 group-hover:text-blue-700">Jelajahi Event</p>
            <p class="text-sm text-slate-500">Temukan event favoritmu</p>
          </div>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="card-modern flex items-center gap-4 p-5 group">
          <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-700 transition group-hover:bg-violet-600 group-hover:text-white">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <div>
            <p class="font-bold text-slate-900 group-hover:text-violet-700">Edit Profil</p>
            <p class="text-sm text-slate-500">Perbarui informasi akunmu</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</x-app-layout>
