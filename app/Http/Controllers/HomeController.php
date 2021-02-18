<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seccion = 'Inicio';
        $informes =  DB::table('informes')->select(DB::raw('count(idInformes) as cantInf'))->get();
        $informes= $informes[0]->cantInf;

        $pacientes =  DB::table('pacientes')->select(DB::raw('count(Personas_idPersonas) as cantPac'))->get();
        $pacientes = $pacientes[0]->cantPac;

        $doctores =  DB::table('doctor')->select(DB::raw('count(Personas_idPersonas) as cantDoc'))->get();
        $doctores = $doctores[0]->cantDoc;

        $usuarios =  DB::table('vistausuarios')->where('estado',1)->get();

        return view('home',compact('seccion','informes','pacientes','doctores','usuarios'));
    }
}
