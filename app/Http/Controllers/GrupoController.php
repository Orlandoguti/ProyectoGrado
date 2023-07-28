<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Grupo;

class GrupoController extends Controller
{


    public function selectGrupo(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $grupos = Grupo::where('nombre', 'like', '%'. $filtro . '%')
        ->orWhere('nombre', 'like', '%'. $filtro . '%')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['grupos' => $grupos];
    }

}
