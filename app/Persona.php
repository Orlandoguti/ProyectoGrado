<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre','apellidoP','apellidoM','marca','num_documento','direccion','telefono','imagen','idcargo'];

    public function user()
    {
        return $this->hasOne('App\User');
    }


}
