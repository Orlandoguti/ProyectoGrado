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
            width:100%;
            text-align:center;
        }

        #left {
            text-align:center;
            float:left;
            width:30%;
        }

        #center {
            padding-top:30px;
            display: inline-block;
            margin:0 auto;
            width:50%;
        }

        #right {
            float:right;
            width:100%;
            height: 100%;
        }
        #logo {
            float: right;
            width: 250px;
            height: auto;
            margin-right: -5%;
            margin-top: -7%;
        }
        #fondologo {
            float: center;
            width: 1200px;
            height: auto;
            margin-right: 0%;
            margin-top: -15%;
            margin-bottom: 0%;
            margin-left: -33%;
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.25;
            z-index: -1;
            position: absolute;
        }


        #nuemrop{
            margin-left:15px;
            text-align:center;
            width:100%;
            font-size:15px;
        }
        #orden{
        margin-top: 15px;
        text-align:center;
        font-size: 15px;
        }

        #encabezado{
        text-align: center;
        font-size: 12px;
        }

        #separado{
            width: 100%;
            height:85px;
        }
        section{
        clear: left;
        }

        #fac, #fv, #fa{
        text-align: center;
        color: 000000;
        font-size: 10px;
        }

        table {
         width: 100%;
        }
        th, td {
        width: 25%;
        text-align: center;
        vertical-align: top;
        border-collapse: collapse;
        padding: 0.3em;
        caption-side: bottom;
        }
        caption {
        padding: 0.3em;
        color: #fff;
            background: #000;
        }
        th {
        background: #eee;
        }

        #gracias{
        margin-top:35px;
        width: 380px;
        display: flex;
        text-align: center;
        margin-left:35px;
        }
        #gracias1{
        float: left;
        text-align: center;
        }
        #gracias2{
        float: right;
        text-align: center;
        }
        #sello{
            margin-top:20px;
        }

        #separado2{
            width: 100%;
            height:50px;
        }
        footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: right;
        }

        footer p {
            margin: 0;
        }
    </style>
    <body>
        <header>
<div id="container">
        <div id="left">
        <p id="encabezado">
        <b>F.U.T.E.C.R.A.</b><br>FEDERACION UNICA DE TRABAJADORES EN CARNE Y RAMAS ANEXAS<br>El Alto, Z:Los Andes<br></p>
        </div>
        <div id="center"><b id="orden">REPORTE DE EGRESOS <br> FECHA DE REPORTE: {{now()}}</b></div>
        <img src="img/plantilla/logopdf.png" alt="Logo" id="logo">
</div>
  <img src="img/plantilla/logopdf.png" alt="Logofondo" id="fondologo">
    </header>
    <div id="separado2"></div>
        <section>
            <div>

            </div>
        </section>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>ID</th>
                            <th>Clasificacion</th>
                            <th>Egreso</th>
                            <th>Monto</th>
                            <th>Detalles</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalMonto = 0; // Variable para almacenar la suma total

                        foreach ($egresos as $e) {
                            echo '<tr>';
                            echo '<td>' . $e->id . '</td>';
                            echo '<td>' . $e->nombre . '</td>';
                            echo '<td>' . $e->egreso . '</td>';
                            echo '<td>' . $e->monto . '</td>';
                            echo '<td>' . $e->descripcion . '</td>';
                            echo '<td>' . $e->fecha . '</td>';
                            echo '</tr>';

                            $totalMonto += $e->monto; // Acumular la cantidad en la suma total
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <table class="izquierda">
            <tr>
                <th colspan="5">Total Monto:</th>
                <td><?php echo $totalMonto . ' Bs'; ?></td>
            </tr>
        </table>        
    <footer>
            <p>Reporte generado por: {{ $nombreusuario }}</p>
    </footer>
    </body>    
</html>

