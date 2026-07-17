<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display the lokasi management page.
     */
    public function index()
    {
        $lokasis = Lokasi::withCount('events')->orderBy('nama_lokasi')->get();

        return view('pages.admin.lokasis', compact('lokasis'));
    }

    /**
     * Store a newly created lokasi in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255|unique:lokasis,nama_lokasi',
            'aktif' => 'nullable|in:Y,T',
        ]);

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
            'aktif' => $request->aktif ?? 'Y',
        ]);

        return redirect()->route('admin.lokasis.index')
            ->with('success', 'Lokasi berhasil ditambahkan!');
    }

    /**
     * Update the specified lokasi in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255|unique:lokasis,nama_lokasi,' . $id,
            'aktif' => 'nullable|in:Y,T',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'aktif' => $request->aktif ?? 'Y',
        ]);

        return redirect()->route('admin.lokasis.index')
            ->with('success', 'Lokasi berhasil diperbarui!');
    }

    /**
     * Remove the specified lokasi from storage.
     */
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        
        if ($lokasi->events()->exists()) {
             return redirect()->route('admin.lokasis.index')
                ->with('error', 'Lokasi tidak dapat dihapus karena masih digunakan oleh event!');
        }

        $lokasi->delete();

        return redirect()->route('admin.lokasis.index')
            ->with('success', 'Lokasi berhasil dihapus!');
    }
}
