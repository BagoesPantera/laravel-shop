<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel 'categories'.
     *
     * Fungsi ini akan dipanggil saat menjalankan perintah `php artisan migrate`.
     */
    public function up(): void
    {
        // Membuat tabel 'categories'
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' sebagai primary key auto-increment
            $table->string('name'); // Menambahkan kolom 'name' untuk nama kategori
            $table->timestamps(); // Menambahkan kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Membalikkan migrasi, menghapus tabel 'categories' jika ada.
     *
     * Fungsi ini akan dipanggil saat menjalankan perintah `php artisan migrate:rollback`.
     */
    public function down(): void
    {
        // Menghapus tabel 'categories' jika ada
        Schema::dropIfExists('categories');
    }
};
