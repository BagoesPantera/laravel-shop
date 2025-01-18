@extends('layouts.app')

@section('content')

    <section id="home-content" class="container mt-5">
        <div class="container text-center ">
            <div class="row">
                <div class="col d-flex flex-column align-items-center w-75">

                    <div class="card w-100" style="width: 18rem;">
                        <i class="bi bi-box card-img-top" style="font-size: 70px;"></i>
                        <div class="card-body">
                            <a href="/about" class="stretched-link">What is AYOTI?</a>
                        </div>
                    </div>

                    <a href="/product" class="btn btn-warning w-100 mt-5">List</a>
                    <a href="/category" class="btn btn-success w-100 mt-3">Category</a>

                </div>
                <!-- TENGAH -->
                <div class="col d-flex flex-column align-items-center">
                    <p>MicroController</p>

                </div>
                <!-- KANAN -->
                <div class="col d-flex flex-column  align-items-center">
                    <p>Sensor</p>

                </div>


            </div>
        </div>
    </section>
@endsection
