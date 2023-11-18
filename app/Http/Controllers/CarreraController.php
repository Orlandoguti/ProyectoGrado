<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Carrera;

class CarreraController extends Controller
{

    public function selectCarrera(Request $request)
    {
        $carreras = Carrera::select('id','nombre', 'descripcion')
            ->orderBy('id')
            ->get();
    
        return ['carreras' => $carreras];
    }
}
