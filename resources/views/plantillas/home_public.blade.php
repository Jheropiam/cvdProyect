@extends('bases.base_public')
@section('content')
<div class="content" style="text-align: -webkit-center">
    <div class="card" style="width: 50%;margin-top:130px;">
        <div class="card-body text-center" style="text-align:center">
            <div class="row" style="place-content:center">
                    <h3>Servicio de verificación de  representaciones impresas</h3>
                    <p>Ingrese el codigo CVD</p>
                    <input type="text" class="form-control form-control-lg" placeholder="0015 3824 1828 2104" style="width: 550px;text-align:center">
                    
                    <div class="content">
                        <br>
                        <div class="g-recaptcha" data-sitekey="TU CLAVE DEL SITIO AQUÍ" data-callback="correctCaptcha" style="text-align: -webkit-center"></div>
                        <br>
                    </div>
                    <div class="content">
                        <button class="btn btn-primary btn-lg" style="max-width: 40%;min-width:250px"><i class="bx bx-search"></i>Buscar Documento</button>
                    </div>
                    <div class="col-sm-12" style="text-align-last: right">
                        <p><a href="{{route('usuarios.login')}}">Acceder</a></p>
                    </div>

            </div>
        </div>
    </div>

</div>

@endsection
@section('extra_js')
    <script src="https://www.google.com/recaptcha/api.js"></script>

@endsection