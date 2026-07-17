<div class="rounded-[24px] border border-slate-200 bg-white p-5 shadow-[0_20px_60px_-32px_rgba(15,23,42,0.45)] md:p-6">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-slate-800">Pilih Tiket</h3>
            <p class="mt-1 text-sm text-slate-500">Pilih tipe tiket yang sesuai dengan kebutuhanmu.</p>
        </div>
        <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Fast Access</span>
    </div>

    @if ($event->tikets && $event->tikets->count() > 0)
        <div class="space-y-3.5">
            @foreach ($event->tikets as $tiket)
                @php $habis = $tiket->stok !== null && $tiket->stok <= 0; @endphp
                <div class="group relative overflow-hidden rounded-[20px] border bg-white transition-all duration-300 ease-out"
                     :class="{
                        'border-transparent shadow-[0_18px_45px_-22px_rgba(29,78,216,0.55)] ring-2 ring-blue-700 -translate-y-0.5': selectedId === {{ $tiket->id }},
                        'border-slate-200 hover:border-blue-300 hover:shadow-[0_12px_30px_-20px_rgba(15,23,42,0.35)] cursor-pointer': selectedId !== {{ $tiket->id }} && {{ $habis ? 'false' : 'true' }},
                        'border-slate-200 opacity-45 cursor-not-allowed': {{ $habis ? 'true' : 'false' }}
                     }"
                     @click="select({{ $tiket->id }})">

                    <!-- selected accent bar -->
                    <div class="absolute inset-y-0 left-0 w-1 transition-colors duration-300"
                         :class="selectedId === {{ $tiket->id }} ? 'bg-[linear-gradient(180deg,_#2563eb_0%,_#1d4ed8_45%,_#0f172a_100%)]' : 'bg-transparent'"></div>

                    <!-- perforated "ticket stub" notches -->
                    <span class="pointer-events-none absolute -left-2 top-1/2 hidden h-4 w-4 -translate-y-1/2 rounded-full bg-[radial-gradient(circle_at_top_left,_transparent_70%,_#f8fbff_71%)] sm:block"></span>

                    <div class="flex items-start justify-between gap-3 p-4 pl-5">
                        <div class="flex min-w-0 items-start gap-3">
                            <div class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl transition-all duration-300"
                                 :class="selectedId === {{ $tiket->id }} ? 'bg-[linear-gradient(135deg,_#1d4ed8_0%,_#0f172a_100%)] text-white shadow-lg shadow-blue-900/25' : 'bg-slate-100 text-slate-500 group-hover:bg-blue-50 group-hover:text-blue-700'">
                                @if ($tiket->tipe === 'premium')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M5 16L3 6l5.5 4L12 4l3.5 6L21 6l-2 10H5zm0 2h14v2H5v-2z"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-800">Tiket {{ ucfirst($tiket->tipe) }}</p>
                                @if ($tiket->deskripsi)
                                    <p class="mt-1 text-xs leading-5 text-slate-500 line-clamp-2">{{ $tiket->deskripsi }}</p>
                                @endif
                                <p class="mt-2 text-sm font-bold tracking-tight text-blue-900">Rp {{ number_format($tiket->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="flex shrink-0 flex-col items-end gap-2">
                            <!-- radio indicator -->
                            <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 transition-all duration-300"
                                  :class="selectedId === {{ $tiket->id }} ? 'border-blue-700 bg-blue-700' : 'border-slate-300 bg-white group-hover:border-blue-400'">
                                <svg x-show="selectedId === {{ $tiket->id }}" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            @if ($tiket->stok !== null)
                                <span class="whitespace-nowrap rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $habis ? 'bg-rose-50 text-rose-600' : 'bg-emerald-50 text-emerald-700' }}">
                                    {{ $habis ? 'Habis' : $tiket->stok . ' tersedia' }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div x-show="selectedId === {{ $tiket->id }}" x-cloak
                         x-transition:enter="transition ease-out duration-250"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="flex items-center justify-between gap-3 border-t border-dashed border-blue-100 bg-[linear-gradient(90deg,_rgba(239,246,255,0.7)_0%,_transparent_100%)] px-4 py-3 pl-5" @click.stop>
                        <span class="text-sm font-medium text-slate-600">Jumlah tiket</span>
                        <div class="flex shrink-0 items-center gap-1 rounded-full border border-blue-200 bg-white p-1 shadow-sm">
                            <button type="button" @click="dec()" class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-slate-500 transition hover:bg-blue-50 hover:text-blue-700 active:scale-90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                            </button>
                            <span class="w-7 text-center text-sm font-bold text-slate-800" x-text="qty"></span>
                            <button type="button" @click="inc()" class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-700 text-white transition hover:bg-blue-800 active:scale-90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 hidden lg:block">
            <template x-if="selected">
                <div class="mb-4 space-y-2 rounded-2xl border border-blue-100 bg-blue-50/60 p-4 text-sm">
                    <div class="flex items-center justify-between text-slate-600">
                        <span x-text="selected.tipe + ' × ' + qty"></span>
                        <span class="font-medium text-slate-700" x-text="formatRupiah(subtotal)"></span>
                    </div>
                    <div class="flex items-center justify-between border-t border-dashed border-blue-200 pt-2">
                        <span class="font-semibold text-slate-700">Total</span>
                        <span class="text-base font-extrabold tracking-tight text-blue-900" x-text="formatRupiah(subtotal)"></span>
                    </div>
                </div>
            </template>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" name="tiket_id" :value="selected?.id">
                <input type="hidden" name="qty" :value="qty">
                <button type="submit" :disabled="!selected"
                        class="btn btn-brand w-full rounded-full px-4 py-3 text-sm font-semibold transition-all duration-300 disabled:cursor-not-allowed disabled:opacity-40">
                    <span x-text="selected ? 'Lanjutkan Pembayaran' : 'Pilih tiket terlebih dahulu'"></span>
                </button>
            </form>
        </div>
    @else
        <div class="py-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-2 h-10 w-10 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p class="text-sm text-slate-500">Belum ada tiket yang tersedia untuk event ini.</p>
        </div>
    @endif
</div>
