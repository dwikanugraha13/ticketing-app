@extends('layouts.admin_layouts')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="admin-page-hero mb-6 rounded-[2rem] p-5 text-slate-100 shadow-[0_20px_60px_-30px_rgba(37,99,235,0.35)] sm:p-5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="admin-pill">Master Data</span>
                <h2 class="mt-3 text-2xl font-semibold text-slate-100">Manajemen Kategori</h2>
                <p class="mt-2 text-sm leading-6 text-slate-200/80">Kelola kelompok event agar navigasi dan penampilan konten lebih terstruktur.</p>
            </div>
            <button class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-blue-50" onclick="document.getElementById('add_modal').showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Kategori
            </button>
        </div>
    </div>

    <div class="admin-surface overflow-hidden rounded-[1.75rem]">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50/80">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Jumlah Event</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white/70">
                    @forelse ($categories as $index => $category)
                    <tr class="hover:bg-slate-50/80">
                        <td class="px-4 py-3 text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $category->nama }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $category->events_count > 0 ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $category->events_count }} event
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center gap-1">
                                <button
                                    class="rounded-full p-2 text-blue-700 transition hover:bg-blue-50"
                                    title="Edit"
                                    onclick="openEditModal(this)"
                                    data-id="{{ $category->id }}"
                                    data-nama="{{ $category->nama }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button
                                    class="rounded-full p-2 text-rose-600 transition hover:bg-rose-50"
                                    title="Hapus"
                                    onclick="openDeleteModal(this)"
                                    data-id="{{ $category->id }}"
                                    data-nama="{{ $category->nama }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 4h5l.5 3h-6l.5-3z"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-14 text-center">
                            <div class="flex flex-col items-center gap-2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 106 0 3 3 0 00-6 0"/></svg>
                                <p class="text-sm">Belum ada kategori.</p>
                                <button class="text-sm font-medium text-blue-700 hover:text-blue-900" onclick="document.getElementById('add_modal').showModal()">
                                    Buat kategori pertama
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
        <form method="POST" action="{{ route('categories.store') }}" class="modal-box overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white p-0 shadow-2xl">
            @csrf
            <div class="border-b border-slate-200/70 bg-slate-50/70 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Tambah Kategori</h3>
                        <p class="text-sm text-slate-500">Buat kelompok event baru dengan penamaan yang jelas.</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-600">Nama Kategori</label>
                    <input type="text" placeholder="Masukkan nama kategori" class="input input-bordered w-full focus:border-blue-500 focus:outline-none" name="nama" required />
                    @error('nama')
                        <span class="mt-1 block text-sm text-rose-500">{{ $message }}</span>
                    @enderror
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
            <input type="hidden" name="category_id" id="edit_category_id">
            <div class="border-b border-slate-200/70 bg-slate-50/70 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Edit Kategori</h3>
                        <p class="text-sm text-slate-500">Perbarui nama kategori sesuai kebutuhan organisasi.</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-600">Nama Kategori</label>
                    <input type="text" placeholder="Masukkan nama kategori" class="input input-bordered w-full focus:border-blue-500 focus:outline-none" id="edit_category_name" name="nama" />
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
            <input type="hidden" name="category_id" id="delete_category_id">
            <div class="border-b border-slate-200/70 bg-rose-50/70 p-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 4h5l.5 3h-6l.5-3z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Hapus Kategori</h3>
                        <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <p class="text-sm text-slate-500">
                    Yakin ingin menghapus kategori "<span id="delete_category_name" class="font-medium text-slate-700"></span>"?
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
            const id = button.dataset.id;
            const modal = document.getElementById('edit_modal');
            const form = modal.querySelector('form');

            document.getElementById('edit_category_name').value = name;
            document.getElementById('edit_category_id').value = id;
            form.action = `{{ url('/admin/categories') }}/${id}`;
            modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const name = button.dataset.nama;
            const modal = document.getElementById('delete_modal');
            const form = modal.querySelector('form');

            document.getElementById('delete_category_id').value = id;
            document.getElementById('delete_category_name').textContent = name;
            form.action = `{{ url('/admin/categories') }}/${id}`;
            modal.showModal();
        }
    </script>
@endsection
