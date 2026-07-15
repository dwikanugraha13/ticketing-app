@extends('layouts.admin_layouts')

@section('title', 'Edit Event')

@section('content')
<div class="admin-page-hero mb-6 rounded-[2rem] p-5 text-slate-100 shadow-[0_20px_60px_-30px_rgba(37,99,235,0.35)]">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-100">Edit Event</p>
            <h2 class="mt-1 text-xl font-semibold">{{ $event->judul }}</h2>
        </div>
        <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white backdrop-blur transition hover:bg-white/20">← Kembali</a>
    </div>
</div>

@if (session('error'))
    <div class="alert alert-error shadow-lg mb-4">
        <div><span>{{ session('error') }}</span></div>
    </div>
@endif

<div class="admin-surface rounded-[1.75rem] overflow-hidden">
    <div class="border-b border-slate-200/70 p-5">
        <h2 class="text-lg font-semibold text-slate-900">Detail Event</h2>
        <p class="mt-1 text-sm text-slate-500">Kelola informasi inti, media, dan tiket dari satu tempat dengan pengalaman yang lebih rapi.</p>
    </div>

    <div class="p-5">
        @if ($hasSales)
            <div class="alert alert-warning shadow-lg mb-4">
                <div>
                    <span>⚠️ Event ini sudah memiliki penjualan tiket. Beberapa field mungkin tidak dapat diubah.</span>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="admin-form-card rounded-[1.5rem] p-5">
                <div class="mb-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Informasi Utama</h3>
                        <p class="text-sm text-slate-500">Judul, lokasi, kategori, dan jadwal acara.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Judul Event</span>
                        <span class="text-error">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $event->judul) }}"
                           class="input input-bordered w-full @error('judul') input-error @enderror">
                    @error('judul') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Kategori</span>
                        <span class="text-error">*</span>
                    </label>
                    <select name="kategori_id" class="select select-bordered w-full @error('kategori_id') select-error @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $event->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Lokasi</span>
                        <span class="text-error">*</span>
                    </label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}"
                           class="input input-bordered w-full @error('lokasi') input-error @enderror">
                    @error('lokasi') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Tanggal & Waktu</span>
                        <span class="text-error">*</span>
                        @if ($hasSales)
                            <span class="text-warning text-xs font-medium">(terkunci, sudah ada penjualan)</span>
                        @endif
                    </label>
                    <x-datetime-picker name="tanggal_waktu"
                        :value="old('tanggal_waktu', \Carbon\Carbon::parse($event->tanggal_waktu)->format('Y-m-d\TH:i'))"
                        :readonly="$hasSales"
                        :error="$errors->has('tanggal_waktu')" />
                    @error('tanggal_waktu') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Gambar Baru (maks. 2MB)</span>
                    </label>
                    <p class="text-xs text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</p>
                    <input type="file" name="gambar" id="gambar-input" accept="image/png, image/jpeg"
                           class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror">
                    <input type="hidden" name="hapus_gambar" id="hapus-gambar-field" value="0">
                    @error('gambar') <span class="text-error text-sm">{{ $message }}</span> @enderror

                    <div class="flex gap-3 mt-2">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Gambar saat ini</p>
                            <div class="relative inline-block" id="current-image-wrapper">
                                @if ($event->gambar && $event->gambar !== 'konser.jpg')
                                    <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" id="current-image"
                                         class="w-32 h-32 object-cover rounded-lg border">
                                    <button type="button" id="delete-image-btn"
                                            data-url="{{ route('admin.events.deleteImage', $event) }}"
                                            title="Hapus gambar ini"
                                            class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @else
                                    <div id="current-image-empty" class="w-32 h-32 rounded-lg border bg-gray-100 flex items-center justify-center text-sm text-gray-400">
                                        Tidak ada gambar
                                    </div>
                                @endif
                            </div>
                            <p id="image-status" class="text-xs text-gray-500 mt-2">
                                {{ $event->gambar && $event->gambar !== 'konser.jpg' ? 'Gambar saat ini tersedia dan dapat dihapus.' : 'Menggunakan gambar default saat ini.' }}
                            </p>
                        </div>
                        <div id="image-preview-container" class="hidden">
                            <p class="text-xs text-gray-500 mb-1">Preview baru</p>
                            <img id="image-preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                        </div>
                    </div>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Deskripsi</span>
                        <span class="text-error">*</span>
                    </label>
                    <textarea name="deskripsi" rows="4"
                              class="textarea textarea-bordered w-full @error('deskripsi') textarea-error @enderror">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                    @error('deskripsi') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            </div>

            <div class="admin-form-card rounded-[1.5rem] p-5">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">Tiket Event</h3>
                            <p class="text-sm text-slate-500">Atur tipe tiket, harga, dan stok dengan tampilan yang lebih teratur.</p>
                        </div>
                    </div>
                    <button type="button" id="add-tiket-btn" class="btn btn-sm btn-outline-brand">
                        + Tambah Tiket
                    </button>
                </div>
                @error('tikets') <span class="text-error text-sm">{{ $message }}</span> @enderror

                <div id="tikets-container" class="space-y-4">
                    @foreach ($event->tikets as $tiket)
                        @php $sold = $tiket->detailOrders->isNotEmpty(); @endphp
                        <div class="card bg-base-200 tiket-card" data-index="{{ $loop->index }}" data-sold="{{ $sold ? '1' : '0' }}">
                            <div class="card-body p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium tiket-title">
                                        Tiket #{{ $loop->iteration }}
                                        @if ($sold)
                                            <span class="badge badge-success badge-sm ml-2">Sudah Terjual</span>
                                        @endif
                                    </span>
                                    @unless ($sold)
                                        <button type="button" class="btn btn-xs btn-error btn-outline remove-tiket-btn">Hapus</button>
                                    @endunless
                                </div>
                                <input type="hidden" name="tikets[{{ $loop->index }}][id]" value="{{ $tiket->id }}">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="space-y-1">
                                        <label class="text-sm font-medium">Tipe Tiket</label>
                                        <select name="tikets[{{ $loop->index }}][tipe]" class="select select-bordered w-full">
                                            <option value="Reguler" {{ strtolower($tiket->tipe) !== 'premium' ? 'selected' : '' }}>Reguler</option>
                                            <option value="Premium" {{ strtolower($tiket->tipe) === 'premium' ? 'selected' : '' }}>Premium</option>
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-sm font-medium">Harga</label>
                                        <input type="number" min="0" name="tikets[{{ $loop->index }}][harga]" value="{{ $tiket->harga }}"
                                               class="input input-bordered w-full">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-sm font-medium">Stok</label>
                                        <input type="number" min="0" name="tikets[{{ $loop->index }}][stok]" value="{{ $tiket->stok }}"
                                               class="input input-bordered w-full">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.events.index') }}" class="btn btn-ghost">Batal</a>
                <button type="submit" class="btn btn-brand">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let tiketIndex = {{ $event->tikets->count() }};

    function renderTiketCard(index) {
        return `
        <div class="card bg-base-200 tiket-card" data-index="${index}" data-sold="0">
            <div class="card-body p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-medium tiket-title">Tiket #${index + 1}</span>
                    <button type="button" class="btn btn-xs btn-error btn-outline remove-tiket-btn">Hapus</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="text-sm font-medium">Tipe Tiket</label>
                        <select name="tikets[${index}][tipe]" class="select select-bordered w-full">
                            <option value="Reguler" selected>Reguler</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium">Harga</label>
                        <input type="number" min="0" name="tikets[${index}][harga]" value=""
                               class="input input-bordered w-full">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium">Stok</label>
                        <input type="number" min="0" name="tikets[${index}][stok]" value=""
                               class="input input-bordered w-full">
                    </div>
                </div>
            </div>
        </div>`;
    }

    document.getElementById('add-tiket-btn').addEventListener('click', () => {
        const container = document.getElementById('tikets-container');
        const div = document.createElement('div');
        div.innerHTML = renderTiketCard(tiketIndex);
        container.appendChild(div.firstElementChild);
        tiketIndex++;
        renumberTikets();
    });

    document.getElementById('tikets-container').addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-tiket-btn')) {
            const card = e.target.closest('.tiket-card');
            if (card.dataset.sold === '1') {
                alert('Tiket yang sudah terjual tidak dapat dihapus.');
                return;
            }
            const cards = document.querySelectorAll('.tiket-card');
            if (cards.length <= 1) {
                alert('Minimal harus ada satu tiket.');
                return;
            }
            card.remove();
            renumberTikets();
        }
    });

    function renumberTikets() {
        document.querySelectorAll('.tiket-card').forEach((card, i) => {
            const badge = card.dataset.sold === '1' ? ' <span class="badge badge-success badge-sm ml-2">Sudah Terjual</span>' : '';
            card.querySelector('.tiket-title').innerHTML = `Tiket #${i + 1}${badge}`;
        });
    }

    // Preview gambar baru
    const deleteImageField = document.getElementById('hapus-gambar-field');
    const imageStatus = document.getElementById('image-status');
    const defaultImageUrl = '{{ asset('storage/konser.jpg') }}';
    const wrapper = document.getElementById('current-image-wrapper');
    const originalImage = document.getElementById('current-image');
    const hasOriginalImage = Boolean(originalImage);
    let imageDeleted = false;

    document.getElementById('gambar-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        const deleteImageBtn = document.getElementById('delete-image-btn');
        const currentImage = document.getElementById('current-image');

        if (file) {
            deleteImageField.value = 0;
            const reader = new FileReader();
            reader.onload = (ev) => {
                if (currentImage) {
                    currentImage.src = ev.target.result;
                } else {
                    const emptyPlaceholder = document.getElementById('current-image-empty');
                    if (emptyPlaceholder) {
                        emptyPlaceholder.remove();
                    }
                    wrapper.insertAdjacentHTML('afterbegin', `
                        <img src="${ev.target.result}" alt="Preview" id="current-image"
                             class="w-32 h-32 object-cover rounded-lg border">
                    `);
                }

                if (imageStatus) {
                    imageStatus.textContent = 'Gambar baru dipilih dan akan menjadi gambar saat ini.';
                }

                if (previewContainer) {
                    previewContainer.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        } else {
            if (previewContainer) {
                previewContainer.classList.add('hidden');
            }

            const currentImage = document.getElementById('current-image');
            if (currentImage) {
                currentImage.src = imageDeleted || !hasOriginalImage ? defaultImageUrl : originalImage.src;
            }

            if (deleteImageBtn) {
                if (!imageDeleted && hasOriginalImage) {
                    deleteImageBtn.classList.remove('hidden');
                }
            }

            if (imageStatus) {
                imageStatus.textContent = imageDeleted || !hasOriginalImage
                    ? 'Menggunakan gambar default saat ini.'
                    : 'Gambar saat ini tersedia dan dapat dihapus.';
            }
        }
    });

    // Hapus gambar saat ini secara lokal sebelum submit form.
    const deleteImageBtn = document.getElementById('delete-image-btn');
    if (deleteImageBtn) {
        deleteImageBtn.addEventListener('click', function () {
            if (!confirm('Hapus gambar event ini sekarang? Event akan memakai gambar default.')) {
                return;
            }

            deleteImageField.value = 1;
            imageDeleted = true;
            const currentImage = document.getElementById('current-image');
            const emptyPlaceholder = document.getElementById('current-image-empty');
            const wrapper = document.getElementById('current-image-wrapper');

            if (currentImage) {
                currentImage.src = defaultImageUrl;
            }

            if (!emptyPlaceholder) {
                wrapper.innerHTML = '<img src="' + defaultImageUrl + '" alt="Gambar default" id="current-image" class="w-32 h-32 object-cover rounded-lg border">';
            }

            if (deleteImageBtn) {
                deleteImageBtn.classList.add('hidden');
            }

            if (imageStatus) {
                imageStatus.textContent = 'Gambar telah dihapus; sekarang menggunakan gambar default.';
            }
        });
    }
</script>
@endsection
