<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListadoDoctores;
use App\Doctor;
use App\Persona;
use Auth;
use Alert;
use DB;
use Session;
use Validator;
use Redirect;
use DataTables;
use Illuminate\Support\Str;

class DoctoresController extends Controller
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
        if (Auth::check())//verifico que este logueado
        {
            $data = ListadoDoctores::all();
            $seccion = 'Doctores';
            return view('doctores.index',compact('data','seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function store(Request $request)
    {

    if (Auth::check()){

        $validator = Validator::make($request->all(), [
            'nombreD'=>'required',
            'apellidoD'=>'required',
            'matriculaD'=> 'required',
        ]);

        if ($validator->fails()) {
             $data=array('validation' =>'Faltan completar datos del doctor!');
            return Response()->json($data);
        }

       $aux=0;

       $datos=DB::table('doctor')
            ->select(DB::raw('matricula'))
            ->where('matricula',$request['matriculaD'])
            ->get();

       foreach ($datos as $k) {
          $aux=$k->matricula;
       }

      if($aux!=0){
            //obtengo el id del doctor cuyo matricula pertenezca
             $datos=DB::table('doctor')
            ->select(DB::raw('Personas_idPersonas'))
            ->where('matricula',$aux)
            ->get();

            foreach ($datos as $k) {
                  $idPersona=$k->Personas_idPersonas;
            }

            $data=array('nombre'=>$request['nombreD'],
                   'apellido'=>$request['apellidoD'],
                   'matricula'=> $request['matriculaD'],
                   'especialidad'=>$request['especialidad'],
                   'idPersonaD'=>$idPersona,
                   'msg' => 'El doctor ya se encuentra cargado en la base de datos, sus datos se mostraran abajo',
                   'validation' => '');

            return Response()->json($data);
       }else{
         Persona::create([
            'nombre'=>$request['nombreD'],
            'apellido'=>$request['apellidoD']
            ]);

          $idPersona=Persona::all()->last();
          $idPersona=$idPersona->idPersonas;

           Doctor::create([
            'Personas_idPersonas'=>$idPersona,
            'matricula'=> $request['matriculaD'],
            'especialidad'=>$request['especialidad'],
            ]);
        $data=array('nombre'=>$request['nombreD'],
                   'apellido'=>$request['apellidoD'],
                   'matricula'=> $request['matriculaD'],
                   'especialidad'=>$request['especialidad'],
                   'idPersonaD'=>$idPersona,
                   'msg' => '',
                   'validation' => '');
        return Response()->json($data);
        }
    }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function edit($id)
    {
        if (Auth::check()){
            $seccion='Editar Doctor';
            $data=ListadoDoctores::find($id);
            return view('doctores.edit',compact('seccion','data'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function update(Request $request,$id){
        if (Auth::check()){
        Persona::where('idPersonas',$id)->update(['nombre' =>$request['nombre'],'apellido' =>$request['apellido']]);
        Doctor::where('Personas_idPersonas',$id)->update(['matricula'=>$request['matricula'],'especialidad'=>$request['especialidad']]);
        alert()->success('El doctor se guardo correctamente')->autoclose(3000);
                return Redirect::to('doctores');
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
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
            $data =  DB::table('listadodoctores')
                        ->select(DB::raw('Personas_idPersonas,apellido, nombre, matricula,especialidad'))
                        ->get();

            //mando los datos en formato para el datatable
            return Datatables::of($data)
              ->addIndexColumn()
              ->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                  $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['matricula']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['apellido']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['nombre']), Str::lower($request->get('search')))) {
                      return true;
                    }

                    return false;
                  });
                }
              })
              ->addColumn('btn',function ($data) {
                $ruta1 = route("doctoredit",["id"=>$data->Personas_idPersonas]);

                $btn =  '<a href="' . $ruta1 . '" title="Editar Doctor" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a> ';

                return $btn;
              })->rawColumns(['btn'])
              ->make(true);

    }
}
