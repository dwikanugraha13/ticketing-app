<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-12 md:py-16 lg:px-8">
        <div class="mb-10 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-3xl font-black text-slate-900 md:text-4xl">Riwayat Transaksi</h1>
                <p class="mt-2 text-sm text-slate-500">Lihat semua pesanan dan tiket Anda di sini.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200">
                <div><span>{{ session('success') }}</span></div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error shadow-lg mb-6 rounded-xl">
                <div><span>{{ session('error') }}</span></div>
            </div>
        @endif

        <div id="history-container">
            @if($orders->isEmpty())
            <div class="rounded-[2rem] border border-slate-200 bg-white py-24 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Belum ada transaksi</h3>
                <p class="mt-1 text-sm text-slate-500 mb-6">Anda belum pernah membeli tiket apapun.</p>
                <a href="{{ route('home') }}" class="btn btn-brand rounded-full px-6">Cari Event Sekarang</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm transition hover:shadow-md">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                            
                            {{-- Informasi Order & Event --}}
                            <div class="flex items-start gap-5 min-w-0">
                                <div class="hidden h-20 w-20 shrink-0 overflow-hidden rounded-2xl md:block border border-slate-100">
                                    <img src="{{ $order->events->gambar ? asset('storage/'.$order->events->gambar) : asset('storage/konser.jpg') }}" 
                                         alt="{{ $order->events->judul }}" class="h-full w-full object-cover">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-3 mb-1">
                                        <span class="text-xs font-bold text-slate-400">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        @if($order->status === 'paid')
                                            <span class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-bold text-emerald-700">Lunas</span>
                                        @elseif($order->status === 'pending')
                                            <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-bold text-amber-700">Menunggu Pembayaran</span>
                                        @else
                                            <span class="rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-bold text-rose-700">Gagal</span>
                                        @endif
                                        <span class="text-xs text-slate-400">• {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <h3 class="text-lg font-black text-slate-900 truncate">{{ $order->events->judul }}</h3>
                                    
                                    <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
                                        <span class="flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ \Carbon\Carbon::parse($order->events->tanggal_waktu)->translatedFormat('d M Y, H:i') }}
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $order->events->lokasi->nama_lokasi ?? 'Lokasi Tidak Tersedia' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Tiket & Harga --}}
                            <div class="flex shrink-0 flex-col gap-3 rounded-2xl bg-slate-50 p-4 lg:w-64 lg:items-end lg:bg-transparent lg:p-0">
                                <div class="w-full space-y-1 lg:text-right">
                                    @foreach($order->detailOrders as $detail)
                                        <p class="text-sm text-slate-600">{{ $detail->jumlah }}x Tiket {{ $detail->tiket->tipe }}</p>
                                    @endforeach
                                </div>
                                <div class="mt-2 w-full border-t border-dashed border-slate-200 pt-2 lg:text-right">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Harga</p>
                                    <p class="text-lg font-black text-blue-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                </div>
                                @if($order->status === 'pending')
                                    <a href="{{ route('transactions.payment', $order) }}" class="btn btn-sm btn-brand mt-2 w-full lg:w-auto">Bayar Sekarang</a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        </div>
    </div>

    <script>
        // Real-time polling untuk memperbarui daftar transaksi tanpa refresh
        setInterval(() => {
            fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const newContainer = doc.getElementById('history-container');
                    if (newContainer) {
                        document.getElementById('history-container').innerHTML = newContainer.innerHTML;
                    }
                })
                .catch(err => console.error('Polling error:', err));
        }, 5000);
    </script>
</x-app-layout>
