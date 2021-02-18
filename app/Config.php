<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Informe
 */
class Config extends Model
{
    protected $table = 'config';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'celular',
        'facebook',
        'twitter',
        'instagram'
    ];

    protected $guarded = [];

        
}