<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor
 */
class Derivantes extends Model
{
    protected $table = 'derivantes';

    protected $primaryKey = 'Personas_idPersonas';

	public $timestamps = false;

    protected $fillable = [
    'Personas_idPersonas',
    'matricula'
    ];

    protected $guarded = [];


}