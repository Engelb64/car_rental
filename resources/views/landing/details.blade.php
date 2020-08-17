@extends('layouts.app')

@section('head_link')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

@endsection


@section('content')

<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $car->brandname }} {{ $car->modelname }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">{{ $car->brandname }} {{ $car->modelname }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $car->brandname }} {{ $car->modelname }}</h3>
                        <div class="col-12">
                            <img src="{{ $car->picture_url }}" class="product-image" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $car->brandname }} {{ $car->modelname }}</h3>
                        <p>{{ $car->description }}</p>
                        <hr>
                        <h4>Colors</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                <i class="fas fa-circle fa-2x" style="color: {{ $car->color }}"></i>
                            </label>
                        </div>

                        <h4 class="mt-3">Año <small>{{ $car->year }}</small></h4>

                        <div class="bg-gray py-1 px-3 mt-4">
                            <h2 class="mb-0">
                                {{ number_format($car->price) }} $
                            </h2>
                            <h4 class="mt-0">
                                <small>Precio por dia</small>
                            </h4>
                        </div>

                        <form method="get">
                            <div class="row container">
                                Start Date:
                                <input
                                id="startDate"
                                class="col-6"
                            @if ($priceanddates !=null)
                            value="{{$priceanddates->startdate}}"
                            @endif
                                name="startdate"
                                autocomplete="off"
                                required
                                />
                                End Date:
                                <input
                                id="endDate"
                                class="col-6"
                                name="enddate"
                                @if ($priceanddates !=null)
                                value="{{$priceanddates->enddate}}"
                                @endif
                                autocomplete="off"
                                required
                                />
                            </div>

                            <div class="mt-4 align-self-center">
                                <button class="btn btn-primary btn-lg btn-flat">
                                    <i class="fas fa-car fa-lg mr-2"></i>
                                    Calcular Precio
                                </button>
                            </div>
                        </form>

                        @if ($priceanddates !=null)

    <div class="col-md-12 py-4 ">
        <div class="card card-primary">
        <form method="post">
            @csrf
          <div class="card-header">
            <h2 class="card-title"> <strong>Precio total Renta: {{ number_format($priceanddates->totalprice) }} </strong> </h2>
            <div class="card-tools">
                <h2 class="card-title"> Desde <strong>{{$priceanddates->startdate}}</strong>  hasta <strong>{{$priceanddates->enddate}}</strong> </h2>
            </div>
          </div>
          <div class="card-body row  align-self-center">
            <div class="form-group  col-12">
                <label for="inputStatus">Seleccione un Metodo de Pago</label>
                <select name="payment" id="inputStatus" class="form-control custom-select" required>
                  <option>Efectivo</option>
                  <option>Targeta de Credito</option>
                  <option>Transferencia</option>
                  <option>PSE</option>
                </select>
            </div>
            <div class="d-flex justify-content-center col-12 py-2">
                <button class="col-8 btn btn-danger btn-lg btn-flat" >Rentar Auto</button>
            </div>
        <input name="car_id" value={{$car->id}} style="display:none">
        <input name="departure_date" value={{$priceanddates->startdate}} style="display:none">
        <input name="admission_date" value={{$priceanddates->enddate}} style="display:none">

        </form>

        </div>
      </div>
    @endif
                    </div>
                </div>
            </div>
    </section>




</div>


@endsection


@section('footer_script')

<script>
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#startDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: today,
        maxDate: function () {
            return $('#endDate').val();
        }
    });
    $('#endDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: function () {
            return $('#startDate').val();
        }
    });
</script>





@endsection
