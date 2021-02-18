<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class RelacionAnalisis extends Model
{
    protected $table = 'relacionanalisis';
	public $timestamps = false;

    protected $fillable = [
    	'TiposdeAnalisis_codigo',
        'Pacientes_Personas_idPersonas',
        'Informes_idInformes',
        'muestra',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}