<x-app-layout>
    @php
        if ($event->gambar && filter_var($event->gambar, FILTER_VALIDATE_URL)) {
            $imageUrl = $event->gambar;
        } else {
            $imageName = (!empty($event->gambar) && file_exists(public_path('storage/' . $event->gambar))) ? $event->gambar : 'konser.jpg';
            $imageUrl = asset('storage/' . $imageName);
        }

        $eventDate = $event->tanggal_waktu ?? $event->tanggal ?? null;
        $formattedDate = $eventDate ? \Carbon\Carbon::parse($eventDate)->locale('id')->translatedFormat('d F Y · H:i') : 'Tanggal tidak tersedia';
    @endphp

    {{-- ══════════════════════════════════
         HERO BANNER
    ══════════════════════════════════ --}}
    <div class="relative h-[360px] md:h-[480px] w-full overflow-hidden bg-slate-950">
      <img src="{{ $imageUrl }}" alt="{{ $event->judul ?? $event->nama }}"
           class="absolute inset-0 h-full w-full object-cover opacity-70 scale-105 transition-transform duration-[8s] ease-out"
           style="transform-origin: center;">
      {{-- Layered gradients --}}
      <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/60 to-slate-950/20"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>

      {{-- Floating decoration --}}
      <div class="absolute -top-20 right-20 h-64 w-64 rounded-full bg-blue-600/10 blur-3xl pointer-events-none"></div>

      <div class="relative mx-auto flex h-full max-w-7xl flex-col justify-end px-6 pb-10 md:px-8 lg:px-10">
        {{-- Back button --}}
        <a href="{{ route('home') }}"
           class="mb-5 inline-flex w-fit items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white/90 backdrop-blur-md transition hover:bg-white/20">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Kembali ke Beranda
        </a>

        {{-- Category badge --}}
        @if ($event->kategori)
          <span class="mb-3 inline-flex w-fit items-center rounded-full border border-white/20 bg-white/90 px-3.5 py-1 text-[11px] font-bold uppercase tracking-widest text-blue-900 backdrop-blur">
            {{ $event->kategori->nama }}
          </span>
        @endif

        {{-- Event Title --}}
        <h1 class="mb-4 max-w-3xl text-3xl font-black leading-tight text-white md:text-4xl lg:text-5xl drop-shadow-lg">
          {{ $event->judul ?? $event->nama }}
        </h1>

        {{-- Meta chips --}}
        <div class="flex flex-wrap gap-2.5 text-sm text-white/90">
          <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-1.5 backdrop-blur">
            <svg class="h-4 w-4 text-blue-300 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ $formattedDate }}
          </span>
          <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-1.5 backdrop-blur">
            <svg class="h-4 w-4 text-rose-300 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ $event->lokasi->nama_lokasi ?? 'Lokasi tidak tersedia' }}
          </span>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════
         CONTENT AREA
    ══════════════════════════════════ --}}
    <div class="mx-auto max-w-7xl px-6 py-10 md:px-8 lg:px-10"
         x-data="ticketSelector({{ $event->tikets->map(fn($t) => ['id' => $t->id, 'tipe' => ucfirst($t->tipe), 'harga' => (float) $t->harga, 'stok' => $t->stok])->values()->toJson() }})">

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

        {{-- LEFT: Description --}}
        <div class="lg:col-span-2 space-y-6">
          @if ($event->deskripsi)
            <div class="section-panel p-6 md:p-8">
              <div class="mb-5 flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50">
                  <svg class="h-5 w-5 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                </div>
                <h2 class="text-lg font-bold text-slate-900">Deskripsi Event</h2>
              </div>
              <p class="leading-relaxed text-slate-600 whitespace-pre-line">{{ $event->deskripsi }}</p>
            </div>
          @endif

          {{-- Mobile ticket list --}}
          <div class="lg:hidden">
            @include('events.partials.ticket-list')
          </div>
        </div>

        {{-- RIGHT: Ticket Sidebar --}}
        <div class="hidden lg:block lg:col-span-1">
          <div class="lg:sticky lg:top-24">
            @include('events.partials.ticket-list')
          </div>
        </div>
      </div>

      {{-- ── Related Events --}}
      @if ($relatedEvents->count() > 0)
        <div class="mt-20 border-t border-slate-200 pt-12">
          <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
              <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Jelajahi Lainnya</p>
              <h2 class="mt-2 text-2xl font-black text-slate-900">Event Terkait</h2>
            </div>
            <a href="{{ route('home') }}" class="text-sm font-semibold text-blue-700 transition hover:text-blue-900">
              Lihat semua →
            </a>
          </div>
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($relatedEvents as $related)
              <x-event-card
                :title="$related->judul"
                :date="$related->tanggal_waktu"
                :location="$related->lokasi->nama_lokasi ?? '-'"
                :price="$related->tikets->min('harga')"
                :image="$related->gambar"
                :category="$related->kategori->nama ?? null"
                :href="route('events.show', $related)"
              />
            @endforeach
          </div>
        </div>
      @endif

      {{-- ── Mobile Sticky Checkout Bar --}}
      <div x-show="selected" x-cloak
           class="lg:hidden fixed bottom-0 left-0 right-0 z-40 border-t border-slate-200 bg-white/95 backdrop-blur-xl px-4 py-4 shadow-[0_-8px_30px_-10px_rgba(15,23,42,0.15)]">
        <form action="{{ route('checkout') }}" method="POST" class="mx-auto flex max-w-7xl items-center justify-between gap-4">
          @csrf
          <input type="hidden" name="event_id" value="{{ $event->id }}">
          <input type="hidden" name="tiket_id" :value="selected?.id">
          <input type="hidden" name="qty" :value="qty">
          <div class="min-w-0">
            <p class="text-xs font-medium text-slate-500" x-text="selected ? selected.tipe + ' × ' + qty : ''"></p>
            <p class="text-lg font-black text-blue-700" x-text="formatRupiah(subtotal)"></p>
          </div>
          <button type="submit"
                  class="btn-brand shrink-0 px-6 py-3 text-sm font-bold">
            Lanjutkan Pembayaran
          </button>
        </form>
      </div>
    </div>

    <script>
        function ticketSelector(tikets) {
            return {
                tikets: tikets,
                selectedId: null,
                qty: 1,

                get selected() {
                    return this.tikets.find(t => t.id === this.selectedId) || null;
                },

                get subtotal() {
                    return this.selected ? this.selected.harga * this.qty : 0;
                },

                select(id) {
                    const t = this.tikets.find(x => x.id === id);
                    if (!t || (t.stok !== null && t.stok <= 0)) return;
                    if (this.selectedId === id) { this.selectedId = null; this.qty = 1; return; }
                    this.selectedId = id;
                    this.qty = 1;
                },

                inc() {
                    if (!this.selected) return;
                    if (this.selected.stok === null || this.qty < this.selected.stok) this.qty++;
                },

                dec() { if (this.qty > 1) this.qty--; },

                formatRupiah(value) {
                    return 'Rp ' + Math.round(value).toLocaleString('id-ID');
                },

                checkout() {
                    if (!this.selected) return;
                    // Submit is handled by the form now
                }
            }
        }
    </script>
</x-app-layout>
