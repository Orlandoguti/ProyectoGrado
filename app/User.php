<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


    protected $fillable = [
        'id', 'email', 'password','condicion','idrol'
    ];

    public $timestamps = false;

    public function hasRole($role)
    {
        return $this->belongsTo(Rol::class, 'idrol'== $role);
    }

    public function persona()
    {
        return $this->hasOne(Persona::class, 'id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idrol'); // 'idrol' es la clave foránea en la tabla 'users' y 'id' es la clave primaria en la tabla 'roles'
    }

}
