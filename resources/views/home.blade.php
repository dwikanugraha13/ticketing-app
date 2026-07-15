<x-app-layout>
    <section class="hero-fade-up relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.22),_transparent_35%),linear-gradient(135deg,_#0f172a_0%,_#1d4ed8_45%,_#2563eb_100%)]">
        <div class="absolute inset-0 opacity-25" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px), radial-gradient(circle at 80% 60%, white 1px, transparent 1px); background-size: 60px 60px;"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-16 lg:py-20">
            <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-8 items-center">
                <div class="text-white">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-sm font-medium backdrop-blur">
                        <span class="text-base">✨</span>
                        Platform tiket event modern untuk momen terbaikmu
                    </div>
                    <h1 class="mt-6 text-4xl md:text-5xl font-black leading-tight">
                        Temukan event favoritmu dan amankan tiket dengan cepat.
                    </h1>
                    <p class="mt-4 max-w-2xl text-lg text-blue-100 leading-relaxed">
                        Dari konser, seminar, hingga workshop, BengTix membantu kamu menjelajah event terbaik dengan pengalaman booking yang simpel, aman, dan elegan.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#event-list" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 shadow-lg shadow-blue-950/20 transition hover:-translate-y-0.5 hover:bg-blue-50">
                            Jelajahi Event
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center rounded-full border border-white/25 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                            Kenapa BengTix?
                        </a>
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3 text-sm text-blue-100">
                        <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur">
                            <div class="font-semibold text-white">10k+ tiket</div>
                            <div class="text-blue-100/80">terjual setiap bulan</div>
                        </div>
                        <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur">
                            <div class="font-semibold text-white">24/7</div>
                            <div class="text-blue-100/80">akses mudah & cepat</div>
                        </div>
                    </div>
                </div>

                <div class="card-float-in rounded-[28px] border border-white/30 bg-white/80 p-4 shadow-2xl shadow-blue-950/20 backdrop-blur">
                    <div class="rounded-[24px] bg-gradient-to-br from-blue-900 via-blue-800 to-sky-600 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">Featured</span>
                            <span class="text-sm text-blue-100">Live now</span>
                        </div>
                        <h2 class="mt-5 text-2xl font-bold">Festival Musik Malam Ini</h2>
                        <p class="mt-2 text-sm text-blue-100">
                            Nikmati suasana penuh energi dengan lineup terbaik dan pengalaman booking yang tanpa ribet.
                        </p>
                        <div class="mt-6 rounded-2xl border border-white/20 bg-white/10 p-4">
                            <div class="flex items-center justify-between text-sm">
                                <span>Lokasi</span>
                                <span class="font-semibold">Bandung Convention Center</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span>Mulai dari</span>
                                <span class="font-semibold">Rp 125.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-sm font-semibold text-slate-700">Pembayaran aman</div>
                            <p class="mt-1 text-sm text-slate-500">Transaksi terjamin dan cepat.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-sm font-semibold text-slate-700">E-ticket instan</div>
                            <p class="mt-1 text-sm text-slate-500">Langsung diterima setelah checkout.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="max-w-7xl mx-auto px-6 py-8 lg:py-10">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-50 text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-800">Transaksi aman</h3>
                <p class="mt-2 text-sm text-slate-500">Proses booking terjamin dan nyaman dari awal hingga tiket masuk ke inbox.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-800">Cepat & instan</h3>
                <p class="mt-2 text-sm text-slate-500">E-ticket langsung tersedia setelah pembayaran selesai, tanpa antrean.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0"/></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-800">Beragam pilihan</h3>
                <p class="mt-2 text-sm text-slate-500">Temukan berbagai kategori event dari komunitas lokal sampai pengalaman premium.</p>
            </div>
        </div>
    </section>

    <section id="event-list" class="max-w-7xl mx-auto py-8 px-6 lg:py-12">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-700">Event Terbaru</p>
                <h2 class="mt-2 text-2xl font-black text-slate-800">Jelajahi pengalaman menarik yang sedang berlangsung</h2>
                @if ($search)
                    <p class="mt-2 text-sm text-slate-500">
                        Menampilkan {{ $events->count() }} hasil untuk "<span class="font-medium text-slate-700">{{ $search }}</span>"
                    </p>
                @endif
            </div>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('home', array_filter(['search' => $search])) }}">
                    <x-ui.category-pill :label="'Semua'" :active="!request('kategori')" />
                </a>
                @foreach($categories as $kategori)
                    <a href="{{ route('home', array_filter(['kategori' => $kategori->id, 'search' => $search])) }}">
                        <x-ui.category-pill :label="$kategori->nama" :active="request('kategori') == $kategori->id" />
                    </a>
                @endforeach
            </div>
        </div>

        @if ($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($events as $event)
                    <x-event-card :title="$event->judul" :date="$event->tanggal_waktu" :location="$event->lokasi"
                        :price="$event->tikets_min_harga" :image="$event->gambar" :category="$event->kategori->nama ?? null"
                        :href="route('events.show', $event)" />
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center rounded-[28px] border border-dashed border-slate-300 bg-white/70 py-20 text-center shadow-sm">
                <div class="text-5xl mb-4">🔍</div>
                <h3 class="text-lg font-semibold text-slate-700">Tidak ada event ditemukan</h3>
                <p class="mt-1 text-sm text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-flex items-center rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">Reset Pencarian</a>
            </div>
        @endif
    </section>
</x-app-layout>
