<x-app-layout>

  {{-- ════════════════════════════════
       HERO SECTION
  ════════════════════════════════ --}}
  <section class="hero-fade-up relative overflow-hidden">
    {{-- Gradient background --}}
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900"></div>

    {{-- Animated mesh overlay --}}
    <div class="absolute inset-0 dot-mesh opacity-40"></div>

    {{-- Soft glow orbs --}}
    <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-blue-600/20 blur-3xl"></div>
    <div class="absolute -bottom-20 right-0 h-72 w-72 rounded-full bg-indigo-500/15 blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[500px] w-[500px] rounded-full bg-blue-700/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-20 lg:py-28">
      <div class="grid items-center gap-12 lg:grid-cols-[1.15fr_0.85fr]">

        {{-- LEFT: Headline --}}
        <div class="text-white space-y-6">
          {{-- Badge --}}
          <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-sm font-medium backdrop-blur-md">
            <span class="relative flex h-2 w-2">
              <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex h-2 w-2 rounded-full bg-green-400"></span>
            </span>
            Platform tiket event modern Indonesia
          </div>

          {{-- Main Heading --}}
          <h1 class="text-4xl font-black leading-[1.08] tracking-tight sm:text-5xl lg:text-6xl">
            Temukan event <span class="gradient-text-light">favoritmu,</span><br>
            amankan tiket dengan cepat.
          </h1>

          <p class="max-w-lg text-lg text-slate-300 leading-relaxed">
            Dari konser, seminar, hingga workshop — BengTix hadir untuk booking yang simpel, aman, dan elegan.
          </p>

          {{-- CTA Buttons --}}
          <div class="flex flex-wrap gap-3 pt-2">
            <a href="#event-list" id="cta-jelajahi"
               class="btn-brand inline-flex items-center gap-2 px-6 py-3 text-base font-semibold">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
              Jelajahi Event
            </a>
            <a href="#features"
               class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur transition hover:bg-white/20">
              Kenapa BengTix?
            </a>
          </div>

          {{-- Stats --}}
          <div class="flex flex-wrap gap-3 pt-2">
            <div class="stat-pill">
              <span class="text-xl font-black text-white">10k+</span>
              <span class="text-xs text-slate-400">tiket/bulan</span>
            </div>
            <div class="stat-pill">
              <span class="text-xl font-black text-white">500+</span>
              <span class="text-xs text-slate-400">event tersedia</span>
            </div>
            <div class="stat-pill">
              <span class="text-xl font-black text-white">24/7</span>
              <span class="text-xs text-slate-400">akses mudah</span>
            </div>
          </div>
        </div>

        {{-- RIGHT: Featured Card --}}
        <div class="card-float-in">
          <div class="rounded-[2rem] border border-white/20 bg-white/8 p-3 shadow-2xl shadow-blue-950/40 backdrop-blur-lg">
            <div class="rounded-[1.6rem] bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-700 p-6 text-white">
              <div class="flex items-center justify-between">
                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold uppercase tracking-widest backdrop-blur">
                  ✦ Featured
                </span>
                <span class="flex items-center gap-1.5 text-xs text-blue-200">
                  <span class="h-1.5 w-1.5 rounded-full bg-green-400 animate-pulse"></span>
                  Live now
                </span>
              </div>
              <h2 class="mt-5 text-2xl font-bold leading-snug">Festival Musik Malam Ini</h2>
              <p class="mt-2 text-sm text-blue-200 leading-relaxed">
                Lineup terbaik, venue premium, pengalaman booking tanpa ribet.
              </p>
              <div class="mt-5 space-y-2 rounded-2xl border border-white/15 bg-white/10 p-4 text-sm backdrop-blur">
                <div class="flex items-center justify-between">
                  <span class="text-blue-200">📍 Lokasi</span>
                  <span class="font-semibold">Bandung Convention Center</span>
                </div>
                <div class="h-px bg-white/10"></div>
                <div class="flex items-center justify-between">
                  <span class="text-blue-200">🎟 Mulai dari</span>
                  <span class="font-bold text-lg">Rp 125.000</span>
                </div>
              </div>
            </div>

            <div class="mt-3 grid grid-cols-2 gap-2.5">
              <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                <div class="mb-1 flex h-8 w-8 items-center justify-center rounded-xl bg-blue-50">
                  <svg class="h-4 w-4 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  </svg>
                </div>
                <p class="text-sm font-semibold text-slate-800">Pembayaran Aman</p>
                <p class="mt-0.5 text-xs text-slate-500">Transaksi terjamin.</p>
              </div>
              <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
                <div class="mb-1 flex h-8 w-8 items-center justify-center rounded-xl bg-amber-50">
                  <svg class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                </div>
                <p class="text-sm font-semibold text-slate-800">E-Ticket Instan</p>
                <p class="mt-0.5 text-xs text-slate-500">Langsung ke inbox.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    {{-- Wave separator --}}
    <div class="absolute bottom-0 left-0 right-0">
      <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" preserveAspectRatio="none">
        <path d="M0 60L1440 60L1440 20C1200 60 960 0 720 20C480 40 240 0 0 20L0 60Z" fill="#f8fafc"/>
      </svg>
    </div>
  </section>


  {{-- ════════════════════════════════
       FEATURES SECTION
  ════════════════════════════════ --}}
  <section id="features" class="mx-auto max-w-7xl px-6 pt-14 pb-10 lg:pt-20 lg:pb-12">
    <div class="mb-10 text-center">
      <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Mengapa BengTix?</p>
      <h2 class="mt-3 text-3xl font-black text-slate-900 sm:text-4xl">
        Pengalaman booking yang <span class="gradient-text">berbeda</span>
      </h2>
    </div>

    <div class="grid gap-5 sm:grid-cols-3">
      {{-- Feature 1 --}}
      <div class="feature-card group card-modern flex flex-col gap-4 p-7">
        <div class="feature-icon bg-blue-50 text-blue-700">
          <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-bold text-slate-900">Transaksi Aman</h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-500">Proses booking terjamin dan nyaman dari awal hingga tiket masuk ke inbox kamu.</p>
        </div>
        <div class="mt-auto pt-2 border-t border-slate-100">
          <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-700">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            SSL Encrypted
          </span>
        </div>
      </div>

      {{-- Feature 2 --}}
      <div class="feature-card group card-modern flex flex-col gap-4 p-7">
        <div class="feature-icon bg-amber-50 text-amber-600">
          <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-bold text-slate-900">Cepat & Instan</h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-500">E-ticket langsung tersedia setelah pembayaran selesai, tanpa antrean panjang.</p>
        </div>
        <div class="mt-auto pt-2 border-t border-slate-100">
          <span class="inline-flex items-center gap-1 text-xs font-semibold text-amber-700">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            Realtime Delivery
          </span>
        </div>
      </div>

      {{-- Feature 3 --}}
      <div class="feature-card group card-modern flex flex-col gap-4 p-7">
        <div class="feature-icon bg-emerald-50 text-emerald-700">
          <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0"/>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-bold text-slate-900">Beragam Pilihan</h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-500">Temukan berbagai kategori event dari komunitas lokal hingga pengalaman premium.</p>
        </div>
        <div class="mt-auto pt-2 border-t border-slate-100">
          <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            500+ Event Aktif
          </span>
        </div>
      </div>
    </div>
  </section>


  {{-- ════════════════════════════════
       EVENT LIST SECTION
  ════════════════════════════════ --}}
  <section id="event-list" class="mx-auto max-w-7xl px-6 pb-16 pt-4 lg:pb-24">

    {{-- Section Header --}}
    <div class="mb-8 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Event Terbaru</p>
        <h2 class="mt-2 text-2xl font-black text-slate-900 sm:text-3xl">
          Jelajahi pengalaman menarik
        </h2>
        @if ($search)
          <p class="mt-1.5 text-sm text-slate-500">
            <span class="font-medium text-slate-700">{{ $events->count() }}</span> hasil untuk
            "<span class="font-semibold text-blue-700">{{ $search }}</span>"
          </p>
        @endif
      </div>

      {{-- Category Pills --}}
      <div class="flex flex-wrap gap-2" id="category-pills-container">
        <a href="{{ route('home', array_filter(['search' => $search])) }}" class="category-link">
          <x-ui.category-pill :label="'Semua'" :active="!request('kategori')" />
        </a>
        @foreach($categories as $kategori)
          <a href="{{ route('home', array_filter(['kategori' => $kategori->id, 'search' => $search])) }}" class="category-link">
            <x-ui.category-pill :label="$kategori->nama" :active="request('kategori') == $kategori->id" />
          </a>
        @endforeach
      </div>
    </div>

    {{-- Events Grid --}}
    @if ($events->count() > 0)
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($events as $i => $event)
          <div class="stagger-{{ min($i + 1, 4) }} card-float-in">
            <x-event-card
              :title="$event->judul"
              :date="$event->tanggal_waktu"
              :location="$event->lokasi->nama_lokasi ?? '-'"
              :price="$event->tikets_min_harga"
              :image="$event->gambar"
              :category="$event->kategori->nama ?? null"
              :href="route('events.show', $event)"
            />
          </div>
        @endforeach
      </div>
    @else
      {{-- Empty State --}}
      <div class="flex flex-col items-center justify-center rounded-[2rem] border border-dashed border-slate-300 bg-white py-24 text-center shadow-sm">
        <div class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-slate-100">
          <svg class="h-9 w-9 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800">Tidak ada event ditemukan</h3>
        <p class="mt-2 max-w-sm text-sm text-slate-500">
          Coba ubah kata kunci pencarian atau pilih kategori lain untuk menemukan event yang tepat.
        </p>
        <a href="{{ route('home') }}"
           class="btn-brand mt-6 inline-flex items-center gap-2 px-5 py-2.5 text-sm">
          Reset Pencarian
        </a>
      </div>
    @endif
  </section>

