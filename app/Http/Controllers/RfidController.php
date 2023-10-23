<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\GanadoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Persona;
use App\Lista;
use App\Rfid;
use App\Genero;

class RfidController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fecha = Carbon::now('America/La_Paz')->format('Y-m-d');
        $buscar = $request->buscar;
        $festado = $request->input('festado');


            $rfids = Rfid::join('personas','rfids.idpersona','=','personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos','rfids.idgenero','=','generos.id')
            ->join('grupos','rfids.idgrupo','=','grupos.id')
            ->select('rfids.id','rfids.idrfid','rfids.idregistro','rfids.idprocesofaeneo','rfids.idfaeneo','personas.id as idpersona','personas.nombre','personas.apellidoP','personas.apellidoM','generos.id as idgenero','generos.nombre as gnombre','grupos.nombre as grunombre','personas.marca','personas.num_documento','personas.direccion','personas.telefono','rfids.estado','rfids.fecha')
            ->where('rfids.fecha','=',$fecha)
            ->where('users.idrol', '=', 3)
            ->where(function($query) use ($buscar) {
                $query->where('personas.nombre', 'LIKE', "%$buscar%")
                      ->orWhere('personas.num_documento', 'LIKE', "%$buscar%")
                      ->orWhere('personas.direccion', 'LIKE', "%$buscar%")
                      ->orWhere('personas.marca', 'LIKE', "%$buscar%")
                      ->orWhere('generos.nombre', 'LIKE', "%$buscar%")
                      ->orWhere('rfids.idrfid', 'LIKE', "%$buscar%");
            })
            ->when($festado, function ($query) use ($festado) {
                // Aplicar el filtro de fecha solo si se proporciona una fecha
                return $query->where('rfids.estado', $festado);
            })
            ->orderBy('rfids.estado', 'asc')
            ->orderBy('rfids.created_at', 'desc')->paginate(10);
            $total_estado0 = Rfid::where('estado', 0)->where('fecha','=', $fecha)->count();
            $total_estado1 = Rfid::where('estado', 1)->where('fecha','=', $fecha)->count();
            $total_estado2 = Rfid::where('estado', 2)->where('fecha','=', $fecha)->count();


        return [
            'pagination' => [
                'total'        => $rfids->total(),
                'current_page' => $rfids->currentPage(),
                'per_page'     => $rfids->perPage(),
                'last_page'    => $rfids->lastPage(),
                'from'         => $rfids->firstItem(),
                'to'           => $rfids->lastItem(),
            ],
            'rfids' => $rfids,'total_estado0'=> $total_estado0,'total_estado1'=> $total_estado1,'total_estado2'=> $total_estado2
        ];
    }
    public function indexAfiliado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fecha = Carbon::now('America/La_Paz')->format('Y-m-d');
        $marca = Auth::user()->persona->marca;


        $rfids = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos', 'rfids.idgenero', '=', 'generos.id')
            ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
            ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre','personas.apellidoP','personas.apellidoM', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha','rfids.updated_at as fechaupdate')
            ->where('users.idrol', '=', 3)
            ->whereIn('rfids.estado', [0, 1])
            ->where('personas.marca','=', $marca)
            ->orderBy('rfids.created_at', 'desc')
            ->orderBy('rfids.estado', 'desc')->paginate(10);        

        $total_estado0 = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
        ->join('users', 'personas.id', '=', 'users.id')
        ->join('generos', 'rfids.idgenero', '=', 'generos.id')
        ->where('estado', 0)
        ->where('users.idrol', '=', 3)
        ->where('personas.marca','=', $marca)->count();

        $total_estado1 = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
        ->join('users', 'personas.id', '=', 'users.id')
        ->join('generos', 'rfids.idgenero', '=', 'generos.id')
        ->where('estado', 1)
        ->where('users.idrol', '=', 3)
        ->where('personas.marca','=', $marca)->count();

        $total_estado2 = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
        ->join('users', 'personas.id', '=', 'users.id')
        ->join('generos', 'rfids.idgenero', '=', 'generos.id')
        ->where('estado', 2)
        ->where('users.idrol', '=', 3)
        ->where('personas.marca','=', $marca)->count();

        return [
            'pagination' => [
                'total'        => $rfids->total(),
                'current_page' => $rfids->currentPage(),
                'per_page'     => $rfids->perPage(),
                'last_page'    => $rfids->lastPage(),
                'from'         => $rfids->firstItem(),
                'to'           => $rfids->lastItem(),
            ],
            'rfids' => $rfids, 'total_estado0' => $total_estado0, 'total_estado1' => $total_estado1, 'total_estado2' => $total_estado2
        ];
    }
    public function indexAdministrador(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $date1 = $request->date1;
        $date2 = $request->date2;
        $id = $request->id;
        $buscar = $request->buscar;
        $festado = $request->input('festado');

        if ($date1 !='' && $date2 !=''){

            $rfids = DB::table('rfids')
            ->join('personas', 'rfids.idpersona', '=', 'personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos', 'rfids.idgenero', '=', 'generos.id')
            ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
            ->select('rfids.id', 'rfids.idrfid', 'rfids.idregistro', 'rfids.idprocesofaeneo', 'rfids.idfaeneo', 'personas.id as idpersona', 'personas.nombre','personas.apellidoP','personas.apellidoM', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
            ->where(function ($query) use ($buscar) {
                $query->where('personas.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('generos.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('grupos.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.marca', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.num_documento', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.direccion', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.telefono', 'like', '%' . $buscar . '%');
            })
            ->when($date1 != '' && $date2 != '', function ($query) use ($date1, $date2) {
                $query->whereBetween('rfids.fecha', [$date1, $date2]);
            })
            ->when($festado != '', function ($query) use ($festado) {
                return $query->where('rfids.estado', $festado);
            })
            ->where('users.idrol', '=', 3)
            ->orderByDesc('rfids.created_at')
            ->orderBy('rfids.estado')
            ->orderBy('rfids.idgrupo')
            ->paginate(10);


            $total_estado0 = Rfid::where('estado', 0)->whereBetween('fecha', [$date1, $date2])->count();
            $total_estado1 = Rfid::where('estado', 1)->whereBetween('fecha', [$date1, $date2])->count();
            $total_estado2 = Rfid::where('estado', 2)->whereBetween('fecha', [$date1, $date2])->count();

            $chartData = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->select(DB::raw('COUNT(r.idrfid) as total'), 'p.marca')
            ->whereBetween('fecha', [$date1, $date2])
            ->where('u.idrol', '=', 3)
            ->groupBy('p.marca')
            ->get();

            $chartData2 = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->where('r.estado', '=', 2)
            ->where('u.idrol', '=', 3)
            ->select('p.marca as marca', DB::raw('COUNT(r.estado) AS total'))
            ->whereBetween('fecha', [$date1, $date2])
            ->groupBy('p.marca')
            ->get();

            $chartData3 = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->where('r.estado', '=', 2)
            ->where('u.idrol', '=', 3)
            ->select('p.marca as marca', DB::raw('COUNT(r.estado) AS total'), DB::raw('MONTH(r.fecha) AS mes'))
            ->groupBy('p.marca', DB::raw('MONTH(r.fecha)'))
            ->get();
            $chartData4 = DB::table('rfids as r')
            ->join('generos as g', 'r.idgenero', '=', 'g.id')
            ->where('r.estado', '=', 2)
            ->select('g.nombre as genero', DB::raw('COUNT(r.estado) AS total'), DB::raw('MONTH(r.fecha) AS mes'))
            ->groupBy('g.nombre', DB::raw('MONTH(r.fecha)'))
            ->get();

            $chartData5 = DB::table('rfids as r')
            ->join('grupos as g', 'r.idgrupo', '=', 'g.id')
            ->where('r.estado', '=', 2)
            ->select('g.nombre as grupo', DB::raw('COUNT(r.idgrupo) AS total'), DB::raw('MONTH(r.fecha) AS mes'))
            ->groupBy('g.nombre', DB::raw('MONTH(r.fecha)'))
            ->get();

            $chartData6 = DB::table('rfids as r')
            ->selectRaw('COUNT(r.id) as total, MONTH(r.fecha) as mes')
            ->where('r.estado', 2)
            ->groupBy(DB::raw('MONTH(r.fecha)'))
            ->get();

        }
        else{

            $rfids = Rfid::join('personas','rfids.idpersona','=','personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos','rfids.idgenero','=','generos.id')
            ->join('grupos','rfids.idgrupo','=','grupos.id')
            ->select('rfids.id','rfids.idrfid','rfids.idregistro','rfids.idprocesofaeneo','rfids.idfaeneo','personas.id as idpersona','personas.nombre','personas.apellidoP','personas.apellidoM','generos.nombre as gnombre','grupos.nombre as grunombre','personas.marca','personas.num_documento','personas.direccion','personas.telefono','rfids.estado','rfids.fecha')
            ->where(function($query) use ($buscar) {
                $query->where('personas.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('generos.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('grupos.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.marca', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.num_documento', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.direccion', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.telefono', 'like', '%' . $buscar . '%');
            })
            ->where('users.idrol', '=', 3)             
            ->when($festado, function ($query) use ($festado) {
                // Aplicar el filtro de grupo solo si se proporciona un grupo
                return $query->where('rfids.estado', $festado);
            })        
            ->orderBy('rfids.created_at', 'desc')
            ->orderBy('rfids.estado', 'desc')->paginate(10);
            $total_estado0 = Rfid::where('estado', 0)->count();
            $total_estado1 = Rfid::where('estado', 1)->count();
            $total_estado2 = Rfid::where('estado', 2)->count();

            $chartData = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->select(DB::raw('COUNT(r.idrfid) as total'), 'p.marca')
            ->where('u.idrol', '=', 3)
            ->groupBy('p.marca')
            ->get();

            $chartData2 = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->where('r.estado', '=', 2)
            ->select('p.marca as marca', DB::raw('COUNT(r.estado) AS total'))
            ->where('u.idrol', '=', 3)
            ->groupBy('p.marca')
            ->get();

            $chartData3 = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->where('r.estado', '=', 2)
            ->where('u.idrol', '=', 3)
            ->select('p.marca as marca', DB::raw('COUNT(r.estado) AS total'), DB::raw('MONTH(r.fecha) AS mes'))
            ->groupBy('p.marca', DB::raw('MONTH(r.fecha)'))
            ->get();
            $chartData4 = DB::table('rfids as r')
            ->join('generos as g', 'r.idgenero', '=', 'g.id')
            ->where('r.estado', '=', 2)
            ->select('g.nombre as genero', DB::raw('COUNT(r.estado) AS total'), DB::raw('MONTH(r.fecha) AS mes'))
            ->groupBy('g.nombre', DB::raw('MONTH(r.fecha)'))
            ->get();
            $chartData5 = DB::table('rfids as r')
            ->join('grupos as g', 'r.idgrupo', '=', 'g.id')
            ->where('r.estado', '=', 2)
            ->select('g.nombre as grupo', DB::raw('COUNT(r.idgrupo) AS total'), DB::raw('MONTH(r.fecha) AS mes'))
            ->groupBy('g.nombre', DB::raw('MONTH(r.fecha)'))
            ->get();

            $chartData6 = DB::table('rfids as r')
            ->selectRaw('COUNT(r.id) as total, MONTH(r.fecha) as mes')
            ->where('r.estado', 2)
            ->groupBy(DB::raw('MONTH(r.fecha)'))
            ->get();


        }

        return
        [
            'pagination' => [
                'total'        => $rfids->total(),
                'current_page' => $rfids->currentPage(),
                'per_page'     => $rfids->perPage(),
                'last_page'    => $rfids->lastPage(),
                'from'         => $rfids->firstItem(),
                'to'           => $rfids->lastItem(),
            ],
            'rfids' => $rfids,'total_estado0'=> $total_estado0,'total_estado1'=> $total_estado1,'total_estado2'=> $total_estado2,'chartData' => $chartData,'chartData2' => $chartData2,'chartData3' => $chartData3,'chartData4' => $chartData4,'chartData5' => $chartData5,'chartData6' => $chartData6
        ];
    }

    public function verInformacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;


            $rfids = DB::table('rfids')
            ->join('personas', 'rfids.idpersona', '=', 'personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos', 'rfids.idgenero', '=', 'generos.id')
            ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
            ->leftJoin('personas AS registro', 'rfids.idregistro', '=', 'registro.id')
            ->leftJoin('personas AS procesofaeneo', 'rfids.idprocesofaeneo', '=', 'procesofaeneo.id')
            ->leftJoin('personas AS faeneo', 'rfids.idfaeneo', '=', 'faeneo.id')
            ->select(
                'rfids.id',
                'rfids.idrfid',
                'registro.nombre AS idregistro',
                'registro.apellidoP AS idregistroP',
                'registro.apellidoM AS idregistroM',
                'procesofaeneo.nombre AS idprocesofaeneo',
                'procesofaeneo.apellidoP AS idprocesofaeneoP',
                'procesofaeneo.apellidoM AS idprocesofaeneoM',                
                'faeneo.nombre AS idfaeneo',
                'faeneo.apellidoP AS idfaeneoP',
                'faeneo.apellidoM AS idfaeneoM',
                'personas.id AS idpersona',
                'personas.nombre AS persona_nombre',
                'personas.apellidoP',
                'personas.apellidoM',                
                'generos.nombre AS gnombre',
                'grupos.nombre AS grunombre',
                'personas.marca',
                'personas.num_documento',
                'personas.direccion',
                'personas.telefono',
                'rfids.estado',
                'rfids.fecha',
                'rfids.updated_at',
            )->where('rfids.id','=',$id)
            ->get();

        return ['rfids' => $rfids];

        return ['rfids' => $rfids];
    }
    public function pdf(Request $request)
        {
        if (!$request->ajax()) return redirect('/');
        $mytime= Carbon::now('America/La_Paz');
        $date1 = $request->date1;
        $date2 = $request->date2;
        $buscar = $request->buscar;
        $festado = $request->input('festado');

        if ($date1 !='' && $date2 !='' && $buscar != '' || $date1 !='' && $date2 !='' && $buscar == '' ){

            $rfids = DB::table('rfids')
            ->join('personas', 'rfids.idpersona', '=', 'personas.id')
            ->join('generos', 'rfids.idgenero', '=', 'generos.id')
            ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
            ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre','personas.apellidoP','personas.apellidoM', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
            ->where(function($query) use ($buscar) {
                $query->where('personas.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('generos.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('grupos.nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.marca', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.num_documento', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.direccion', 'like', '%' . $buscar . '%')
                    ->orWhere('personas.telefono', 'like', '%' . $buscar . '%');
            })
            ->whereBetween('rfids.fecha', [$date1, $date2])
            ->when($festado, function ($query) use ($festado) {
                // Aplicar el filtro de grupo solo si se proporciona un grupo
                return $query->where('rfids.estado', $festado);
            })
            ->orderByDesc('rfids.created_at')
            ->orderBy('rfids.estado')
            ->orderBy('rfids.idgrupo')
            ->get();
        }
        else{
                $rfids = Rfid::join('personas','rfids.idpersona','=','personas.id')
                ->join('generos','rfids.idgenero','=','generos.id')
                ->join('grupos','rfids.idgrupo','=','grupos.id')
                ->select('rfids.id','rfids.idrfid','personas.id as idpersona','personas.nombre','personas.apellidoP','personas.apellidoM','generos.nombre as gnombre','grupos.nombre as grunombre','personas.marca','personas.num_documento','personas.direccion','personas.telefono','rfids.estado','rfids.fecha')
                ->where(function($query) use ($buscar) {
                    $query->where('personas.nombre', 'like', '%' . $buscar . '%')
                        ->orWhere('generos.nombre', 'like', '%' . $buscar . '%')
                        ->orWhere('grupos.nombre', 'like', '%' . $buscar . '%')
                        ->orWhere('personas.marca', 'like', '%' . $buscar . '%')
                        ->orWhere('personas.num_documento', 'like', '%' . $buscar . '%')
                        ->orWhere('personas.direccion', 'like', '%' . $buscar . '%')
                        ->orWhere('personas.telefono', 'like', '%' . $buscar . '%');
                })
                ->when($festado, function ($query) use ($festado) {
                    // Aplicar el filtro de grupo solo si se proporciona un grupo
                    return $query->where('rfids.estado', $festado);
                })
                ->orderBy('rfids.created_at', 'desc')
                ->orderBy('rfids.estado', 'desc')->get();             
            }

        $pdf = \PDF::loadView('pdf.ganados', ['rfids' => $rfids]);
        return $pdf->stream('ListaPdf'.$mytime.'.pdf');
    }

    public function excel(Request $request){
        $mytime= Carbon::now('America/La_Paz');
        $buscar = $request->buscar;
        $date1 =  $request->date1;
        $date2 = $request->date2;
        $festado = $request->festado;
        ob_end_clean();
        ob_start();
        return Excel::download(new GanadoExport($date1,$date2,$buscar,$festado),'ReporteGanado'.$mytime.'.xlsx');
    }



    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $rfid = new Rfid();
            $rfid->idrfid = $request->idrfid;
            $rfid->idpersona = $request->idpersona;
            $rfid->idgenero = $request->idgenero;
            $rfid->estado = $request->estado;
            $rfid->idregistro = \Auth::user()->id;
            $rfid->asignado = 0;
            $rfid->fecha = $request->fecha;
            $rfid->save();

            // Verificar si hay registros en la lista sin idgenero que coincidan con la marca del nuevo RFID
            $lista = Lista::where('idpersona', $request->idpersona)
                ->where('idgenero', 0)
                ->where('cantidad', '=', 1)
                ->where('estado', 0)
                ->orderBy('idgrupo', 'asc')
                ->first();

            if ($lista) {
                // Asignar el idgenero del nuevo RFID al registro en la lista
                $lista->idgenero = $request->idgenero;
                $lista->save();

                // Cambiar el valor de asignado a 1 en el RFID
                $rfid->asignado = 1;
                $rfid->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $rfid = Rfid::findOrFail($request->id);
            $rfid->idrfid = $request->idrfid;
            $rfid->idpersona = $request->idpersona;
            $rfid->idgenero = $request->idgenero;
            $rfid->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function autollenarRfid(Request $request)
    {
        $rfidId = $request->input('rfidData');

        $rfid = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
            ->join('generos', 'rfids.idgenero', '=', 'generos.id')
            ->select('rfids.idgenero','generos.nombre as gnombre', 'rfids.id','rfids.idrfid', 'rfids.idpersona', 'personas.nombre','personas.apellidoP','personas.apellidoM', 'personas.marca', 'personas.num_documento', 'rfids.estado', 'rfids.fecha')
            ->where('rfids.idrfid', $rfidId)->whereIn('rfids.estado', [0, 1,])
            ->first();

        if ($rfid) {
            return response()->json([
                'idgenero' => $rfid->idgenero,
                'estado' => $rfid->estado,
                'gnombre' => $rfid->gnombre,
                'idpersona' => $rfid->idpersona,
                'nombre' => $rfid->nombre,
                'apellidoP' => $rfid->apellidoP,
                'apellidoM' => $rfid->apellidoM,
                'marca' => $rfid->marca,
                'num_documento' => $rfid->num_documento,
                'fecha' => $rfid->fecha,
            ]);
        }
    }

    public function eliminar($id)
    {
        $rfid = Rfid::find($id);

        if (!$rfid) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $rfid->delete();

        return response()->json(['message' => 'Registro eliminado correctamente']);
    }

    public function listaVerificar(Request $request)
        {
        $idpersona = $request->input('idpersona');
        $fechaActual = Carbon::now()->format('Y-m-d');

        $lista = Lista::where('idpersona', $idpersona)
            ->where('cantidad', '>', 0)
            ->whereDate('fecha', $fechaActual)
            ->get();

        return response()->json(['arrayListaFiltrada' => $lista]);
        }

        public function Proceso1(Request $request)
        {
            $rfidData = $request->input('rfidData');
            $idpersona = $request->input('idpersona');

            // Buscar registro en la lista con el idpersona especificado y las condiciones necesarias
            $lista = Lista::where('idpersona', $idpersona)
                ->where('cantidad', '>', 0)
                ->where('estado', 0)
                ->orderBy('idgrupo', 'asc')
                ->first();

            $rfid = Rfid::where('idrfid', $rfidData)
                ->where('estado', 0)
                ->first();

            // Verificar si existe un registro de lista y un RFID correspondiente
            if ($lista && $rfid) {
                $idgrupo = $lista->idgrupo;
                $idgenero = $rfid->idgenero;

                // Actualizar el estado de la lista a 1 y descontar la cantidad
                $cantidad = $lista->cantidad - 1;
                $lista->cantidad = $cantidad;
                $lista->estado = 1;
                $lista->idgenero = $idgenero;
                $lista->save();

                $rfid->idgrupo = $idgrupo;
                $rfid->estado = 1;
                $rfid->asignado = 2;
                $rfid->idprocesofaeneo = \Auth::user()->id;
                $rfid->save();

            }

            return response()->json(['success' => true]);
        }
        public function actualizarIdGeneroLista(Request $request)
        {
            $rfidData = $request->input('rfidData');
            $idpersona = $request->input('idpersona');
            $cantidad = $request->input('cantidad'); // La cantidad de registros de lista que deseas actualizar

            // Obtener los RFIDs disponibles para el idpersona
            $rfids = Rfid::where('idpersona', $idpersona)
                ->where('estado', 0)
                ->where('asignado', 1)
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

            // Obtener los registros de lista correspondientes al idpersona
            $lista = Lista::where('idpersona', $idpersona)
                ->where('cantidad', '>', 0)
                ->where('estado', 0)
                ->orderBy('idgrupo', 'ASC')
                ->take($cantidad)
                ->get();

            // Iniciar la transacción
            DB::beginTransaction();

            try {
                $i = 0; // Índice para recorrer los idgeneros disponibles

                // Actualizar los registros de lista con los idgeneros disponibles
                foreach ($lista as $registro) {
                    if ($i < count($idgeneros)) {
                        // Asignar el idgenero disponible al registro de la lista
                        $registro->idgenero = $idgeneros[$i];
                    } else {
                        // Asignar 0 si no hay suficientes idgenero disponibles
                        $registro->idgenero = 0;
                    }
                    $registro->save();
                    $i++;
                }

                // Establecer "asignado" en 1 para los RFIDs correspondientes a la misma idpersona con estado 0
                Rfid::where('idpersona', $idpersona)
                    ->where('estado', 0)
                    ->update(['asignado' => 1]);

                // Commit de la transacción si todo se guardó correctamente
                DB::commit();

                return response()->json(['success' => 'Los idgenero de los registros de lista se han actualizado correctamente.']);
            } catch (\Exception $e) {
                // Rollback de la transacción en caso de error
                DB::rollback();
                return response()->json(['error' => 'Ocurrió un error al actualizar los idgenero de los registros de lista.']);
            }
        }


    public function verificar(Request $request)
    {
        $rfidData = $request->input('rfidData');

        // Verificar si existe un registro con el mismo RFID y los estados 0, 1 y 2
        $registros = Rfid::where('idrfid', $rfidData)
            ->whereIn('estado', [0, 1])
            ->get();

        if ($registros->isNotEmpty()) {
            // Mostrar alerta de que existen registros con el mismo RFID y los estados 0, 1 y 2
            return response()->json(['registros' => $registros]);
        }

        return response()->json(['registros' => $registros]);
    }

    public function ProcesoFinal(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fecha = Carbon::now('America/La_Paz')->format('Y-m-d');

            $rfids = Rfid::join('personas','rfids.idpersona','=','personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos','rfids.idgenero','=','generos.id')
            ->join('grupos','rfids.idgrupo','=','grupos.id')
            ->select('rfids.id','rfids.idrfid','personas.id as idpersona','personas.nombre','personas.apellidoP','personas.apellidoM','generos.nombre as gnombre','grupos.nombre as grunombre','personas.marca','personas.num_documento','personas.direccion','personas.telefono','rfids.estado','rfids.fecha')
            ->where('rfids.fecha','=',$fecha)
            ->where('rfids.estado', '=', 1)
            ->where('users.idrol', '=', 3)
            ->orderBy('rfids.created_at', 'desc')
            ->orderBy('rfids.estado', 'desc')->paginate(10);


        return [
            'pagination' => [
                'total'        => $rfids->total(),
                'current_page' => $rfids->currentPage(),
                'per_page'     => $rfids->perPage(),
                'last_page'    => $rfids->lastPage(),
                'from'         => $rfids->firstItem(),
                'to'           => $rfids->lastItem(),
            ],
            'rfids' => $rfids
        ];
    }

    public function indexCorral(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $chartData = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->select(DB::raw('COUNT(r.idrfid) as total'), 'p.marca')
            ->where('r.estado', '=', 0)
            ->where('r.idgenero', '=', 1)
            ->groupBy('p.marca')
            ->get();

            $chartData1 = DB::table('rfids as r')
            ->join('personas as p', 'r.idpersona', '=', 'p.id')
            ->join('users as u', 'p.id', '=', 'u.id')
            ->select(DB::raw('COUNT(r.idrfid) as total'), 'p.marca')
            ->where('r.estado', '=', 0)
            ->where('r.idgenero', '=', 2)
            ->groupBy('p.marca')
            ->get();

            $total_toros = Rfid::where('estado', 0)->where('idgenero', 1)->count();
            $total_vacas = Rfid::where('estado', 0)->where('idgenero', 2)->count();

            return ['chartData'=> $chartData,'chartData1'=> $chartData1,'total_toros'=> $total_toros,'total_vacas'=> $total_vacas];


    }

    public function indexlistaAfiliado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $marca = Auth::user()->persona->marca;


        $rfidslista = Rfid::leftJoin('personas', 'rfids.idpersona', '=', 'personas.id')
            ->leftJoin('users', 'personas.id', '=', 'users.id')
            ->leftJoin('generos', 'rfids.idgenero', '=', 'generos.id')
            ->leftJoin('grupos', 'rfids.idgrupo', '=', 'grupos.id')
            ->leftJoin('personas as faeneo', 'rfids.idfaeneo', '=', 'faeneo.id')
            ->select( 'faeneo.nombre as idfaeneo','rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre','personas.apellidoP','personas.apellidoM', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha','rfids.updated_at as fechaupdate')
            ->where('users.idrol', '=', 3)
            ->where('rfids.estado', '=', 2)
            ->where('personas.marca','=', $marca)
            ->orderBy('rfids.created_at', 'desc')
            ->orderBy('rfids.estado', 'desc')->paginate(10);        

        $total_estado2 = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
        ->join('users', 'personas.id', '=', 'users.id')
        ->join('generos', 'rfids.idgenero', '=', 'generos.id')
        ->where('estado', 2)
        ->where('users.idrol', '=', 3)
        ->where('personas.marca','=', $marca)->count();

        return [
            'pagination' => [
                'total'        => $rfidslista->total(),
                'current_page' => $rfidslista->currentPage(),
                'per_page'     => $rfidslista->perPage(),
                'last_page'    => $rfidslista->lastPage(),
                'from'         => $rfidslista->firstItem(),
                'to'           => $rfidslista->lastItem(),
            ],
            'rfidslista' => $rfidslista,'total_estado2' => $total_estado2
        ];
    }

}
