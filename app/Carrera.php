<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Carrera extends Authenticatable
{

    protected $table = 'carreras';
    protected $fillable = ['id','nombre','descripcion'];
}