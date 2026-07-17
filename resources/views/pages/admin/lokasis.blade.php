@extends('layouts.admin_layouts')

@section('title', 'Manajemen Lokasi')

@section('content')
    <div class="admin-page-hero mb-8 rounded-3xl p-8 text-white shadow-xl shadow-blue-900/10">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between relative z-10">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider backdrop-blur-md">
                    Master Data
                </span>
                <h2 class="mt-4 text-3xl font-bold text-white">Manajemen Lokasi</h2>
                <p class="mt-2 text-sm leading-relaxed text-blue-100/90">Kelola daftar lokasi event agar pilihan venue lebih terstruktur.</p>
            </div>
            <button class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-700 shadow-md transition hover:bg-blue-50 hover:scale-105" onclick="document.getElementById('add_modal').showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Lokasi Baru
            </button>
        </div>
    </div>

    <div class="admin-table-container mb-8">
        <div class="overflow-x-auto">
            <table class="admin-table w-full text-left">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>Status</th>
                        <th>Jumlah Event</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lokasis as $index => $lokasi)
                    <tr>
                        <td class="text-slate-400 font-medium">{{ $index + 1 }}</td>
                        <td class="font-semibold text-slate-900">{{ $lokasi->nama_lokasi }}</td>
                        <td>
                            @if($lokasi->aktif === 'Y')
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold bg-emerald-50 text-emerald-700">Aktif</span>
                            @else
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold bg-rose-50 text-rose-700">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $lokasi->events_count > 0 ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $lokasi->events_count }} event
                            </span>
                        </td>
                        <td>
                            <div class="flex justify-end items-center gap-2">
                                <button
                                    class="rounded-lg p-2 text-blue-600 transition hover:bg-blue-50 hover:text-blue-800"
                                    title="Edit"
                                    onclick="openEditModal(this)"
                                    data-id="{{ $lokasi->id }}"
                                    data-nama="{{ $lokasi->nama_lokasi }}"
                                    data-aktif="{{ $lokasi->aktif }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button
                                    class="rounded-lg p-2 text-rose-600 transition hover:bg-rose-50 hover:text-rose-700"
                                    title="Hapus"
                                    onclick="openDeleteModal(this)"
                                    data-id="{{ $lokasi->id }}"
                                    data-nama="{{ $lokasi->nama_lokasi }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 4h5l.5 3h-6l.5-3z"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="flex flex-col items-center gap-3 text-slate-400">
                                <div class="rounded-full bg-slate-50 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <p class="text-sm font-medium">Belum ada lokasi.</p>
                                <button class="text-sm font-bold text-blue-600 hover:text-blue-800" onclick="document.getElementById('add_modal').showModal()">
                                    Buat lokasi pertama
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.lokasis.store') }}" class="modal-box overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white p-0 shadow-2xl">
            @csrf
            <div class="border-b border-slate-200/70 bg-slate-50/70 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Tambah Lokasi</h3>
                        <p class="text-sm text-slate-500">Buat lokasi event baru untuk dipilih nantinya.</p>
                    </div>
                </div>
            </div>
            <div class="p-5 space-y-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-600">Nama Lokasi</label>
                    <input type="text" placeholder="Masukkan nama lokasi" class="input input-bordered w-full focus:border-blue-500 focus:outline-none" name="nama_lokasi" required />
                    @error('nama_lokasi')
                        <span class="mt-1 block text-sm text-rose-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-600">Status Aktif</label>
                    <select name="aktif" class="select select-bordered w-full focus:border-blue-500 focus:outline-none" required>
                        <option value="Y">Aktif</option>
                        <option value="T">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-200/70 bg-slate-50/70 px-5 py-3">
                <button class="btn btn-ghost" onclick="document.getElementById('add_modal').close()" type="reset">Batal</button>
                <button class="btn btn-brand" type="submit">Simpan</button>
            </div>
        </form>
    </dialog>

    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white p-0 shadow-2xl">
            @csrf
            @method('PUT')
            <input type="hidden" name="lokasi_id" id="edit_lokasi_id">
            <div class="border-b border-slate-200/70 bg-slate-50/70 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Edit Lokasi</h3>
                        <p class="text-sm text-slate-500">Perbarui informasi nama dan status lokasi.</p>
                    </div>
                </div>
            </div>
            <div class="p-5 space-y-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-600">Nama Lokasi</label>
                    <input type="text" placeholder="Masukkan nama lokasi" class="input input-bordered w-full focus:border-blue-500 focus:outline-none" id="edit_lokasi_name" name="nama_lokasi" required />
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-600">Status Aktif</label>
                    <select name="aktif" id="edit_lokasi_aktif" class="select select-bordered w-full focus:border-blue-500 focus:outline-none" required>
                        <option value="Y">Aktif</option>
                        <option value="T">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-200/70 bg-slate-50/70 px-5 py-3">
                <button class="btn btn-ghost" onclick="document.getElementById('edit_modal').close()" type="reset">Batal</button>
                <button class="btn btn-brand" type="submit">Simpan</button>
            </div>
        </form>
    </dialog>

    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white p-0 shadow-2xl">
            @csrf
            @method('DELETE')
            <input type="hidden" name="lokasi_id" id="delete_lokasi_id">
            <div class="border-b border-slate-200/70 bg-rose-50/70 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 4h5l.5 3h-6l.5-3z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Hapus Lokasi</h3>
                        <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <p class="text-sm text-slate-500">
                    Yakin ingin menghapus lokasi "<span id="delete_lokasi_name" class="font-medium text-slate-700"></span>"?
                </p>
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-200/70 bg-slate-50/70 px-5 py-3">
                <button class="btn btn-ghost" onclick="document.getElementById('delete_modal').close()" type="reset">Batal</button>
                <button class="btn btn-error text-white" type="submit">Hapus</button>
            </div>
        </form>
    </dialog>

    <script>
        function openEditModal(button) {
            const name = button.dataset.nama;
            const aktif = button.dataset.aktif;
            const id = button.dataset.id;
            const modal = document.getElementById('edit_modal');
            const form = modal.querySelector('form');

            document.getElementById('edit_lokasi_name').value = name;
            document.getElementById('edit_lokasi_aktif').value = aktif;
            document.getElementById('edit_lokasi_id').value = id;
            form.action = `{{ url('/admin/lokasis') }}/${id}`;
            modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const name = button.dataset.nama;
            const modal = document.getElementById('delete_modal');
            const form = modal.querySelector('form');

            document.getElementById('delete_lokasi_id').value = id;
            document.getElementById('delete_lokasi_name').textContent = name;
            form.action = `{{ url('/admin/lokasis') }}/${id}`;
            modal.showModal();
        }
    </script>
@endsection
