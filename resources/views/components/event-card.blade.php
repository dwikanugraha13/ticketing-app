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
    // Format Indonesian price
    $formattedPrice = $price
        ? 'Rp ' . number_format($price, 0, ',', '.')
        : 'Harga tidak tersedia';

    // Format Indonesian date
    $formattedDate = $date
        ? \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y, H:i')
        : 'Tanggal tidak tersedia';

    // Safe image URL: use external URL if provided, otherwise use storage URL
    if ($image && filter_var($image, FILTER_VALIDATE_URL)) {
        $imageUrl = $image;
    } else {
        // Use provided image if it exists and file is found, otherwise use default
        $imageName = (!empty($image) && file_exists(public_path('storage/' . $image))) ? $image : 'konser.jpg';
        $imageUrl = asset('storage/' . $imageName);
    }
@endphp

<a href="{{ $href ?? '#' }}" class="block group h-full">
  <div class="card card-float-in h-full overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-[0_20px_50px_-28px_rgba(15,23,42,0.45)] transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-[0_24px_70px_-24px_rgba(15,23,42,0.5)]">
      <figure class="relative overflow-hidden">
          <img src="{{ $imageUrl }}" alt="{{ $title }}" class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-slate-900/10 to-transparent"></div>
          @if (!empty($category))
            <span class="absolute left-3 top-3 rounded-full border border-white/60 bg-white/85 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-blue-900 shadow-sm backdrop-blur">{{ $category }}</span>
          @endif
      </figure>

      <div class="card-body flex h-full flex-col p-5">
          <h2 class="line-clamp-2 text-base font-semibold leading-snug text-slate-800">
              {{ $title }}
          </h2>

          <div class="mt-3 space-y-2 text-sm text-slate-500">
              <p class="flex items-start gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  <span class="line-clamp-2">{{ $formattedDate }}</span>
              </p>

              <p class="flex items-start gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  <span class="line-clamp-2">{{ $location }}</span>
              </p>
          </div>

          <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-4">
              <span class="font-bold text-blue-900">
                  {{ $formattedPrice }}
              </span>
              <span class="text-sm font-medium text-blue-700 opacity-0 transition-opacity group-hover:opacity-100">Lihat detail →</span>
          </div>
      </div>
  </div>
</a>
