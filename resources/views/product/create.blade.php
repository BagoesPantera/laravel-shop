@extends('layouts.app')

@section('content')
    {{-- Bagian utama konten dengan ID 'home-content' yang terbungkus dalam kontainer --}}
    <section id="home-content" class="container">
        <div class="mt-5">
            {{-- Baris header dengan judul dan tombol Cancel --}}
            <div class="align-items-center d-flex justify-content-between">
                <h3>Add product Data</h3>

                {{-- Tombol Cancel yang mengarah ke halaman daftar produk --}}
                <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

            {{-- Form untuk menambahkan data produk, menggunakan metode POST dan CSRF token --}}
            <form
                class="mt-4"
                action="{{ route('products.store') }}"
                method="post"
                enctype="multipart/form-data" {{-- Form ini mendukung unggahan file --}}
            >
                @csrf {{-- Token CSRF untuk keamanan --}}

                {{-- Form Input untuk Nama dan Jumlah Produk --}}
                <div class="mb-3 row justify-content-start">
                    <div class="col-12 col-sm-6">
                        <label for="name" class="form-label">Name</label>

                        {{-- Input untuk nama produk --}}
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="Ex. Arduino"
                            required
                        />
                    </div>

                    <div class="col-12 col-sm-6">
                        <label for="size" class="form-label">Quantity</label>

                        {{-- Input untuk jumlah produk --}}
                        <input
                            type="text"
                            name="qty"
                            class="form-control"
                            id="size"
                            placeholder="Ex. 32"
                            required
                        />
                    </div>
                </div>

                {{-- Form Input untuk Harga dan Kategori Produk --}}
                <div class="mb-3 row justify-content-start">
                    <div class="col-12 col-sm-6">
                        <label for="price" class="form-label">Price</label>

                        {{-- Input untuk harga produk --}}
                        <input
                            name="price"
                            type="number"
                            class="form-control"
                            id="price"
                            placeholder="Ex. 10000"
                            required
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="description" class="form-label"> Category </label>

                        {{-- Dropdown untuk memilih kategori produk --}}
                        <select name="category_id" class="form-select" aria-label="Default select example" required>
                            <option value="">Open this to select category</option>

                            {{-- Menampilkan daftar kategori yang tersedia --}}
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Form Input untuk File Gambar Produk --}}
                <div class="mb-3">
                    <label for="img" class="form-label d-block">Image File</label>

                    {{-- Input untuk mengunggah file gambar produk --}}
                    <input name="image" type="file" class="form-control" id="img" />
                </div>

                {{-- Form Input untuk Deskripsi Produk --}}
                <div class="mb-3">
                    <label for="description" class="form-label"> Description </label>

                    {{-- Textarea untuk deskripsi produk --}}
                    <textarea
                        name="description"
                        class="form-control"
                        id="description"
                        rows="3"
                        required
                    ></textarea>
                </div>

                {{-- Tombol untuk men-submit form dan menambahkan produk --}}
                <button type="submit" class="btn btn-outline-primary my-4">
                    Add
                </button>
            </form>
        </div>
    </section>
@endsection
