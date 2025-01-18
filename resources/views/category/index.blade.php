@extends('layouts.app')

@section('content')
    <section id="home-content" class="container">

        <div class="align-items-center d-flex justify-content-between mt-5 mb-4">
            <h3>Category List</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-outline-primary"> Add </a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td class="d-flex gap-2">
                    <a
                        href="{{ route('categories.edit', $category->id) }}"
                        class="btn btn-sm btn-light"
                    >
                        <i class="bi bi-pencil-square" style="font-size: 20px;"></i>
                    </a>
                    <form method="post" action="{{ route('categories.destroy', $category->id) }}">
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
