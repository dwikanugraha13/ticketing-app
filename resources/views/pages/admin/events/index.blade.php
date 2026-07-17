@extends('layouts.admin_layouts')

@section('title', 'Manajemen Event')

@section('content')
<div class="admin-page-hero mb-8 rounded-3xl p-8 text-white shadow-xl shadow-blue-900/10">
    <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between relative z-10">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider backdrop-blur-md">
                Content Management
            </span>
            <h2 class="mt-4 text-3xl font-bold text-white">Manajemen Event</h2>
            <p class="mt-2 text-sm leading-relaxed text-blue-100/90">{{ $events->total() }} event terdaftar dan siap dikelola dari satu tempat.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-700 shadow-md transition hover:bg-blue-50 hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Event Baru
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

<div class="admin-form-card mb-8 p-6">
    <form method="GET" action="{{ route('admin.events.index') }}" class="grid grid-cols-1 gap-5 md:grid-cols-4">
        <div>
            <label>Cari (judul/lokasi)</label>
            <input type="text" name="search" value="{{ request('search') }}" autocomplete="off"
                   class="input" placeholder="Ketik kata kunci...">
        </div>

        <div>
            <label>Kategori</label>
            <select name="kategori_id" class="select">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Urutkan Tanggal</label>
            <select name="sort" class="select">
                <option value="asc" {{ request('sort', 'asc') === 'asc' ? 'selected' : '' }}>Terdekat dulu</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Terjauh dulu</option>
            </select>
        </div>

        <div class="flex items-end gap-3">
            <button type="submit" class="inline-flex flex-1 items-center justify-center rounded-lg bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-800">Filter</button>
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-100 px-4 py-3 text-slate-600 transition hover:bg-slate-200" title="Reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </a>
        </div>
    </form>
</div>

<div class="admin-table-container mb-8">
    <div class="overflow-x-auto">
        <table class="admin-table w-full text-left">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>
                            <div class="flex items-center gap-4">
                                <img src="{{ $event->image_url }}" alt="{{ $event->judul }}" class="h-12 w-12 shrink-0 rounded-xl object-cover shadow-sm">
                                <span class="font-semibold text-slate-900">{{ $event->judul }}</span>
                            </div>
                        </td>
                        <td>{{ $event->kategori->nama ?? '-' }}</td>
                        <td class="whitespace-nowrap">{{ \Carbon\Carbon::parse($event->tanggal_waktu)->translatedFormat('d M Y, H:i') }}</td>
                        <td>{{ $event->lokasi->nama_lokasi ?? '-' }}</td>
                        <td>
                            @php
                                $statusColor = match ($event->status) {
                                    'Upcoming' => 'bg-blue-50 text-blue-700',
                                    'Ongoing' => 'bg-emerald-50 text-emerald-700',
                                    default => 'bg-slate-100 text-slate-600',
                                };
                            @endphp
                            <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $statusColor }}">{{ $event->status }}</span>
                        </td>
                        <td>
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('events.show', $event) }}" class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700" title="Lihat di Web">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="rounded-lg p-2 text-blue-600 transition hover:bg-blue-50 hover:text-blue-800" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>

                                <div class="dropdown dropdown-end">
                                    <div tabindex="0" role="button" class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700" title="Lainnya">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 8a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content menu menu-sm z-10 mt-2 w-36 rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
                                        <li>
                                            <form action="{{ route('admin.events.clone', $event) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 4h8a2 2 0 012 2v6a2 2 0 01-2 2h-8a2 2 0 01-2-2v-6a2 2 0 012-2z"/></svg>
                                                    Clone
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex w-full items-center gap-2 text-rose-600 hover:text-rose-700 hover:bg-rose-50 rounded-lg mt-1">
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
                        <td colspan="6" class="py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center gap-3">
                                <div class="rounded-full bg-slate-50 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <p class="text-sm font-medium">Belum ada event yang didaftarkan.</p>
                                <a href="{{ route('admin.events.create') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800">Buat event pertama</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($events->hasPages())
        <div class="border-t border-slate-200 bg-slate-50 p-4">
            {{ $events->appends(request()->except('page'))->links() }}
        </div>
    @endif
</div>
@endsection
