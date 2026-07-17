<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokasis = [
            ['id' => 1, 'nama_lokasi' => 'Stadion Utama', 'aktif' => 'Y'],
            ['id' => 2, 'nama_lokasi' => 'Galeri Seni Kota', 'aktif' => 'Y'],
            ['id' => 3, 'nama_lokasi' => 'Taman Kota', 'aktif' => 'Y'],
        ];

        foreach ($lokasis as $lokasi) {
            Lokasi::updateOrCreate(
                ['id' => $lokasi['id']],
                ['nama_lokasi' => $lokasi['nama_lokasi'], 'aktif' => $lokasi['aktif']]
            );
        }
    }
}
