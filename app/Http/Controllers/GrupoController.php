<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Grupo;

class GrupoController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $grupos = Grupo::select('grupos.id','grupos.nombre', 'grupos.detalle','grupos.created_at as fecharegistro')
            ->paginate(10);

        return [
            'pagination' => [
                'total'        => $grupos->total(),
                'current_page' => $grupos->currentPage(),
                'per_page'     => $grupos->perPage(),
                'last_page'    => $grupos->lastPage(),
                'from'         => $grupos->firstItem(),
                'to'           => $grupos->lastItem(),
            ],
            'grupos' => $grupos
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $grupos = new Grupo();
            $grupos->nombre = $request->nombre;
            $grupos->detalle = $request->detalle;
            $grupos->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

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
