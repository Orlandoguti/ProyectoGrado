<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'password','condicion','idrol'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
