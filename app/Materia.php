<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Materia extends Authenticatable
{

    protected $table = 'materias';
    protected $fillable = ['id','idcarrera','codigo','materia'];
}