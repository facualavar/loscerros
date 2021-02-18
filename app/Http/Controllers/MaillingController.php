<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;
use Alert;
use DateTime;
use Redirect;
use App\Informe;
use App\Config;
use App\RelacionInforme;
use App\LineasInformes;
use App\InformeDerivante;
use App\RelacionInformeDerivante;
use App\LineasInformesDerivantes;
use App\Obrassociales;
use App\User;

class MaillingController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id=$request['id'];
        $idP=$request['idP'];

        if (Auth::check()){
        //obtener el mail del paciente
            $email=contactos($idP);

            if($email->email){

                $pacData=personaData($idP);

				$data=Informe::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','relacionanalisis.muestra','tiposdeanalisis.tipo','tiposdeanalisis.referencia','tiposdeanalisis.grupo')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->get();

                $firmaUser=Informe::select('informes.Usuarios_Personas_idPersonas')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->first();

                $firmaImagen=User::find($firmaUser->Usuarios_Personas_idPersonas);
               // $firmaImagen=$firmaImagen->firmaImagen;

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


                $pdf = PDF::loadView('previews.previewMail',['data'=>$data,'result'=>$result,'pac'=>$pac,'doc'=>$doc,'protocolo'=>$id,'os'=>$os->nombre,'fecha'=>$fecha,'firmaImagen'=>$firmaImagen]);

                $pdf->save(env('URL_BASE_FILES').conv_tildes(strtoupper($pacData->apellido)).' '.conv_tildes(strtoupper($pacData->nombre)).' informe_'.$id.'.pdf');

                $pathToFile=env('URL_BASE_FILES').conv_tildes(strtoupper($pacData->apellido)).' '.conv_tildes(strtoupper($pacData->nombre)).' informe_'.$id.'.pdf';

                $laboratorio=Config::where('id',1)->first();
                $content=[
                    'nombre' => $pacData->nombre,
                    'laboratorio' => $laboratorio->nombre,
                    'telefono' => $laboratorio->telefono,
                    'celular' => $laboratorio->celular,
                    'direccion' => $laboratorio->direccion,
                    'facebook' => $laboratorio->facebook,
                    'instagram' => $laboratorio->instagram,
                    'twitter' => $laboratorio->twitter
                ];

                enviar_mail($email->email,$pathToFile,$content);

                 //cambio a estado enviado
                $inf=Informe::where('idInformes',$id)->update(['estado' => 7]);

                $data=array('msg'=>'ok');
                return Response()->json($data);
            }else{
                alert()->warning('El paciente no tiene cargado un email por favor verifique los datos!')->autoclose(3000);
                return Redirect::to('informesList');
            }

        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                Auth::logout();
        }

    }

    public function indexDer(Request $request)
    {
        $id=$request['id'];
        $idP=$request['idP'];

        if (Auth::check()){
        //obtener el mail del paciente
            $email=contactos($idP);
            if($email->email){

                $derData=personaData($idP);

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

                $pdf->save(env('URL_BASE_FILES').$derData->apellido.' '.$derData->nombre.' informederivante_'.$id.'.pdf');

                $pathToFile=env('URL_BASE_FILES').$derData->apellido.' '.$derData->nombre.' informederivante_'.$id.'.pdf';

                $laboratorio=Config::where('id',1)->first();

                $content=[
                    'nombre' => $derData->nombre,
                    'laboratorio' => $laboratorio->nombre,
                    'telefono' => $laboratorio->telefono,
                    'celular' => $laboratorio->celular,
                    'direccion' => $laboratorio->direccion,
                    'facebook' => $laboratorio->facebook,
                    'instagram' => $laboratorio->instagram,
                    'twitter' => $laboratorio->twitter
                ];

                enviar_mail($email->email,$pathToFile,$content);
                //cambio a estado enviado
                $inf=InformeDerivante::where('idInformes',$id)->update(['estado' => 7]);
                $data=array('msg'=>'ok');
                return Response()->json($data);
            }else{
                 $data=array('msg'=>'El derivante no tiene cargado un email por favor verifique los datos!');
                 return Response()->json($data);
            }

        }else{
                alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                Auth::logout();
        }

    }
}
