<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{

    protected $fillable = [
        'id', 'idpersona', 'estado','cantidad','fecha'
    ];

    public function persona(){
        return $this->belongsTo('App\Persona');
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'nombre');
    }


}
