<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetalleLista;
use App\Egresos;

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

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $egreso = new Egresos();
            $egreso->fecha = $request->fecha;
            $detalles = $request->data; // Array of detalles
            $registrosJson = json_encode(['detalles' => $detalles]);

            // Store the JSON-encoded descriptions in the $egreso object
            $egreso->descripcion = $registrosJson;
            $egreso->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }



}
