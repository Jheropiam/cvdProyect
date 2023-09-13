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
        @if (session()->has('mensaje'))
        <div class="col-sm-12">
            <div class="card">
                <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                        </div>
                        <div class="ms-6">
                            <h6 class="mb-0 text-danger" style="text-align: left">Eliminado</h6>
                            <div>El registro ha sido eliminado.</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        
        @if ($creado=='si')
        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
                </div>
                <div class="ms-6">
                    <h6 class="mb-0 text-success" style="text-align: left">Registrado</h6>
                        <div>Los documentos se han registrado correctamente.</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
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
                        <td> <a href="/documentos/destroy/{{$d->id}}" class="btn btn-warning btn-danger btn-sm btneliminar">Eliminar</a></td>
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

<div class="modal fade" id="modaleliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Por favor confirma para poder eliminar.</div>
            <form action="{{route('documentos.destroy')}}" method="POST">@csrf
                <input type="text" name="iddocumento" id="iddocumento" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btnsieliminar">Si Eliminar</button>
                </div>
            </form>
        </div>
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

        $(document).on("click",".btneliminar",function (e) { 
            e.preventDefault();
            fila = $(this).closest("tr");
            id = (fila).find('td:eq(0)').text();
            $("#iddocumento").val(id);
            $("#modaleliminar").modal('show');
         })
    </script>
@endsection