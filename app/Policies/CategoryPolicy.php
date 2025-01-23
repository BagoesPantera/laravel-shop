<?php

namespace App\Policies;

use App\Models\Category; // Mengimpor model Category yang akan diproteksi dengan kebijakan ini
use App\Models\User; // Mengimpor model User yang terkait dengan kebijakan akses

class CategoryPolicy
{
    /**
     * Menentukan apakah pengguna dapat melihat semua model kategori.
     *
     * Di sini, selalu mengembalikan `true`, yang berarti pengguna dapat melihat daftar kategori apa pun.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // Mengembalikan true, artinya semua pengguna dapat melihat daftar kategori
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat melihat model kategori tertentu.
     *
     * Di sini, selalu mengembalikan `true`, yang berarti pengguna dapat melihat kategori apa pun.
     *
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function view(User $user, Category $category): bool
    {
        // Mengembalikan true, artinya semua pengguna dapat melihat kategori
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat membuat kategori baru.
     *
     * Di sini, hanya mengizinkan pengguna yang terautentikasi untuk membuat kategori.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // Memeriksa apakah pengguna terautentikasi
        return auth()->check();
    }

    /**
     * Menentukan apakah pengguna dapat memperbarui kategori yang ada.
     *
     * Di sini, hanya mengizinkan pengguna yang terautentikasi untuk memperbarui kategori.
     *
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function update(User $user, Category $category): bool
    {
        // Memeriksa apakah pengguna terautentikasi
        return auth()->check();
    }

    /**
     * Menentukan apakah pengguna dapat menghapus kategori.
     *
     * Di sini, hanya mengizinkan pengguna yang terautentikasi untuk menghapus kategori.
     *
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function delete(User $user, Category $category): bool
    {
        // Memeriksa apakah pengguna terautentikasi
        return auth()->check();
    }

    /**
     * Menentukan apakah pengguna dapat mengembalikan kategori yang dihapus.
     *
     * Di sini, hanya mengizinkan pengguna yang terautentikasi untuk memulihkan kategori yang dihapus.
     *
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function restore(User $user, Category $category): bool
    {
        // Memeriksa apakah pengguna terautentikasi
        return auth()->check();
    }

    /**
     * Menentukan apakah pengguna dapat menghapus kategori secara permanen.
     *
     * Di sini, hanya mengizinkan pengguna yang terautentikasi untuk menghapus kategori secara permanen.
     *
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function forceDelete(User $user, Category $category): bool
    {
        // Memeriksa apakah pengguna terautentikasi
        return auth()->check();
    }
}
