@extends('layouts.app')

@section('content')
    <section id="home-content" class="container">
        <div class="mt-5">
            <div class="align-items-center d-flex justify-content-between">
                <h3>Edit Category Data</h3>

                <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">Cancel</a>
            </div>


            <form class="mt-4" action="{{ route('categories.update', $category->id) }}" method="post" novalidate>
                @method('put')
                @csrf
                <div class="mb-3 row justify-content-start">
                    <div class="col-12">
                        <label for="size" class="form-label">Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control" id="size" placeholder="Ex. Microcontroller" required />
                        @if($errors->get('name'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->get('name')[0] }}</small>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-4">
                    Edit
                </button>
            </form>
        </div>
    </section>
@endsection
