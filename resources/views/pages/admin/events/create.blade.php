@extends('layouts.admin_layouts')

@section('title', 'Tambah Event')

@section('content')
<!-- Header -->
<div class="admin-page-hero mb-8 rounded-3xl p-8 text-white shadow-xl shadow-blue-900/10">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between relative z-10">
        <div>
            <div class="mb-1 flex items-center gap-1.5 text-xs text-blue-100">
                <a href="{{ route('admin.events.index') }}" class="transition hover:text-white font-medium">Manajemen Event</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                <span class="text-white/80 font-medium">Tambah Event</span>
            </div>
            <h2 class="text-3xl font-bold text-white mt-3">Tambah Event Baru</h2>
            <p class="mt-2 text-sm text-blue-100/90 leading-relaxed">Lengkapi informasi event dan atur jenis tiket yang dijual.</p>
        </div>
        <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-bold text-white backdrop-blur transition hover:bg-white/20 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>
</div>

<form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="event-form">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Column -->
        <div class="lg:col-span-2 space-y-6">
            <div class="admin-form-card rounded-[1.5rem] p-5">
                <div class="mb-4 flex items-center gap-2.5">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800 leading-tight">Informasi Dasar</h3>
                        <p class="text-xs text-slate-400">Judul, kategori, lokasi, dan jadwal event</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                            Judul Event <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Mis. Konser Rock Semarang 2026"
                               class="input input-bordered mt-1.5 w-full @error('judul') input-error @enderror">
                        @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori_id" class="select select-bordered mt-1.5 w-full @error('kategori_id') select-error @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                            Tanggal &amp; Waktu <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1.5">
                            <x-datetime-picker name="tanggal_waktu" :value="old('tanggal_waktu')" :error="$errors->has('tanggal_waktu')" />
                        </div>
                        @error('tanggal_waktu') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <select name="lokasi_id" class="select select-bordered mt-1.5 w-full @error('lokasi_id') select-error @enderror">
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($lokasis as $lokasi)
                                <option value="{{ $lokasi->id }}" {{ old('lokasi_id') == $lokasi->id ? 'selected' : '' }}>
                                    {{ $lokasi->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('lokasi_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="admin-form-card rounded-[1.5rem] p-5">
                <div class="mb-4 flex items-center gap-2.5">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800 leading-tight">Deskripsi</h3>
                        <p class="text-xs text-slate-400">Ceritakan detail event kepada calon pengunjung</p>
                    </div>
                </div>

                <textarea name="deskripsi" rows="5" placeholder="Tulis deskripsi event secara singkat dan menarik..."
                          class="textarea textarea-bordered w-full @error('deskripsi') textarea-error @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="admin-form-card rounded-[1.5rem] p-5">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800 leading-tight">Jenis Tiket</h3>
                            <p class="text-xs text-slate-400">Minimal satu jenis tiket wajib diisi</p>
                        </div>
                    </div>
                    <button type="button" id="add-tiket-btn" class="btn btn-sm btn-outline-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Tiket
                    </button>
                </div>
                @error('tikets') <p class="mb-3 text-sm text-red-500">{{ $message }}</p> @enderror
                <div id="tikets-container" class="space-y-3"></div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Section: Media -->
            <div class="admin-form-card rounded-[1.5rem] p-5">
                <div class="mb-4 flex items-center gap-2.5">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h16M4 4h16a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800 leading-tight">Gambar Event</h3>
                        <p class="text-xs text-slate-400">Format PNG/JPG, maks. 2MB</p>
                    </div>
                </div>

                    <label for="gambar-input" id="dropzone-label"
                           class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-gray-200 rounded-xl py-8 px-4 cursor-pointer hover:border-blue-300 hover:bg-blue-50/40 transition-colors text-center">
                        <div id="dropzone-icon" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M12 12v9m0-9l-3 3m3-3l3 3"/></svg>
                        </div>
                        <p class="text-sm text-gray-600"><span class="text-blue-900 font-medium">Klik untuk unggah</span> atau seret gambar ke sini</p>
                        <p class="text-xs text-gray-400" id="dropzone-filename">Belum ada file dipilih</p>
                    </label>
                    <input type="file" name="gambar" id="gambar-input" accept="image/png, image/jpeg" class="hidden @error('gambar') input-error @enderror">
                    @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                    <div id="image-preview-container" class="hidden mt-4">
                        <p class="text-xs text-gray-500 mb-2">Pratinjau</p>
                        <div class="relative rounded-xl overflow-hidden border border-gray-100">
                            <img id="image-preview" src="" alt="Preview" class="w-full h-40 object-cover">
                            <button type="button" id="remove-image-btn"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-full bg-black/60 hover:bg-black/80 text-white flex items-center justify-center transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info tip card -->
            <div class="rounded-[1.5rem] border border-blue-100 bg-blue-50/70 p-5 shadow-sm">
                <div class="flex flex-col gap-4">
                    <div class="flex gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white/70 text-blue-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm leading-7 text-blue-900/80">
                            Event yang sudah tersimpan akan otomatis tampil di beranda sesuai kategori dan jadwalnya. Pastikan harga dan stok tiket sudah benar sebelum menyimpan.
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center justify-end gap-2">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-ghost btn-sm">Batal</a>
                        <button type="submit" class="btn btn-brand btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Simpan Event
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    let tiketIndex = 0;

    function tipeIcon(tipe) {
        const isPremium = (tipe || '').toLowerCase() === 'premium';
        return isPremium
            ? `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M5 16L3 6l5.5 4L12 4l3.5 6L21 6l-2 10H5zm0 2h14v2H5v-2z"/></svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`;
    }

    function renderTiketCard(index, data = {}) {
        const tipe = data.tipe || '';
        const harga = data.harga ?? '';
        const stok = data.stok ?? '';

        return `
        <div class="rounded-[20px] border border-slate-200 bg-slate-50/70 p-4 tiket-card" data-index="${index}">
            <div class="mb-3 flex items-center justify-between">
                <span class="flex items-center gap-2 text-sm font-semibold text-slate-700 tiket-title">
                    <span class="tiket-icon">${tipeIcon(tipe)}</span>
                    Tiket #${index + 1}
                </span>
                <button type="button" class="flex h-8 w-8 items-center justify-center rounded-xl text-slate-400 transition hover:bg-rose-50 hover:text-rose-600 remove-tiket-btn" title="Hapus tiket">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 4h5l.5 3h-6l.5-3z"/></svg>
                </button>
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Tipe Tiket</label>
                    <select name="tikets[${index}][tipe]" class="select select-bordered select-sm mt-1 w-full tiket-tipe-input">
                        <option value="Reguler" ${tipe.toLowerCase() !== 'premium' ? 'selected' : ''}>Reguler</option>
                        <option value="Premium" ${tipe.toLowerCase() === 'premium' ? 'selected' : ''}>Premium</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Harga</label>
                    <div class="relative mt-1">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400">Rp</span>
                        <input type="number" min="0" name="tikets[${index}][harga]" value="${harga}" placeholder="0"
                               class="input input-bordered input-sm w-full pl-8">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Stok</label>
                    <input type="number" min="0" name="tikets[${index}][stok]" value="${stok}" placeholder="0"
                           class="input input-bordered input-sm mt-1 w-full">
                </div>
            </div>
        </div>`;
    }

    function addTiket(data = {}) {
        const container = document.getElementById('tikets-container');
        const div = document.createElement('div');
        div.innerHTML = renderTiketCard(tiketIndex, data);
        container.appendChild(div.firstElementChild);
        tiketIndex++;
        renumberTikets();
    }

    function renumberTikets() {
        document.querySelectorAll('.tiket-card').forEach((card, i) => {
            card.querySelector('.tiket-title').innerHTML =
                `<span class="tiket-icon">${card.querySelector('.tiket-icon').innerHTML}</span> Tiket #${i + 1}`;
        });
    }

    document.getElementById('add-tiket-btn').addEventListener('click', () => addTiket());

    document.getElementById('tikets-container').addEventListener('click', (e) => {
        const removeBtn = e.target.closest('.remove-tiket-btn');
        if (removeBtn) {
            const cards = document.querySelectorAll('.tiket-card');
            if (cards.length <= 1) {
                alert('Minimal harus ada satu tiket.');
                return;
            }
            removeBtn.closest('.tiket-card').remove();
            renumberTikets();
        }
    });

    document.getElementById('tikets-container').addEventListener('input', (e) => {
        if (e.target.classList.contains('tiket-tipe-input')) {
            const card = e.target.closest('.tiket-card');
            card.querySelector('.tiket-icon').innerHTML = tipeIcon(e.target.value);
        }
    });

    // Dropzone + preview gambar
    const gambarInput = document.getElementById('gambar-input');
    const dropzone = document.getElementById('dropzone-label');
    const dropzoneFilename = document.getElementById('dropzone-filename');

    function showPreview(file) {
        const container = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                preview.src = ev.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
            dropzoneFilename.textContent = file.name;
        } else {
            container.classList.add('hidden');
            dropzoneFilename.textContent = 'Belum ada file dipilih';
        }
    }

    gambarInput.addEventListener('change', (e) => showPreview(e.target.files[0]));

    ['dragover', 'dragleave', 'drop'].forEach(evt => {
        dropzone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropzone.classList.toggle('border-blue-400', evt === 'dragover');
            dropzone.classList.toggle('bg-blue-50/40', evt === 'dragover');
        });
    });
    dropzone.addEventListener('drop', (e) => {
        const file = e.dataTransfer.files[0];
        if (file) {
            gambarInput.files = e.dataTransfer.files;
            showPreview(file);
        }
    });

    document.getElementById('remove-image-btn').addEventListener('click', () => {
        gambarInput.value = '';
        showPreview(null);
    });

    // Tambah 1 tiket default saat halaman dimuat
    addTiket({ tipe: 'Reguler' });
</script>
@endsection
