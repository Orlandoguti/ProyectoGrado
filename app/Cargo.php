<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $fillable = ['id','nombre','descripcion','condicion'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

}
