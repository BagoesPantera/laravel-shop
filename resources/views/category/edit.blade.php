@extends('layouts.app') {{-- Menggunakan layout 'app' sebagai template untuk halaman ini --}}

@section('content') {{-- Menyisipkan konten ke dalam bagian 'content' pada layout --}}

<section id="home-content" class="container">
    <div class="mt-5">
        <div class="align-items-center d-flex justify-content-between">
            <h3>Edit Category Data</h3> {{-- Judul halaman untuk mengedit data kategori --}}

            {{-- Tombol 'Cancel' yang mengarah ke halaman daftar kategori --}}
            <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">Cancel</a>
        </div>

        {{-- Formulir untuk mengedit kategori --}}
        <form class="mt-4" action="{{ route('categories.update', $category->id) }}" method="post" novalidate>
            @method('put') {{-- Menambahkan metode 'PUT' untuk mengupdate data --}}
            @csrf {{-- Laravel CSRF Token untuk melindungi aplikasi dari serangan CSRF --}}

            {{-- Input untuk nama kategori yang sudah terisi dengan nilai kategori yang sedang diedit --}}
            <div class="mb-3 row justify-content-start">
                <div class="col-12">
                    <label for="size" class="form-label">Name</label> {{-- Label untuk input nama kategori --}}
                    <input type="text" value="{{ $category->name }}" name="name" class="form-control" id="size" placeholder="Ex. Microcontroller" required /> {{-- Input untuk nama kategori yang terisi --}}

                    {{-- Menampilkan pesan error jika ada kesalahan pada input nama --}}
                    @if($errors->get('name'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->get('name')[0] }}</small> {{-- Menampilkan pesan error --}}
                    @endif
                </div>
            </div>

            {{-- Tombol untuk mengupdate kategori --}}
            <button type="submit" class="btn btn-outline-primary mt-4">
                Edit
            </button>
        </form>
    </div>
</section>

@endsection {{-- Menutup bagian content yang disisipkan ke layout --}}
