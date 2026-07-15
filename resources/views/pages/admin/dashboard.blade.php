@extends('layouts.admin_layouts')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-page-hero mb-8 rounded-[2rem] p-5 text-slate-100 shadow-[0_20px_60px_-30px_rgba(37,99,235,0.35)] sm:p-5">
        <div class="flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-2xl">
                <span class="admin-pill">Admin Control Center</span>
                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-100 sm:text-4xl">Halo, {{ auth()->user()?->name }} 👋</h2>
                <p class="mt-3 text-base leading-8 text-slate-200/80 sm:text-lg">Pantau performa event, kategori, dan transaksi dengan tampilan yang lebih rapi, informatif, dan konsisten.</p>
            </div>
            <div class="rounded-[1.5rem] border border-white/20 bg-white/10 px-5 py-4 text-sm text-slate-200 backdrop-blur-md shadow-sm">
                <p class="font-semibold text-slate-100">Ringkasan hari ini</p>
                <p class="mt-2 text-base leading-7 text-slate-200">{{ $totalEvents }} event aktif dan {{ $totalOrders }} transaksi tercatat.</p>
            </div>
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="admin-stat-card rounded-[1.5rem] p-4">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-slate-500">Total Event</span>
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-50 text-blue-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
            </div>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalEvents }}</p>
        </div>

        <div class="admin-stat-card rounded-[1.5rem] p-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-slate-500">Total Kategori</span>
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-50 text-violet-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 106 0 3 3 0 00-6 0"/></svg></span>
            </div>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalKategori }}</p>
        </div>

        <div class="admin-stat-card rounded-[1.5rem] p-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-slate-500">Total Order</span>
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m-10 4a1 1 0 102 0 1 1 0 00-2 0zm10 0a1 1 0 102 0 1 1 0 00-2 0z"/></svg></span>
            </div>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalOrders }}</p>
        </div>

        <div class="admin-stat-card rounded-[1.5rem] p-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-slate-500">Total Pendapatan</span>
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m9-8a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
            </div>
            <p class="mt-4 text-2xl font-semibold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
        <div class="admin-surface rounded-[1.75rem] p-4 lg:col-span-1">
            <h3 class="text-lg font-semibold text-slate-900">Status Event</h3>
            @php
                $statusTotal = max(1, $upcomingCount + $ongoingCount + $completedCount);
            @endphp
            <div class="mt-5 space-y-4">
                <div>
                    <div class="mb-1 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2 text-slate-600"><span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span> Upcoming</span>
                        <span class="font-semibold text-slate-900">{{ $upcomingCount }}</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-blue-500" style="width: {{ $upcomingCount / $statusTotal * 100 }}%"></div></div>
                </div>
                <div>
                    <div class="mb-1 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2 text-slate-600"><span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span> Ongoing</span>
                        <span class="font-semibold text-slate-900">{{ $ongoingCount }}</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-emerald-500" style="width: {{ $ongoingCount / $statusTotal * 100 }}%"></div></div>
                </div>
                <div>
                    <div class="mb-1 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2 text-slate-600"><span class="h-2.5 w-2.5 rounded-full bg-slate-400"></span> Completed</span>
                        <span class="font-semibold text-slate-900">{{ $completedCount }}</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-slate-400" style="width: {{ $completedCount / $statusTotal * 100 }}%"></div></div>
                </div>
            </div>

            <div class="my-6 h-px bg-slate-200"></div>

            <h3 class="text-lg font-semibold text-slate-900">Kategori Terpopuler</h3>
            <div class="mt-4 space-y-2">
                @forelse ($topCategories as $kategori)
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-3 py-2.5 text-sm">
                        <span class="text-slate-600">{{ $kategori->nama }}</span>
                        <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">{{ $kategori->events_count }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>

        <div class="admin-surface rounded-[1.75rem] p-4 lg:col-span-2">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Event Terbaru</h3>
                    <p class="mt-1 text-sm text-slate-500">Aktivitas terbaru yang perlu Anda pantau.</p>
                </div>
                <a href="{{ route('admin.events.index') }}" class="text-sm font-medium text-blue-700 hover:text-blue-900">Lihat semua &rarr;</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                            <th class="pb-3">Judul</th>
                            <th class="pb-3">Kategori</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentEvents as $event)
                            <tr class="hover:bg-slate-50/80">
                                <td class="py-3 font-medium text-slate-800">{{ $event->judul }}</td>
                                <td class="py-3 text-slate-500">{{ $event->kategori->nama ?? '-' }}</td>
                                <td class="py-3 text-slate-500">{{ optional($event->tanggal_waktu)->translatedFormat('d M Y, H:i') }}</td>
                                <td class="py-3">
                                    @php
                                        $statusColor = match($event->status) {
                                            'Upcoming' => 'bg-blue-50 text-blue-700',
                                            'Ongoing' => 'bg-emerald-50 text-emerald-700',
                                            default => 'bg-slate-100 text-slate-500',
                                        };
                                    @endphp
                                    <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusColor }}">{{ $event->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-slate-400">
                                    Belum ada event. <a href="{{ route('admin.events.create') }}" class="font-medium text-blue-700 hover:text-blue-900">Buat event pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
