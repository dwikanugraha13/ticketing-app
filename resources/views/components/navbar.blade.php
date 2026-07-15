<div class="navbar sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 px-4 py-3 shadow-[0_8px_30px_-20px_rgba(15,23,42,0.35)] backdrop-blur transition-all duration-300 lg:px-8">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h8m-8 6h16"
          />
        </svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        @guest
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
        @endguest
        @auth
          @if (auth()->user()->role === 'admin')
            <li><a href="{{ route('admin.events.index') }}">Manajemen Event</a></li>
            <li><a href="{{ route('categories.index') }}">Manajemen Kategori</a></li>
          @endif
          <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li><a href="{{ route('profile.edit') }}">Profile</a></li>
        @endauth
      </ul>
    </div>
    <a href="{{ route('home') }}" class="flex items-center gap-2 ml-1">
      <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-9 w-9">
      <span class="hidden sm:inline text-lg font-bold text-blue-900">BengTix</span>
    </a>
  </div>

  <div class="navbar-center flex lg:hidden px-2">
    <form action="{{ route('home') }}#event-list" method="GET" class="search-pill w-full">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="search-pill__icon h-4 w-4" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
      </svg>
      <input type="search" name="search" value="{{ request('search') }}" class="search-pill__input" placeholder="Cari event..." autocomplete="off" />
      @if (request('search'))
        <a href="{{ route('home', array_filter(['kategori' => request('kategori')])) }}" class="search-pill__clear" aria-label="Hapus pencarian">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </a>
      @endif
      @if (request('kategori'))
        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
      @endif
    </form>
  </div>

  <div class="navbar-center hidden lg:flex">
    <form action="{{ route('home') }}#event-list" method="GET" class="search-pill w-96">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="search-pill__icon h-4 w-4" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
      </svg>
      <input type="search" name="search" value="{{ request('search') }}" class="search-pill__input" placeholder="Cari event atau lokasi..." autocomplete="off" />
      @if (request('search'))
        <a href="{{ route('home', array_filter(['kategori' => request('kategori')])) }}" class="search-pill__clear" aria-label="Hapus pencarian">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </a>
      @endif
      @if (request('kategori'))
        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
      @endif
      <button type="submit" class="search-pill__submit" aria-label="Cari">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
        </svg>
      </button>
    </form>
  </div>

  <div class="navbar-end gap-2">
    @guest
      <a href="{{ route('login') }}" class="btn btn-outline-brand hidden sm:inline-flex">Login</a>
      <a href="{{ route('register') }}" class="btn btn-brand">Register</a>
    @endguest
    @auth
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar placeholder avatar-ring">
          <div class="w-10 rounded-full bg-blue-900 text-white flex items-center justify-center">
            <span class="text-sm font-semibold">{{ strtoupper(substr(Auth::user()?->name ?? '', 0, 1)) }}</span>
          </div>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-56"
        >
          <li class="menu-title px-3 pt-1 pb-2">
            <span class="text-sm font-semibold text-gray-700">{{ Auth::user()?->name }}</span>
            <span class="text-xs text-gray-400 font-normal">{{ Auth::user()->email }}</span>
          </li>
          @if (Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.events.index') }}">Manajemen Event</a></li>
            <li><a href="{{ route('categories.index') }}">Manajemen Kategori</a></li>
          @endif
          <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li><a href="{{ route('profile.edit') }}">Profile</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left text-error">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    @endauth
  </div>
</div>
