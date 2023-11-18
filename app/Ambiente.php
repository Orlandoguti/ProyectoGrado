<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $table = 'ambientes';
    protected $fillable = ['id','nombre','capacidad','tipo','accesorio'];
}
