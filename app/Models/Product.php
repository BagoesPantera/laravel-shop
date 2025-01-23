<?php

namespace App\Models;

use Database\Factories\ProductFactory; // Mengimpor ProductFactory untuk pembuatan data dummy produk (factory)
use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor HasFactory untuk penggunaan factory
use Illuminate\Database\Eloquent\Model; // Mengimpor Model sebagai kelas dasar untuk model Eloquent
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Mengimpor BelongsTo untuk mendefinisikan relasi antar model

class Product extends Model
{
    /**
     * Menggunakan HasFactory untuk memungkinkan pembuatan data dummy produk menggunakan factory.
     * @use HasFactory<ProductFactory>
     */
    use HasFactory;

    // Menentukan atribut yang dapat diisi secara massal melalui create() atau update()
    protected $fillable = [
        'category_id', // Kolom category_id yang menghubungkan produk dengan kategori
        'name',        // Kolom name yang menyimpan nama produk
        'description', // Kolom description yang menyimpan deskripsi produk
        'qty',         // Kolom qty yang menyimpan jumlah stok produk
        'price',       // Kolom price yang menyimpan harga produk
        'image',       // Kolom image yang menyimpan path gambar produk
    ];

    /**
     * Mendefinisikan relasi antara produk dan kategori.
     *
     * Setiap produk memiliki kategori yang terkait, dan di sini kita menggunakan
     * relasi "BelongsTo" untuk menunjukkan bahwa produk milik satu kategori.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); // Relasi produk dengan kategori
    }
}
