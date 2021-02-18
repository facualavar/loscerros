<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiposdeanalisis;
use DB;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request){

            $term=$request->term;
            $data=DB::table('autocompletes')
                    ->where('atajos','LIKE',$term)
                    ->orWhere('valor','LIKE',$term.'%')
                    ->take(2)
                    ->get();

            $results=array();
            foreach ($data as $key => $v) {
                $results[]=['id'=>$v->id,'value'=>$v->valor];
            }
            return response()->json($results);
        }
}
