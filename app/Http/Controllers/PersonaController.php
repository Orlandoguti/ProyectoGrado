<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Persona;

class PersonaController extends Controller
{


    public function selectPersona(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;

        $personas = Persona::select('personas.id', 'personas.nombre', 'personas.num_documento', 'personas.marca')
        ->join('users as u', 'personas.id', '=', 'u.id')
        ->where(function ($query) use ($filtro) {
            $query->where('nombre', 'like', '%' . $filtro . '%')
                ->orWhere('num_documento', 'like', '%' . $filtro . '%');
        })
        ->where('u.idrol', 3)
        ->orderBy('personas.nombre', 'asc')
        ->get();

        return ['personas' => $personas];
    }

    public function autollenarPersona ($id) {$personas = Persona::find($id);
        return response()->json($personas);
    }
}
