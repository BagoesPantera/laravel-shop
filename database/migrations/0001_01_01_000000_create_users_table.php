<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel 'users' dan 'sessions'.
     *
     * Fungsi ini akan dipanggil saat menjalankan perintah `php artisan migrate`.
     */
    public function up(): void
    {
        // Membuat tabel 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' sebagai primary key auto-increment
            $table->string('username')->unique(); // Menambahkan kolom 'username' yang harus unik
            $table->string('password'); // Menambahkan kolom 'password'
            $table->rememberToken(); // Menambahkan kolom 'remember_token' untuk autentikasi
            $table->timestamps(); // Menambahkan kolom 'created_at' dan 'updated_at'
        });

        // Membuat tabel 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Menambahkan kolom 'id' sebagai primary key
            $table->foreignId('user_id')->nullable()->index(); // Menambahkan kolom 'user_id' dengan relasi ke tabel 'users', nullable dan di-index
            $table->string('ip_address', 45)->nullable(); // Menambahkan kolom 'ip_address' untuk menyimpan alamat IP (maksimal 45 karakter untuk IPv6)
            $table->text('user_agent')->nullable(); // Menambahkan kolom 'user_agent' untuk menyimpan informasi agen pengguna
            $table->longText('payload'); // Menambahkan kolom 'payload' untuk menyimpan data sesi dalam format longText
            $table->integer('last_activity')->index(); // Menambahkan kolom 'last_activity' untuk menyimpan waktu terakhir aktivitas, dan di-index
        });
    }

    /**
     * Membalikkan migrasi, menghapus tabel 'sessions' jika ada.
     *
     * Fungsi ini akan dipanggil saat menjalankan perintah `php artisan migrate:rollback`.
     */
    public function down(): void
    {
        // Menghapus tabel 'sessions' jika ada
        Schema::dropIfExists('sessions');
    }
};
