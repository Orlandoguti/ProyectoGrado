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

class ProcesofinalController extends Controller
{




    public function ProcesoFinal(Request $request)
    {
        $rfidData = $request->input('rfidData');
        $idpersona = $request->input('idpersona');
        $fechaActual = Carbon::now()->format('Y-m-d');


        $rfid = Rfid::where('idrfid', $rfidData)
            ->where('estado', 1)
            ->where('fecha', $fechaActual)
            ->first();

            $rfid->estado = 2;
            $rfid->idfaeneo = \Auth::user()->id;
            $rfid->save();

        return response()->json(['success' => true]);
    }

    public function autollenarRfid(Request $request)
    {
        $rfidId = $request->input('rfidData');

        $rfid = Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
            ->join('generos', 'rfids.idgenero', '=', 'generos.id')
            ->select('rfids.idgenero','generos.nombre as gnombre', 'rfids.id','rfids.idrfid', 'rfids.idpersona', 'personas.nombre', 'personas.marca', 'personas.num_documento', 'rfids.estado', 'rfids.fecha')
            ->where('rfids.idrfid', $rfidId)->whereIn('rfids.estado', [1])
            ->first();

        if ($rfid) {
            return response()->json([
                'idgenero' => $rfid->idgenero,
                'estado' => $rfid->estado,
                'gnombre' => $rfid->gnombre,
                'idpersona' => $rfid->idpersona,
                'nombre' => $rfid->nombre,
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

        $rfid = Rfid::where('idpersona', $idpersona)
            ->where('estado', '=', 1)
            ->whereDate('fecha', $fechaActual)
            ->get();

        return response()->json(['arrayListaFiltrada' => $rfid]);
        }


    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fecha = Carbon::now('America/La_Paz')->format('Y-m-d');

            $rfids = Rfid::join('personas','rfids.idpersona','=','personas.id')
            ->join('users', 'personas.id', '=', 'users.id')
            ->join('generos','rfids.idgenero','=','generos.id')
            ->join('grupos','rfids.idgrupo','=','grupos.id')
            ->select('rfids.id','rfids.idrfid','personas.id as idpersona','personas.nombre','generos.nombre as gnombre','grupos.nombre as grunombre','personas.marca','personas.num_documento','personas.direccion','personas.telefono','rfids.estado','rfids.fecha')

            ->where('rfids.estado', '=', 1)

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

}
