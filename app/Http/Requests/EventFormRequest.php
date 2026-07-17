<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Hanya admin yang boleh mengelola event.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'lokasi_id' => ['required', 'exists:lokasis,id'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'tanggal_waktu' => ['required', 'date', 'after:now'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'hapus_gambar' => ['nullable', 'boolean'],

            'tikets' => ['required', 'array', 'min:1'],
            'tikets.*.id' => ['nullable', 'exists:tikets,id'],
            'tikets.*.tipe' => ['required', 'string', 'max:50', 'in:Reguler,Premium'],
            'tikets.*.harga' => ['required', 'numeric', 'min:0'],
            'tikets.*.stok' => ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul event wajib diisi.',
            'judul.max' => 'Judul event maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi event wajib diisi.',
            'lokasi_id.required' => 'Lokasi event wajib dipilih.',
            'lokasi_id.exists' => 'Lokasi yang dipilih tidak valid.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'tanggal_waktu.required' => 'Tanggal & waktu event wajib diisi.',
            'tanggal_waktu.date' => 'Format tanggal & waktu tidak valid.',
            'tanggal_waktu.after' => 'Tanggal & waktu event harus di masa depan.',
            'gambar.image' => 'File yang diupload harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',

            'tikets.required' => 'Minimal harus ada satu jenis tiket.',
            'tikets.min' => 'Minimal harus ada satu jenis tiket.',
            'tikets.*.tipe.required' => 'Tipe tiket wajib diisi.',
            'tikets.*.tipe.max' => 'Nama tipe tiket maksimal 50 karakter.',
            'tikets.*.harga.required' => 'Harga tiket wajib diisi.',
            'tikets.*.harga.numeric' => 'Harga tiket harus berupa angka.',
            'tikets.*.harga.min' => 'Harga tiket tidak boleh negatif.',
            'tikets.*.stok.required' => 'Stok tiket wajib diisi.',
            'tikets.*.stok.integer' => 'Stok tiket harus berupa angka bulat.',
            'tikets.*.stok.min' => 'Stok tiket tidak boleh negatif.',
        ];
    }
}
