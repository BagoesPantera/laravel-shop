@extends('layouts.app')

@section('content')
    {{-- Bagian utama konten dengan ID 'home-content' yang terbungkus dalam kontainer --}}
    <section id="home-content" class="container">
        <div class="mt-5">
            {{-- Baris header dengan judul dan tombol Cancel --}}
            <div class="align-items-center d-flex justify-content-between">
                <h3>Edit product Data</h3>

                {{-- Tombol Cancel yang mengarah ke halaman daftar produk --}}
                <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

            {{-- Form untuk mengupdate data produk, menggunakan metode PUT dan CSRF token --}}
            <form
                class="mt-4"
                action="{{ route('products.update', $product->id) }}" {{-- Mengarahkan ke route update dengan ID produk --}}
                method="post"
                enctype="multipart/form-data" {{-- Form ini mendukung unggahan file --}}
            >
                @method('put') {{-- Menggunakan metode PUT untuk pembaruan --}}
                @csrf {{-- Token CSRF untuk keamanan --}}

                {{-- Form Input untuk Nama dan Jumlah Produk --}}
                <div class="mb-3 row justify-content-start">
                    <div class="col-12 col-sm-6">
                        <label for="name" class="form-label">Name</label>

                        {{-- Input untuk nama produk, dengan nilai default dari $product->name --}}
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" required />
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="size" class="form-label">Quantity</label>

                        {{-- Input untuk jumlah produk, dengan nilai default dari $product->qty --}}
                        <input type="text" name="qty" value="{{ $product->qty }}" class="form-control" id="size" placeholder="Ex. 32" required />
                    </div>
                </div>

                {{-- Form Input untuk Harga dan Kategori Produk --}}
                <div class="mb-3 row justify-content-start">
                    <div class="col-12 col-sm-6">
                        <label for="price" class="form-label">Price</label>

                        {{-- Input untuk harga produk, dengan nilai default dari $product->price --}}
                        <input
                            name="price"
                            value="{{ $product->price }}"
                            type="number"
                            class="form-control"
                            id="price"
                            placeholder="Ex. 10000"
                            required
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="description" class="form-label"> Category </label>

                        {{-- Dropdown untuk memilih kategori produk, dengan kategori yang sudah dipilih sebelumnya --}}
                        <select name="category_id" class="form-select" aria-label="Default select example" required>
                            <option value="">Open this for select category</option>

                            {{-- Menampilkan daftar kategori yang tersedia, dengan kategori yang dipilih berdasarkan ID --}}
                            @foreach($categories as $category)
                                @if($category->id == $product->category_id) {{-- Cek jika kategori sama dengan yang ada di produk --}}
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Menampilkan gambar produk yang sudah ada, dengan link menuju ke gambar --}}
                <div class="mb-3 ">
                    <img src="{{ asset('storage'.$product->image) }}" class="my-3" style="width: 100px; height: 100px;" />

                    {{-- Input untuk mengunggah gambar baru --}}
                    <label for="img" class="form-label d-block">Image File</label>
                    <input name="image" type="file" class="form-control" id="img"/>
                </div>

                {{-- Form Input untuk Deskripsi Produk --}}
                <div class="mb-3">
                    <label for="description" class="form-label"> Description </label>

                    {{-- Textarea untuk deskripsi produk, dengan nilai default dari $product->description --}}
                    <textarea name="description" class="form-control" id="description" rows="3" required>{{ $product->description }}</textarea>
                </div>

                {{-- Tombol untuk men-submit form dan mengupdate produk --}}
                <button type="submit" class="btn btn-outline-primary my-4">
                    Update
                </button>
            </form>
        </div>
    </section>
@endsection
