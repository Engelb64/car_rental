@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="row mx-0">
        <div class="col-12 px-0">
            <img src="/img/Background_home.jpg" class="img-fluid w-100">
            <div class="centered rounded ">
                <h1 class="text-center">Way better than a rental car
                    Book unforgettable cars from trusted hosts around the world
                </h1>

            </div>
        </div>
    </div>
</div>

<div>
    <h1 class="text-center py-4">Carros Disponibles </h1>
</div>
<div class="row">

    @foreach($cars as $car)
        <div class="col-md-4">
            <div class="card card-widget widget-user">
                <a href="/details/{{$car->id}}">
                    <div class="widget-user-header text-white"
                        style="background: url('{{$car->picture_url}}') center center; height:300px">
                        <h3 class="widget-user-username text-right"> <strong
                                style="background-color: #000000d1">{{$car->brandname}}</strong> </h3>
                        <h5 class="widget-user-desc text-right"><strong style="background-color: #000000d1">{{$car->modelname}}</strong>
                        </h5>
                    </div>
                </a>
                <div class="card-footer"style="background-color:#80808045">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header"><i  class="fas fa-circle" style="color:{{$car->color}}; "></i></h5>
                                <span class="description-text">Color</span>
                            </div>
                        </div>
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{$car->year}}</h5>
                                <span class="description-text">Año</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{$car->price}}</h5>
                                <span class="description-text">Precio</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection
