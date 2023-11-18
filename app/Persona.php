<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre','color','num_documento','direccion','telefono','imagen','idcarrera'];

    public function user()
    {
        return $this->hasOne('App\User');
    }


}
