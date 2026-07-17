@extends('layouts.admin_layouts')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-page-hero mb-8 rounded-3xl p-8 text-white shadow-xl shadow-blue-900/10">
        <div class="flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between relative z-10">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider backdrop-blur-md">
                    <span class="h-1.5 w-1.5 rounded-full bg-white animate-pulse"></span>
                    Admin Control Center
                </span>
                <h2 class="mt-5 text-3xl font-bold tracking-tight sm:text-4xl">Halo, {{ auth()->user()?->name }} 👋</h2>
                <p class="mt-3 text-base leading-relaxed text-blue-100/90 sm:text-lg">Pantau performa event, kategori, dan transaksi dengan tampilan yang lebih rapi, informatif, dan konsisten.</p>
            </div>
            <div class="rounded-2xl border border-white/20 bg-white/10 px-6 py-5 text-sm text-white backdrop-blur-md shadow-lg">
                <p class="font-medium text-blue-100">Ringkasan hari ini</p>
                <p class="mt-2 text-lg leading-7 font-semibold">{{ $totalEvents }} event aktif &middot; {{ $totalOrders }} transaksi</p>
            </div>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <div class="admin-stat-card p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Total Event</span>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $totalEvents }}</p>
        </div>

        <div class="admin-stat-card p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Kategori</span>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 106 0 3 3 0 00-6 0"/></svg></span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $totalKategori }}</p>
        </div>

        <div class="admin-stat-card p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Order</span>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m-10 4a1 1 0 102 0 1 1 0 00-2 0zm10 0a1 1 0 102 0 1 1 0 00-2 0z"/></svg></span>
            </div>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $totalOrders }}</p>
        </div>

        <div class="admin-stat-card p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Pendapatan</span>
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m9-8a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
            </div>
            <p class="mt-4 text-2xl font-bold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="admin-surface p-6 lg:col-span-1">
            <h3 class="text-lg font-bold text-slate-900">Status Event</h3>
            @php
                $statusTotal = max(1, $upcomingCount + $ongoingCount + $completedCount);
            @endphp
            <div class="mt-6 space-y-5">
                <div>
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2.5 text-slate-600 font-medium"><span class="h-3 w-3 rounded-full bg-blue-500 shadow-sm shadow-blue-500/50"></span> Upcoming</span>
                        <span class="font-bold text-slate-900">{{ $upcomingCount }}</span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-blue-500" style="width: {{ $upcomingCount / $statusTotal * 100 }}%"></div></div>
                </div>
                <div>
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2.5 text-slate-600 font-medium"><span class="h-3 w-3 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span> Ongoing</span>
                        <span class="font-bold text-slate-900">{{ $ongoingCount }}</span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-emerald-500" style="width: {{ $ongoingCount / $statusTotal * 100 }}%"></div></div>
                </div>
                <div>
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2.5 text-slate-600 font-medium"><span class="h-3 w-3 rounded-full bg-slate-400 shadow-sm shadow-slate-400/50"></span> Completed</span>
                        <span class="font-bold text-slate-900">{{ $completedCount }}</span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-slate-400" style="width: {{ $completedCount / $statusTotal * 100 }}%"></div></div>
                </div>
            </div>

            <div class="my-8 h-px bg-slate-200"></div>

            <h3 class="text-lg font-bold text-slate-900">Kategori Terpopuler</h3>
            <div class="mt-5 space-y-3">
                @forelse ($topCategories as $kategori)
                    <div class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-100 px-4 py-3 text-sm transition hover:bg-slate-100/70">
                        <span class="font-medium text-slate-700">{{ $kategori->nama }}</span>
                        <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-700">{{ $kategori->events_count }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>

        <div class="admin-surface p-6 lg:col-span-2">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Event Terbaru</h3>
                    <p class="mt-1 text-sm text-slate-500">Aktivitas terbaru yang perlu Anda pantau.</p>
                </div>
                <a href="{{ route('admin.events.index') }}" class="text-sm font-semibold text-blue-600 transition hover:text-blue-800">Lihat semua &rarr;</a>
            </div>

            <div class="admin-table-container">
                <table class="admin-table w-full text-left">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentEvents as $event)
                            <tr>
                                <td class="font-medium">{{ $event->judul }}</td>
                                <td>{{ $event->kategori->nama ?? '-' }}</td>
                                <td>{{ optional($event->tanggal_waktu)->translatedFormat('d M Y, H:i') }}</td>
                                <td>
                                    @php
                                        $statusColor = match($event->status) {
                                            'Upcoming' => 'bg-blue-50 text-blue-700',
                                            'Ongoing' => 'bg-emerald-50 text-emerald-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                    @endphp
                                    <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $statusColor }}">{{ $event->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-400">
                                    Belum ada event. <a href="{{ route('admin.events.create') }}" class="font-semibold text-blue-600 hover:text-blue-800">Buat event pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
