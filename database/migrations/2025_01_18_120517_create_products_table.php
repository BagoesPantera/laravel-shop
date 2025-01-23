<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel 'products'.
     *
     * Fungsi ini akan dipanggil saat menjalankan perintah `php artisan migrate`.
     */
    public function up(): void
    {
        // Membuat tabel 'products'
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' sebagai primary key auto-increment
            $table->unsignedBigInteger('category_id'); // Menambahkan kolom 'category_id' sebagai foreign key untuk relasi ke tabel 'categories'
            $table->string('name'); // Menambahkan kolom 'name' untuk nama produk
            $table->text('description'); // Menambahkan kolom 'description' untuk deskripsi produk
            $table->integer('qty'); // Menambahkan kolom 'qty' untuk jumlah produk
            $table->integer('price'); // Menambahkan kolom 'price' untuk harga produk
            $table->string('image'); // Menambahkan kolom 'image' untuk menyimpan nama atau path gambar produk
            $table->timestamps(); // Menambahkan kolom 'created_at' dan 'updated_at'

            // Menetapkan foreign key pada 'category_id' yang mengacu pada kolom 'id' di tabel 'categories'
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Membalikkan migrasi, menghapus tabel 'products' jika ada.
     *
     * Fungsi ini akan dipanggil saat menjalankan perintah `php artisan migrate:rollback`.
     */
    public function down(): void
    {
        // Menghapus tabel 'products' jika ada
        Schema::dropIfExists('products');
    }
};
