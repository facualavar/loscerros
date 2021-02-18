<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class Factura extends Model
{
    protected $table = 'facturas';

    protected $primaryKey = 'idFacturas';

	public $timestamps = false;

    protected $fillable = [
        'Pacientes_Personas_idPersonas',
        'fechaVencimiento',
        'fechaInicio',
        'fecha',
        'numero',
        'cai',
        'cuit'
    ];

    protected $guarded = [];

        
}