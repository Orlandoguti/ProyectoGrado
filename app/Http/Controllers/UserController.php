<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\User;
use App\Persona;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $personas = User::leftjoin('personas','users.id','=','personas.id')
            ->leftjoin('roles','users.idrol','=','roles.id')
            ->leftjoin('carreras','personas.idcarrera','=','carreras.id')
            ->select('personas.id','personas.nombre','personas.color','personas.idcarrera','personas.num_documento','personas.direccion','personas.telefono','users.email','users.password','users.condicion','users.idrol','roles.nombre as rol','personas.imagen')
            ->orderBy('personas.id', 'desc')->paginate(10);
        }
        else{
            $personas = User::leftjoin('personas', 'users.id', '=', 'personas.id')
            ->leftjoin('roles', 'users.idrol', '=', 'roles.id')
            ->leftjoin('carreras', 'personas.idcarrera', '=', 'carreras.id')
            ->select('personas.id', 'personas.nombre','personas.color', 'personas.idcarrera', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'users.email', 'users.password', 'users.condicion', 'users.idrol', 'roles.nombre as rol', 'personas.imagen')
            ->where(function ($query) use ($criterio, $buscar) {
                $query->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
                    ->orWhere('roles.nombre', 'like', '%'. $buscar . '%');
            })
            ->orderBy('personas.id', 'desc')
            ->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->color = $request->color;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->idcarrera = $request->idcarrera;
            if ($request->idrol == 2) {
                $persona->color = 'Sin color';
                }else{
                $persona->color = $request->color;
                }
            $fileData = $request->file('imagen');
            if($fileData) { // Check if an image is uploaded
                $fileName = time()."_".$fileData->getClientOriginalName();
                $fileData->move(public_path().'/img/usuarios/', $fileName);
                $persona->imagen = $fileName;
            } else {
                if ($request->idrol == 3) {
                $persona->imagen = 'avatarafiliado.png';
                }else{
                $persona->imagen = 'avatartrabajador.png';
                }
                // If no image is uploaded, set a default image name
            }
            $persona->save();

            $user = new User();
            $user->id = $persona->id;
            $user->idrol = $request->idrol;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $persona = Persona::findOrFail($user->id);
            $persona->nombre = $request->nombre;
            $persona->color = $request->color;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->idcarrera = $request->idcarrera;
            $fileData = $request->file('imagen');
            if(Input::hasfile('imagen')) {
                $fileName = time()."_".$fileData->getClientOriginalName();
                $fileData->move(public_path().'/img/usuarios/', $fileName);
                $persona->imagen = $fileName;
            }
            $persona->save();


            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->email = $request->email;
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
    public function saveExcelUsers(Request $request)
    {
        $path = $request->file('select_users_file')->getRealPath();
        Excel::import(new UsersImport,$path);
    }

    public function obteneridCarrera()
    {
        $idcarreras = Auth::user()->persona->idcarrera;

        return ['idcarreras' => $idcarreras];
    }

    public function obteneridUsuaio()
    {
        $idusuarioget = Auth::user()->persona->id;

        return ['idusuarioget' => $idusuarioget];
    }
}
