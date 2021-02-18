<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiposdeanalisis;

class AutocompleteCodigoController extends Controller
{
    public function autocomplete(Request $request){

            $term=$request->term;
            $data=Tiposdeanalisis::where('codigo','LIKE','%'.$term.'%')
            ->orWhere('nombre', 'LIKE', '%'.$term.'%')
            ->orWhere('tipo', 'LIKE', '%'.$term.'%')
            ->take(10)
            ->get();
            $results=array();
            foreach ($data as $key => $v) {
                $results[]=['id'=>$v->codigo,'value'=>$v->nombre,'otro'=>$v->UB];
            }
            return response()->json($results);
        }
}
