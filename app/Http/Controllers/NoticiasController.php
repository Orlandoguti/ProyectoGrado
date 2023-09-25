<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Noticias;
use App\Informacion;

class NoticiasController extends Controller
{


    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


            $noticias = Noticias::orderBy('id', 'desc')->paginate(20);

            return [
                'pagination' => [
                    'total'        => $noticias->total(),
                    'current_page' => $noticias->currentPage(),
                    'per_page'     => $noticias->perPage(),
                    'last_page'    => $noticias->lastPage(),
                    'from'         => $noticias->firstItem(),
                    'to'           => $noticias->lastItem(),
                ],
                'noticias' => $noticias
            ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $noticias = new Noticias();
            $noticias->titulo = $request->titulo;
            $noticias->descripcion = $request->descripcion;
            $noticias->fecha = $request->fecha;
            $noticias->idpersona = \Auth::user()->id;

            $fileData = $request->file('imagen');
            if ($request->hasFile('imagen')) {
                $fileName = time() . "_" . $fileData->getClientOriginalName();
                $fileData->move(public_path() . '/img/noticias/', $fileName);
                $noticias->imagen = $fileName;
            }
            $noticias->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    public function indexInformacionAdministrador(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


            $informacion = Informacion::paginate(5);

            return [
                'pagination' => [
                    'total'        => $informacion->total(),
                    'current_page' => $informacion->currentPage(),
                    'per_page'     => $informacion->perPage(),
                    'last_page'    => $informacion->lastPage(),
                    'from'         => $informacion->firstItem(),
                    'to'           => $informacion->lastItem(),
                ],
                'informacion' => $informacion
            ];
    }
  public function eliminar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $noticias = Noticias::findOrFail($request->id);
            $noticias->delete();

            DB::commit();
            return response()->json(['mensaje' => 'Noticia eliminada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Error al eliminar la noticia'], 500);
        }
    }

public function registrarInformacion(Request $request)
{
    if (!$request->ajax()) return redirect('/');

    try {
        DB::beginTransaction();
        $informacion = new Informacion();
        $informacion->titulo = $request->titulo;
        $informacion->contenido = $request->contenido;
        $informacion->fecha = $request->fecha;
        $informacion->idpersona = \Auth::user()->id;

        $informacion->save();

        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al registrar el aviso.');
    }
}

public function indexInformacion(Request $request)
{
    if (!$request->ajax()) return redirect('/');


        $informacion = Informacion::paginate(20);

        return [
            'pagination' => [
                'total'        => $informacion->total(),
                'current_page' => $informacion->currentPage(),
                'per_page'     => $informacion->perPage(),
                'last_page'    => $informacion->lastPage(),
                'from'         => $informacion->firstItem(),
                'to'           => $informacion->lastItem(),
            ],
            'informacion' => $informacion
        ];
}

}
