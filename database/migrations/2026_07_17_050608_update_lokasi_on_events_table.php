<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan kolom lokasi_id (sementara nullable)
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('lokasi_id')->nullable()->after('kategori_id');
        });

        // 2. Migrasi data lokasi lama (string) ke tabel lokasis
        $events = DB::table('events')->get();
        foreach ($events as $event) {
            if ($event->lokasi) {
                $lokasiRecord = DB::table('lokasis')->where('nama_lokasi', $event->lokasi)->first();
                if (!$lokasiRecord) {
                    $lokasiId = DB::table('lokasis')->insertGetId([
                        'nama_lokasi' => $event->lokasi,
                        'aktif' => 'Y',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $lokasiId = $lokasiRecord->id;
                }

                // Update event dengan lokasi_id baru
                DB::table('events')->where('id', $event->id)->update([
                    'lokasi_id' => $lokasiId
                ]);
            }
        }

        // 3. Ubah lokasi_id menjadi required, foreign key constrained, lalu hapus lokasi (string)
        Schema::table('events', function (Blueprint $table) {
            // Karena data sudah terisi (atau setidaknya harus ada seeder)
            // Namun agar aman untuk sqlite, kita pastikan foreign key.
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            $table->dropColumn('lokasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('lokasi')->after('deskripsi')->nullable();
        });

        $events = DB::table('events')->get();
        foreach ($events as $event) {
            if ($event->lokasi_id) {
                $lokasiRecord = DB::table('lokasis')->where('id', $event->lokasi_id)->first();
                if ($lokasiRecord) {
                    DB::table('events')->where('id', $event->id)->update([
                        'lokasi' => $lokasiRecord->nama_lokasi
                    ]);
                }
            }
        }

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['lokasi_id']);
            $table->dropColumn('lokasi_id');
        });
    }
};
