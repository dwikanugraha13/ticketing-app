<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Kolom `tipe` semula hanya berupa enum('reguler', 'premium') sehingga admin
     * tidak bisa menambahkan jenis tiket lain (mis. VIP, Early Bird, dll).
     * Diubah menjadi VARCHAR agar admin bebas menentukan nama jenis tiket.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('tikets', 'tipe')) {
            return;
        }

        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE tikets MODIFY tipe VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('tikets', 'tipe')) {
            return;
        }

        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        // Normalisasi nilai yang bukan reguler/premium sebelum kembali ke enum,
        // supaya rollback tidak gagal karena data tidak sesuai daftar enum.
        DB::statement("UPDATE tikets SET tipe = 'reguler' WHERE tipe NOT IN ('reguler', 'premium')");
        DB::statement("ALTER TABLE tikets MODIFY tipe ENUM('reguler', 'premium') NOT NULL");
    }
};
