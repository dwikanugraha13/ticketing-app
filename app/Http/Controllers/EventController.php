<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFormRequest;
use App\Models\Event;
use App\Models\Kategori;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Tentukan folder penyimpanan gambar berdasarkan nama kategori,
     * misal "Konser" -> events/konser, "Workshop" -> events/workshop.
     * Kategori baru otomatis dapat folder sendiri tanpa perlu ubah kode.
     */
    private function imageFolderFor(int $kategoriId): string
    {
        $kategori = Kategori::find($kategoriId);
        $slug = $kategori ? Str::slug($kategori->nama) : 'lainnya';

        return 'events/' . $slug;
    }

    /**
     * Pindahkan file gambar event ke folder kategori yang baru,
     * dipanggil saat kategori event diganti tapi tidak upload gambar baru.
     * Mengembalikan path gambar yang sudah diperbarui (atau path lama jika tidak perlu dipindah).
     */
    private function relocateImageToCategory(?string $gambar, int $newKategoriId): ?string
    {
        if (empty($gambar) || $gambar === 'konser.jpg' || !Storage::disk('public')->exists($gambar)) {
            return $gambar ?: 'konser.jpg';
        }

        $newFolder = $this->imageFolderFor($newKategoriId);
        $currentFolder = trim(dirname($gambar), '.');
        $currentFolder = $currentFolder === '' ? '' : $currentFolder;

        if ($currentFolder === $newFolder) {
            return $gambar;
        }

        $newPath = $newFolder . '/' . basename($gambar);
        Storage::disk('public')->move($gambar, $newPath);

        return $newPath;
    }

    /**
     * Display a listing of events (admin).
     */
    public function index(Request $request)
    {
        $query = Event::with(['kategori', 'tikets']);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $sort = $request->get('sort', 'asc');
        $query->orderBy('tanggal_waktu', $sort === 'desc' ? 'desc' : 'asc');

        $events = $query->paginate(10)->withQueryString();
        $categories = Kategori::all();

        return view('pages.admin.events.index', [
            'events' => $events,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $categories = Kategori::all();

        return view('pages.admin.events.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(EventFormRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($request, $validated) {
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar')->store($this->imageFolderFor($validated['kategori_id']), 'public');
            } else {
                $gambar = 'konser.jpg';
            }

            $event = Event::create([
                'user_id' => auth()->id(),
                'kategori_id' => $validated['kategori_id'],
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'lokasi' => $validated['lokasi'],
                'gambar' => $gambar,
                'tanggal_waktu' => $validated['tanggal_waktu'],
            ]);

            foreach ($validated['tikets'] as $tiket) {
                $event->tikets()->create([
                    'tipe' => $tiket['tipe'],
                    'harga' => $tiket['harga'],
                    'stok' => $tiket['stok'],
                ]);
            }
        });

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $event->load('tikets.detailOrders');
        $categories = Kategori::all();
        $hasSales = $event->hasSales();

        return view('pages.admin.events.edit', [
            'event' => $event,
            'categories' => $categories,
            'hasSales' => $hasSales,
        ]);
    }

    /**
     * Update the specified event in storage.
     */
    public function update(EventFormRequest $request, Event $event)
    {
        $validated = $request->validated();
        $hasSales = $event->hasSales();

        if ($hasSales) {
            $newDate = \Carbon\Carbon::parse($validated['tanggal_waktu']);
            if (!$newDate->equalTo($event->tanggal_waktu)) {
                return back()
                    ->withInput()
                    ->with('error', 'Tanggal & waktu tidak dapat diubah karena event sudah memiliki penjualan tiket.');
            }
        }

        DB::transaction(function () use ($request, $validated, $event, $hasSales) {
            if ($request->hasFile('gambar')) {
                if ($event->gambar && $event->gambar !== 'konser.jpg' && Storage::disk('public')->exists($event->gambar)) {
                    $deleted = Storage::disk('public')->delete($event->gambar);
                    if (!$deleted) {
                        \Illuminate\Support\Facades\Log::warning('Gagal menghapus gambar lama event.', [
                            'event_id' => $event->id,
                            'path' => $event->gambar,
                            'full_path' => Storage::disk('public')->path($event->gambar),
                        ]);
                    }
                }
                $gambar = $request->file('gambar')->store($this->imageFolderFor($validated['kategori_id']), 'public');
            } elseif ($request->boolean('hapus_gambar')) {
                // Admin memilih untuk menghapus gambar tanpa mengganti dengan yang baru.
                if ($event->gambar && $event->gambar !== 'konser.jpg' && Storage::disk('public')->exists($event->gambar)) {
                    $deleted = Storage::disk('public')->delete($event->gambar);
                    if (!$deleted) {
                        \Illuminate\Support\Facades\Log::warning('Gagal menghapus gambar event (hapus manual).', [
                            'event_id' => $event->id,
                            'path' => $event->gambar,
                            'full_path' => Storage::disk('public')->path($event->gambar),
                        ]);
                    }
                }
                $gambar = 'konser.jpg';
            } else {
                $gambar = $this->relocateImageToCategory($event->gambar ?? 'konser.jpg', $validated['kategori_id']);
                if (empty($gambar)) {
                    $gambar = 'konser.jpg';
                }
            }

            $event->update([
                'kategori_id' => $validated['kategori_id'],
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'lokasi' => $validated['lokasi'],
                'gambar' => $gambar,
                'tanggal_waktu' => $hasSales ? $event->tanggal_waktu : $validated['tanggal_waktu'],
            ]);

            $incomingIds = [];

            foreach ($validated['tikets'] as $tiketData) {
                if (!empty($tiketData['id'])) {
                    $tiket = Tiket::find($tiketData['id']);
                    if ($tiket && $tiket->event_id === $event->id) {
                        $tiket->update([
                            'tipe' => $tiketData['tipe'],
                            'harga' => $tiketData['harga'],
                            'stok' => $tiketData['stok'],
                        ]);
                        $incomingIds[] = $tiket->id;
                    }
                } else {
                    $newTiket = $event->tikets()->create([
                        'tipe' => $tiketData['tipe'],
                        'harga' => $tiketData['harga'],
                        'stok' => $tiketData['stok'],
                    ]);
                    $incomingIds[] = $newTiket->id;
                }
            }

            // Hapus tiket yang tidak lagi ada di form, hanya jika belum ada penjualan pada tiket tsb
            $event->tikets()
                ->whereNotIn('id', $incomingIds)
                ->get()
                ->each(function ($tiket) {
                    if (!$tiket->detailOrders()->exists()) {
                        $tiket->delete();
                    }
                });
        });

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Hapus gambar event via AJAX (tombol "×" di form edit).
     * Gambar langsung dihapus dari storage & event direset ke gambar default,
     * tanpa perlu submit form utama / klik "Simpan Event".
     */
    public function deleteImage(Event $event)
    {
        if ($event->gambar && $event->gambar !== 'konser.jpg' && Storage::disk('public')->exists($event->gambar)) {
            $deleted = Storage::disk('public')->delete($event->gambar);
            if (!$deleted) {
                \Illuminate\Support\Facades\Log::warning('Gagal menghapus gambar event (tombol silang).', [
                    'event_id' => $event->id,
                    'path' => $event->gambar,
                    'full_path' => Storage::disk('public')->path($event->gambar),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus file gambar dari storage.',
                ], 500);
            }
        }

        $event->update(['gambar' => null]);

        return response()->json([
            'success' => true,
            'image_url' => '',
        ]);
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->hasSales()) {
            return back()->with('error', 'Event tidak dapat dihapus karena sudah memiliki penjualan tiket.');
        }

        if ($event->gambar && $event->gambar !== 'konser.jpg' && Storage::disk('public')->exists($event->gambar)) {
            Storage::disk('public')->delete($event->gambar);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Clone / duplicate the specified event beserta tiketnya (bonus challenge).
     * Event hasil clone selalu berstatus draft (tanggal H+1) dan tidak membawa data penjualan.
     */
    public function clone(Event $event)
    {
        $event->load('tikets');

        $newEvent = DB::transaction(function () use ($event) {
            $clone = Event::create([
                'user_id' => auth()->id(),
                'kategori_id' => $event->kategori_id,
                'judul' => $event->judul . ' (Copy)',
                'deskripsi' => $event->deskripsi,
                'lokasi' => $event->lokasi,
                'gambar' => $event->gambar,
                'tanggal_waktu' => now()->addDay(),
            ]);

            foreach ($event->tikets as $tiket) {
                $clone->tikets()->create([
                    'tipe' => $tiket->tipe,
                    'harga' => $tiket->harga,
                    'stok' => $tiket->stok,
                ]);
            }

            return $clone;
        });

        return redirect()->route('admin.events.edit', $newEvent)
            ->with('success', 'Event berhasil di-clone. Silakan sesuaikan tanggal & detail lainnya.');
    }

    /**
     * Display the specified event (public).
     */
    public function show(Event $event)
    {
        $event->load(['kategori', 'tikets']);

        $relatedEvents = Event::with(['kategori', 'tikets'])
            ->where('kategori_id', $event->kategori_id)
            ->where('id', '!=', $event->id)
            ->upcoming()
            ->orderBy('tanggal_waktu', 'asc')
            ->take(4)
            ->get();

        return view('events.show', [
            'event' => $event,
            'relatedEvents' => $relatedEvents,
        ]);
    }
}
