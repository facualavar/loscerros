<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 */
class ListadoPacientes extends Model
{
    protected $table = 'listadopacientes';
     protected $primaryKey ='Personas_idPersonas';
    public $timestamps = false;

    protected $fillable = [
        'idPersonas',
        'nombre',
        'apellido',
        'DNI',
        'telefono',
        'direccion',
        'email',
        'matricula',
        'pago',
        'seña',
        'debe',
        'trajo',
        'diagnostico',
        'obra',
        'idObrasSociales',
        'fechaIngreso'
        
    ];

    protected $guarded = [];

    public function scopePacients($query,$pacients){
       // dd("scope".$name);
        if (trim($pacients) != "") {
            $query->where('DNI','LIKE','%'.$pacients.'%')
                 ->orwhere('apellido','LIKE','%'.$pacients.'%')
                  ->orwhere('nombre','LIKE','%'.$pacients.'%');
        }
        
    }
    
     public function scopeName($query,$name){
       
       

        if (trim($name) != "") {
            $query->where('DNI','LIKE','%'.$name.'%');
        }

       
    }
}