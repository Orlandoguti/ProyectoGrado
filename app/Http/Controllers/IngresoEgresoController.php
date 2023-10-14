<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\DetalleLista;
use App\Egresos;
use App\ClasEgresos;

class IngresoEgresoController extends Controller
{


    public function indexIngresoEgreso(Request $request)
    {
        $idclasegreso = $request->input('idclasegreso');
        $buscar = $request->input('buscar'); // Obtener el parámetro de filtro de grupo
        $date1 = $request->date1;
        $date2 = $request->date2;

        if (!$request->ajax()) return redirect('/');

        $results = DB::table(DB::raw('(
            SELECT DISTINCT DATE_FORMAT(fecha, "%m") AS mes, DATE_FORMAT(fecha, "%Y") AS anio
            FROM egresos
            UNION
            SELECT DISTINCT DATE_FORMAT(fecha, "%m") AS mes, DATE_FORMAT(fecha, "%Y") AS anio
            FROM listas
        ) AS all_dates'))
            ->leftJoin(DB::raw('(
                SELECT DATE_FORMAT(fecha, "%m") AS mes, DATE_FORMAT(fecha, "%Y") AS anio, SUM(monto) AS monto
                FROM egresos
                GROUP BY DATE_FORMAT(fecha, "%m"), DATE_FORMAT(fecha, "%Y")
            ) AS e'), function ($join) {
                $join->on('all_dates.mes', '=', 'e.mes')
                    ->on('all_dates.anio', '=', 'e.anio');
            })
            ->leftJoin(DB::raw('(
                SELECT DATE_FORMAT(fecha, "%m") AS mes, DATE_FORMAT(fecha, "%Y") AS anio, SUM(total) AS ingreso
                FROM listas
                GROUP BY DATE_FORMAT(fecha, "%m"), DATE_FORMAT(fecha, "%Y")
            ) AS l'), function ($join) {
                $join->on('all_dates.mes', '=', 'l.mes')
                    ->on('all_dates.anio', '=', 'l.anio');
            })
            ->groupBy('all_dates.mes', 'all_dates.anio')
            ->select(
                'all_dates.mes',
                'all_dates.anio',
                DB::raw('IFNULL(SUM(e.monto), 0) AS egreso'),
                DB::raw('IFNULL(SUM(l.ingreso), 0) AS ingreso'),
                DB::raw('(IFNULL(SUM(l.ingreso), 0) - IFNULL(SUM(e.monto), 0)) AS saldo')
            )
            ->get();


        $previousBalance = 0;
        $resultsWithCalculations = [];

        foreach ($results as $row) {
            $saldo = $row->ingreso - $row->egreso + $previousBalance;
            $ingresoConSaldo = $row->ingreso + $previousBalance;

            $row->saldo = $saldo;
            $row->ingreso_con_saldo = $ingresoConSaldo;

            $previousBalance = $saldo;

            $resultsWithCalculations[] = $row;
        }

        $total_efectivo = DB::table('variables')
        ->selectRaw('ingresos - egresos AS totalefectivo')
        ->value('totalefectivo');

