@extends('bases.base_public')
@section('content')
<div class="content" style="text-align: -webkit-center">
    <div class="row justify-content-center mt-4">
        <div class="card col-md-7 col-sm-6 p-3">
            <div class="row">
                <form action="{{route('documentos.show')}}" method="POST" id="consulta"> @csrf
                    <h3 style="text-align: center">Servicio de verificación de  representaciones impresas</h3>
                    <h4 style="text-align: center">Gobierno Regional de Loreto</h4>
                    <hr/>
                    <p style="text-align: center">Ingrese el codigo CVD</p>
                    <input type="text" name="codigo" id="codigo" class="form-control form-control-md text-center" placeholder="0015 3824 1828 2104" required>
                    <br>
                    <div class="col-md-12- col-sm-12 " style="text-align: center">
                        {{-- <button type="submit" class="btn btn-primary btn-lg form-control g-recaptcha" 
                        data-sitekey="6Lc6JCEoAAAAAPnl2uTh91F2LXkHuRvpGwPYV9F8" 
                        data-callback='onSubmit' 
                        data-action='submit'
                        style="max-width: 40%;min-width:250px"><i class="bx bx-search"></i>Buscar Documento</button> --}}
                        
                        <button type="submit" class="btn btn-primary btn-lg form-control" 
                        style="max-width: 40%;min-width:250px"><i class="bx bx-search"></i>Buscar Documento</button>
                    </div>
                </form>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            @if($mensaje=='existe')
                                <div class="col-sm-12">
                                    <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
                                            </div>
                                            <div class="ms-6">
                                                <h6 class="mb-0 text-success" style="text-align: left">Documento Encontrado</h6>
                                                    <div class="text-justify">Puede descargar el documento en el siguiente enlace:
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>

                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>documento</th>
                                                    <th>adjuntos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($doc as $d)
                                                <tr>
                                                    <td>#</td>
                                                    <td>
                                                        <a target="blank_" class="text-justify" href="{{asset('storage/documentos/'.$d->documento)}}">{{$d->documento}}</a>    
                                                    </td>
                                                    <td>
                                                        @if (!$doc_adjuntos->isEmpty())
                                                            @foreach ($doc_adjuntos as $da)
                                                                {{-- {{ $loop->index + 1 }} --}}
                                                                <a href="{{asset('storage/documentos_adjuntos/'.$da->documento)}}" class="text-justify">{{$da->documento}}</a>
                                                                <br>
                                                            @endforeach
                                                        @else
                                                            <p>No hay documentos adjuntos disponibles.</p>
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                </div>
                            @endif
                            @if($mensaje=='noexiste')
                                <div class="col-sm-12">
                                    <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                            </div>
                                            <div class="ms-6">
                                                <h6 class="mb-0 text-danger" style="text-align: left">Documento No encontrado</h6>
                                                <div class="text-justify">CVD No válido, intente con otro código</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12" style="text-align-last: right">
                        <br>
                        <br>
                        <br>
                        <p><a href="{{route('login')}}" class="btn btn-danger btn-sm"><i class="bx bx-user-circle"></i>Acceder</a></p>
                    </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('extra_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script> 
<script>
    $("#codigo").mask("00000000000000000");
    function onSubmit(token) {
      document.getElementById("consulta").submit();
    }
</script>
@endsection