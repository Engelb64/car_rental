@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Modelos</h3>
                <div class="card-tools">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                        Nueva Modelo <strong>+</strong>
                    </button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">


                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marca</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($models as $model)
                            <tr>
                                <td>{{ $model->id }}</td>
                                <td>{{ $model->name }}</td>
                                <td>
                                    <form action="{{ Request::url() }}/{{ $model->id }}" method="POST">
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
                <h4 class="modal-title">Agregar nuevo Modelo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="align-items-center row px-3 py-3 ">

                    <div class="form-group col-6">
                        <label>Brand </label>
                        <select id="brand" name="brand_id" class="form-control" required>
                            @foreach($brands as $brand)
                                <option value={{ $brand->id }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label>Nombre de la Modelo</label>
                        <input id="model_name" name="model_name" type="text" class="form-control" required>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary ">Guardar Cambios</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>


@endsection
@section('footer_scripts')

@endsection
