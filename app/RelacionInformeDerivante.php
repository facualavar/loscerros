<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class RelacionInformeDerivante extends Model
{
    protected $table = 'relacioninformederivante';
    public $timestamps = false;

    protected $fillable = [
        'Informes_idInformes',
        'Derivantes_Personas_idPersonas',
        'muestra',
        'fechaIngreso'
    ];

    protected $guarded = [];

        
}