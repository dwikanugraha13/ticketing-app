<x-app-layout>
    @php
        if ($event->gambar && filter_var($event->gambar, FILTER_VALIDATE_URL)) {
            $imageUrl = $event->gambar;
        } else {
            $imageName = (!empty($event->gambar) && file_exists(public_path('storage/' . $event->gambar))) ? $event->gambar : 'konser.jpg';
            $imageUrl = asset('storage/' . $imageName);
        }

        $eventDate = $event->tanggal_waktu ?? $event->tanggal ?? null;
        $formattedDate = $eventDate ? \Carbon\Carbon::parse($eventDate)->locale('id')->translatedFormat('d F Y, H:i') : 'Tanggal tidak tersedia';
    @endphp

    <div class="relative h-[340px] md:h-[440px] w-full overflow-hidden bg-slate-950">
        <img src="{{ $imageUrl }}" alt="{{ $event->judul ?? $event->nama }}"
             class="absolute inset-0 h-full w-full object-cover opacity-80">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/50 to-slate-950/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/25 to-transparent"></div>

        <div class="relative mx-auto flex h-full max-w-7xl flex-col justify-end px-6 pb-8 md:px-8 lg:px-10">
            <a href="{{ route('home') }}" class="mb-4 inline-flex w-fit items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1.5 text-sm text-white/90 backdrop-blur transition hover:bg-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>

            @if ($event->kategori)
                <span class="mb-3 inline-flex w-fit items-center rounded-full border border-white/20 bg-white/90 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-900 backdrop-blur">
                    {{ $event->kategori->nama }}
                </span>
            @endif

            <h1 class="mb-3 max-w-3xl text-2xl font-black text-white md:text-4xl">{{ $event->judul ?? $event->nama }}</h1>

            <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-white/90">
                <span class="flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1.5 backdrop-blur">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $formattedDate }}
                </span>
                <span class="flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1.5 backdrop-blur">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $event->lokasi ?? 'Lokasi tidak tersedia' }}
                </span>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-6 py-10 md:px-8 lg:px-10"
         x-data="ticketSelector({{ $event->tikets->map(fn($t) => ['id' => $t->id, 'tipe' => ucfirst($t->tipe), 'harga' => (float) $t->harga, 'stok' => $t->stok])->values()->toJson() }})">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Details -->
            <div class="lg:col-span-2 space-y-6">
                @if ($event->deskripsi)
                    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_20px_60px_-32px_rgba(15,23,42,0.45)] md:p-8">
                        <div class="mb-4 inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-sm font-semibold text-blue-900">
                            Deskripsi Event
                        </div>
                        <p class="leading-relaxed text-slate-600 whitespace-pre-line">{{ $event->deskripsi }}</p>
                    </div>
                @endif

                <!-- Mobile ticket list (shown under lg breakpoint, sidebar hidden) -->
                <div class="lg:hidden">
                    @include('events.partials.ticket-list')
                </div>
            </div>

            <!-- Right: Ticket Sidebar (desktop) -->
            <div class="hidden lg:block lg:col-span-1">
                <div class="lg:pl-4">
                    <div class="lg:sticky lg:top-24 lg:h-fit lg:ml-auto lg:max-w-[340px] xl:max-w-[360px]">
                        @include('events.partials.ticket-list')
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Events -->
        @if ($relatedEvents->count() > 0)
            <div class="mt-16 py-2 md:mt-20">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-700">Jelajahi Lainnya</p>
                        <h2 class="mt-1 text-2xl font-bold text-slate-800">Event Terkait</h2>
                    </div>
                    <a href="{{ route('home') }}" class="text-sm font-medium text-blue-700 transition hover:text-blue-900">Lihat semua</a>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($relatedEvents as $related)
                        <x-event-card
                            :title="$related->judul"
                            :date="$related->tanggal_waktu"
                            :location="$related->lokasi"
                            :price="$related->tikets->min('harga')"
                            :image="$related->gambar"
                            :category="$related->kategori->nama ?? null"
                            :href="route('events.show', $related)"
                        />
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Mobile sticky checkout bar -->
        <div x-show="selected" x-cloak
             class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-[0_-4px_16px_rgba(0,0,0,0.08)] px-4 py-3 z-40">
            <div class="flex items-center justify-between gap-3 max-w-7xl mx-auto">
                <div class="min-w-0">
                    <p class="text-xs text-gray-500" x-text="selected ? selected.tipe + ' × ' + qty : ''"></p>
                    <p class="font-bold text-blue-900" x-text="formatRupiah(subtotal)"></p>
                </div>
                <button type="button" @click="checkout()" class="btn btn-brand shrink-0">Lanjutkan Pembayaran</button>
            </div>
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
                    if (this.selectedId === id) {
                        this.selectedId = null;
                        this.qty = 1;
                        return;
                    }
                    this.selectedId = id;
                    this.qty = 1;
                },

                inc() {
                    if (!this.selected) return;
                    if (this.selected.stok === null || this.qty < this.selected.stok) this.qty++;
                },

                dec() {
                    if (this.qty > 1) this.qty--;
                },

                formatRupiah(value) {
                    return 'Rp ' + Math.round(value).toLocaleString('id-ID');
                },

                checkout() {
                    if (!this.selected) return;
                    alert('Fitur pembayaran akan segera hadir. Tiket dipilih: ' + this.selected.tipe + ' x' + this.qty + ' (' + this.formatRupiah(this.subtotal) + ')');
                }
            }
        }
    </script>
</x-app-layout>
