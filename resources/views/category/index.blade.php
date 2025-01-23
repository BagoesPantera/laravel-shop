@extends('layouts.app') {{-- Menggunakan layout 'app' sebagai template untuk halaman ini --}}

@section('content') {{-- Menyisipkan konten ke dalam bagian 'content' pada layout --}}

<section id="home-content" class="container">

    {{-- Header untuk halaman kategori dengan tombol 'Add' untuk menambahkan kategori baru --}}
    <div class="align-items-center d-flex justify-content-between mt-5 mb-4">
        <h3>Category List</h3> {{-- Judul halaman yang menampilkan daftar kategori --}}
        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary"> Add </a> {{-- Tombol untuk menambah kategori baru --}}
    </div>

    {{-- Tabel untuk menampilkan daftar kategori --}}
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th> {{-- Kolom untuk menampilkan ID kategori --}}
            <th scope="col">Name</th> {{-- Kolom untuk menampilkan nama kategori --}}
            <th scope="col">Action</th> {{-- Kolom untuk tindakan seperti edit dan delete --}}
        </tr>
        </thead>
        <tbody>
        {{-- Menampilkan setiap kategori yang ada dalam koleksi $categories --}}
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th> {{-- Menampilkan ID kategori --}}
                <td>{{ $category->name }}</td> {{-- Menampilkan nama kategori --}}
                <td class="d-flex gap-2">
                    {{-- Tombol untuk mengedit kategori --}}
                    <a
                        href="{{ route('categories.edit', $category->id) }}"
                        class="btn btn-sm btn-light"
                    >
                        <i class="bi bi-pencil-square" style="font-size: 20px;"></i> {{-- Ikon pensil untuk edit --}}
                    </a>

                    {{-- Formulir untuk menghapus kategori --}}
                    <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                        @method('delete') {{-- Menggunakan metode DELETE untuk menghapus kategori --}}
                        @csrf {{-- Token CSRF untuk melindungi dari serangan CSRF --}}
                        <button type="submit" class="btn btn-sm btn-light">
                            <i class="bi bi-trash" style="font-size: 20px;"></i> {{-- Ikon sampah untuk hapus --}}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>

@endsection {{-- Menutup bagian content yang disisipkan ke layout --}}