</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const eventListSection = document.getElementById('event-list');
  
  if (!eventListSection) return;

  // SPA-like navigation for category pills
  document.body.addEventListener('click', async function (e) {
    const link = e.target.closest('a.category-link');
    if (!link) return;
    
    e.preventDefault();
    
    // Set loading state
    eventListSection.style.transition = 'opacity 0.3s ease';
    eventListSection.style.opacity = '0.4';
    eventListSection.style.pointerEvents = 'none';

    try {
      const url = new URL(link.href);
      url.hash = ''; // ensure no hash jump
      
      const response = await fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      
      if (!response.ok) throw new Error('Network response was not ok');
      
      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      
      const newEventList = doc.getElementById('event-list');
      
      if (newEventList) {
        // Replace innerHTML
        eventListSection.innerHTML = newEventList.innerHTML;
        // Update URL
        window.history.pushState({}, '', url);
      }
    } catch (error) {
      console.error('Error fetching events:', error);
      // Fallback to normal navigation
      window.location.href = link.href;
    } finally {
      // Remove loading state
      eventListSection.style.opacity = '1';
      eventListSection.style.pointerEvents = 'auto';
    }
  });

  // Handle browser back/forward buttons
  window.addEventListener('popstate', async function () {
    eventListSection.style.opacity = '0.4';
    eventListSection.style.pointerEvents = 'none';
    
    try {
      const response = await fetch(window.location.href, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const html = await response.text();
      const doc = new DOMParser().parseFromString(html, 'text/html');
      const newEventList = doc.getElementById('event-list');
      if (newEventList) {
        eventListSection.innerHTML = newEventList.innerHTML;
      }
    } catch (error) {
      window.location.reload();
    } finally {
      eventListSection.style.opacity = '1';
      eventListSection.style.pointerEvents = 'auto';
    }
  });
});
</script>
