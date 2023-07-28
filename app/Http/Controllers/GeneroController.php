<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Genero;

class GeneroController extends Controller
{


    public function selectGenero(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $generos = Genero::where('nombre', 'like', '%'. $filtro . '%')
        ->orWhere('nombre', 'like', '%'. $filtro . '%')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['generos' => $generos];
    }

}
