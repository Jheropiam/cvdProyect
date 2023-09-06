@extends('bases.base')

@section('extra_css')
<link rel="stylesheet" href="{{ assetCss ('bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}">
@endsection

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Listar</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Listar documentos</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 mx-auto">
        <h6 class="mb-0 text-uppercase">Buscar documento</h6>
        <hr/>
        <div class="card">
            <div class="card-body row">
                <div class="col-md-4  col-sm-12">
                    <label class = "form-label">Código CVD</label>
                    <input type="text" class="result form-control" placeholder="Ingrese su código CVD">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label">Desde</label>
                    <input type="date" class="result form-control">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label">Hasta</label>
                    <input type="date" class="result form-control">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label">Ordenar</label>
                    <select class="form-select" aria-label="Ordenar por">
                        <option selected value="desc">Descendente</option>
                        <option value="asc">Ascendente</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="form-label"><label>
                    <button type="button" class="btn btn-dark px-5"><i class='lni lni-search mr-1'></i>Buscar</button>
                </div>
            </div>
        </div>
        <hr/>
        <div class="card">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script src="{{ assetsJs('bootstrap-material-datetimepicker/js/moment.min.js') }}"></script>
<script src="{{ assetsJs('bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
@endsection