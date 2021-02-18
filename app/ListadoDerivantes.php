<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 */
class ListadoDerivantes extends Model
{
    protected $table = 'listadoderivantes';
    protected $primaryKey ='Personas_idPersonas';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'Personas_idPersonas',
        'matricula'        
    ];

    protected $guarded = [];

    /* public function scopeDoctors($query,$doctors){
        if (trim($doctors) != "") {
            $query->where('nombre','LIKE','%'.$doctors.'%')
                  ->orwhere('apellido','LIKE','%'.$doctors.'%')
                   ->orwhere('matricula','LIKE',$doctors);
        }
        
    } */
}