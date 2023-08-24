<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $table = 'informaciones';
    protected $fillable = ['titulo','contenido'];
    public $timestamps = false;

}
