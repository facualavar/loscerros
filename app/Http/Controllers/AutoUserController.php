<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AutoUserController extends Controller
{
        public function autocomplete(Request $request){

            $term=$request->term;
            $data=User::where('name','LIKE','%'.$term.'%')
            ->take(5)
            ->get();
            $results=array();
            foreach ($data as $key => $v) {
                $results[]=['value'=>$v->name,'id'=>$v->id];
            }
            return response()->json($results);
        }
}
