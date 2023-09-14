@extends('bases.base_public')
@section('content')
<div class="content" style="text-align: -webkit-center">
    <div class="row justify-content-center mt-4">
        <div class="card col-md-7 col-sm-6 p-3">
            <div class="row">
                <form action="{{route('documentos.show')}}" method="POST" id="consulta"> @csrf
                    <h3>Servicio de verificación de  representaciones impresas</h3>
                    <h4>Gobierno Regional de Loreto</h4>
                    <hr/>
                    <p>Ingrese el codigo CVD</p>
                    <input type="text" name="codigo" class="form-control form-control-md text-center" placeholder="0015 3824 1828 2104" required>
                    <br>
                    <div class="col-md-12- col-sm-12 ">
                        <button type="submit" class="btn btn-primary btn-lg form-control g-recaptcha" 
                        data-sitekey="6Lc6JCEoAAAAAPnl2uTh91F2LXkHuRvpGwPYV9F8" 
                        data-callback='onSubmit' 
                        data-action='submit'
                        style="max-width: 40%;min-width:250px"><i class="bx bx-search"></i>Buscar Documento</button>
                    </div>
                </form>
                    <div class="col-md-12 col-sm-12 d-flex justify-content-end mt-4">
                        <p><a class="btn btn-dark btn-sm px-1" href="{{route('usuarios.login')}}"><i class="bx bx-user mr-1"></i> Acceder</a></p>
                    </div>
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
                                                    <div>Puede descargar el documento en el siguiente enlace:
                                                        @foreach ($doc as $d)
                                                            <a target="blank_" href="{{asset('storage/documentos/'.$d->documento)}}">{{$d->documento}}</a>
                                                            y el Documento Electrónico adjunto:
                                                            <a target="blank_" href="{{asset('storage/documentos/'.$d->documento_adjunto)}}">{{$d->documento_adjunto}}</a>
                                                        @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
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
                                                <div>CVD No válido, intente con otro código</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('extra_js')

<script src="https://www.google.com/recaptcha/api.js"></script> 
<script>
    function onSubmit(token) {
      document.getElementById("consulta").submit();
    }
</script>
@endsection