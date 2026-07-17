@php
    $footerCategories = \App\Models\Kategori::withCount('events')
        ->orderByDesc('events_count')
        ->take(6)
        ->get();
@endphp

<footer class="relative overflow-hidden bg-slate-950 text-white">

  {{-- Background decoration --}}
  <div class="absolute inset-0 dot-mesh opacity-20 pointer-events-none"></div>
  <div class="absolute -top-40 left-1/4 h-80 w-80 rounded-full bg-blue-800/15 blur-3xl pointer-events-none"></div>
  <div class="absolute -bottom-20 right-1/4 h-60 w-60 rounded-full bg-indigo-700/10 blur-3xl pointer-events-none"></div>

  {{-- Top divider wave --}}
  <div class="relative">
    <div class="relative mx-auto max-w-7xl px-6 pt-16 pb-12 lg:px-8 lg:pt-20">

      <div class="grid grid-cols-2 gap-10 md:grid-cols-5">

        {{-- Brand --}}
        <div class="col-span-2">
          <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 mb-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-700 to-slate-900 shadow-md">
              <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="BengTix" class="h-6 w-6">
            </div>
            <span class="text-xl font-bold text-white">Beng<span class="text-blue-400">Tix</span></span>
          </a>

          <p class="max-w-xs text-sm leading-relaxed text-slate-400">
            Platform tiket event terpercaya. Temukan dan amankan tiket konser, seminar, dan workshop favoritmu dengan mudah dan aman.
          </p>

          {{-- Social Links --}}
          <div class="mt-6 flex items-center gap-2.5">
            @foreach([
              ['url' => env('SOCIAL_INSTAGRAM_URL', 'https://www.instagram.com/'), 'label' => 'Instagram', 'icon' => '<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>'],
              ['url' => env('SOCIAL_YOUTUBE_URL', 'https://youtube.com/'), 'label' => 'YouTube', 'icon' => '<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>'],
              ['url' => env('SOCIAL_X_URL', 'https://x.com/'), 'label' => 'X', 'icon' => '<path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>'],
              ['url' => env('SOCIAL_TIKTOK_URL', 'https://www.tiktok.com/'), 'label' => 'TikTok', 'icon' => '<path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>'],
            ] as $social)
              <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}"
                 class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-white/8 text-slate-400 transition-all hover:border-blue-500/40 hover:bg-blue-500/15 hover:text-blue-300 hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                  {!! $social['icon'] !!}
                </svg>
              </a>
            @endforeach
          </div>
        </div>

        {{-- Links: BengTix --}}
        <nav>
          <h6 class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400">BengTix</h6>
          <ul class="space-y-2.5 text-sm text-slate-400">
            <li><a class="transition-colors hover:text-white" href="{{ route('info.show', 'tentang-kami') }}">Tentang Kami</a></li>
            <li><a class="transition-colors hover:text-white" href="{{ route('info.show', 'syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
            <li><a class="transition-colors hover:text-white" href="{{ route('info.show', 'kebijakan-privasi') }}">Kebijakan Privasi</a></li>
          </ul>
        </nav>

        {{-- Links: Layanan --}}
        <nav>
          <h6 class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400">Layanan</h6>
          <ul class="space-y-2.5 text-sm text-slate-400">
            <li><a class="transition-colors hover:text-white" href="{{ route('home') }}#event-list">Booking Tiket</a></li>
            @if (auth()->check() && auth()->user()->role === 'admin')
              <li><a class="transition-colors hover:text-white" href="{{ route('admin.events.create') }}">Buat Event</a></li>
            @else
              <li><a class="transition-colors hover:text-white" href="{{ route('login') }}">Buat Event</a></li>
            @endif
          </ul>
        </nav>

        {{-- Links: Kategori --}}
        <nav>
          <h6 class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400">Kategori Event</h6>
          <ul class="space-y-2.5 text-sm text-slate-400">
            @forelse ($footerCategories as $kategori)
              <li>
                <a class="transition-colors hover:text-white" href="{{ route('home', ['kategori' => $kategori->id]) }}">
                  {{ $kategori->nama }}
                </a>
              </li>
            @empty
              <li><span class="text-slate-600">Belum ada kategori</span></li>
            @endforelse
          </ul>
        </nav>
      </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-white/8">
      <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-6 py-5 text-xs text-slate-500 sm:flex-row lg:px-8">
        <span>© {{ date('Y') }} BengTix. Seluruh hak cipta dilindungi.</span>
        <span class="flex items-center gap-1.5">
          Dibuat dengan
          <svg class="h-3.5 w-3.5 text-rose-500 fill-current" viewBox="0 0 24 24">
            <path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/>
          </svg>
          oleh Bengkel Koding
        </span>
      </div>
    </div>
  </div>
</footer>
