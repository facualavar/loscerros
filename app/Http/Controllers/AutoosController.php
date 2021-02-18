<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obrassociales;


class AutoosController extends Controller
{
   public function autocomplete(Request $request){

            $term=$request->term;
            $data=Obrassociales::where('idObrasSociales','LIKE','%'.$term.'%')
            ->orWhere('nombre', 'LIKE', '%'.$term.'%')
            ->take(10)
            ->get();
            $results=array();
            foreach ($data as $key => $v) {
                $results[]=['id'=>$v->idObrasSociales,'value'=>$v->nombre];
            }
            return response()->json($results);
        }
}
