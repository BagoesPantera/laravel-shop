<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest; // Mengimpor request yang telah difilter untuk validasi login
use Illuminate\Http\RedirectResponse; // Mengimpor RedirectResponse untuk tipe data pengembalian
use Illuminate\Support\Facades\Auth; // Mengimpor facade Auth untuk menangani otentikasi
use Illuminate\View\View; // Mengimpor View untuk tipe data pengembalian

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * Method ini hanya mengembalikan view 'auth.login' untuk menampilkan form login.
     *
     * @return View
     */
    public function loginView(): View
    {
        return view('auth.login'); // Mengembalikan view login
    }

    /**
     * Menangani proses login pengguna.
     *
     * Method ini menerima permintaan login, memvalidasi kredensial, dan melakukan autentikasi.
     * Jika autentikasi berhasil, pengguna akan diarahkan ke halaman utama.
     * Jika gagal, pengguna akan diarahkan kembali ke halaman login dengan pesan error.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // Mengambil kredensial dari input form
        $credentials = $request->only('username', 'password');

        // Mencoba untuk autentikasi pengguna menggunakan kredensial
        if (Auth::attempt($credentials, true)) {
            return redirect('/'); // Jika berhasil login, arahkan ke halaman utama
        } else {
            // Jika login gagal, arahkan kembali dengan pesan error
            return redirect()->back()->withErrors(['msg' => 'Wrong username or password']);
        }
    }

    /**
     * Menangani proses logout pengguna.
     *
     * Method ini akan logout pengguna dan mengarahkan kembali ke halaman utama.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout(); // Mengeluarkan pengguna dari sistem

        return redirect('/'); // Arahkan pengguna kembali ke halaman utama setelah logout
    }
}
