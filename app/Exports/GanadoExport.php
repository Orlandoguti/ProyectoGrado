<?php
namespace App\Http\Controllers;
namespace App\Exports;

use App\User;
use App\Persona;
use App\Lista;
use App\Rfid;
use App\Genero;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GanadoExport implements FromView, ShouldAutoSize
{
    protected $date1, $date2, $buscar,$festado;

    function __construct($date1,$date2,$buscar,$festado) {
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->buscar = $buscar;
        $this->festado = $festado;
 }
     public function view(): View
    {
        if ($this->date1 != '' && $this->date2 != '' && $this ->buscar != '' && $this ->festado != '' || $this->buscar == '' && $this->festado == '' && $this->date1 != '' && $this->date2 != '') {
            return view('exports.ganadoexcel', [
                'rfids' => DB::table('rfids')
                    ->join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->whereBetween('rfids.fecha', [$this->date1, $this->date2])
                    ->where(function ($query) {
                        $query->where('rfids.estado', '=',$this->festado);
                    })
                    ->orderByDesc('rfids.created_at')
                    ->orderBy('rfids.estado')
                    ->orderBy('rfids.idgrupo')
                    ->get(),
                    'total_estado0' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where('estado', 0)->whereBetween('fecha', [$this->date1, $this->date2])->count(),
                    'total_estado1' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where('estado', 1)->whereBetween('fecha', [$this->date1, $this->date2])->count(),
                    'total_estado2' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where('estado', 2)->whereBetween('fecha', [$this->date1, $this->date2])->count()
            ]);
        } else {
            return view('exports.ganadoexcel', [
                'rfids' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where(function ($query) {
                        $query->where('rfids.estado', '=',$this->festado);
                    })
                    ->orderBy('rfids.created_at', 'desc')
                    ->orderBy('rfids.estado', 'desc')->get(),

                    'total_estado0' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where('estado', 0)->count(),
                    'total_estado1' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where('estado', 1)->count(),
                    'total_estado2' => Rfid::join('personas', 'rfids.idpersona', '=', 'personas.id')
                    ->join('generos', 'rfids.idgenero', '=', 'generos.id')
                    ->join('grupos', 'rfids.idgrupo', '=', 'grupos.id')
                    ->select('rfids.id', 'rfids.idrfid', 'personas.id as idpersona', 'personas.nombre', 'generos.nombre as gnombre', 'grupos.nombre as grunombre', 'personas.marca', 'personas.num_documento', 'personas.direccion', 'personas.telefono', 'rfids.estado', 'rfids.fecha')
                    ->where(function ($query) {
                        $query->where('personas.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('generos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('grupos.nombre', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.marca', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.num_documento', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.direccion', 'like', '%' . $this->buscar . '%')
                            ->orWhere('personas.telefono', 'like', '%' . $this->buscar . '%');
                    })
                    ->where('estado', 2)->count()
            ]);
        }
    }
}
