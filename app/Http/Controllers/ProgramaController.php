<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Programa;
use App\Registro;
class ProgramaController extends Controller
{
    public function store(Request $request)
    {
        $registro = new Registro();
        $registro->idusuario = \Auth::user()->id;
        $registro->idmateria = $request->input('idmateria');
        $registro->docente = $request->input('docente');
        $registro->paralelo = $request->input('paralelo');
        
        $idcarrerauser = $request->input('idcarrerauser');
        $selectedOptions = $request->input('selectedOptions');        
        // Combina los ID en un solo campo separados por comas
        $carreras = implode(',', array_merge([$idcarrerauser], $selectedOptions));        
        $registro->carreras = $carreras;
        $registro->save();
        // Obtener los programas desde la solicitud
        $programas = $request->input('registros');
    
        // Crear registros de Programa asociados al registro principal
        foreach ($programas as $programa) {
            Programa::create([
                'idregistro' => $registro->id, // Utilizar el ID del registro principal
                'idambiente' => $programa['idambiente'],
                'iddia' => $programa['iddia'],
                'idperiodo' => $programa['idperiodo'],
                // Otros campos según sea necesario
            ]);
        }
    
        // Puedes devolver una respuesta según sea necesario
        return response()->json(['mensaje' => 'Registros guardados exitosamente']);
    }
    
   

    public function obtenerCamposOcupados($idambiente)
    {
        $camposOcupados = DB::table('programas as p')
        ->join('registros as r', 'r.id', '=', 'p.idregistro')
        ->join('personas as u', 'u.id', '=', 'r.idusuario')
        ->join('materias as m', 'm.id', '=', 'r.idmateria')
        ->select('p.id','p.idambiente','p.idperiodo','p.iddia','p.idregistro','r.docente','r.idusuario','r.paralelo','m.materia','m.codigo','u.color',
            DB::raw('(SELECT GROUP_CONCAT(c.nombre SEPARATOR " - ") FROM carreras c WHERE FIND_IN_SET(c.id, r.carreras)) AS nombres_carreras')
        )
        ->where('p.idambiente', '=',$idambiente)
        ->get();

        return response()->json(['campos_ocupados' => $camposOcupados]);
    }

    public function eliminarRegistro(Request $request)
    {
        $idambiente = $request->input('idambiente');
        $idperiodo = $request->input('idperiodo');
        $iddia = $request->input('iddia');

        // Eliminar el registro de la tabla programas
        Programa::where('idambiente', $idambiente)
                ->where('idperiodo', $idperiodo)
                ->where('iddia', $iddia)
                ->delete();

        return response()->json(['message' => 'Registro eliminado exitosamente']);
    }
    
}
