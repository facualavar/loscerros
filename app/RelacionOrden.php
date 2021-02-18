<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class RelacionOrden extends Model
{
    protected $table = 'relacionorden';
	public $timestamps = false;

    protected $fillable = [
    	'Pacientes_Personas_idPersonas',
        'Informes_idInformes',
        'autorizada',
        'numero',
        'fechaIngreso'
    ];

    protected $guarded = [];

}