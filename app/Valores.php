<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obrassociale
 */
class Valores extends Model
{
    protected $table = 'valores';
    protected $primaryKey = 'codigo';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'codigo',
        'nombre',
        'nombreFormal',
        'referencia',
        'unidades'
    ];

    protected $guarded = [];

        
}