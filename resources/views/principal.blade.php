<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title> F.U.T.E.C.R.A.</title>

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/sweetalert2.min.css">
<script src="js/sweetalert2.all.js" ></script>
<script src="js/websocket.js" ></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="{{ mix('/css/base.css') }}">
<link rel="stylesheet" type="text/css" href="auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link href="css/pe-icon-7-stroke.min.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="https://apis.google.com/js/platform.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body class="modal-open">

     <div id="app" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">


	@if(Auth::check())
            @if (Auth::user()->idrol == 1)
                @include('plantilla.sidebaradministrador')
            @elseif (Auth::user()->idrol == 2)
                @include('plantilla.sidebartrabajador')
            @elseif (Auth::user()->idrol == 3)
                @include('plantilla.sidebarafiliado')
            @else
            @endif

        @endif

        <!-- Contenido Principal -->

        <!-- /Fin del contenido principal -->
    </div>
    <script src="{{ asset('js/app.js') }}" async></script>

</body>

</html>
