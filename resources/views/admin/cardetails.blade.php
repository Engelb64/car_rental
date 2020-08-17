@extends('admin.layouts.app')

@section('head_link')

<link rel="stylesheet" href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
@endsection


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline ">
                    <div class="card-body box-profile ">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{$car->picture_url}}"
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $car->brandname }} {{ $car->modelname }}</h3>
                        <p class="text-muted text-center">{{ $car->year }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Matricula</b> <a class="float-right">{{ $car->registration }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Precio</b> <a class="float-right">{{ $car->price }}</a>
                            </li>
                        </ul>
                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                        Editar Vehículo
                    </button>

                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title " >Descriptión</h3>
                    </div>
                    <div class="card-body">
                        <strong>
                            <p class="text-muted">
                                {{ $car->description }}
                            </p>
                        </strong>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">

                            <li class="nav-item">
                                <h2><strong>Ultimas Rentas</strong></h2>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">

                                <div class=" active tab-pane" id="timeline">
                                    <div class="timeline timeline-inverse">
                                        @foreach ($rentaldates as $rentaldate)
                                        <div>
                                            <i class="fas fa-user bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{$rentaldate->created_at}}</span>
                                                <h3 class="timeline-header border-0">
                                                    <a href="#">
                                                        {{$rentaldate->user->name}}
                                                    </a>
                                                    rento de {{$rentaldate->departure_date}} a {{$rentaldate->admission_date}}
                                                </h3>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edición de Vehículo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row align-items-center px-3 py-3 ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Brand </label>
                                    <select id="brand" name="brand" class="form-control" required>
                                        <option value={{ $car->brand_id }}>{{ $car->brandname }}</option>
                                        @foreach($brands as $brand)
                                            <option value={{ $brand->id }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select id="models" name="model" class="form-control" required>
                                        <option value={{ $car->model_id }}>{{ $car->modelname }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Matricula</label>
                                    <input id="registration" name="registration" type="text" class="form-control"
                                        value={{ $car->registration }} required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input id="price" name="price" type="text" class="form-control"
                                        value={{ $car->price }} required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Color</label>
                                    <div class="input-group my-colorpicker2">
                                        <input name="color" type="text" class="form-control" value={{ $car->color }} required autocomplete="off">
                                        <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square" style="color: {{$car->color}}"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Año</label>
                                    <input id="price" name="year" type="text" class="form-control"
                                        value={{ $car->year }} required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Seleccione una imagen del Vehículo
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" name="file">
                                                <label class="custom-file-label">Imagen ...</label>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select id="status" name="status" class="form-control" required>
                                        @if ( $car->status == 1)
                                            <option value=1 selected>Disponible</option>
                                            <option value=0>No disponible</option>
                                        @else
                                            <option value=0 selected>No disponible</option>
                                            <option value=1>Disponible</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea id="description" name="description" class="form-control"
                                        rows="3">{{ $car->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>

@endsection

@section('footer_scripts')

<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script>
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function (event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $('#document').ready(function () {
        $('#brand').on('change', function () {
            var brand_id = this.value;
            Models(brand_id);
        });
    });
    var Models = function (brand_id) {
        $.ajax({
                url: 'http://car_rental.test/Car/Models',
                method: 'GET',
                data: {
                    brand_id: brand_id
                },
            })
            .done(function (result) {
                result = JSON.parse(result);
                $("#models").empty().append('<option value="-1" disabled>Seleccione una opción</option>');
                $.each(result, function (i, model) {
                    $("#models").append('<option  value="' + model.id + '">' +
                        model.name + '</option>');
                });
            });
    }
</script>
@endsection
