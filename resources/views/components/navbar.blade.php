{{--
  Modern Glassmorphism Navbar
  - Sticky with scroll-aware blur & shadow
  - Centered search pill (desktop)
  - Mobile: hamburger + bottom-sheet style dropdown
--}}
<nav class="bengtix-navbar sticky top-0 z-50 border-b border-slate-200/60 bg-white/90 backdrop-blur-2xl transition-all duration-300"
     x-data="{ mobileOpen: false }">

  <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-4 lg:px-8">

    {{-- ── LOGO ── --}}
    <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5 group mr-2">
      <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-slate-900 to-blue-700 shadow-md shadow-blue-900/20 transition-transform group-hover:scale-105">
        <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-5 w-5">
      </div>
      <span class="hidden text-lg font-bold tracking-tight text-slate-900 sm:inline">
        Beng<span class="text-blue-600">Tix</span>
      </span>
    </a>

    {{-- ── DESKTOP SEARCH ── --}}
    <div class="hidden flex-1 justify-center lg:flex">
      <form action="{{ route('home') }}#event-list" method="GET" class="search-pill w-full max-w-md">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="search-pill__icon h-4 w-4" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
        </svg>
        <input type="search" name="search" value="{{ request('search') }}"
               class="search-pill__input" placeholder="Cari event atau lokasi..." autocomplete="off"/>
        @if (request('search'))
          <a href="{{ route('home', array_filter(['kategori' => request('kategori')])) }}"
             class="search-pill__clear" aria-label="Hapus pencarian">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </a>
        @endif
        @if (request('kategori'))
          <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
        <button type="submit" class="search-pill__submit" aria-label="Cari">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
          </svg>
        </button>
      </form>
    </div>

    {{-- ── SPACER (mobile, pushes items to sides) ── --}}
    <div class="flex-1 lg:hidden"></div>

    {{-- ── DESKTOP AUTH ── --}}
    <div class="hidden items-center gap-2 lg:flex">
      @guest
        <a href="{{ route('login') }}" class="btn-outline-brand text-sm py-2 px-4">Masuk</a>
        <a href="{{ route('register') }}" class="btn-brand text-sm py-2 px-4">Daftar</a>
      @endguest

      @auth
        <div class="dropdown dropdown-end relative" x-data="{ open: false }">
          <button @click="open = !open" @click.away="open = false"
                  class="avatar-ring flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white ring-2 ring-slate-200 cursor-pointer">
            {{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 1)) }}
          </button>

          <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
               x-transition:enter-start="opacity-0 scale-95 translate-y-1"
               x-transition:enter-end="opacity-100 scale-100 translate-y-0"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 top-12 w-60 origin-top-right rounded-2xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-900/12 z-50">

            {{-- User info --}}
            <div class="mb-1 rounded-xl bg-gradient-to-br from-slate-50 to-blue-50/40 px-3 py-3">
              <p class="truncate text-sm font-semibold text-slate-900">{{ Auth::user()?->name }}</p>
              <p class="truncate text-xs text-slate-500">{{ Auth::user()?->email }}</p>
            </div>

            <div class="space-y-0.5">
              @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.events.index') }}"
                   class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-blue-700">
                  <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                  Manajemen Event
                </a>
                <a href="{{ route('categories.index') }}"
                   class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-blue-700">
                  <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 106 0 3 3 0 00-6 0"/>
                  </svg>
                  Manajemen Kategori
                </a>
                <div class="my-1 h-px bg-slate-100"></div>
              @endif

              <a href="{{ route('dashboard') }}"
                 class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-blue-700">
                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
              </a>
              <a href="{{ route('transactions.history') }}"
                 class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-blue-700">
                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Riwayat Transaksi
              </a>
              <a href="{{ route('profile.edit') }}"
                 class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-blue-700">
                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil
              </a>

              <div class="my-1 h-px bg-slate-100"></div>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                  </svg>
                  Keluar
                </button>
              </form>
            </div>
          </div>
        </div>
      @endauth
    </div>

    {{-- ── MOBILE HAMBURGER ── --}}
    <button @click="mobileOpen = !mobileOpen"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 lg:hidden">
      <svg x-show="!mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
      <svg x-show="mobileOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  {{-- ── MOBILE SEARCH ── --}}
  <div class="border-t border-slate-100 px-4 py-2.5 lg:hidden">
    <form action="{{ route('home') }}#event-list" method="GET" class="search-pill w-full">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="search-pill__icon h-4 w-4" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
      </svg>
      <input type="search" name="search" value="{{ request('search') }}"
             class="search-pill__input" placeholder="Cari event..." autocomplete="off"/>
      @if (request('search'))
        <a href="{{ route('home', array_filter(['kategori' => request('kategori')])) }}"
           class="search-pill__clear" aria-label="Hapus pencarian">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </a>
      @endif
      @if (request('kategori'))
        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
      @endif
    </form>
  </div>

  {{-- ── MOBILE MENU PANEL ── --}}
  <div x-show="mobileOpen" x-cloak
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-2"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-2"
       class="border-t border-slate-100 bg-white px-4 pb-4 lg:hidden">

    <div class="mt-3 space-y-1">
      <a href="{{ route('home') }}"
         class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-blue-700">
        Beranda
      </a>

      @guest
        <div class="mt-3 flex flex-col gap-2 pt-3 border-t border-slate-100">
          <a href="{{ route('login') }}" class="btn-outline-brand w-full justify-center py-2.5">Masuk</a>
          <a href="{{ route('register') }}" class="btn-brand w-full justify-center py-2.5">Daftar Sekarang</a>
        </div>
      @endguest

      @auth
        <div class="mt-2 rounded-xl bg-gradient-to-br from-slate-50 to-blue-50/40 px-3 py-3">
          <p class="text-sm font-semibold text-slate-900">{{ Auth::user()?->name }}</p>
          <p class="text-xs text-slate-500">{{ Auth::user()?->email }}</p>
        </div>

        @if (Auth::user()->role === 'admin')
          <a href="{{ route('admin.events.index') }}"
             class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
            Manajemen Event
          </a>
          <a href="{{ route('categories.index') }}"
             class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
            Manajemen Kategori
          </a>
        @endif

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
          Dashboard
        </a>
        <a href="{{ route('transactions.history') }}"
           class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
          Riwayat Transaksi
        </a>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
          Profil
        </a>

        <form method="POST" action="{{ route('logout') }}" class="mt-1">
          @csrf
          <button type="submit"
                  class="flex w-full items-center gap-2 rounded-xl px-3 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50">
            Keluar
          </button>
        </form>
      @endauth
    </div>
  </div>
</nav>
