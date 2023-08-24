<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class DetalleLista extends Model
{

    protected $fillable = [
        'id', 'idpersona', 'detalle','fecha'
    ];

    public function persona(){
        return $this->belongsTo('App\Persona');
    }
}
