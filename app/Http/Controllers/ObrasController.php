<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Redirect;
use Auth;
use Validator;
use DB;
use App\Paciente;
use App\Obrassociales;
use DataTables;
use Illuminate\Support\Str;

class ObrasController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check())//verifico que este logueado
        {
            $data = Obrassociales::all();
            $seccion = 'Obras Sociales';

            return view('obras.index',compact('data','seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function store(Request $request)
    {
        if (Auth::check()){

            $validator = Validator::make($request->all(), [
                'nombre'=>'required'
            ]);

            if ($validator->fails()) {
                alert()->warning('Falta completar el nombre de la obra');
                return Redirect::to('obrassociales');
            }else{
                Obrassociales::create([
                    'nombre'=>$request['nombre'],
                    'nbu'=>$request['nbu']
                ]);
            }

            alert()->success('La obra social se agrego correctamente');
            return Redirect::to('obrassociales');
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

    public function ordenesMes(Request $request)
    {
      if (Auth::check())
      {

        $data=Paciente::select(DB::raw('personas.idPersonas,personas.nombre,personas.apellido, GROUP_CONCAT(relacionanalisis.TiposdeAnalisis_codigo) as analisis,relacionanalisis.Informes_idInformes,date_format(relacionanalisis.fechaIngreso,"%d-%m-%Y %H:%i:%s") as fecha,GROUP_CONCAT(relacionanalisis.muestra) as muestra,relacionorden.autorizada as orden'))
            ->join('obrassociales','obrassociales.idObrasSociales','=','pacientes.ObrasSociales_idObrasSociales')
            ->join('relacionanalisis','relacionanalisis.Pacientes_Personas_idPersonas','=','pacientes.Personas_idPersonas')
            ->join('personas','personas.idPersonas','=','pacientes.Personas_idPersonas')
            ->join('relacionorden','relacionorden.Informes_idInformes','=','relacionanalisis.Informes_idInformes')
            ->where('pacientes.ObrasSociales_idObrasSociales','=',$request['obra'])
            ->where(DB::raw('date_format(pacientes.fechaIngreso,"%m")'),'=',$request['mes'])
            ->groupBy('relacionanalisis.Informes_idInformes')
            ->get();

        return Response()->json($data);

      }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
      }
    }

    public function tablaeditos(Request $request){
        if (Auth::check()){
            if ($request['action'] == 'edit') {
                    $arrayS = array_filter(
                        $request->except(['action'])
                    );
                    $pac = Obrassociales::find($request['idObrasSociales']);
                    $pac->fill($arrayS);
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
            $data =  DB::table('obrassociales')
                        ->select(DB::raw('idObrasSociales,nombre,nbu'))
                        ->get();

            //mando los datos en formato para el datatable
            return Datatables::of($data)
              ->addIndexColumn()
              ->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                  $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['nombre']), Str::lower($request->get('search')))) {
                      return true;
                    } /* else if (Str::contains(Str::lower($row['apellido']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['nombre']), Str::lower($request->get('search')))) {
                      return true;
                    } */

                    return false;
                  });
                }
              })
             /*  ->addColumn('btn',function ($data) {
                $ruta1 = route("doctoredit",["id"=>$data->Personas_idPersonas]);

                $btn =  '<a href="' . $ruta1 . '" title="Editar Doctor" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a> ';

                return $btn;
              })->rawColumns(['estados','btn']) */
              ->make(true);

    }
}
