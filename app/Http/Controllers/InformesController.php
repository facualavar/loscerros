<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use Alert;
use Carbon\Carbon;
use App\Informe;
use App\LineasInformes;
use App\RelacionAnalisis;
use App\RelacionDoctor;
use App\RelacionOrden;
use App\RelacionInforme;
use App\Persona;
use App\Valores;
use App\User;
use App\PersonaToken;
use DataTables;
use Illuminate\Support\Str;

class InformesController extends Controller
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
        $seccion='Informes';
            return view('informes.index',compact('seccion'));
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
          $dni=$request['dniP']; //obtengo el dni del paciente en caso de estar ya almacenado
          $mutual=$request['mutual1'];//obtengo el id de la obra social
          $idPersona=$request['idPersona'];
          $idPersonaD=$request['idPersonaD'];
          $seña=$request['seña']; $copago=$request['copago'];
          $diagnostico=$request['diagnostico'];
          $afiliado=$request['afiliado'];
          $retira=$request['retira']; $observaciones=$request['observaciones']; $orden=$request['orden'];
          (isset($request['veterinaria']))? $veterinaria=1 : $veterinaria=0;
          (isset($request['si']))? $trajo=1 : $trajo=0;
          (isset($request['no']))? $debe=1 : $debe=0;

          //controlo los datos obligatorios
          if(!isset($_POST["codigo"])){
            alert()->warning('Debe ingresar al menos un codigo de analisis')->autoclose(3000);
                            return Redirect::to('informes');
          }

          if(!$matricula){
            alert()->warning('Debe ingresar datos del doctor')->autoclose(3000);
                            return Redirect::to('informes');
          }

          if(!$idPersona){
            alert()->warning('Debe ingresar datos del paciente')->autoclose(3000);
                            return Redirect::to('informes');
          }

         /*  if($trajo==0 && $debe==0){
                alert()->warning('Confirmar si debe o trajo')->autoclose(3000);
                            return Redirect::to('informes');
          } */

          if ($request['fechaIngreso']!=""){
             $fechaIngreso=$request['fechaIngreso'];
          }else{
            $fechaIngreso=Carbon::now();//date('Y-m-d H:i:s');
          }

          Informe::create([
                'Usuarios_Personas_idPersonas'=>Auth::user()->id,
                'fechaIngreso'=>$fechaIngreso
          ]);

          //armo el numero de protocolo
          $protocolo=date('ymd');
          $cant=Informe::select(DB::raw('count(idInformes) as cant'))
                ->where(DB::raw('date_format(fechaIngreso,"%Y-%m-%d")'),'=',date('Y-m-d'))
                ->groupBy(DB::raw('date_format(fechaIngreso,"%Y-%m-%d")'))
                ->first();
                /* \Log::info(print_r($cant,true));
      \Log::info(count($cant)); */
          //(count($cant) > 0 ) ? $cant=$cant->cant : $cant=1;//conteo de informe del dia

          $cant=1;
          $protocolo=$protocolo.$cant;

          Informe::where('idInformes',Informe::all()->last()->idInformes)->update(['protocolo'=>$protocolo]);

          $muestra=[];

          if(isset($request['muestra'])){
                foreach ($request["muestra"] as $v) {
                     array_push($muestra, $v);
                }
          }

          foreach ($_POST["codigo"] as $k=>$c) {

            if (!empty($c)){
                RelacionAnalisis::create([
                        'TiposdeAnalisis_codigo'=>$c,
                        'Pacientes_Personas_idPersonas'=>$idPersona,
                        'Informes_idInformes'=>Informe::all()->last()->idInformes,
                        'muestra' => $muestra[$k],
                        'fechaIngreso'=>$fechaIngreso,
                ]);
            }
          }

          RelacionDoctor::create([
                'Pacientes_Personas_idPersonas'=>$idPersona,
                'Doctor_Personas_idPersonas'=>$idPersonaD,
                'fechaIngreso'=>$fechaIngreso,
          ]);

          RelacionInforme::create([
                'Pacientes_Personas_idPersonas'=>$idPersona,
                'Informes_idInformes'=>Informe::all()->last()->idInformes,
                'Doctor_idDoctor'=>$idPersonaD,
                'retira'=>$retira,
                'debe'=>$debe,
                'trajo'=>$trajo,
                'seña'=>$seña,
                'diagnostico'=>$diagnostico,
                'numOrden'=>$orden,
                'copago'=>$copago,
                'observaciones'=>$observaciones,
                'afiliado'=>$afiliado,
                'veterinaria'=>$veterinaria,
                'fechaIngreso'=>$fechaIngreso
          ]);

          RelacionOrden::create([
                'Pacientes_Personas_idPersonas'=>$idPersona,
                'Informes_idInformes'=>Informe::all()->last()->idInformes,
                'autorizada'=>($trajo)? 1 : 0,
                'numero'=>$request['orden'],
                'fechaIngreso'=>$fechaIngreso
          ]);

          LineasInformes::create([
                'Informes_idInformes'=>Informe::all()->last()->idInformes,
                'Informes_Pacientes_Personas_idPersonas'=>$idPersona,
                'Informes_Usuarios_Personas_idPersonas'=>Auth::user()->id
          ]);

          alert()->success('Analisis Cargados Correctamente')->autoclose(3000);
                            return Redirect::to('informes');

      }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
            }
    }

    public function update(Request $request){

      if (Auth::check())//verifico que este logueado
      {
        $msg = array('msg' => 'Datos actualizados correctamente!');

        RelacionInforme::where('Informes_idInformes',$request['id'])->update(['diagnostico'=>$request['diagnostico'],'observaciones'=>$request['obs'],'numOrden'=>$request['numOrden'],'afiliado' =>$request['afiliado'] ]);

        if($request['paciente']!=''){
            $data =  Persona::leftJoin('pacientes', 'pacientes.Personas_idPersonas', '=', 'personas.idPersonas')
            ->whereRaw('personas.idPersonas = "' . $request['paciente'] . '"')
            ->first();

            if ($data) {
                RelacionAnalisis::where('Informes_idInformes', $request['id'])->update(['Pacientes_Personas_idPersonas' => $data->idPersonas]);
                RelacionInforme::where('Informes_idInformes', $request['id'])->update(['Pacientes_Personas_idPersonas' => $data->idPersonas]);
            }else{
                $msg = array('msg' => 'No se encontro el paciente solicitado');
            }
        }

         //Busco el doctor segun nombre y apellido
        if ($request['doctor'] != '') {
            $data =  Persona::leftJoin('doctor', 'doctor.Personas_idPersonas', '=', 'personas.idPersonas')
                ->whereRaw('personas.idPersonas = "' . $request['doctor'] . '"')
                ->first();

            if ($data) {
                RelacionInforme::where('Informes_idInformes', $request['id'])->update(['Doctor_idDoctor' => $data->idPersonas]);
            }else{
                $msg = array('msg' => 'No se encontro el doctor solicitado');
            }
        }

         //Busco el usuario segun nombre y apellido
        if ($request['usuario'] != '') {
            $data =  User::where('id',$request['usuario'])->first();
            if ($data) {
                Informe::where('idInformes', $request['id'])->update(['Usuarios_Personas_idPersonas' => $data->id]);
                $data = array('msg' => 'Datos Actualizados');
                return Response()->json($data);
            } else {
                $data = array('msg' => 'Usuario no encontrado');
                return Response()->json($data);
            }
        }

        return Response()->json($msg);
      }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
      }

    }

    public function result()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion='Informes';
            $data =  DB::table('vistainformeresultados')->get();
            return view('informes.informesResult',compact('data','seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function list()
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion='Informes';
           // $data =  DB::table('vistainformes')->orderBy('Informes_idInformes','desc')->Paginate(20);
           // $data =  DB::table('vistainformes')->get();
            return view('informes.informesList',compact('seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function agregar($id,$idP)
    {
          if (Auth::check()){
            $seccion = 'Editar Análisis';
            $data=Informe::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->get();

            return view('informes.agregar.index',compact('seccion','data','id','idP'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }

    }

    public function agregarStore(Request $request){
        if (Auth::check()){

            DB::table('relacionanalisis')->where('Informes_idInformes', $request['Informes_idInformes'])->delete();

           //controlo los datos obligatorios
            if(!isset($_POST["codigo"])){
                alert()->warning('Debe ingresar al menos un codigo de analisis')->autoclose(3000);
                                return Redirect::to('agregar/'.$request['Informes_idInformes'].'/'.$request['Informes_Pacientes']);
            }
            foreach ($_POST["codigo"] as $c) {

                if (!empty($c)){
                    RelacionAnalisis::create([
                            'TiposdeAnalisis_codigo'=>$c,
                            'Pacientes_Personas_idPersonas'=>$request['Informes_Pacientes'],
                            'Informes_idInformes'=>$request['Informes_idInformes'],
                            'muestra'=>1,
                            'fechaIngreso'=>Carbon::now()//date('Y-m-d H:i:s'),
                    ]);

                    //busco si existe la linea del informe cargada
                  $lininf = LineasInformes::find($request['Informes_idInformes'])->linea;

                  if($lininf!=''){
                      $linea = json_decode($lininf,true);                      
                      $valor = Valores::where('codigo','=',$c)->get();
                                           
                      foreach($valor as $v){
                        $nombre = $v->nombre;                                                                        
                        if(!isset($linea->$nombre)){                          
                          if(!isset($linea[$nombre])){
                              $linea[$nombre] = "";
                          }                                                                                                                 
                        }
                      }                                                                                                              
                  }

                }
            }
            
            if(isset($linea)){              
              $linea = json_encode($linea);
            
              LineasInformes::where('Informes_idInformes', $request['Informes_idInformes'])
                          ->update(['linea' => $linea]);
            }
            
            alert()->success('Análisis cargados correctamente')->autoclose(3000);
            return Redirect::to('informesList');
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }


    public function tablaeditInf(Request $request)
    {
      if (Auth::check()) {
        if ($request['action'] == 'edit') {
              //actualizacion de fecha
              if($request['fecha']!=''){

                  $date = date('Y-m-d H:i:s', strtotime($request['fecha']));
                  Informe::where('idInformes', $request['Informes_idInformes'])->update(['fechaIngreso' => $date]);
                  RelacionAnalisis::where('Informes_idInformes', $request['Informes_idInformes'])->update(['fechaIngreso' => $date]);

                  $data = array('msg' => 'ok');
                  return Response()->json($data);
              }

        }

      } else {
        alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
        return Redirect::to('/');
      }
    }

    public function impreso(Request $request){
        Informe::where('idInformes',$request['id'])->update(['estado' => 2]);
        $data=array('msg'=>'ok');
        return Response()->json($data);
    }

    public function search(Request $request)
    {      //traigo todas las coincidencias
            $data =  DB::table('vistainformes')
                        ->select(DB::raw('Pacientes_Personas_idPersonas,Informes_idInformes, CONCAT(apellido, " ", nombre) AS paciente, doctor,  CONCAT(fecha, " ", hora) AS fecha, usuario , estado, observaciones, afiliado, veterinaria, debe, trajo, retira, seña, diagnostico, copago, numOrden'))
                        ->get();

            //mando los datos en formato para el datatable
            return Datatables::of($data)
              ->addIndexColumn()
              ->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                  $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['Informes_idInformes']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['paciente']), Str::lower($request->get('search')))) {
                      return true;
                    }

                    return false;
                  });
                }
              })
              ->addColumn('estados', function ($data) {
                  switch ($data->estado) {
                    case 'VALIDADO':
                      $est = '<b class="badge badge-pill badge-success mb-1">' . $data->estado . '</b>';
                      break;
                    case 'INGRESADO':
                      $est = '<b class="badge badge-pill badge-primary mb-1">' . $data->estado . '</b>';
                      break;
                    case 'ENVIADO':
                      $est = '<b class="badge badge-pill badge-danger mb-1">' . $data->estado . '</b>';
                      break;
                    case 'PENDIENTE':
                      $est = '<b class="badge badge-pill badge-dark mb-1">' . $data->estado . '</b>';
                      break;
                    case 'VALIDACION PARCIAL':
                      $est = '<b class="badge badge-pill badge-info mb-1">' . $data->estado . '</b>';
                      break;
                    case 'IMPRESO':
                      $est = '<b class="badge badge-pill badge-secondary mb-1">' . $data->estado . '</b>';
                      break;
		    default:
		      $est = '';
                  }
                return $est;
              })
              ->addColumn('btn',function ($data) {

                       ($data->trajo==0)?  $aux='Debe' : $aux='Trajo'. '<br>';
                       ($data->numOrden!='')? $aux1='<input type="text" name="numOrden'.$data->Informes_idInformes.'" value="'.$data->numOrden.'" class="form-control" style="width: 91% !important;">'  : $aux1='<input type="text" name="numOrden'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       ($data->afiliado!='')? $aux10='<input type="text" name="afiliado'.$data->Informes_idInformes.'" value="'.$data->afiliado.'" class="form-control" style="width: 91% !important;">'  : $aux10='<input type="text" name="afiliado'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       ($data->diagnostico!='')? $aux2='<input type="text" name="diagnostico'.$data->Informes_idInformes.'" value="'.$data->diagnostico.'" class="form-control" style="width: 91% !important;">'  : $aux2='<input type="text" name="diagnostico'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       ($data->seña!='')? $aux3=$data->seña. '<br><br>' : $aux3='-'. '<br><br>';
                       ($data->copago!='')? $aux4=$data->copago. '<br><br>' : $aux4='-'. '<br><br>';
                       ($data->retira!='')? $aux5=$data->retira. '<br><br>' : $aux5='-'. '<br><br>';
                       /* ($data->veterinaria==0)? $aux6='No' : $aux6='Si' .'<br>'; */
                       ($data->observaciones!='')? $aux7='<input type="text" name="obs'.$data->Informes_idInformes.'" value="'.$data->observaciones.'" class="form-control" style="width: 91% !important;">'  : $aux7='<input type="text" name="obs'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       ($data->doctor!='')? $aux8='<input type="text" id="doct'.$data->Informes_idInformes.'" value="'.$data->doctor.'" name="doc'.$data->Informes_idInformes.'" class="form-control" style="width: 91% !important;">'  : $aux8='<input type="text" name="doc'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       ($data->doctor!='')? $aux9='<input type="text" id="pac'.$data->Informes_idInformes.'" value="'.$data->paciente.'" name="pac'.$data->Informes_idInformes.'" class="form-control" style="width: 91% !important;">'  : $aux9='<input type="text" name="pac'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       ($data->usuario!='')? $aux11='<input type="text" id="user'.$data->Informes_idInformes.'" value="'.$data->usuario.'" name="user'.$data->Informes_idInformes.'" class="form-control" style="width: 91% !important;">'  : $aux11='<input type="text" name="user'.$data->Informes_idInformes.'" value="-" class="form-control" style="width: 91% !important;">';
                       $cadena = /* $aux. */$aux1.$aux2.$aux3.$aux4.$aux5./* $aux6. */$aux7;

                $modal = '<form>
                                <div class="modal fade" id="myModal'.$data->Informes_idInformes.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" id="modalDoc'.$data->Informes_idInformes.'">
                                                <h4 class="modal-title" id="myModalLabel">Detalle del informe</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row invoice-info">
                                                            <div class="col-md-6 dd-handle"> Protocolo '. $data->Informes_idInformes.'</div>
                                                            <div class="col-md-6 dd-handle">Detalle</div>


                                                            <div class="col-md-6"> <b> Debe/Trajo </b> <hr> </div>
                                                            <div class="col-md-6"> '. $aux .' <hr> </div>

                                                            <div class="col-md-6"> <strong>N° de orden:</strong> <hr> </div>
                                                            <div class="col-md-6"> '. $aux1 .' <hr> </div>

                                                            <div class="col-md-6"> <strong>N° de afiliado:</strong> <hr> </div>
                                                            <div class="col-md-6"> '. $aux10 .' <hr> </div>

                                                            <div class="col-md-6"> <strong>Diagnostico:</strong> <hr> </div>
                                                            <div class="col-md-6"> '. $aux2 .' </div>

                                                            <div class="col-md-6"> <strong>Paciente:</strong> <hr> </div>
                                                            <div class="col-md-6" onclick="updatePac('.$data->Informes_idInformes.')"> '. $aux9 .' </div>
                                                            <input type="hidden" name="paciente" id="paciente'.$data->Informes_idInformes.'">

                                                            <div class="col-md-6"> <strong>Doctor:</strong> <hr> </div>
                                                            <div class="col-md-6" onclick="updateDoc('.$data->Informes_idInformes.')"> '. $aux8 .' </div>
                                                            <input type="hidden" name="doctor" id="doctor'.$data->Informes_idInformes.'">

                                                            <div class="col-md-6"> <strong>Usuario:</strong> <hr> </div>
                                                            <div class="col-md-6" onclick="updateUser('.$data->Informes_idInformes.')"> '. $aux11 .' </div>
                                                            <input type="hidden" name="usuario" id="usuario'.$data->Informes_idInformes.'">

                                                            <div class="col-md-6"> <strong>Observaciones:</strong> <hr> </div>
                                                            <div class="col-md-6"> '. $aux7 .'</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateInf('.$data->Informes_idInformes.')">Guardar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <form>
                                      </div>';

                if (Auth::user()->id != 6) {
                  $ruta1 = route("editarResultados",["id"=>$data->Informes_idInformes,"idP"=>$data->Pacientes_Personas_idPersonas,"mode"=>0]);
                  $ruta2 = route("agregar",["id"=>$data->Informes_idInformes,"idP"=>$data->Pacientes_Personas_idPersonas]);
                  ($data->veterinaria==0)? $ruta3 = route("tapapdf",["id"=>$data->Informes_idInformes,"idP"=>$data->Pacientes_Personas_idPersonas]) : $ruta3 = route("tapaVpdf", ["id" => $data->Informes_idInformes, "idP" => $data->Pacientes_Personas_idPersonas]);
                  $ruta4 = route("editarResultados",["id"=>$data->Informes_idInformes,"idP"=>$data->Pacientes_Personas_idPersonas,"mode"=>1]);
                  $ruta5 = route('informepdf',['id'=>$data->Informes_idInformes,'idP'=>$data->Pacientes_Personas_idPersonas]);
                  $ruta6 = route('informepdfirma', ['id' => $data->Informes_idInformes, 'idP' => $data->Pacientes_Personas_idPersonas]);
                  $checked = ($data->estado=="IMPRESO") ? "checked disabled" : '';

                  if ($data->estado=="VALIDADO" || $data->estado=="ENVIADO" || $data->estado=="VALIDACION PARCIAL" || $data->estado=="IMPRESO"){
                    $href1 = '<a onclick="enviar('.$data->Informes_idInformes.','.$data->Pacientes_Personas_idPersonas.')" title="Enviar por Mail" class="feed-card"><i class="ik ik-mail bg-primary feed-icon"></i></a> '.
                             '<a href="' . $ruta5 . '" title="Imprimir Informe" class="feed-card" target="_blank"><i class="ik ik-printer bg-secondary feed-icon"></i></a> '.
                             '<a href="' . $ruta6 . '" title="Imprimir Informe con firma"  class="feed-card" target="_blank"><i class="ik ik-printer btn-dribbble feed-icon"></i></a> ' .
                             '<input type="checkbox" id="impreso'.$data->Informes_idInformes.'" class="checkbox" onclick="impreso('.$data->Informes_idInformes.')" title="ENTREGADO" '.$checked.' >';
                 }else{
                    $href1 = '';
                 }
                }

                $btn =  '<div><a href="' . $ruta1 . '" title="Editar Resultados" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a> '.
                        '<a href="' . $ruta2 . '" title="Agregar/Eliminar Análisis" class="feed-card"><i class="ik ik-plus bg-yellow feed-icon"></i></a> '.
                        '<a href="' . $ruta3 . '" title="Tapa" class="feed-card" target="_blank"><i class="ik ik-square  bg-info feed-icon"></i></a> '.
                        '<a href="' . $ruta4 . '" title="Validar" class="feed-card"><i class="ik ik-check  bg-green feed-icon"></i></a> '.
                        '<a title="Ver detalle de Informe" class="feed-card" data-toggle="modal" data-target="#myModal'.$data->Informes_idInformes.'"><i class="ik ik-eye bg-warning feed-icon"></i></a>'.
                        $href1.' </div>'.
                        $modal;

                return $btn;
              })->rawColumns(['estados','btn'])
              ->make(true);

    }
}
