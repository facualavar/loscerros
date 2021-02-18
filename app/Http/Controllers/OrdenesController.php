<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Redirect;
use Auth;
use Validator;
use DB;
use App\Paciente;
use App\Informe;
use App\Obrassociales;
use DataTables;
use Illuminate\Support\Str;

class OrdenesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ipss()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Ordenes';
            $nbu = Obrassociales::find(1)->nbu;
            return view('ordenes.ipss',compact('seccion','nbu'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }


    public function pami()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Ordenes PAMI';
            $nbu = Obrassociales::find(1)->nbu;
            return view('ordenes.pami',compact('seccion','nbu'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }


    public function nacionales()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Ordenes NACIONALES';
            $nbu = Obrassociales::find(1)->nbu;
            return view('ordenes.nacionales',compact('seccion','nbu'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function deudores()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Ordenes Deudores';

            return view('ordenes.deudores',compact('seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function particulares()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Ordenes Particulares';

            return view('ordenes.particulares',compact('seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function obraMes()
    {
      if (Auth::check())//verifico que este logueado
      {
        $seccion='Ordenes Mensual';
            return view('obras.facturacion',compact('seccion'));
      }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
      }
    }

    public function ordenesIpss(Request $request)
    {
      if (Auth::check())
      {

        if($request['fecha1']!='' and $request['fecha2']!=''){

            $data['data'] = ordenes($request['fecha1'],$request['fecha2'],'1');

            if($data['data']->isEmpty()){
                $data['msg']='Sin coincidencias';
                $data['status']=0;
            }else{
                 $data['status']=1;
            }

            return Response()->json($data);
        }else{
            $data['data']='';
            $data['status']=0;
            $data['msg']='Falta una o ambas fechas';
            return Response()->json($data);
        }

      }else{
        alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
        return Redirect::to('/');
      }
    }


    public function ordenesPami(Request $request)
    {
      if (Auth::check())
      {

        if($request['fecha1']!='' and $request['fecha2']!=''){

            $data['data'] = ordenes($request['fecha1'],$request['fecha2'],'2');

            if($data['data']->isEmpty()){
                $data['msg']='Sin coincidencias';
                $data['status']=0;
            }else{
                 $data['status']=1;
            }

            return Response()->json($data);
        }else{
            $data['data']='';
            $data['status']=0;
            $data['msg']='Falta una o ambas fechas';
            return Response()->json($data);
        }

      }else{
        alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
        return Redirect::to('/');
      }
    }

    public function ordenesNacionales(Request $request)
    {
      if (Auth::check())
      {

        if($request['fecha1']!='' and $request['fecha2']!=''){

            $data['data'] = ordenes($request['fecha1'],$request['fecha2'],'0');

            if($data['data']->isEmpty()){
                $data['msg']='Sin coincidencias';
                $data['status']=0;
            }else{
                 $data['status']=1;
            }

            return Response()->json($data);
        }else{
            $data['data']='';
            $data['status']=0;
            $data['msg']='Falta una o ambas fechas';
            return Response()->json($data);
        }

      }else{
        alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
        return Redirect::to('/');
      }
    }

    public function ordenesParticulares(Request $request)
    {
      if (Auth::check())
      {

        if($request['fecha1']!='' and $request['fecha2']!=''){

            $data['data'] = ordenes($request['fecha1'],$request['fecha2'],'68');

            if($data['data']->isEmpty()){
                $data['msg']='Sin coincidencias';
                $data['status']=0;
            }else{
                 $data['status']=1;
            }

            return Response()->json($data);
        }else{
            $data['data']='';
            $data['status']=0;
            $data['msg']='Falta una o ambas fechas';
            return Response()->json($data);
        }

      }else{
        alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
        return Redirect::to('/');
      }
    }

    public function ordenesDeudores(Request $request)
    {
      if (Auth::check())
      {

        if($request['fecha1']!='' and $request['fecha2']!=''){

            $data['data'] = ordenes($request['fecha1'],$request['fecha2'],'d');

            if($data['data']->isEmpty()){
                $data['msg']='Sin coincidencias';
                $data['status']=0;
            }else{
                 $data['status']=1;
            }

            return Response()->json($data);
        }else{
            $data['data']='';
            $data['status']=0;
            $data['msg']='Falta una o ambas fechas';
            return Response()->json($data);
        }

      }else{
        alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
        return Redirect::to('/');
      }
    }

}
