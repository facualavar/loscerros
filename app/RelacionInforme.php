<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class RelacionInforme extends Model
{
    protected $table = 'relacioninforme';
    public $timestamps = false;

    protected $fillable = [
    	'Pacientes_Personas_idPersonas',
        'Informes_idInformes',
        'Doctor_idDoctor',
        'retira',
        'debe',
        'trajo',
        'seña',
        'diagnostico',
        'numOrden',
        'copago',
        'observaciones',
        'afiliado',
        'veterinaria',
        'fechaIngreso'
    ];

    protected $guarded = [];


}