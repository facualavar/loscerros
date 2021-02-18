<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lineasinforme
 */
class LineasInformes extends Model
{   
    
    protected $table = 'lineasinformes';
    protected $primaryKey = 'Informes_idInformes';
    public $timestamps = false;

    protected $guarded = [];

        
}