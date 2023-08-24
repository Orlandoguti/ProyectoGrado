<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{

    protected $fillable = ['id','idrfid','idpersona','idgrupo','idgenero','estado','asignado','fecha','idregistro','idprocesofaeneo','idfaeneo'];

    public function persona(){
        return $this->belongsTo('App\Persona');
    }


}
