<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasEgresos extends Model
{
    protected $table = 'clasegresos';
    protected $fillable = ['id','nombre','detalle'];

}
