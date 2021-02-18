<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class LineasFacturas extends Model
{
    protected $table = 'lineasfacturas';

	public $timestamps = false;

    protected $fillable = [
    	'Facturas_idFacturas',
        'cantidad',
        'descripcion',
        'total'
    ];

    protected $guarded = [];

        
}