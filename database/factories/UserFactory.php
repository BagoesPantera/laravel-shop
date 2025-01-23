<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory untuk menghasilkan data palsu (dummy) untuk model User.
 *
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Menyimpan password yang digunakan dalam factory ini.
     *
     * @var string|null
     */
    protected static ?string $password;

    /**
     * Menentukan keadaan default model User.
     *
     * Ini digunakan untuk mendefinisikan data palsu yang akan digunakan
     * untuk membuat instance model User ketika menjalankan factory.
     *
     * @return array<string, mixed> Data default untuk model User.
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(), // Menetapkan username dengan nama acak.
            'password' => static::$password ??= Hash::make('password'), // Menetapkan password, jika belum ada, menggunakan hash default.
            'remember_token' => Str::random(10), // Menetapkan token random untuk 'remember_token'.
            'created_at' => now(), // Menetapkan waktu pembuatan.
            'updated_at' => now(), // Menetapkan waktu pembaruan.
        ];
    }

    /**
     * Menandakan bahwa alamat email model User tidak diverifikasi.
     *
     * Fungsi ini digunakan untuk menetapkan nilai null pada kolom
     * 'email_verified_at' sehingga email pengguna dianggap belum diverifikasi.
     *
     * @return static Instance factory yang telah dimodifikasi.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // Setel 'email_verified_at' menjadi null.
        ]);
    }
}
