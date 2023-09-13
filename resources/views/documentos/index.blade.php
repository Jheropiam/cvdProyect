@extends('bases.base')
@section('extra_css')
    <link rel="stylesheet" href="../../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" />
@endsection
@section('content')
<div class="row">
    <a href="">Home</a>

</div>
<div class="row">

    <div class="row">
        <div class="col-sm-6">
            <h5>Lista de Documentos con código CVD</h5>

        </div>
        <div class="col-sm-6" style="text-align:right">
            <a href="{{route('documentos.create')}}" class="btn btn-primary btn-sm"><i class="bx bx-plus"></i>Nuevo</a>
        </div>
    </div>

    <div class="card card-body">
        <table class="table table-hover table-bordered" id="DTdocumentos">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Acción</th>
                    <th>CVD</th>
                    <th>NombreDocumento(CVD)</th>
                    <th>DocumentoAdjunto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $d)
                    <tr>
                        <td> {{$d->id}} </td>
                        <td> <a href="" class="btn btn-warning btn-sm">Eliminar</a></td>
                        <td>
                            {{$d->cvd}}
                            
                        
                        </td>
                        <td><a target="blank_" href="{{asset('storage/documentos/'.$d->documento)}}">{{$d->documento}}</a></td>
                        <td><a target="blank_" href="{{asset('storage/documentos/'.$d->documento_adjunto)}}">{{$d->documento_adjunto}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('extra_js')
    
    <script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $("#DTdocumentos").DataTable({
            order:[0],
        });
    </script>
@endsection