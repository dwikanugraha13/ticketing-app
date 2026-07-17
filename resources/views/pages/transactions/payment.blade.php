<x-app-layout>
    <div class="mx-auto max-w-3xl px-6 py-12 md:py-20 lg:px-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 md:p-10 shadow-2xl">
            <div class="mb-8 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 md:text-3xl">Selesaikan Pembayaran</h1>
                <p class="mt-2 text-sm text-slate-500">Order ID: <span class="font-bold text-slate-700">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></p>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6 mb-8">
                <h3 class="font-bold text-slate-800 mb-4 text-lg">Ringkasan Pesanan</h3>
                <div class="space-y-4">
                    <div class="flex justify-between border-b border-dashed border-slate-200 pb-4">
                        <div>
                            <p class="font-medium text-slate-900">{{ $order->events->judul }}</p>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ \Carbon\Carbon::parse($order->events->tanggal_waktu)->translatedFormat('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                    @foreach($order->detailOrders as $detail)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">{{ $detail->jumlah }}x Tiket {{ $detail->tiket->tipe }}</span>
                            <span class="text-sm font-bold text-slate-800">Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <div class="flex items-center justify-between border-t border-slate-200 pt-4">
                        <span class="font-bold text-slate-900">Total Harga</span>
                        <span class="text-xl font-black text-blue-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-error shadow-lg mb-6 rounded-xl">
                    <div><span>{{ session('error') }}</span></div>
                </div>
            @endif

            <div x-data="{ processing: false, paid: {{ $order->status === 'paid' ? 'true' : 'false' }} }">
                <template x-if="!paid">
                    <form @submit.prevent="
                        processing = true;
                        fetch('{{ route('transactions.process', $order) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            processing = false;
                            if(data.success) {
                                paid = true;
                            } else {
                                alert(data.error || 'Terjadi kesalahan');
                            }
                        })
                        .catch(() => { processing = false; alert('Error jaringan'); });
                    ">
                        <button type="submit" :disabled="processing" class="btn btn-brand w-full rounded-xl py-4 text-base font-bold shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40">
                            <span x-show="!processing">Simulasikan Pembayaran Sekarang</span>
                            <span x-show="processing">Memproses...</span>
                        </button>
                    </form>
                </template>
                <template x-if="paid">
                    <div class="text-center space-y-4 py-4">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Pembayaran Berhasil!</h3>
                        <a href="{{ route('transactions.history') }}" class="btn btn-outline-brand w-full rounded-xl py-3 mt-4">Ke Riwayat Transaksi</a>
                    </div>
                </template>
            </div>
            <p class="text-center text-xs text-slate-400 mt-4">
                Ini adalah halaman simulasi pembayaran. Klik tombol di atas untuk menyelesaikan pesanan.
            </p>
        </div>
    </div>
</x-app-layout>
