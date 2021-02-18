<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class RelacionAnalisisDerivante extends Model
{
    protected $table = 'relacionanalisisderivante';
	public $timestamps = false;

    protected $fillable = [
    	'TiposdeAnalisis_codigo',
        'Derivantes_Personas_idPersonas',
        'Informes_idInformes',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}