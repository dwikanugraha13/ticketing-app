@extends('layouts.admin_layouts')

@section('title', 'Manajemen Event')

@section('content')
<div class="admin-page-hero mb-6 rounded-[2rem] p-5 text-slate-100 shadow-[0_20px_60px_-30px_rgba(37,99,235,0.35)] sm:p-5">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <span class="admin-pill">Content Management</span>
            <h2 class="mt-3 text-2xl font-semibold text-slate-100">Manajemen Event</h2>
            <p class="mt-2 text-sm leading-6 text-slate-200/80">{{ $events->total() }} event terdaftar dan siap dikelola dari satu tempat.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-blue-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Event
        </a>
    </div>
</div>

@if (session('success'))
    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="admin-form-card mb-6 rounded-[1.75rem] p-4">
    <form method="GET" action="{{ route('admin.events.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-4">
        <div>
            <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Cari (judul/lokasi)</label>
            <input type="text" name="search" value="{{ request('search') }}" autocomplete="off"
                   class="input input-bordered mt-2 w-full" placeholder="Cari event...">
        </div>

        <div>
            <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Kategori</label>
            <select name="kategori_id" class="select select-bordered mt-2 w-full">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Urutkan Tanggal</label>
            <select name="sort" class="select select-bordered mt-2 w-full">
                <option value="asc" {{ request('sort', 'asc') === 'asc' ? 'selected' : '' }}>Terdekat dulu</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Terjauh dulu</option>
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="btn btn-brand flex-1">Filter</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-ghost" title="Reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </a>
        </div>
    </form>
</div>

<div class="admin-surface overflow-hidden rounded-[1.75rem]">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50/80">
                <tr class="text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                    <th class="px-5 py-4">Event</th>
                    <th class="px-5 py-4">Kategori</th>
                    <th class="px-5 py-4">Tanggal</th>
                    <th class="px-5 py-4">Lokasi</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white/70">
                @forelse ($events as $event)
                    <tr class="hover:bg-slate-50/80">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $event->image_url }}" alt="{{ $event->judul }}" class="h-14 w-14 shrink-0 rounded-2xl object-cover">
                                <span class="line-clamp-2 font-medium text-slate-800">{{ $event->judul }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $event->kategori->nama ?? '-' }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-slate-500">{{ \Carbon\Carbon::parse($event->tanggal_waktu)->translatedFormat('d M Y, H:i') }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $event->lokasi }}</td>
                        <td class="px-4 py-3">
                            @php
                                $statusColor = match ($event->status) {
                                    'Upcoming' => 'bg-blue-50 text-blue-700',
                                    'Ongoing' => 'bg-emerald-50 text-emerald-700',
                                    default => 'bg-slate-100 text-slate-500',
                                };
                            @endphp
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusColor }}">{{ $event->status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end items-center gap-1">
                                <a href="{{ route('events.show', $event) }}" class="rounded-full p-2 text-slate-500 transition hover:bg-slate-100" title="Lihat">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="rounded-full p-2 text-blue-700 transition hover:bg-blue-50" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>

                                <div class="dropdown dropdown-end">
                                    <div tabindex="0" role="button" class="rounded-full p-2 text-slate-500 transition hover:bg-slate-100" title="Lainnya">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 8a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content menu menu-sm z-10 mt-2 w-36 rounded-2xl border border-slate-200 bg-white p-1.5 shadow-lg">
                                        <li>
                                            <form action="{{ route('admin.events.clone', $event) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-slate-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 4h8a2 2 0 012 2v6a2 2 0 01-2 2h-8a2 2 0 01-2-2v-6a2 2 0 012-2z"/></svg>
                                                    Clone
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 4h5l.5 3h-6l.5-3z"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-14 text-center text-slate-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm">Belum ada event.</p>
                                <a href="{{ route('admin.events.create') }}" class="text-sm font-medium text-blue-700 hover:text-blue-900">Buat event pertama</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($events->hasPages())
        <div class="border-t border-slate-200 bg-slate-50/60 p-4">
            {{ $events->appends(request()->except('page'))->links() }}
        </div>
    @endif
</div>
@endsection
