<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Persona;
use App\Lista;
use App\DetalleLista;
use App\Grupo;
use App\Rfid;
use PDF;
use App\Variables;

class ListaController extends Controller
{

    public function listaProceso1(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fechahoy = Carbon::now('America/La_Paz')->format('Y-m-d');
        $grupo = $request->input('grupo'); // Obtener el parámetro de filtro de grupo
        $fechaFiltro = $request->input('fechaFiltro'); // Obtener el parámetro de filtro de grupo

        $listas = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
            ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
            ->join('generos', 'listas.idgenero', '=', 'generos.id')
            ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
            ->selectRaw('GROUP_CONCAT(generos.nombre SEPARATOR " - ") as ganados')
            ->selectRaw('SUM(listas.cantidad_registrada) as total_cantidad')
            ->where('listas.cantidad', '>', 0)
            ->selectRaw('SUM(listas.cantidad) as total_cantidad')
            ->when($grupo, function ($query) use ($grupo) {
                // Aplicar el filtro de grupo solo si se proporciona un grupo
                return $query->where('grupos.nombre', $grupo);
            })
            ->when($fechaFiltro, function ($query) use ($fechaFiltro) {
                // Aplicar el filtro de fecha solo si se proporciona una fecha
                return $query->where('listas.fecha', $fechaFiltro);
            })
            ->groupBy('grupos.nombre', 'personas.nombre', 'personas.marca', 'listas.fecha')
            ->orderBy('listas.fecha')
            ->paginate(4);

            $listashoy = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
            ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
            ->join('generos', 'listas.idgenero', '=', 'generos.id')
            ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
            ->where('listas.fecha', '=', $fechahoy)
            ->where('listas.estado', '=', 0)
            ->paginate();

        return [
            'pagination' => [
                'total'        => $listas->total(),
                'current_page' => $listas->currentPage(),
                'per_page'     => $listas->perPage(),
                'last_page'    => $listas->lastPage(),
                'from'         => $listas->firstItem(),
                'to'           => $listas->lastItem(),
            ],
            'listas' => $listas, 'listashoy' => $listashoy
        ];
    }

    public function listagrupo1(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fechahoy = Carbon::now('America/La_Paz')->format('Y-m-d');
        $grupo = $request->input('grupo'); // Obtener el parámetro de filtro de grupo
        $date1 = $request->date1;
        $date2 = $request->date2;
        $fmarca = $request->input('fmarca'); // Obtener el parámetro de filtro de marca


        if ($date1 == '' && $date2 == ''){
            $listas = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
            ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
            ->join('generos', 'listas.idgenero', '=', 'generos.id')
            ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
            ->selectRaw('GROUP_CONCAT(generos.nombre SEPARATOR " - ") as ganados')
            ->selectRaw('SUM(listas.cantidad_registrada) as total_cantidad')
            ->selectRaw('SUM(listas.cantidad * 24) as totalbs')
            ->when($grupo, function ($query) use ($grupo) {
                // Aplicar el filtro de grupo solo si se proporciona un grupo
                return $query->where('grupos.nombre', $grupo);
            })
            ->when($fmarca, function ($query) use ($fmarca) {
                // Aplicar el filtro de marca solo si se proporciona una marca
                return $query->where('personas.marca', $fmarca);
            })
            ->where('listas.fecha','=', $fechahoy)
            ->groupBy('grupos.nombre', 'personas.nombre', 'personas.marca', 'listas.fecha')
            ->orderBy('listas.fecha', 'desc')->paginate(10);

        }else{
            $listas = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
                        ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
                        ->join('generos', 'listas.idgenero', '=', 'generos.id')
                        ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
                        ->selectRaw('GROUP_CONCAT(generos.nombre SEPARATOR " - ") as ganados')
                        ->selectRaw('SUM(listas.cantidad_registrada) as total_cantidad')
                        ->selectRaw('SUM(listas.cantidad * 24) as totalbs')
                        ->when($grupo, function ($query) use ($grupo) {
                            // Aplicar el filtro de grupo solo si se proporciona un grupo
                            return $query->where('grupos.nombre', $grupo);
                        })
                        ->when($fmarca, function ($query) use ($fmarca) {
                            // Aplicar el filtro de marca solo si se proporciona una marca
                            return $query->where('personas.marca', $fmarca);
                        })
                        ->whereBetween('listas.fecha', [$date1, $date2])
                        ->groupBy('grupos.nombre', 'personas.nombre', 'personas.marca', 'listas.fecha')
                        ->orderBy('listas.fecha', 'desc')->paginate(10);
        // Genera el PDF y guarda en una ubicación temporal
        }
        return
         [
            'pagination' => [
                'total'        => $listas->total(),
                'current_page' => $listas->currentPage(),
                'per_page'     => $listas->perPage(),
                'last_page'    => $listas->lastPage(),
                'from'         => $listas->firstItem(),
                'to'           => $listas->lastItem(),
            ],
            'listas' => $listas

        ];
        }
        public function listaPdf(Request $request)
            {
                if (!$request->ajax()) return redirect('/');
                $fechahoy = Carbon::now('America/La_Paz')->format('Y-m-d');
                $grupo = $request->input('grupo'); // Obtener el parámetro de filtro de grupo
                $date1 = $request->date1;
                $date2 = $request->date2;
                $fmarca = $request->input('fmarca'); // Obtener el parámetro de filtro de marca


                if ($date1 == '' && $date2 == ''){
                    $listas = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
                    ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
                    ->join('generos', 'listas.idgenero', '=', 'generos.id')
                    ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
                    ->selectRaw('GROUP_CONCAT(generos.nombre SEPARATOR " - ") as ganados')
                    ->selectRaw('SUM(listas.cantidad_registrada) as total_cantidad')
                    ->selectRaw('SUM(listas.cantidad * 24) as totalbs')
                    ->when($grupo, function ($query) use ($grupo) {
                        // Aplicar el filtro de grupo solo si se proporciona un grupo
                        return $query->where('grupos.nombre', $grupo);
                    })
                    ->when($fmarca, function ($query) use ($fmarca) {
                        // Aplicar el filtro de marca solo si se proporciona una marca
                        return $query->where('personas.marca', $fmarca);
                    })
                    ->where('listas.fecha','=', $fechahoy)
                    ->groupBy('grupos.nombre', 'personas.nombre', 'personas.marca', 'listas.fecha')
                    ->orderBy('listas.fecha', 'desc')->get();

                }else{
                    $listas = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
                                ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
                                ->join('generos', 'listas.idgenero', '=', 'generos.id')
                                ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
                                ->selectRaw('GROUP_CONCAT(generos.nombre SEPARATOR " - ") as ganados')
                                ->selectRaw('SUM(listas.cantidad_registrada) as total_cantidad')
                                ->selectRaw('SUM(listas.cantidad * 24) as totalbs')
                                ->when($grupo, function ($query) use ($grupo) {
                                    // Aplicar el filtro de grupo solo si se proporciona un grupo
                                    return $query->where('grupos.nombre', $grupo);
                                })
                                ->when($fmarca, function ($query) use ($fmarca) {
                                    // Aplicar el filtro de marca solo si se proporciona una marca
                                    return $query->where('personas.marca', $fmarca);
                                })
                                ->whereBetween('listas.fecha', [$date1, $date2])
                                ->groupBy('grupos.nombre', 'personas.nombre', 'personas.marca', 'listas.fecha')
                                ->orderBy('listas.fecha', 'desc')->get();
                // Genera el PDF y guarda en una ubicación temporal
                }

                $pdf = \PDF::loadView('pdf.listaspdf', ['listas' => $listas]);
                return $pdf->stream('ListaPdf.pdf');
            }

