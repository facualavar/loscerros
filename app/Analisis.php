<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Obrassociale
 */
class Analisis extends Model
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