<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 */
class ListadoDoctores extends Model
{
    protected $table = 'listadodoctores';
    protected $primaryKey ='Personas_idPersonas';
    public $timestamps = false;

    protected $fillable = [
        'Personas_idPersonas',
        'matricula',
        'especialidad',
        'idPersonas',
        'nombre',
        'apellido',
        'DNI',
        'telefono',
        'direccion',
        'email',
        'sexo',
        'fechaNac'
        
    ];

    protected $guarded = [];

    public function scopeDoctors($query,$doctors){
        if (trim($doctors) != "") {
            $query->where('nombre','LIKE','%'.$doctors.'%')
                  ->orwhere('apellido','LIKE','%'.$doctors.'%')
                   ->orwhere('matricula','LIKE',$doctors);
        }
        
    }
}