@extends('bases.base_public')
@section('extra_css')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection
@section('content')
<div class="content" style="text-align: -webkit-center">
    <div class="card" style="width: 50%;margin-top:130px;">
        <div class="card-body" >
            <div class="row" style="place-content:center">
                <form action="{{route('documentos.show')}}" method="POST"> @csrf
                    <h3>Servicio de verificación de  representaciones impresas</h3>
                    <p>Ingrese el codigo CVD</p>
                    <input type="text" name="codigo" class="form-control form-control-lg" placeholder="0015 3824 1828 2104" style="width: 550px;text-align:center" required>
                    
                    <div class="content">
                        <br>
                        <div class="g-recaptcha" data-sitekey="6Lc6JCEoAAAAAPnl2uTh91F2LXkHuRvpGwPYV9F8" data-callback="correctCaptcha" style="text-align: -webkit-center"></div>
                        <br>
                    </div>
                    <div class="content">
                        <button type="submit" class="btn btn-primary btn-lg" style="max-width: 40%;min-width:250px"><i class="bx bx-search"></i>Buscar Documento</button>
                    </div>
                </form>
                    <div class="col-sm-12" style="text-align-last: right">
                        <p><a href="{{route('usuarios.login')}}">Acceder</a></p>
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
                                                <h6 class="mb-0 text-success" style="text-align: left">Mensaje</h6>
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
                                                <h6 class="mb-0 text-danger" style="text-align: left">Mensaje</h6>
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
    

@endsection