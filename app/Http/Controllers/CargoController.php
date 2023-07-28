<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoController extends Controller
{

    public function selectCargo(Request $request)
    {
        $cargos = Cargo::where('condicion', '=', '1')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['cargos' => $cargos];
    }
}
