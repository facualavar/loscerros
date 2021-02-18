<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class PersonaToken extends Model
{
    protected $table = 'persona_token';

    protected $fillable = [
    	'id',
        'perdona_id',
        'token'
    ];

    protected $guarded = [];

        
}