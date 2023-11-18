<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Ambiente;

class AmbienteController extends Controller
{
    public function index()
    {       
            $ambientes = Ambiente::all();
        return ['ambientes' => $ambientes];
    }

    public function selectAmbiente(Request $request)
    {
        $ambientes = Ambiente::select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['ambientes' => $ambientes];
    }
    public function buscarambiente(Request $request)
    {
        $registrosBuscar = $request->input('registrosbuscar');
        
        $ambientes = DB::table('ambientes')
            ->whereNotIn('id', function ($query) use ($registrosBuscar) {
                $query->select('idambiente')
                    ->from('programas')
                    ->whereIn('iddia', array_column($registrosBuscar, 'iddia'))
                    ->whereIn('idperiodo', array_column($registrosBuscar, 'idperiodo'));
            })
            ->select('id', 'nombre', 'capacidad','tipo','accesorio')
            ->orderBy('capacidad','DESC')
            ->paginate(9);
    
        return response()->json([
            'pagination' => [
                'total'        => $ambientes->total(),
                'current_page' => $ambientes->currentPage(),
                'per_page'     => $ambientes->perPage(),
                
               
    'last_page'    => $ambientes->lastPage(),
                'from'         => $ambientes->firstItem(),
                'to'           => $ambientes->lastItem(),
            ],
            'ambientes' => $ambientes
        ]);
    }
    
}
