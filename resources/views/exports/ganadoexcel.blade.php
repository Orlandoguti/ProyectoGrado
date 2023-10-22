
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>Codigo de Tarjeta</th>
                            <th>Marca</th>
                            <th>Nombre</th>
                            <th>Genero</th>
                            <th>Grupo de Carneo</th>
                            <th>Estado</th>
                            <th>Fecha de Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rfids as $r)
                        <tr>
                            <td>{{$r->idrfid}}</td>
                            <td>{{$r->marca}}</td>
                            <td>{{ $r->nombre . ' ' . $r->apellidoP . ' ' . $r->apellidoM }}</td>
                            <td>{{$r->gnombre}}</td>
                            <td>{{$r->grunombre}}</td>
                            <td>
                            <?php if ($r->estado==0 )
                            {
                                echo 'Ganado en Corral';
                            } else {
                                echo 'Ganado Carneado';
                            }
                            ?>
                            </td>
                            <td>{{$r->fecha}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="izquierda">
                    <tr>
                    <th colspan="1">Total Ganados en Corral:</th>
                    <td>{{ $total_estado0 }}</td>
                    <th colspan="1">Total Ganados en Proceso de Faneo:</th>
                    <td>{{ $total_estado1 }}</td>
                    <th colspan="1">Total Ganados Carneados:</th>
                    <td>{{ $total_estado2 }}</td>
               </table>

