@extends('layouts.app')

@section('content')
    <section id="home-content" class="container">
        <div class="my-5">
            <div class="align-items-center d-flex justify-content-between mt-5 mb-4">
                <h3>Detail</h3>
            </div>
            <div class="d-flex">
                <div>
                    <img class="border mb-3" width="350"
                         src="{{ asset('/storage'.$product->image) }}"
                         alt="product"
                         />
                </div>
                <div class="ms-5">
                    <h2>{{ $product->name }}</h2>
                    <p class="h5">@moneyFormat($product->price)</p>
                    <p class="my-4">Hurry up! Only {{ $product->qty }} product left in stock!</p>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
