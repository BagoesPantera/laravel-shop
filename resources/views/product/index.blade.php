@extends('layouts.app')

@section('content')
    <section id="home-content" class="container">


        <div class="align-items-center d-flex justify-content-between mt-5 mb-4">
            <h3>product List</h3>
            <a href="{{ route('products.create') }}" class="btn btn-outline-primary"> Add </a>
        </div>

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
            @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-light">
                        <i class="bi bi-eye" style="font-size: 20px;"></i>
                    </a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-light">
                        <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                    </a>
                    <form method="post" action="{{ route('products.destroy', $product->id)  }}">
                        @method('delete')
                        @csrf
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
