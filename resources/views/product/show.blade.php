@extends('layouts.app')

@section('content')
    {{-- Bagian utama konten dengan ID 'home-content' yang terbungkus dalam kontainer --}}
    <section id="home-content" class="container">
        <div class="my-5">
            {{-- Baris header dengan judul "Detail" --}}
            <div class="align-items-center d-flex justify-content-between mt-5 mb-4">
                <h3>Detail</h3>
            </div>

            {{-- Menampilkan gambar produk di sebelah kiri dan informasi produk di sebelah kanan --}}
            <div class="d-flex">
                <div>
                    {{-- Menampilkan gambar produk, dengan lebar 350px dan border --}}
                    <img class="border mb-3" width="350"
                         src="{{ asset('/storage'.$product->image) }}" {{-- Menggunakan gambar yang disimpan di storage --}}
                         alt="product" />
                </div>
                <div class="ms-5">
                    {{-- Nama produk ditampilkan dengan ukuran huruf besar --}}
                    <h2>{{ $product->name }}</h2>

                    {{-- Menampilkan harga produk dengan format mata uang, menggunakan fungsi @moneyFormat --}}
                    <p class="h5">@moneyFormat($product->price)</p>

                    {{-- Pesan yang memberitahukan sisa stok produk --}}
                    <p class="my-4">Hurry up! Only {{ $product->qty }} product left in stock!</p>

                    {{-- Deskripsi produk yang lebih detail --}}
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
