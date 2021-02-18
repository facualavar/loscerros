<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Persona;
use App\PersonaToken;

class ConsultasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seccion='Consultas';
        $alert = null;

        return view('consultas.index',compact('seccion', 'alert'));
    }

    public function consultaInformes(Request $request){

        $dni = $request->input('dni');
        $codigo = $request->input('codigo');

        $persona = Persona::where('dni', $dni)->first();

        $alert = null;
        $informes = array();

        if($persona){

            $token = PersonaToken::where('persona_id', $persona->idPersonas)->where('token', $codigo)->first();

            if($token){

                $informes =  DB::table('vistainformes')
                        ->selectRaw('Pacientes_Personas_idPersonas,Informes_idInformes, doctor,  CONCAT(fecha, " ", hora) AS fecha, estado, observaciones')
                        ->where('Pacientes_Personas_idPersonas', $persona->idPersonas)
                        ->get();

                foreach($informes as $informe){
                    $rutaImprimir = route('informepdfirma',['id'=>$informe->Informes_idInformes,'idP'=>$informe->Pacientes_Personas_idPersonas, 'code'=> $codigo]);

                    $informe->imprimir = $rutaImprimir;
                }

                $seccion='Consultas - Informes';
                return view('consultas.informes',compact('seccion', 'persona', 'informes'));

            }else{
                $alert['class'] = 'danger';
                $alert['msg'] = 'Codigo Incorrecto';

                $seccion='Consultas';
                return view('consultas.index',compact('seccion', 'alert'));
            }
        }else{
            $alert['class'] = 'danger';
            $alert['msg'] = 'Dni Incorrecto';

            $seccion='Consultas';
            return view('consultas.index',compact('seccion', 'alert'));
        }
    }
}