        if ($date1 == '' && $date2 == ''){

        $egresos = Egresos::join('clasegresos', 'egresos.idclasegreso', '=', 'clasegresos.id')
        ->select('egresos.id','egresos.egreso', 'egresos.monto','egresos.descripcion','egresos.respaldo','egresos.fecha','clasegresos.nombre')
        ->where(function($query) use ($buscar) {
            $query->where('egresos.id', 'like', '%' . $buscar . '%')
                  ->orWhere('egresos.egreso', 'like', '%' . $buscar . '%')
                  ->orWhere('egresos.monto', 'like', '%' . $buscar . '%')
                  ->orWhere('egresos.fecha', 'like', '%' . $buscar . '%');
        })
        ->when($idclasegreso, function ($query) use ($idclasegreso) {
            return $query->where('egresos.idclasegreso', $idclasegreso);
        })->orderBy('egresos.id', 'desc')
        ->paginate(10);

        $total_egreso = DB::table('variables')
        ->selectRaw('egresos AS totalefectivo')
        ->value('totalefectivo');

        $total_ingreso = DB::table('variables')
        ->selectRaw('ingresos AS totalefectivo')
        ->value('totalefectivo');

        }else{
            $total_egreso = DB::table('egresos')
                ->whereBetween('fecha', [$date1, $date2])
                ->sum('monto');
            $total_ingreso = DB::table('listas')
                ->whereBetween('fecha', [$date1, $date2])
                ->sum('total');

            $egresos = Egresos::join('clasegresos', 'egresos.idclasegreso', '=', 'clasegresos.id')
            ->select('egresos.id','egresos.egreso', 'egresos.monto','egresos.descripcion','egresos.respaldo','egresos.fecha','clasegresos.nombre')
            ->where(function($query) use ($buscar) {
                $query->where('egresos.id', 'like', '%' . $buscar . '%')
                      ->orWhere('egresos.egreso', 'like', '%' . $buscar . '%')
                      ->orWhere('egresos.monto', 'like', '%' . $buscar . '%')
                      ->orWhere('egresos.fecha', 'like', '%' . $buscar . '%');
            })
            ->when($idclasegreso, function ($query) use ($idclasegreso) {
                // Aplicar el filtro de grupo solo si se proporciona un grupo
                return $query->where('egresos.idclasegreso', $idclasegreso);
            })
            ->whereBetween('egresos.fecha', [$date1, $date2])
            ->orderBy('egresos.id', 'desc')
            ->paginate(10);
        }
        // La variable $result ahora contiene los resultados de la consulta
            return [
            'pagination' => [
                'total'        => $egresos->total(),
                'current_page' => $egresos->currentPage(),
                'per_page'     => $egresos->perPage(),
                'last_page'    => $egresos->lastPage(),
                'from'         => $egresos->firstItem(),
                'to'           => $egresos->lastItem(),
            ],'egresos'=> $egresos,'results' => $resultsWithCalculations,'total_egreso'=>$total_egreso,'total_ingreso'=>$total_ingreso, 'total_efectivo' => $total_efectivo];

    }
    public function egresoPdf(Request $request)
            {
                if (!$request->ajax()) return redirect('/');
                $date1 = $request->date1;
                $date2 = $request->date2;
                $buscar = $request->input('buscar');
                $idclasegreso = $request->input('idclasegreso'); // Obtener el parámetro de filtro de grupo
                if ($date1 == '' && $date2 == ''){
                    $egresos = Egresos::join('clasegresos', 'egresos.idclasegreso', '=', 'clasegresos.id')
                    ->select('egresos.id','egresos.egreso', 'egresos.monto','egresos.descripcion','egresos.respaldo','egresos.fecha','clasegresos.nombre')
                    ->where(function($query) use ($buscar) {
                        $query->where('egresos.id', 'like', '%' . $buscar . '%')
                              ->orWhere('egresos.egreso', 'like', '%' . $buscar . '%')
                              ->orWhere('egresos.monto', 'like', '%' . $buscar . '%')
                              ->orWhere('egresos.fecha', 'like', '%' . $buscar . '%');
                    })
                    ->when($idclasegreso, function ($query) use ($idclasegreso) {
                        // Aplicar el filtro de grupo solo si se proporciona un grupo
                        return $query->where('egresos.idclasegreso', $idclasegreso);
                    })
                    ->get();
                    }else{
                        $egresos = Egresos::join('clasegresos', 'egresos.idclasegreso', '=', 'clasegresos.id')
                        ->select('egresos.id','egresos.egreso', 'egresos.monto','egresos.descripcion','egresos.respaldo','egresos.fecha','clasegresos.nombre')
                        ->where(function($query) use ($buscar) {
                            $query->where('egresos.id', 'like', '%' . $buscar . '%')
                                  ->orWhere('egresos.egreso', 'like', '%' . $buscar . '%')
                                  ->orWhere('egresos.monto', 'like', '%' . $buscar . '%')
                                  ->orWhere('egresos.fecha', 'like', '%' . $buscar . '%');
                        })
                        ->when($idclasegreso, function ($query) use ($idclasegreso) {
                            // Aplicar el filtro de grupo solo si se proporciona un grupo
                            return $query->where('egresos.idclasegreso', $idclasegreso);
                        })
                        ->whereBetween('egresos.fecha', [$date1, $date2])
                        ->get();
                    }

                $pdf = \PDF::loadView('pdf.egresopdf', ['egresos' => $egresos]);
                return $pdf->stream('EgresoPdf.pdf');
            }

            public function storeEgreso(Request $request)
                {
                    if (!$request->ajax()) return redirect('/');

                    $mytime = Carbon::now('America/La_Paz');

                    $egreso = new Egresos();
                    $egreso->idclasegreso = $request->idclasegreso;
                    $egreso->egreso = $request->egreso;
                    $egreso->monto = $request->monto;
                    $egreso->descripcion = $request->descripcion;

                    if ($request->hasFile('respaldo')) {
                        $fileData = $request->file('respaldo');
                        $fileName = time()."_".$fileData->getClientOriginalName();
                        $fileData->move(public_path().'/respaldos/sueldos/', $fileName);
                        $egreso->respaldo = $fileName;
                    }

                    $egreso->fecha = $mytime->toDateTimeString();
                    $egreso->save();

                    DB::commit();
                    return response()->json(['message' => 'Egreso registered successfully.']);
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

    public function eliminar($id)
    {
        $egreso = Egresos::find($id);

        if (!$egreso) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $egreso->delete();

        return response()->json(['message' => 'Registro eliminado correctamente']);
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $clasegresos = ClasEgresos::findOrFail($request->id);
            $clasegresos->id = $request->idrfid;
            $clasegresos->nombre = $request->nombre;
            $clasegresos->detalle = $request->detalle;
            $clasegresos->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    public function eliminarclasegreso($id)
    {
        $clasegresos = ClasEgresos::find($id);

        if (!$clasegresos) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $clasegresos->delete();

        return response()->json(['message' => 'Registro eliminado correctamente']);
    }

}
