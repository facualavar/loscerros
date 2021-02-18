<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Informe
 */
class Informe extends Model
{
    protected $table = 'informes';
    protected $primaryKey ='idInformes';
    public $timestamps = false;

    protected $fillable = [
        'idInformes',
        'Usuarios_Personas_idPersonas',        
        'estado',
        'protocolo',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}