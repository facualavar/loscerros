<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SweetAlert;
use DB;
use Session;
use Redirect;
use Validator;
use App\ListadoPacientes;
use App\Persona;
use App\PersonaToken;
use App\Paciente;
use DataTables;
use Illuminate\Support\Str;

class PacientesController extends Controller
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
    public function index(Request $request)
    {
        if (Auth::check()){
            $seccion='Pacientes';
            $data=DB::table('listadopacientes')->get();
            return view('pacientes.index',compact('data','seccion'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function store(Request $request)
    {

    if (Auth::check()){

        $validator = Validator::make($request->all(), [
            'nombre'=>'required',
            'apellido'=>'required',
            'DNI'=>'required',
            'mutual' => 'required',
        ]);

        if ($validator->fails()) {
             $data=array('validation' =>'Faltan completar datos del paciente!');
            return Response()->json($data);
        }
        //variables sauxiliares
       $aux=0;
       $fecha=date('Y-m-d H:i:s');


       $datos=DB::table('personas')
            ->select(DB::raw('DNI,idPersonas'))
            ->where('DNI',$request['DNI'])
            ->get();

      foreach ($datos as $k) {
          $aux=$k->DNI;
          $idP = $k->idPersonas;
      }

       if($aux!=0){
            //obtengo el id del paciente cuyo dni pertenezca
             $datos=DB::table('listadopacientes')
            ->where('DNI',$aux)
            ->get();

            if(count($datos)>0){//puede pasar que este en la tabla de personas pero no en la vista de pacientes
                foreach ($datos as $k) {
                  // armo un arreglo con los datos obtenidos del form
                    $data=array('nombre'=>$k->nombre,
                                'apellido'=>$k->apellido,
                                'DNI'=>$k->DNI,
                                'telefono'=>$k->telefono,
                                'direccion'=>$k->direccion,
                                'email'=>$k->email,
                                'sexo'=>$k->sexo,
                                'fechaNac'=>$k->fechaNac,
                                'edad' => $k->edad,
                                'mutual'=>$k->osnombre,
                                'obrasocial'=>$k->idObrasSociales,
                                /* 'diagnostico'=>$k->diagnostico, */
                                'idPersona'=>$k->Personas_idPersonas,
                                'fechaIngreso'=>$k->fecha,
                                'msg' => 'El paciente ya se encuentra cargado en la base de datos sus datos se mostraran abajo',
                                'status' => '1',
                                'validation' => '');
                }
            }else{
                if($request['ob']){
                    Paciente::create([
                        'Personas_idPersonas'=>$idP,
                        'ObrasSociales_idObrasSociales'=>$request['ob'],
                        /* 'afiliado' =>$request['afiliado'],
                        'diagnostico'=>$request['diagnostico'], */
                        'fechaIngreso'=>$fecha,
                    ]);

                    $data=array('nombre'=>$request['nombre'],
                            'apellido'=>$request['apellido'],
                            'DNI'=>$aux,
                            'telefono'=>$request['telefono'],
                            'direccion'=>$request['direccion'],
                            'email'=>$request['email'],
                            'sexo'=>$request['sexo'],
                            'fechaNac'=>$request['fechaNac'],
                            'edad' => $request['edad'],
                            'mutual'=>$request['mutual'],
                            'obrasocial'=>$request['ob'],
                            /* 'diagnostico'=>$request['diagnostico'], */
                            'idPersona'=>$idP,
                            'fechaIngreso'=>$fecha,
                            'msg' => 'El paciente ya se encuentra cargado en la base de datos sus datos se mostraran abajo',
                            'status' => '1',
                            'validation' => '');
                }else{
                     $data = array('msg'=>'Falta completar correctamente la obra social,intente volver a cargarlo desde el autocomppletado',
                                   'validation' =>'',
                                   'status' => '0');
                }

            }

            return Response()->json($data);

       }else{
          Persona::create([
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'DNI'=>$request['DNI'],
            'telefono'=>$request['telefono'],
            'direccion'=>$request['direccion'],
            'email'=>$request['email'],
            'sexo'=>$request['sexo'],
            'fechaNac'=>$request['fechaNac'],
            'edad' => $request['edad'],
            ]);

          $idPersona=Persona::all()->last();
          $idPersona=$idPersona->idPersonas;

          PersonaToken::create([['persona_id'] => $idPersona, 'token'=> (string) rand(10000, 99999)]);

        if($request['ob']){
            Paciente::create([
                'Personas_idPersonas'=>$idPersona,
                'ObrasSociales_idObrasSociales'=>$request['ob'],
            /* 'afiliado' =>$request['afiliado'],
                'diagnostico'=>$request['diagnostico'],*/
                'fechaIngreso'=>$fecha,
            ]);

            $data=array('nombre'=>$request['nombre'],
                            'apellido'=>$request['apellido'],
                            'DNI'=>$request['DNI'],
                            'telefono'=>$request['telefono'],
                            'direccion'=>$request['direccion'],
                            'email'=>$request['email'],
                            'sexo'=>$request['sexo'],
                            'fechaNac'=>$request['fechaNac'],
                            'edad' => $request['edad'],
                            'mutual'=>$request['mutual'],
                            'obrasocial'=>$request['ob'],
                            /* 'diagnostico'=>$request['diagnostico'], */
                            'idPersona'=>$idPersona,
                            'fechaIngreso'=>$fecha,
                            'msg' => '',
                            'validation' => '',
                            'status' => '1');
        }else{
            $data = array('msg'=>'Falta completar correctamente la obra social,intente volver a cargarlo desde el autocomppletado',
                          'validation' => '',
                          'status' => '0');
        }

           return Response()->json($data);
        }
    }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function edit($id){
        if (Auth::check()){
            $seccion='Editar Pacientes';
            $data = Listadopacientes::find($id);

            $personaToken = PersonaToken::where('persona_id', $data->Personas_idPersonas)->first();
            if (!$personaToken) {
              $personaToken = new PersonaToken();
              $personaToken->persona_id = $data->Personas_idPersonas;
              $personaToken->token = (string) rand(10000, 99999);
              $personaToken->save();
            }

            $data->code = $personaToken->token;
            return view('pacientes.edit',compact('data','seccion'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function update(Request $request,$id){
        if (Auth::check()){
         Persona::where('idPersonas',$id)->update(['nombre' =>$request['nombre'],'apellido' =>$request['apellido'],'DNI' => $request['DNI'],'telefono' =>$request['telefono'],'direccion' =>$request['direccion'],'email' => $request['email'],'sexo' => $request['sexo'],'fechaNac' => $request['fechaNac'],'edad' => $request['edad']]);
         Paciente::where('Personas_idPersonas',$id)->update(['ObrasSociales_idObrasSociales'=>$request['ob']/* ,'afiliado'=>$request['afiliado'] */]);

         PersonaToken::where('persona_id',$id)->update(['token' => $request['code']]);

         alert()->success('El paciente se guardo correctamente');
                return Redirect::to('pacientes');
        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)');
            return Redirect::to('/');
        }
    }

    public function tablaedit(Request $request){
        if (Auth::check()){
            if ($request['action'] == 'edit') {
                //Se actualiza datos de la cuenta
                    $pac = Persona::find($request['Personas_idPersonas']);
                    $pac->fill($request->all());
                    $pac->save();
            }
            $data=array('msg' =>'Datos actualizados con exito!');
            return Response()->json($data);
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function search(Request $request)
    {      //traigo todas las coincidencias
            $data =  DB::table('listadopacientes')
                        ->select(DB::raw('Personas_idPersonas,apellido, nombre, DNI, osnombre'))
                        ->get();

            //mando los datos en formato para el datatable
            return Datatables::of($data)
              ->addIndexColumn()
              ->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                  $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['DNI']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['apellido']), Str::lower($request->get('search')))) {
                      return true;
                    }  else if (Str::contains(Str::lower($row['nombre']), Str::lower($request->get('search')))) {
                      return true;
                    }else if (Str::contains(Str::lower($row['osnombre']), Str::lower($request->get('search')))) {
                      return true;
                    }

                    return false;
                  });
                }
              })
              ->addColumn('btn',function ($data) {
                $ruta1 = route("pacienteedit",["id"=>$data->Personas_idPersonas]);

                $btn =  '<a href="' . $ruta1 . '" title="Editar Paciente" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a> ';

                return $btn;
              })->rawColumns(['estados','btn'])
              ->make(true);

    }
}
