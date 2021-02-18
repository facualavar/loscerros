<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposdeanalisi
 */
class Tiposdeanalisis extends Model
{
    protected $table = 'tiposdeanalisis';

    protected $primaryKey = 'codigo';

	public $timestamps = false;
        public $incrementing = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'UB',
        'NBU',
        'tipo',
        'referencia',
        'metodo',
        'precioDerivantes',
        'grupo'
    ];

    protected $guarded = [];

        
}