@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Marcas</h3>
                <div class="card-tools">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                        Nueva Marca <strong>+</strong>
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
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <form action="{{ Request::url() }}/{{ $brand->id }}" method="POST">
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
            <form method="post" >
                @csrf
                <div class="row align-items-center px-3 py-3 ">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nombre de la marca</label>
                            <input id="brand_name" name="brand_name" type="text" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary ">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('footer_scripts')

@endsection
