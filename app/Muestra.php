<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class Muestra extends Model
{
    protected $table = 'muestras';

    protected $primaryKey = 'idMuestras';

	public $timestamps = false;

    protected $fillable = [
        'Personas_idPersonas',
        'nombre'

    ];

    protected $guarded = [];

        
}