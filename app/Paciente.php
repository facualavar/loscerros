<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paciente
 */
class Paciente extends Model
{
    protected $table = 'pacientes';
	public $timestamps = false;
    protected $primaryKey = 'Personas_idPersonas';
    protected $fillable = [
        'Personas_idPersonas',
        'ObrasSociales_idObrasSociales',
        /* 'afiliado', */
        'diagnostico',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}