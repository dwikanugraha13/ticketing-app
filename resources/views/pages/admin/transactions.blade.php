@extends('layouts.admin_layouts')

@section('title', 'Manajemen Transaksi')

@section('content')
    <div class="admin-page-hero mb-8 rounded-3xl p-8 text-white shadow-xl shadow-blue-900/10">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between relative z-10">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider backdrop-blur-md">
                    Rekapitulasi
                </span>
                <h2 class="mt-4 text-3xl font-bold text-white">Data Transaksi</h2>
                <p class="mt-2 text-sm leading-relaxed text-blue-100/90">Pantau seluruh riwayat transaksi pemesanan tiket dari semua pengguna.</p>
            </div>
        </div>
    </div>

    <div class="admin-table-container mb-8" id="admin-transactions-container">
        <div class="overflow-x-auto">
            <table class="admin-table w-full text-left">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pengguna</th>
                        <th>Event</th>
                        <th>Waktu Transaksi</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td class="font-semibold text-slate-900">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-slate-700">{{ $order->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-slate-700">{{ $order->events->judul }}</span>
                            <div class="text-xs text-slate-500 mt-1">
                                @foreach($order->detailOrders as $detail)
                                    {{ $detail->jumlah }}x {{ $detail->tiket->tipe }}
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <span class="text-sm text-slate-600">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y, H:i') }}</span>
                        </td>
                        <td>
                            <span class="font-bold text-blue-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @if($order->status === 'paid')
                                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 border border-emerald-200">Lunas</span>
                            @elseif($order->status === 'pending')
                                <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 border border-amber-200">Pending</span>
                            @else
                                <span class="rounded-full bg-rose-100 px-2.5 py-1 text-xs font-bold text-rose-700 border border-rose-200">Gagal</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center gap-3 text-slate-400">
                                <div class="rounded-full bg-slate-50 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <p class="text-sm font-medium">Belum ada transaksi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Real-time polling untuk memperbarui daftar transaksi admin tanpa refresh
        setInterval(() => {
            fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const newContainer = doc.getElementById('admin-transactions-container');
                    if (newContainer) {
                        document.getElementById('admin-transactions-container').innerHTML = newContainer.innerHTML;
                    }
                })
                .catch(err => console.error('Polling error:', err));
        }, 5000);
    </script>
@endsection
