<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListadoDoctores;

class AutoDoctorController extends Controller
{
      public function autocomplete(Request $request){

            $term=$request->term;
            $data=ListadoDoctores::where('matricula','LIKE','%'.$term.'%')
            ->orWhere('nombre', 'LIKE', '%'.$term.'%')
            ->orWhere('apellido', 'LIKE', '%'.$term.'%')
            ->take(5)
            ->get();
            $results=array();
            foreach ($data as $key => $v) {
                $results[]=['value'=>$v->matricula.'-'.$v->apellido.' '.$v->nombre,'matricula'=>$v->matricula,'nombre'=>$v->nombre,'apellido'=>$v->apellido,'idPersonaD'=>$v->Personas_idPersonas];
            }
            return response()->json($results);
        }
}
