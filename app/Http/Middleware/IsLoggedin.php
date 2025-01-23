<?php

namespace App\Http\Middleware;

use Closure; // Mengimpor Closure untuk memproses request berikutnya
use Illuminate\Http\Request; // Mengimpor Request untuk menangani HTTP request
use Symfony\Component\HttpFoundation\Response; // Mengimpor Response untuk mengembalikan respon HTTP

class IsLoggedin
{
    /**
     * Menangani request yang masuk untuk memverifikasi apakah pengguna sudah login.
     *
     * Middleware ini memeriksa apakah pengguna sudah terautentikasi.
     * Jika pengguna sudah login, request akan diteruskan ke middleware berikutnya atau controller.
     * Jika pengguna belum login, maka pengguna akan diarahkan kembali ke halaman utama.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah pengguna sudah login
        if (auth()->check()) {
            // Jika sudah login, lanjutkan ke middleware atau controller berikutnya
            return $next($request);
        }

        // Jika pengguna belum login, arahkan kembali ke halaman utama
        return redirect('/');
    }
}
