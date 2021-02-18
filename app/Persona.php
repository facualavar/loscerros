<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 */
class Persona extends Model
{
    protected $table = 'personas';

    protected $primaryKey = 'idPersonas';

	public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'DNI',
        'telefono',
        'direccion',
        'email',
        'sexo',
        'fechaNac',
        'edad'
    ];

    protected $guarded = [];
        
}