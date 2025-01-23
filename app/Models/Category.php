<?php

namespace App\Models;

use Database\Factories\CategoryFactory; // Mengimpor CategoryFactory untuk pembuatan data dummy kategori (factory)
use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor HasFactory untuk penggunaan factory
use Illuminate\Database\Eloquent\Model; // Mengimpor Model sebagai kelas dasar untuk model Eloquent

class Category extends Model
{
    /**
     * Menggunakan HasFactory untuk memungkinkan pembuatan data dummy kategori menggunakan factory.
     * @use HasFactory<CategoryFactory>
     */
    use HasFactory;

    // Menentukan atribut yang dapat diisi secara massal melalui create() atau update()
    protected $fillable = [
        'name', // Hanya kolom 'name' yang dapat diisi secara massal
    ];
}
