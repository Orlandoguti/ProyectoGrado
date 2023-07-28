<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Persona;
use App\Lista;
use App\Grupo;
use App\Rfid;

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

        $grupo = $request->input('grupo'); // Obtener el parámetro de filtro de grupo
        $fechaFiltro = $request->input('fechaFiltro'); // Obtener el parámetro de filtro de fecha
        $fmarca = $request->input('fmarca'); // Obtener el parámetro de filtro de marca

        $listas = Lista::join('personas', 'listas.idpersona', '=', 'personas.id')
            ->join('grupos', 'listas.idgrupo', '=', 'grupos.id')
            ->join('generos', 'listas.idgenero', '=', 'generos.id')
            ->select('grupos.nombre as gnombre','personas.nombre', 'personas.marca', 'listas.fecha')
            ->selectRaw('GROUP_CONCAT(generos.nombre SEPARATOR " - ") as ganados')
            ->selectRaw('SUM(listas.cantidad_registrada) as total_cantidad')
            ->when($grupo, function ($query) use ($grupo) {
                // Aplicar el filtro de grupo solo si se proporciona un grupo
                return $query->where('grupos.nombre', $grupo);
            })
            ->when($fechaFiltro, function ($query) use ($fechaFiltro) {
                // Aplicar el filtro de fecha solo si se proporciona una fecha
                return $query->where('listas.fecha', $fechaFiltro);
            })
            ->when($fmarca, function ($query) use ($fmarca) {
                // Aplicar el filtro de marca solo si se proporciona una marca
                return $query->where('personas.marca', $fmarca);
            })
            ->groupBy('grupos.nombre', 'personas.nombre', 'personas.marca', 'listas.fecha')
            ->orderBy('listas.fecha')
            ->paginate(4);

        return [
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
    public function store(Request $request)
    {
        $cantidad = $request->input('cantidad');
        $idpersona = $request->input('idpersona');
        $idgrupo = $request->input('idgrupo');
        $estado = $request->input('estado');
        $fecha = $request->input('fecha');

        // Verificar la cantidad total registrada para la persona y fecha específicas
        $cantidadTotal = Lista::where('idpersona', $idpersona)
            ->where('fecha', $fecha)
            ->sum('cantidad_registrada');

        // Calcular la cantidad restante permitida
        $cantidadRestante = 3 - $cantidadTotal;

        // Verificar si la cantidad restante es suficiente para registrar la nueva cantidad
        if ($cantidad > $cantidadRestante) {
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

        // Verificar si existen RFIDs disponibles
        if ($rfids->isEmpty()) {
            // No hay RFIDs disponibles
            $idgeneros = [];
        } else {
            // Obtener los idgenero de los RFIDs disponibles
            $idgeneros = $rfids->pluck('idgenero')->toArray();

            // Marcar los RFIDs como utilizados estableciendo el asignado en 1
            $rfids->each(function ($rfid) {
                $rfid->asignado = 1;
                $rfid->save();
            });
        }

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Registrar los registros en la lista
            for ($i = 0; $i < $cantidad; $i++) {
                $lista = new Lista();
                $lista->idpersona = $idpersona;
                $lista->cantidad = 1;
                $lista->cantidad_registrada = 1;

                if (isset($idgeneros[$i])) {
                    // Asignar el idgenero disponible al registro de la lista
                    $lista->idgenero = $idgeneros[$i];
                } else {
                    // Asignar 0 si no hay suficientes idgenero disponibles
                    $lista->idgenero = 0;
                }

                $lista->idgrupo = $idgrupo;
                $lista->estado = $estado;
                $lista->fecha = $fecha;
                $lista->save();
            }

            // Commit de la transacción si todo se guardó correctamente
            DB::commit();

            return response()->json(['success' => 'Las listas se han registrado correctamente.']);
        } catch (\Exception $e) {
            // Rollback de la transacción en caso de error
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

}
