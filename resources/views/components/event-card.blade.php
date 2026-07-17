@props([
    'title',
    'date',
    'location',
    'price',
    'image',
    'href' => null,
    'category' => null,
])

@php
    $formattedPrice = $price
        ? 'Rp ' . number_format($price, 0, ',', '.')
        : 'Gratis';

    $formattedDate = $date
        ? \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d M Y · H:i')
        : 'Tanggal tidak tersedia';

    if ($image && filter_var($image, FILTER_VALIDATE_URL)) {
        $imageUrl = $image;
    } else {
        $imageName = (!empty($image) && file_exists(public_path('storage/' . $image))) ? $image : 'konser.jpg';
        $imageUrl = asset('storage/' . $imageName);
    }
@endphp

<a href="{{ $href ?? '#' }}" class="block group h-full" tabindex="0">
  <article class="card-modern h-full overflow-hidden flex flex-col">

    {{-- ── Image --}}
    <figure class="relative overflow-hidden">
      <img src="{{ $imageUrl }}" alt="{{ $title }}"
           class="h-48 w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
           loading="lazy"/>

      {{-- Gradient overlay --}}
      <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-slate-900/15 to-transparent transition-opacity duration-300"></div>

      {{-- Category badge --}}
      @if (!empty($category))
        <span class="absolute left-3 top-3 rounded-full border border-white/50 bg-white/90 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-blue-900 shadow-sm backdrop-blur">
          {{ $category }}
        </span>
      @endif

      {{-- Hover arrow overlay --}}
      <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100">
        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/95 shadow-xl shadow-slate-900/20">
          <svg class="h-5 w-5 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </div>
      </div>
    </figure>

    {{-- ── Body --}}
    <div class="flex flex-1 flex-col p-5">
      <h2 class="line-clamp-2 text-[0.9375rem] font-bold leading-snug text-slate-900 transition-colors group-hover:text-blue-700">
        {{ $title }}
      </h2>

      <div class="mt-3.5 space-y-2 text-xs text-slate-500">
        <p class="flex items-center gap-2">
          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </span>
          <span class="line-clamp-1">{{ $formattedDate }}</span>
        </p>
        <p class="flex items-center gap-2">
          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-500">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </span>
          <span class="line-clamp-1">{{ $location }}</span>
        </p>
      </div>

      {{-- ── Footer --}}
      <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-4">
        <div>
          <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-400">Harga mulai</p>
          <p class="mt-0.5 text-base font-black text-blue-700">{{ $formattedPrice }}</p>
        </div>
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition-all duration-300 group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-md">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </span>
      </div>
    </div>

  </article>
</a>
