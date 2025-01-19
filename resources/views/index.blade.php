@extends('layouts.app')

@section('content')
    <section id="home-content" class="container mt-5">
        @foreach($products->chunk(4) as $chunk)
            <div class="row mt-3">
                @foreach($chunk as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage'.$product->image) }}" class="card-img-top" alt="..."/>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary stretched-link">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
