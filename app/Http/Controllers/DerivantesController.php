<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Redirect;
use Alert;
use Validator;
use Carbon\Carbon;
use App\InformeDerivante;
use App\LineasInformesDerivantes;
use App\Persona;
use App\Derivantes;
use App\Listadoderivantes;
use App\RelacionAnalisisDerivante;
use App\RelacionInformeDerivante;
use App\Tiposdeanalisis;

class DerivantesController extends Controller
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
      if (Auth::check())//verifico que este logueado
      {
        $seccion='Derivantes';
            return view('derivantes.index',compact('seccion'));
      }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
      }
    }

    public function derivante(Request $request)
    {

    if (Auth::check()){

        $validator = Validator::make($request->all(), [
            'apellidoD' => 'required',
            'nombreD' => 'required',
            'matriculaD' =>'required',
        ]);

        if ($validator->fails()) {
             $data=array('validation' =>'Faltan completar datos del derivante!');
            return Response()->json($data);
        }

       $aux=0;

       $datos=DB::table('derivantes')
            ->select(DB::raw('matricula'))
            ->where('matricula',$request['matriculaD'])
            ->get();

       foreach ($datos as $k) {
          $aux=$k->matricula;
       }

      if($aux!=0){
            //obtengo el id del doctor cuyo matricula pertenezca
             $datos=DB::table('derivante')
            ->select(DB::raw('Personas_idPersonas'))
            ->where('matricula',$aux)
            ->get();

            foreach ($datos as $k) {
                  $idPersona=$k->Personas_idPersonas;
            }

            $data=array('nombre'=>$request['nombreD'],
                   'apellido'=>$request['apellidoD'],
                   'matricula'=> $request['matriculaD'],
                   'idPersonaD'=>$idPersona,
                   'msg' =>'El derivante ya existe en la base de datos, sus datos se muestran abajo',
                   'validation' => ''
                    );
            return Response()->json($data);
       }else{
         Persona::create([
            'nombre'=>$request['nombreD'],
            'apellido'=>$request['apellidoD'],
            'email'=>$request['email']
            ]);

          $idPersona=Persona::all()->last();
          $idPersona=$idPersona->idPersonas;

           Derivantes::create([
            'Personas_idPersonas'=>$idPersona,
            'matricula'=> $request['matriculaD'],
            ]);
        $data=array('nombre'=>$request['nombreD'],
                   'apellido'=>$request['apellidoD'],
                   'matricula'=> $request['matriculaD'],
                   'idPersonaD'=>$idPersona,
                   'msg' => '',
                   'validation' => ''
                    );
        return Response()->json($data);
        }
    }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function store(Request $request)
    {

      if (Auth::check())//verifico que este logueado
      {
          //capturo valores de los inputs hidden
          $matricula=$request['matricula1'];
          $idPersonaD=$request['idPersonaD'];
          $derivante=Persona::find($idPersonaD);

          //controlo los datos obligatorios
          if(!isset($_POST["codigo"])){
            alert()->warning('Debe ingresar al menos un codigo de analisis')->autoclose(3000);
                            return Redirect::to('derivantes');
          }

          if(!$matricula){
            alert()->warning('Debe ingresar datos del derivante')->autoclose(3000);
                            return Redirect::to('derivantes');
          }

          if(!$request['muestra']){
            alert()->warning('Debe ingresar el n° de muestra')->autoclose(3000);
                            return Redirect::to('derivantes');
          }

          if ($request['fechaIngreso']!="")
             $fechaIngreso=$request['fechaIngreso'];
          else
            $fechaIngreso=date('Y-m-d H:i:s');

        //armo el numero de protocolo
        $protocolo=date('ymd').'-'.$derivante->apellido.'-'.$request['muestra'];

          InformeDerivante::create([
            'protocolo' => $protocolo,
            'Usuarios_Personas_idPersonas'=>Auth::user()->id,
            'fechaIngreso'=>$fechaIngreso,
          ]);

          foreach ($_POST["codigo"] as $c) {

            if (!empty($c)){

            RelacionAnalisisDerivante::create([
                'TiposdeAnalisis_codigo'=>$c,
                'Derivantes_Personas_idPersonas'=>$idPersonaD,
                'Informes_idInformes'=>InformeDerivante::all()->last()->idInformes,
                'fechaIngreso'=>$fechaIngreso,
               ]);
                    }
           }

            RelacionInformeDerivante::create([
                'Informes_idInformes'=>InformeDerivante::all()->last()->idInformes,
                'Derivantes_Personas_idPersonas'=>$idPersonaD,
                'muestra'=>$request['muestra'],
                'fechaIngreso'=>$fechaIngreso
            ]);

            LineasInformesDerivantes::create([
                'Informes_idInformes'=>InformeDerivante::all()->last()->idInformes,
                'Informes_Derivantes_Personas_idPersonas'=>$idPersonaD,
                'Informes_Usuarios_Personas_idPersonas'=>Auth::user()->id
           ]);

            Alert::success('Analisis Cargados Correctamente')->autoclose(3000);
                        return Redirect::to('derivantes');

            }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
            }
    }

    public function result()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion='Derivantes';
            $data =  DB::table('vistaderivantesresultados')->get();
            return view('derivantes.derivantesResult',compact('data','seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function list()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion='Derivantes';
            $data =  DB::table('vistainformesderivantes')->get();
            return view('derivantes.derivantesList',compact('data','seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function agregar($id,$idP)
    {
          if (Auth::check()){
            $seccion = 'Editar Análisis';
            $data=InformeDerivante::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo')
                ->join('relacionanalisisderivante','relacionanalisisderivante.Informes_idInformes','=','informesderivantes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisisderivante.TiposdeAnalisis_codigo')
                ->where('informesderivantes.idInformes','=',$id)
                ->get();

            return view('derivantes.agregar.index',compact('seccion','data','id','idP'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }

    }

    public function agregarStore(Request $request){
        if (Auth::check()){

            DB::table('relacionanalisisderivante')->where('Informes_idInformes', $request['Informes_idInformes'])->delete();

           //controlo los datos obligatorios
            if(!isset($_POST["codigo"])){
                alert()->warning('Debe ingresar al menos un codigo de analisis')->autoclose(3000);
                                return Redirect::to('agregarDer/'.$request['Informes_idInformes'].'/'.$request['Informes_Pacientes']);
            }
            foreach ($_POST["codigo"] as $c) {

                if (!empty($c)){
                    RelacionAnalisisDerivante::create([
                            'TiposdeAnalisis_codigo'=>$c,
                            'Derivantes_Personas_idPersonas'=>$request['Derivantes_Personas_idPersonas'],
                            'Informes_idInformes'=>$request['Informes_idInformes'],
                            'fechaIngreso'=>date('Y-m-d H:i:s'),
                    ]);
                }
            }

            Alert::success('Análisis cargados correctamente')->autoclose(3000);
            return Redirect::to('derivantesList');
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function listado(){
      if (Auth::check())
      {
        $seccion='Derivantes Listado';
        $data=Derivantes::join('personas','personas.idPersonas','=','derivantes.Personas_idPersonas')->get();
            return view('derivantes.listado.index',compact('seccion','data'));
      }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
      }
    }

    public function edit($id){
         if (Auth::check()){
            $seccion='Editar Derivantes';
            $data = Listadoderivantes::find($id);
            return view('derivantes.edit',compact('data','seccion'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function update(Request $request,$id){

        if (Auth::check()){

            $validator = Validator::make($request->all(), [
                'nombre'=>'required',
                'apellido'=>'required',
                'matricula'=> 'required'
            ]);

            if ($validator->fails()) {
                alert()->warning('Faltan completar datos del derivante!');
                return Redirect::to('derivanteEdit/'.$id);
            }

            Persona::where('idPersonas',$id)->update(['nombre' =>$request['nombre'],'apellido' =>$request['apellido'],'email'=>$request['email']]);
            Derivantes::where('Personas_idPersonas',$id)->update(['matricula'=>$request['matricula']]);
            Alert::success('El derivante se guardo correctamente')->autoclose(3000);
                    return Redirect::to('derivantesListado');
            }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                return Redirect::to('/');
        }

    }

    public function tablaedit(Request $request){
        if (Auth::check()){
            if ($request['action'] == 'edit') {

                $arrayS = array_filter(
                    $request->except(['matricula','action'])
                );
                $pac = Persona::find($request['Personas_idPersonas']);
                $pac->fill($arrayS);
                $pac->save();

                $arrayD = array_filter(
                    $request->except(['nombre','apellido','email','action'])
                );
                $der = Derivantes::find($request['Personas_idPersonas']);
                $der->fill($arrayD);
                $der->save();

            }
            $data=array('msg' =>'Datos actualizados con exito!');
            return Response()->json($data);
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function facturacion()
    {
      if (Auth::check())//verifico que este logueado
      {
        $seccion='Facturacion Mensual';
            return view('derivantes.facturacion.facturacion',compact('seccion'));
      }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
      }
    }

    public function facturacionDerivante()
    {
      if (Auth::check())//verifico que este logueado
      {
        $seccion='Facturacion Mensual por Derivante';
            return view('derivantes.facturacion.facturacionDer',compact('seccion'));
      }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
      }
    }

    public function tablaeditFecha(Request $request){
        if (Auth::check()){
            if ($request['action'] == 'edit') {
                $date=date('Y-m-d H:i:s', strtotime($request['fecha']));
                InformeDerivante::where('idInformes',$request['Informes_idInformes'])->update(['fechaIngreso' =>$date]);
                RelacionAnalisisDerivante::where('Informes_idInformes',$request['Informes_idInformes'])->update(['fechaIngreso' =>$date]);
            }
            $data=array('msg' =>'Datos actualizados con exito!');
            return Response()->json($data);
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }
}
