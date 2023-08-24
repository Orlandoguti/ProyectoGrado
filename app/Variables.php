<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
    protected $table = 'variables';
    protected $fillable = ['totalfaeneo','ingresos','egresos'];
}
