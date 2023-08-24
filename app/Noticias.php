<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['id','imagen','titulo','descripcion'];
    public $timestamps = false;

}
