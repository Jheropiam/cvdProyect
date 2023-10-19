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
            <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-success">Mensaje</h6>
                        <div>{{Session::get('mensaje')}}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="col-sm-6">
            <h5>Lista de Documentos con código CVD</h5>

        </div>
        <div class="col-sm-6 mt-2 mb-2" style="text-align:right">
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
                    <th>Documentos Adjuntos</th>
                    <th>Nuevo Adjunto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $d)
                    <tr>
                        <td> {{$d->id}} </td>
                        <td> <a href="/documentos/destroy/{{$d->id}}" class="btn btn-warning btn-danger btn-sm btneliminar">Eliminar</a></td>
                        <td> {{$d->cvd}} </td>
                        <td><a target="blank_" href="{{asset('storage/documentos/'.$d->documento)}}">{{$d->documento}}</a> </td>
                        <td>
                            @foreach ($documentos_adjuntos as $da)
                                @if ($da->documentos_id==$d->id)
                                    <a target="blank_" href="{{asset('storage/documentos_adjuntos/'.$da->documento)}}">{{$da->documento}}</a>
                                    <a href="{{route('documentosadjuntos.destroy',$da->id)}}" class="btn btn-outline-danger btn-sm btneliminar_adjunto"><i class="bx bx-trash"></i></a>
                                    <br>
                                @endif                                
                            @endforeach
                        </td>
                        <td> <a href="{{route('documentosadjuntos.create',$d->id)}}" class="btn btn-primary btn-sm"><i class="bx bx-plus"></i></a> </td>
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
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            }
        });

        $(document).on("click",".btneliminar",function (e) { 
            e.preventDefault();
            fila = $(this).closest("tr");
            id = (fila).find('td:eq(0)').text();
            $("#iddocumento").val(id);
            $("#modaleliminar").modal('show');
         })

         $(document).on("click",".btneliminaradjunto",function (e) { 
            e.preventDefault();
            fila = $(this).closest("tr");
            id = (fila).find('td:eq(0)').text();
            $("#iddocumento_adjunto").val(id);
            $("#modaleliminarDocumento").modal('show');
         })
    </script>
@endsection