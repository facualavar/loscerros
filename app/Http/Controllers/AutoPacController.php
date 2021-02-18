<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListadoPacientes;

class AutoPacController extends Controller
{
        public function autocomplete(Request $request){

            $term=$request->term;
            $data=ListadoPacientes::where('DNI','LIKE','%'.$term.'%')
            ->orWhere('nombre', 'LIKE', '%'.$term.'%')
            ->orWhere('apellido', 'LIKE', '%'.$term.'%')
            ->take(5)
            ->get();
            $results=array();
            foreach ($data as $key => $v) {
                $results[]=['value'=>$v->DNI.'-'.$v->apellido.' '.$v->nombre,'dni'=>$v->DNI,'nombre'=>$v->nombre,'apellido'=>$v->apellido,'os'=>$v->osnombre,'idos'=>$v->idObrasSociales,'idPersona'=>$v->Personas_idPersonas,'afiliado'=>$v->afiliado];
            }
            return response()->json($results);
        }
}
