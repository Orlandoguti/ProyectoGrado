<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title> F.U.T.E.C.R.A.</title>

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/sweetalert2.css">
<script src="js/sweetalert2.min.js" ></script>
<link rel="stylesheet" href="{{ mix('/css/base.css') }}">
<link rel="stylesheet" type="text/css" href="auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link href="css/pe-icon-7-stroke.min.css" rel="stylesheet" type="text/css" media="all" />
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
