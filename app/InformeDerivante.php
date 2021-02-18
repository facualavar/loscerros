<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Informe
 */
class InformeDerivante extends Model
{
    protected $table = 'informesderivantes';
    protected $primaryKey ='idInformes';
    public $timestamps = false;

    protected $fillable = [
        'idInformes',
        'protocolo',
        'Usuarios_Personas_idPersonas',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}