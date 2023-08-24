<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Variables;

class VariablesController extends Controller
{


    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


        $maxfaeneo = Variables::select('totalfaeneo')->first()->totalfaeneo;

            return ['maxfaeneo' => $maxfaeneo];
    }


    public function actualizarTotal(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $nuevoTotal = $request->input('totalfaeneo'); // Cambia 'maxtotalfaeneo' a 'totalfaeneo'

            // Actualizar todos los registros en la tabla 'informaciones'
            Variables::query()->update([
                'totalfaeneo' => $nuevoTotal
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar el total.');
        }
    }


}
