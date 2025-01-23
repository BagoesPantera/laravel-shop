<?php

namespace App\Policies;

use App\Models\Product; // Mengimpor model Product yang akan diproteksi dengan kebijakan ini
use App\Models\User; // Mengimpor model User yang terkait dengan kebijakan akses

class ProductPolicy
{
    /**
     * Menentukan apakah pengguna dapat melihat semua produk.
     *
     * Di sini, selalu mengembalikan `true`, yang berarti semua pengguna dapat melihat daftar produk.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true; // Semua pengguna dapat melihat daftar produk
    }

    /**
     * Menentukan apakah pengguna dapat melihat produk tertentu.
     *
     * Di sini, selalu mengembalikan `true`, yang berarti semua pengguna dapat melihat produk apa pun.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function view(User $user, Product $product): bool
    {
        return true; // Semua pengguna dapat melihat produk tertentu
    }

    /**
     * Menentukan apakah pengguna dapat membuat produk baru.
     *
     * Hanya pengguna yang terautentikasi (login) yang dapat membuat produk.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return auth()->check(); // Hanya pengguna yang terautentikasi yang dapat membuat produk
    }

    /**
     * Menentukan apakah pengguna dapat memperbarui produk.
     *
     * Hanya pengguna yang terautentikasi (login) yang dapat memperbarui produk.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function update(User $user, Product $product): bool
    {
        return auth()->check(); // Hanya pengguna yang terautentikasi yang dapat memperbarui produk
    }

    /**
     * Menentukan apakah pengguna dapat menghapus produk.
     *
     * Hanya pengguna yang terautentikasi (login) yang dapat menghapus produk.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function delete(User $user, Product $product): bool
    {
        return auth()->check(); // Hanya pengguna yang terautentikasi yang dapat menghapus produk
    }

    /**
     * Menentukan apakah pengguna dapat memulihkan produk yang dihapus.
     *
     * Hanya pengguna yang terautentikasi (login) yang dapat memulihkan produk.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function restore(User $user, Product $product): bool
    {
        return auth()->check(); // Hanya pengguna yang terautentikasi yang dapat memulihkan produk
    }

    /**
     * Menentukan apakah pengguna dapat menghapus produk secara permanen.
     *
     * Hanya pengguna yang terautentikasi (login) yang dapat menghapus produk secara permanen.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return auth()->check(); // Hanya pengguna yang terautentikasi yang dapat menghapus produk secara permanen
    }
}
