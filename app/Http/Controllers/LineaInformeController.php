<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Alert;
use Validator;
use Auth;
use App\LineasInformes;

class LineaInformeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //ANTIBIOGRAMAS
        $sensible=''; $resistente=''; $sensibleI='';
            if (!empty($_POST["antiS"])){
                foreach ($_POST["antiS"] as $c) {

                    if (!empty($c)){
                        $sensible.=$c.'<br>';

                        }
                }
                $request['antibiogramaS']=$sensible;
            }

            if (!empty($_POST["antiSI"])){
                foreach ($_POST["antiSI"] as $c) {

                    if (!empty($c)){
                        $sensibleI.=$c.'<br>';
                    }
                }
                $request['antibiogramaSI']=$sensibleI;
            }

            if (!empty($_POST["antiR"])){
                foreach ($_POST["antiR"] as $c) {

                    if (!empty($c)){
                        $resistente.=$c.'<br>';
                        }
                }
                $request['antibiogramaR']=$resistente;
            }
        //busco si existe la linea del informe cargada
        $lininf = LineasInformes::find($request['Informes_idInformes']);

        if($lininf){
            $arrayS = array_except($request->all(), ['Informes_idInformes','Informes_Pacientes_Personas_idPersonas','Informes_Usuarios_Personas_idPersonas', 'mode','antiS','antiSI','antiR']);
            $lininf->fill($arrayS);
            $lininf->save();
        }else{

            $arrayS = array_except($request->all(), ['mode']);
            Lineasinformes::create($arrayS);
        }

         alert()->success('Resultados cargados correctamente')->autoclose(3000);
                return Redirect::to('informesList');
    }
}
