<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use DateTime;
use Auth;
use Alert;
use Redirect;
use Dompdf\Dompdf;
use App\Informe;
use App\Persona;
use App\RelacionInforme;
use App\LineasInformes;
use App\InformeDerivante;
use App\RelacionInformeDerivante;
use App\RelacionAnalisisDerivante;
use App\LineasInformesDerivantes;
use App\Obrassociales;
use App\User;
use App\PersonaToken;

class PdfController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$idP, $code = '')
    {
        $personaToken = PersonaToken::where('persona_id', $idP)->where('token', $code)->first();
        
        if (Auth::check() || $personaToken){

            $data=Informe::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','relacionanalisis.muestra','tiposdeanalisis.tipo','tiposdeanalisis.referencia','tiposdeanalisis.grupo')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->get();

            $fecha= Informe::select(DB::raw('date_format(fechaIngreso,"%d/%m/%Y") as fecha'))
                    ->where('informes.idInformes','=',$id)
                    ->first()->fecha;

            $result=LineasInformes::find($id);

            if($result->linea!=''){
                $result=json_decode($result->linea);
            }

            $pac=RelacionInforme::select('personas.nombre','personas.apellido','personas.DNI','pacientes.ObrasSociales_idObrasSociales','personas.edad','personas.DNI')
                                ->join('pacientes','pacientes.Personas_idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

            $os=Obrassociales::select('nombre')->where('idObrasSociales',$pac->ObrasSociales_idObrasSociales)->first();

            $doc=RelacionInforme::select('personas.nombre','personas.apellido')
                                ->join('doctor','doctor.Personas_idPersonas','=','relacioninforme.Doctor_idDoctor')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Doctor_idDoctor')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

             $firmaUser=Informe::select('informes.Usuarios_Personas_idPersonas')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->first();

            $firmaImagen=User::find($firmaUser->Usuarios_Personas_idPersonas);
            //$firmaImagen=$firmaImagen->firmaImagen;

            $pdf = PDF::loadView('previews.preview',['data'=>$data,'result'=>$result,'pac'=>$pac,'doc'=>$doc,'protocolo'=>$id,'os'=>$os->nombre,'fecha'=>$fecha,'firmaImagen'=>$firmaImagen]);
            PDF::setOptions(['isHtml5ParserEnabled' => true]);
            //$pdf->set_option('isHtml5ParserEnabled', true);
            return $pdf->stream();
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }

    public function indexI($id, $idP, $code = '')
    {
    	$personaToken = PersonaToken::where('persona_id', $idP)->where('token', $code)->first();
    
        if (Auth::check() || $personaToken) {

            $data = Informe::select('tiposdeanalisis.nombre', 'tiposdeanalisis.codigo', 'relacionanalisis.muestra', 'tiposdeanalisis.tipo', 'tiposdeanalisis.referencia', 'tiposdeanalisis.grupo')
                ->join('relacionanalisis', 'relacionanalisis.Informes_idInformes', '=', 'informes.idInformes')
                ->join('tiposdeanalisis', 'tiposdeanalisis.codigo', '=', 'relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes', '=', $id)
                ->get();

            $fecha = Informe::select(DB::raw('date_format(fechaIngreso,"%d/%m/%Y") as fecha'))
                ->where('informes.idInformes', '=', $id)
                ->first()->fecha;

            $result = LineasInformes::find($id);

            if($result->linea!=''){
                $result=json_decode($result->linea);
            }

            $pac = RelacionInforme::select('personas.nombre', 'personas.apellido', 'personas.DNI', 'pacientes.ObrasSociales_idObrasSociales','personas.edad','personas.DNI')
                ->join('pacientes', 'pacientes.Personas_idPersonas', '=', 'relacioninforme.Pacientes_Personas_idPersonas')
                ->join('personas', 'personas.idPersonas', '=', 'relacioninforme.Pacientes_Personas_idPersonas')
                ->where('relacioninforme.Informes_idInformes', $id)
                ->first();


            $os = Obrassociales::select('nombre')->where('idObrasSociales', $pac->ObrasSociales_idObrasSociales)->first();

            $doc = RelacionInforme::select('personas.nombre', 'personas.apellido')
                ->join('doctor', 'doctor.Personas_idPersonas', '=', 'relacioninforme.Doctor_idDoctor')
                ->join('personas', 'personas.idPersonas', '=', 'relacioninforme.Doctor_idDoctor')
                ->where('relacioninforme.Informes_idInformes', $id)
                ->first();

            $firmaUser = Informe::select('informes.Usuarios_Personas_idPersonas')
                ->join('relacionanalisis', 'relacionanalisis.Informes_idInformes', '=', 'informes.idInformes')
                ->join('tiposdeanalisis', 'tiposdeanalisis.codigo', '=', 'relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes', '=', $id)
                ->first();

            $firmaImagen = User::find($firmaUser->Usuarios_Personas_idPersonas);
            ///$firmaImagen = $firmaImagen->firmaImagen;

            $pdf = PDF::loadView('previews.previewMail', ['data' => $data, 'result' => $result, 'pac' => $pac, 'doc' => $doc, 'protocolo' => $id, 'os' => $os->nombre, 'fecha' => $fecha, 'firmaImagen' => $firmaImagen]);

            return $pdf->stream();
        } else {
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function ordenes($fecha1,$fecha2,$obra){
        $data = ordenes($fecha1,$fecha2,$obra);
        $pdf = PDF::loadView('ordenes.preview', ['data' => $data, 'fecha1' => $fecha1, 'fecha2' => $fecha2,'obra'=>$obra]);
        return $pdf->stream();
    }

    public function tapa($id,$idP)
    {
        if (Auth::check()){
            $pac=RelacionInforme::select('personas.nombre','personas.apellido','obrassociales.nombre as obra','relacioninforme.diagnostico','personas.edad','personas.DNI')
                                ->join('pacientes','pacientes.Personas_idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->join('obrassociales','obrassociales.idObrasSociales','=','pacientes.ObrasSociales_idObrasSociales')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

            $doc=RelacionInforme::select('personas.nombre','personas.apellido','doctor.matricula')
                                ->join('doctor','doctor.Personas_idPersonas','=','relacioninforme.Doctor_idDoctor')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Doctor_idDoctor')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

            $fecha= Informe::select(DB::raw('date_format(fechaIngreso,"%d/%m/%Y") as fecha'))
                    ->where('informes.idInformes','=',$id)
                    ->first()->fecha;

            $pdf = PDF::loadView('previews.tapa',['pac'=>$pac,'doc'=>$doc,'id'=>$id,'fecha'=>$fecha]);
            return $pdf->stream();
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }

    public function tapaV($id,$idP)
    {
        if (Auth::check()){
            $pac=RelacionInforme::select('personas.nombre','personas.apellido','obrassociales.nombre as obra','relacioninforme.diagnostico')
                                ->join('pacientes','pacientes.Personas_idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->join('obrassociales','obrassociales.idObrasSociales','=','pacientes.ObrasSociales_idObrasSociales')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

            $doc=RelacionInforme::select('personas.nombre','personas.apellido')
                                ->join('doctor','doctor.Personas_idPersonas','=','relacioninforme.Doctor_idDoctor')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Doctor_idDoctor')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

            $fecha= Informe::select(DB::raw('date_format(fechaIngreso,"%d-%m-%Y") as fecha'))
                    ->where('informes.idInformes','=',$id)
                    ->first()->fecha;

            $pdf = PDF::loadView('previews.tapaVet',['pac'=>$pac,'doc'=>$doc,'id'=>$id,'fecha'=>$fecha]);
            return $pdf->stream();
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }

    public function tapaDer($id,$idP)
    {
        if (Auth::check()){
            $doc=RelacionInformeDerivante::select('personas.nombre','personas.apellido')
                                ->join('derivantes','derivantes.Personas_idPersonas','=','relacioninformederivante.Derivantes_Personas_idPersonas')
                                ->join('personas','personas.idPersonas','=','relacioninformederivante.Derivantes_Personas_idPersonas')
                                ->where('relacioninformederivante.Informes_idInformes',$id)
                                ->first();

            $pdf = PDF::loadView('previews.tapaDer',['doc'=>$doc]);
            return $pdf->stream();
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }

    public function derivanteindex($id,$idP)
    {
        if (Auth::check()){
            $data=InformeDerivante::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','tiposdeanalisis.tipo')
                ->join('relacionanalisisderivante','relacionanalisisderivante.Informes_idInformes','=','informesderivantes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisisderivante.TiposdeAnalisis_codigo')
                ->where('informesderivantes.idInformes','=',$id)
                ->get();

            $prot=InformeDerivante::select('protocolo')
                ->where('informesderivantes.idInformes','=',$id)
                ->first()->protocolo;

            $result=LineasInformesDerivantes::find($id);

            if($result->linea!=''){
                $result=json_decode($result->linea);
            }

            $der=RelacionInformeDerivante::select('personas.nombre','personas.apellido','derivantes.matricula')
                                ->join('derivantes','derivantes.Personas_idPersonas','=','relacioninformederivante.Derivantes_Personas_idPersonas')
                                ->join('personas','personas.idPersonas','=','relacioninformederivante.Derivantes_Personas_idPersonas')
                                ->where('relacioninformederivante.Informes_idInformes',$id)
                                ->first();

            $pdf = PDF::loadView('previews.previewderivante',['data'=>$data,'result'=>$result,'der'=>$der,'protocolo'=>$prot]);

            return $pdf->stream();
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }

    public function facturacion(Request $request){

        if (Auth::check()){
            $data=RelacionAnalisisDerivante::select(DB::raw('personas.idPersonas,date_format(relacionanalisisderivante.fechaIngreso,"%d-%m-%y") as fecha,personas.nombre,personas.apellido,tiposdeanalisis.nombre as determinacion, tiposdeanalisis.precioDerivantes as precio,relacioninformederivante.muestra, relacionanalisisderivante.Informes_idInformes'))
                                    ->join('tiposdeanalisis','relacionanalisisderivante.TiposdeAnalisis_codigo','=','tiposdeanalisis.codigo')
                                    ->join('personas','personas.idPersonas','=','relacionanalisisderivante.Derivantes_Personas_idPersonas')
                                    ->join('relacioninformederivante','relacioninformederivante.Informes_idInformes','=','relacionanalisisderivante.Informes_idInformes')
                                    ->where(DB::raw('date_format(relacionanalisisderivante.fechaIngreso,"%m")'),'=',$request['mes'])
                                    ->orderBy('relacionanalisisderivante.fechaIngreso','desc')
                                    ->get();

            if(count($data)>0){
                $mes = array (1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
                $periodo=$mes[(int)$request['mes']].' '.$request['año'];

                $pdf = PDF::loadView('derivantes.facturacion.index',compact('data','periodo'));

                return $pdf->stream();
            }else{
                 alert()->warning('No hay determinaciones cargadas en el periodo elegido')->autoclose(3000);
                return Redirect::to('facturacion');
            }
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }

    public function facturacionDerivante(Request $request){

        if (Auth::check()){
            $data=RelacionAnalisisDerivante::select(DB::raw('count(tiposdeanalisis.codigo) as cant, date_format(relacionanalisisderivante.fechaIngreso,"%d-%m-%y") as fecha,tiposdeanalisis.nombre as determinacion, tiposdeanalisis.precioDerivantes as preciounidad, (tiposdeanalisis.precioDerivantes*count(tiposdeanalisis.codigo))  as precioparcial'))
                                    ->join('tiposdeanalisis','relacionanalisisderivante.TiposdeAnalisis_codigo','=','tiposdeanalisis.codigo')
                                    ->join('personas','personas.idPersonas','=','relacionanalisisderivante.Derivantes_Personas_idPersonas')
                                    ->where(DB::raw('date_format(relacionanalisisderivante.fechaIngreso,"%m")'),'=',$request['mes'])
                                    ->where('relacionanalisisderivante.Derivantes_Personas_idPersonas','=',$request['idPersona'])
                                    ->groupBy(DB::raw('tiposdeanalisis.codigo'))
                                    ->get();

            if(count($data)>0){
                $mes = array (1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
                $periodo=$mes[(int)$request['mes']].' '.$request['año'];
                $derivante=Persona::find($request['idPersona']);
                $muestra=RelacionInformeDerivante::select('muestra')->where('Derivantes_Personas_idPersonas',$request['idPersona'])->first();
                $pdf = PDF::loadView('derivantes.facturacion.indexDer',compact('data','periodo','derivante','muestra'));

                return $pdf->stream();
            }else{
                 alert()->warning('No hay determinaciones cargadas en el periodo elegido para el derivante ingresado')->autoclose(3000);
                return Redirect::to('facturacion');
            }
        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }
    }
}
