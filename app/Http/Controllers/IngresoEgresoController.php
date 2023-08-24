<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\DetalleLista;
use App\Egresos;
use App\ClasEgresos;

class IngresoEgresoController extends Controller
{


    public function indexIngresoEgreso(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


        $results = DB::table('detalle_listas')
            ->crossJoin(DB::raw("JSON_TABLE(detalle, '$.registros[*]' COLUMNS (cantidad INT PATH '$.cantidad', fecha VARCHAR(10) PATH '$.fecha')) AS jt1"))
            ->selectRaw('SUM(cantidad) * 24 AS totalCantidad, MONTH(STR_TO_DATE(jt1.fecha, "%Y-%m-%d")) AS mes , YEAR(STR_TO_DATE(jt1.fecha, "%Y-%m-%d")) AS anio')
            ->groupBy('mes','anio')
            ->get();

            return ['results' => $results];
    }

    public function storeEgreso(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
            $mytime= Carbon::now('America/La_Paz');
            $detalles = $request->data; // Array de detalles

            foreach ($detalles as $ep => $det) {
                // Debugging: Imprimir cada detalle antes de insertarlo

                $egreso = new Egresos();
                $egreso->fecha = $mytime->toDateTimeString();
                $egreso->idclasegreso = $det['idclasegreso'];
                $egreso->egreso = $det['egreso'];
                $egreso->monto = $det['monto'];
                $egreso->detalle = $det['detalle'];
                $egreso->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $clasegresos = ClasEgresos::select('clasegresos.id','clasegresos.nombre', 'clasegresos.detalle','clasegresos.created_at as fecharegistro')
            ->paginate(10);

        return [
            'pagination' => [
                'total'        => $clasegresos->total(),
                'current_page' => $clasegresos->currentPage(),
                'per_page'     => $clasegresos->perPage(),
                'last_page'    => $clasegresos->lastPage(),
                'from'         => $clasegresos->firstItem(),
                'to'           => $clasegresos->lastItem(),
            ],
            'clasegresos' => $clasegresos
        ];
    }
    public function storeclasegresos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $clasegresos = new ClasEgresos();
            $clasegresos->nombre = $request->nombre;
            $clasegresos->detalle = $request->detalle;
            $clasegresos->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function selectClasEgresos(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $clasegresos = ClasEgresos::where('nombre', 'like', '%'. $filtro . '%')
        ->orWhere('nombre', 'like', '%'. $filtro . '%')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['clasegresos' => $clasegresos];
    }



}
