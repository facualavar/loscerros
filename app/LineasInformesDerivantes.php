<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lineasinforme
 */
class LineasInformesDerivantes extends Model
{   
    
    protected $table = 'lineasinformesderivantes';
    protected $primaryKey = 'Informes_idInformes';
    public $timestamps = false;

    protected $guarded = [];

        
}