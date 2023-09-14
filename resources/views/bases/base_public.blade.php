<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Para validar la autenticidad de los documentos emitidos por el Gobierno Regional de Loreto, puedes utilizar el validador de documentos electrónicos VALIDADOR-CVD.">
    <meta name="keywords" content="Gobierno Regional de Loreto cvd Validador, cvd gore loreto, validador cvd gore loreto, qr validador loreto, codigo qr validador gorel">
	<link rel="icon" href="{{ assetImg ('favicon-32x32.png')}}" type="image/png" />
	<style>
		.ps__rail-y {background-color: blue;}
		@font-face {
			font-family: 'Pacifico';
			font-style: normal,
			src:local('Pacifico Regular'), local('Pacifico-Regular'),
				url(https://fonts.gstatic.com/s/pacifico/v12/FwZY7-Qmy14u9lezJ-6H6MmBp0u-.woff2)
				format('woff2');
			font-display: swap;	
		}
	</style>
	<link href="{{ assetPlugin ('simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ assetPlugin ('perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ assetPlugin ('metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{ assetCss ('pace.min.css" rel="stylesheet')}}" />

	<link href="{{ assetCss ('bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ assetCss ('bootstrap-extended.css')}}" rel="stylesheet">
	<link href="{{ assetCss ('icons.css')}}" rel="stylesheet">
    @yield('extra_css')
    <title>Búsqueda CVD</title>
</head>
<body id='body'>
    @yield('content')

<script src="{{ assetJs ('pace.min.js')}}"></script>

<script src="{{ assetjS ('bootstrap.bundle.min.js ')}}"></script>

<script src="{{ assetjS ('jquery.min.js ')}}"></script>
<script src="{{ assetPlugin ('simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ assetPlugin ('metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ assetPlugin ('perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	const element = document.querySelector('#body');
	const ps = new PerfectScrollbar(element);
</script>
@yield('extra_js')
</body>
</html>
