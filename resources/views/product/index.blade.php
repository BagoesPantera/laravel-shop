@extends('layouts.app')

@section('content')
    {{-- Bagian utama konten dengan ID 'home-content' yang terbungkus dalam kontainer --}}
    <section id="home-content" class="container">

        {{-- Baris header dengan judul dan tombol Add --}}
        <div class="align-items-center d-flex justify-content-between mt-5 mb-4">
            <h3>product List</h3>
            {{-- Tombol untuk menambahkan produk baru, mengarahkan ke halaman create --}}
            <a href="{{ route('products.create') }}" class="btn btn-outline-primary"> Add </a>
        </div>

        {{-- Tabel untuk menampilkan daftar produk --}}
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            {{-- Menampilkan produk yang ada pada variabel $products --}}
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th> {{-- ID produk --}}
                    <td>{{ $product->name }}</td> {{-- Nama produk --}}
                    <td>{{ $product->qty }}</td> {{-- Jumlah produk --}}
                    <td>{{ $product->category->name }}</td> {{-- Nama kategori produk --}}

                    {{-- Kolom untuk aksi yang bisa dilakukan (lihat, edit, hapus) --}}
                    <td class="d-flex gap-2">
                        {{-- Tombol untuk melihat detail produk, mengarahkan ke halaman show --}}
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-light">
                            <i class="bi bi-eye" style="font-size: 20px;"></i>
                        </a>

                        {{-- Tombol untuk mengedit produk, mengarahkan ke halaman edit --}}
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-light">
                            <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                        </a>

                        {{-- Form untuk menghapus produk, menggunakan metode DELETE --}}
                        <form method="post" action="{{ route('products.destroy', $product->id) }}">
                            @method('delete') {{-- Menggunakan metode DELETE --}}
                            @csrf {{-- Token CSRF untuk keamanan --}}
                            <button type="submit" class="btn btn-sm btn-light">
                                <i class="bi bi-trash" style="font-size: 20px;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>
@endsection
