<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Mengimpor stylesheet Bootstrap dengan tema Lux dari Bootswatch --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/lux/bootstrap.min.css" integrity="sha512-RI2S7J+KOTIVVh6JxrBRNIxJjIioHORVNow+SSz2OMKsDLG5y/YT6iXEK+R0LlKBo/Uwr1O063yT198V6AZh4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/lux/bootstrap.rtl.min.css" integrity="sha512-HTAZCwhj2s2OzMZrBJX5D8qBhYXA2KAG5G983UY1D+zsWTwj/FBpiAijY8gG1XqSF8EyJlkue9BcjG2jlhxj9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Mengimpor icon Bootstrap untuk penggunaan ikon-ikon berbasis font --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <title>AYOTI</title>
</head>
<body>
{{-- Navbar utama untuk aplikasi, dengan opsi navigasi --}}
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        {{-- Link untuk logo dan halaman utama --}}
        <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-box"></i> AYOTI</a>

        {{-- Tombol toggle navbar untuk perangkat mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Konten navigasi yang akan ditampilkan pada perangkat besar --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav" style="margin-left: auto !important;">
                {{-- Link About --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>

                {{-- Tautan untuk pengguna yang sudah login --}}
                @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    {{-- Form logout --}}
                    <li class="nav-item">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf {{-- Token CSRF untuk mengamankan permintaan logout --}}
                            <button type="submit" class="btn nav-link">Logout</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- Menampilkan pesan error jika ada --}}
@error('msg')
<div class="container">
    <div
        class="alert alert-danger alert-dismissible fade show mt-4"
        role="alert"
    >
        {{ $message }} {{-- Pesan error yang ditampilkan --}}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
</div>
@enderror

{{-- Konten utama yang disisipkan dari halaman Blade yang lain --}}
@yield('content')

{{-- Mengimpor script Bootstrap untuk fitur interaktif seperti dropdown, modal, dll --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
