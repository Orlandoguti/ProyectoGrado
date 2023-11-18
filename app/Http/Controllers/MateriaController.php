<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Materia;

class MateriaController extends Controller
{

    public function selectMateria(Request $request)
    {
        $materias = Materia::select(DB::raw('MIN(id) AS id'), 'codigo', 'materia')
            ->groupBy('codigo', 'materia')
            ->orderBy('codigo')
            ->get();
    
        return ['materias' => $materias]; // Changed 'ambientes' to 'materias'
    }
    
    public function indexMateria(Request $request)
    {
    $idusuario = Auth::user()->persona->id;
    $materias = DB::table('registros as r')
    ->select('r.idusuario', 'm.codigo', 'm.materia', 'r.docente', 'r.paralelo', 'p.idambiente', 'a.nombre')
    ->join('materias as m', 'm.id', '=', 'r.idmateria')
    ->join('programas as p', 'p.idregistro', '=', 'r.id')
    ->join('ambientes as a', 'a.id', '=', 'p.idambiente')
    ->where('r.idusuario','=', $idusuario)
    ->groupBy('r.idusuario', 'm.codigo', 'm.materia', 'r.docente', 'r.paralelo', 'p.idambiente', 'a.nombre')
    ->paginate(10);
    return
    [
       'pagination' => [
           'total'        => $materias->total(),
           'current_page' => $materias->currentPage(),
           'per_page'     => $materias->perPage(),
           'last_page'    => $materias->lastPage(),
           'from'         => $materias->firstItem(),
           'to'           => $materias->lastItem(),
       ],
       'materias' => $materias

        ];
    }
}
