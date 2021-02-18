<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class RelacionDoctor extends Model
{
    protected $table = 'relaciondoctor';
    public $timestamps = false;

    protected $fillable = [
    	'Pacientes_Personas_idPersonas',
        'Doctor_Personas_idPersonas',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}