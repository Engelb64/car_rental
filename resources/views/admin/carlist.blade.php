@extends('admin.layouts.app')

@section('head_link')
<link rel="stylesheet" href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Cars</h3>
                <div class="card-tools">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                        Agregar Nuevo Vehículo <strong>+</strong>
                    </button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="py-2 px-4">
                    <form method="get" onsubmit="return showLoad()">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="find" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Matricula</th>
                            <th>Año</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Ver</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->id }}</td>
                                <td>{{ $car->registration }}</td>
                                <td>{{ $car->year }}</td>
                                <td>{{ $car->brandname }}</td>
                                <td>{{ $car->modelname }}</td>
                                <td>{{ $car->price }}</td>
                                <td class="aling-items-center ">
                                    <form action="{{ Request::url() }}/{{ $car->id }}" method="GET">
                                        <button class="bg-primary"><i class="fas fa-eye"> </i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ Request::url() }}/{{ $car->id }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="bg-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nuevo Vehículo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-center px-3 py-3 ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Brand </label>
                            <select id="brand" name="brand" class="form-control" required>
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
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Matricula</label>
                            <input id="registration" name="registration" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Precio</label>
                            <input id="price" name="price" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Color</label>
                            <div class="input-group my-colorpicker2">
                                <input name="color" type="text" class="form-control" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Año</label>
                            <input id="price" name="year" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <label>Seleccione una imagen del Vehículo
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file" required>
                                        <label class="custom-file-label">Imagen ...</label>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea id="description" name="description" class="form-control" rows="3"></textarea>
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

@endsection


@section('footer_scripts')

<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script>

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    //color picker with addon
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
                $("#models").empty().append('<option value="-1" disabled>Seleccione un Modelo</option>');
                $.each(result, function (i, model) {
                    $("#models").append('<option  value="' + model.id + '">' +
                        model.name + '</option>');
                });
            });
    }

</script>

@endsection
