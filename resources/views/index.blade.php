@extends('layouts.app')

@section('content')
    {{-- Bagian utama konten dengan ID 'home-content' yang terbungkus dalam kontainer, diberi margin atas 5 --}}
    <section id="home-content" class="container mt-5">
        {{-- Mengelompokkan produk menjadi beberapa chunk (4 produk per baris) --}}
        @foreach($products->chunk(4) as $chunk)
            <div class="row mt-3">
                {{-- Iterasi setiap produk dalam chunk --}}
                @foreach($chunk as $product)
                    <div class="col-md-3">
                        {{-- Card untuk menampilkan setiap produk --}}
                        <div class="card">
                            {{-- Menampilkan gambar produk dengan rasio 4:3 --}}
                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage'.$product->image) }}" class="card-img-top" alt="..."/>
                            </div>
                            <div class="card-body">
                                {{-- Menampilkan nama produk --}}
                                <h5 class="card-title">{{ $product->name }}</h5>

                                {{-- Tombol untuk melihat detail produk, mengarahkan ke halaman show --}}
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary stretched-link">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
