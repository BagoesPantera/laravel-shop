@extends('layouts.app')

@section('content')
    <section id="home-content" class="container">
        <div class="mt-5">
            <div class="align-items-center d-flex justify-content-between">
                <h3>Edit product Data</h3>

                <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Cancel</a>
            </div>

            <form
                class="mt-4"
                action="{{ route('products.update', $product->id) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @method('put')
                @csrf
                <div class="mb-3 row justify-content-start">
                    <div class="col-12 col-sm-6">
                        <label for="name" class="form-label">Name</label>

                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" required />
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="size" class="form-label">Quantity</label>

                        <input type="text" name="qty" value="{{ $product->qty }}" class="form-control" id="size" placeholder="Ex. 32" required />
                    </div>
                </div>

                <div class="mb-3 row justify-content-start">
                    <div class="col-12 col-sm-6">
                        <label for="price" class="form-label">Price</label>

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
                        <select name="category_id" class="form-select" aria-label="Default select example" required>
                            <option value="">Open this for select category</option>
                            @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 ">
                    <img src="{{ asset('storage'.$product->image) }}" class="my-3" style="width: 100px; height: 100px;" />

                    <label for="img" class="form-label d-block">Image File</label>
                    <input name="image" type="file" class="form-control" id="img"/>
                </div>



                <div class="mb-3">
                    <label for="description" class="form-label"> Description </label>

                    <textarea name="description" class="form-control" id="description" rows="3" required>{{ $product->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-outline-primary my-4">
                    Update
                </button>
            </form>
        </div>
    </section>
@endsection
