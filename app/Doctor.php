<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor
 */
class Doctor extends Model
{
    protected $table = 'doctor';

    protected $primaryKey = 'Personas_idPersonas';

	public $timestamps = false;

    protected $fillable = [
    'Personas_idPersonas',
    'matricula',
    'especialidad'
    ];

    protected $guarded = [];


}