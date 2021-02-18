<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 */
class Vistausuario extends Model
{
    protected $table = 'vistausuarios';

    protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'Roles_idRoles',
        'estado',
        'rol',
        'nombreestado'
    ];

    protected $guarded = [];
        
}