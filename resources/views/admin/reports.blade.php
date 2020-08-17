@extends('admin.layouts.app')

@section('head_link')

<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<link rel="stylesheet" href="/plugins/bs-stepper/css/bs-stepper.min.css">
<link rel="stylesheet" href="/plugins/dropzone/min/dropzone.min.css">

@endsection


@section('content')
<div class="row">
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Reporte por Fechas de Rentas</h3>
        </div>
        <div class="card-body align-self-center">
            <form method="get">
            <div class="form-group">
                <label>Seleccione el rango a consultar:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation" name="datarange">
                </div>
            </div>
            <div class="mt-4 align-self-center">
                <button class="btn btn-primary btn-lg btn-flat">
                    <i class="fas fa-car fa-lg mr-2"></i>
                    Exportar Reporte de Rentas
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6 ">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Reporte de Autos</h3>
        </div>
        <div class="card-body align-self-center">
            <form method="get">
            <div class="mt-4 align-self-center">
                <input name="carreport" value="true" style="display: none">
                <button class="btn btn-primary btn-lg btn-flat">
                    <i class="fas fa-car fa-lg mr-2"></i>
                    Exportar Reporte General de Autos
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>

@endsection

@section('footer_scripts')


<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script src="/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
    $(function () {
        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })

        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })

        $('[data-mask]').inputmask()

        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        $('#reservation').daterangepicker()

        $('#timepicker').datetimepicker({
            format: 'LT'
        })

    })
</script>
@endsection