        public function Detallelistaindex(Request $request)
        {
            if (!$request->ajax()) return redirect('/');


            $detalleListas = DB::table('detalle_listas as d')
            ->join('personas as p', 'd.idpersona', '=', 'p.id')
            ->select('d.id', 'p.marca', 'd.fecha', 'p.nombre')
            ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(d.detalle, "$.registros[*].cantidad")) as cantidad_json')
            ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(d.detalle, "$.registros[*].total")) as total_json')
            ->groupBy('p.marca', 'd.id', 'd.fecha', 'p.nombre')
            ->orderBy('d.id', 'desc')
            ->paginate(10);

        // Debug para verificar los valores extraídos del JSON
        foreach ($detalleListas as $detalle) {
            // Formatear el id con ceros a la izquierda
            $detalle->id = str_pad($detalle->id, 9, '0', STR_PAD_LEFT);

            // Decodificar los valores JSON extraídos
            $cantidades = json_decode($detalle->cantidad_json);
            $totales = json_decode($detalle->total_json);

            // Calcular la suma de cantidades y totales
            $sumaCantidad = array_sum($cantidades);
            $sumaTotal = array_sum($totales);

            // Actualizar las propiedades del objeto $detalle
            $detalle->cantidad = $sumaCantidad;
            $detalle->total = $sumaTotal;
        }



            // Genera el PDF y guarda en una ubicación temporal

            return [
                'pagination' => [
                    'total'        => $detalleListas->total(),
                    'current_page' => $detalleListas->currentPage(),
                    'per_page'     => $detalleListas->perPage(),
                    'last_page'    => $detalleListas->lastPage(),
                    'from'         => $detalleListas->firstItem(),
                    'to'           => $detalleListas->lastItem(),
                ],
                'detalleListas' => $detalleListas

            ];


            }

            public function pdfdetalleLista(Request $request)
            {
                if (!$request->ajax()) return redirect('/');

                $id = $request->id;

                $detallelistasindex = DB::table('detalle_listas as d')
                    ->join('personas as p', 'd.idpersona', '=', 'p.id')
                    ->select('p.marca', 'd.id', 'p.nombre', 'd.fecha')
                    ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(d.detalle, "$.registros[*].cantidad")) as cantidad_json')
                    ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(d.detalle, "$.registros[*].total")) as total_json')
                    ->where('d.id', $id)
                    ->get();
                    foreach ($detallelistasindex as $detalle) {
                        // Formatear el id con ceros a la izquierda
                        $detalle->id = str_pad($detalle->id, 9, '0', STR_PAD_LEFT);

                        // Decodificar los valores JSON extraídos
                        $cantidades = json_decode($detalle->cantidad_json);
                        $totales = json_decode($detalle->total_json);

                        // Calcular la suma de cantidades y totales
                        $sumaCantidad = array_sum($cantidades);
                        $sumaTotal = array_sum($totales);
                        // Actualizar las propiedades del objeto $detalle
                        $detalle->cantidad = $sumaCantidad;
                        $detalle->total = $sumaTotal;
                    }

                $detallelistas = DB::table('detalle_listas as d')
                    ->join('personas as p', 'd.idpersona', '=', 'p.id')
                    ->select('p.marca', 'd.id')
                    ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(d.detalle, "$.registros[*].idgrupo")) as idgrupo')
                    ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(d.detalle, "$.registros[*].total")) as total')
                    ->where('d.id', $id)
                    ->get(); // Obtener todos los registros

                $pdfData = [];

                foreach ($detallelistas as $detalle) {
                    $idgrupos = json_decode($detalle->idgrupo);
                    $totals = json_decode($detalle->total);
                    foreach ($cantidades as $index => $cantidad) {
                        $pdfData[] = [
                            'marca' => $detalle->marca,
                            'total' => $totals[$index],
                            'grupo' => $idgrupos[$index],
                        ];
                    }
                }

                $pdf = \PDF::loadView('pdf.detallelistas', ['pdfData' => $pdfData, 'detallelistasindex' => $detallelistasindex]);
                return $pdf->stream('ListaPdf.pdf');
            }


    public function store(Request $request)
    {
        $cantidad = $request->input('cantidad');
        $idpersona = $request->input('idpersona');
        $estado = $request->input('estado');
        $fecha = $request->input('fecha');

        $maxfaeneo = Variables::select('totalfaeneo')->first()->totalfaeneo; // Obtener el valor de totalfaeneo

        // Verificar la cantidad total registrada para la persona y fecha específicas
        $cantidadTotal = Lista::where('idpersona', $idpersona)
            ->where('fecha', $fecha)
            ->sum('cantidad_registrada');

        $cantidadRestante = 3 - $cantidadTotal;
        if ($cantidad > $cantidadRestante) { // Usar '> 3' en lugar de '= 3'
            $errorRegistro = 'Se ha superado el límite de cantidad permitido para esta persona y día.';
            return response()->json(['errorRegistro' => $errorRegistro]);
        }

        // Obtener los RFIDs disponibles y no utilizados con asignado igual a 0
        $rfids = Rfid::where('idpersona', $idpersona)
            ->where('estado', 0)
            ->where('asignado', 0)
            ->whereNotNull('idgenero')
            ->take($cantidad)
            ->get();

        $idgeneros = [];

        if (!$rfids->isEmpty()) {
            $idgeneros = $rfids->pluck('idgenero')->toArray();

            // Marcar los RFIDs como utilizados estableciendo el asignado en 1
            $rfids->each(function ($rfid) {
                $rfid->asignado = 1;
                $rfid->save();
            });
        }
        $registros = []; // Arreglo para almacenar detalles de registros
        // Obtener la fecha actual en formato 'Y-m-d'
        $fechaActual = Carbon::now()->format('Y-m-d');

        $grupoIndex = 1;
        $generoIndex = 0;

        for ($i = 0; $i < $cantidad; $i++) {
            // Revisar si el grupo actual ya está lleno
            while (Lista::where('idgrupo', $grupoIndex)
                ->whereDate('fecha', $fechaActual)
                ->count() >= $maxfaeneo) {
                $grupoIndex++; // Pasar al siguiente grupo si el actual está lleno
            }

                $nuevaLista = new Lista();
                $nuevaLista->idpersona = $idpersona;
                $nuevaLista->cantidad = 1;
                $nuevaLista->total = 24;
                $nuevaLista->cantidad_registrada = 1;

                $nuevaLista->idgenero = isset($idgeneros[$generoIndex]) ? $idgeneros[$generoIndex] : 0;

                $nuevaLista->idgrupo = $grupoIndex;
                $nuevaLista->estado = $estado;
                $nuevaLista->fecha = $fecha;
                $nuevaLista->save();

                $registro = [
                    'cantidad' => $nuevaLista->cantidad,
                    'total' => $nuevaLista->total,
                    'idgrupo' => $nuevaLista->idgrupo,
                    'fecha' => $nuevaLista->fecha,
                ];

                $registros[] = $registro;

                $generoIndex++; // Avanzar al siguiente género disponible
            }
            $registrosJson = json_encode(['registros' => $registros]);
            // Crear y guardar un nuevo registro en DetalleLista
            $nuevodetallelista = new DetalleLista();
            $nuevodetallelista->idpersona = $request->input('idpersona');
            $nuevodetallelista->detalle = $registrosJson;
            $nuevodetallelista->fecha = $fechaActual;
            $nuevodetallelista->save();
            return response()->json([
                'success' => "Se han registrado $cantidad listas en los grupos.",
                'registros' => $registros, // Agregar el arreglo de registros
            ]);
        }
}
