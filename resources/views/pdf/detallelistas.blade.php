<!DOCTYPE>

<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ganados</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        font-size: 10px;
        }
        #container {
            width: 50%;
            text-align:center;
        }
        #center {
            text-align:center;
            width: 50%;
            float:center;
        }

        #left {
            text-align:center;
            float:left;
            width:50%;
        }

        #rigth {
            text-align:center;
            float: right;
            width:50%;
        }
        #separado2{
            width: 50%;
            height:30px;
        }

        .bar-code{
            width: 200px;
            align-self: center;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        /*table*/
        table {
            margin-top: 10px;
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 50%;
            table-layout: fixed;
        }
        table tr {
            background-color: #fff;
            border: 1px solid #000;
            padding: .35em;
        }
        table th,
        table td {
            padding: .625em;
            border: 1px solid #000;
        }
        /*table end*/
        hr{
            border-top: 1px solid #000;
        }
    </style>
    <body>
        @foreach ($detallelistasindex as $di)
        <header>
            <div id="container">
                <div id="left">
                    <p id="encabezado"><b>FACTURA #{{$di->id}}/2023</b></p>
                </div>
                <div id="right">
                    <p id="encabezado"><b>COPIA AL AFILIADO - El ALTO, Z:LOS ANDES </b></p>
                </div>
            </div>
        </header>
        <div id="separado2"></div>
        <div id="container">
            <div id="center">
                <p id="encabezado"><b>F.U.T.E.C.R.A.</b></p>
            </div>
        </div>
        <div id="separado2"></div>
        <div class="container">
            <div class="">
                <div class="">
                    <span>Fecha:</span>
                    <span>{{$di->fecha}}</span>
                </div>
                <div class="">
                    <span>Marca:{{$di->marca}}</span><br>
                    <span>Nombre:{{$di->nombre}}</span>
                </div>
            </div>
            <div class="">
                <img src="https://i.ibb.co/c8CQvBq/barcode.png" alt="bar code" class="bar-code"/>
            </div>
            <table>
                <thead>
                    <tr>
                        <th scope="col left" colspan="2">Descripcion</th>
                        <th scope="col left" colspan="2">Grupo Carneo</th>
                        <th scope="col right" colspan="2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pdfData as $detalle)
                    <tr>
                        <td data-label="Account" colspan="2">{{ $detalle['marca'] }}</td>
                        <td data-label="Account" colspan="2">Grupo {{ $detalle['grupo'] }}</td>
                        <td data-label="Account" colspan="2">{{ $detalle['total'] }} Bs.</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
            <div class="">
                <strong>Total Cantidad:</strong>
                <span>{{$di->cantidad}}</span><br>
                <strong>Total a Pagar:</strong>
                <span>Bs.{{$di->total}}</span>
            </div>
            <br/>
            <hr/>
            <div class="">
                <span>Federacion Unica de Trabajadores en Carne y Ramas Anexas</span>
                <span>F.U.T.E.C.R.A.</span>
            </div><br/>
            <div class="">
                <span>Firma</span>
                <span>______________</span>
            </div>
        </div>
    @endforeach
</body>
</html>
