<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Alert;
use Validator;
use Illuminate\Http\Request;
use App\Analisis;
use App\LineasInformes;
use App\Tiposdeanalisis;
use App\RelacionAnalisis;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DataTables;
use Illuminate\Support\Str;

class AnalisisController extends Controller
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
            $seccion = 'Analisis';
            return view('analisis.index',compact('seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function store(Request $request)
    {
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Valores de Referencia';

            $validator = Validator::make($request->all(), [
                'codigo' => 'required',
                'nombre' => 'required',
                'ub'=> 'required',
                'precioDerivantes'=> 'required',
                'tipo' => 'required',
                'referencia'=>'required',
                'grupo'=>'required',
            ]);

            if ($validator->fails()) {
                alert()->warning('Todos los campos son obligatorios, por favor complete los datos faltantes')->autoclose(3000);
                    return Redirect::to('analisis');
            }else {
                //buscamos si hay duplicados
                $data=Tiposdeanalisis::find($request['codigo']);

                if($data){
                    alert()->warning('El código ingresado ya existe en la base de datos!')->autoclose(3000);
                    return Redirect::to('analisis');
                }else{
                    $analisis=$request['nombre'];//guardo el nombre original para los inf
                    $aux=eliminar_tildes($request['nombre']);
                    $aux=strtolower(trim($aux));
                    $nombre=str_replace(' ','_',$aux);

                   // if($request['tipo']=='simple'){//cambio para guardarlo como columna
                     //   $aux=strtolower(trim($aux));
                      //  $nombre=str_replace(' ','_',$aux);

                       /*  if (Schema::hasColumn('lineasinformes', $nombre))
                        {
                            //guardo el nombre del analisis para que se agregue en la tabla si es simple
                            $nombre=$nombre.'_'.str_random(5);
                            Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                $table->text($nombre);
                            });

                        }else{
                             //guardo el nombre del analisis para que se agregue en la tabla si es simple
                            Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                $table->text($nombre);
                            });

                        } */
                   // }
                        Tiposdeanalisis::create([
                            'codigo'=>$request['codigo'],
                            'nombre'=>$analisis,
                            'UB'=>$request['ub'],
                            'metodo'=>$request['metodo'],
                            'precioDerivantes'=>$request['precioDerivantes'],
                            'tipo'=>$request['tipo'],
                            'referencia'=>$request['referencia'],
                            'grupo'=>$request['grupo'],
                        ]);
                        $codigo = $request['codigo'];
                        $tipo = $request['tipo'];
                        alert()->success('Análisis cargados correctamente')->autoclose(3000);
                            return view('analisis.analisis',compact('seccion','codigo','tipo','nombre','analisis'));
                }

            }
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function vreferencia(){
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Valores de Referencia';
            return view('analisis.analisis',compact('seccion'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function vreferenciastore(Request $request){
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Valores de Referencia';
            for($i=0; $i< count($_POST["codigo"]); $i++ ) {

            $codigo = $request['codigo'][$i];

            if($request['nombreFormal'][$i]!=''){
                $analisis=$request['nombreFormal'][$i];//guardo el nombre original para los inf COMPUESTOS
                $aux=eliminar_tildes($request['nombreFormal'][$i]);
                $aux=strtolower(trim($aux));
                $nombre=str_replace(' ','_',$aux);
               /* if($request['tipo']=='compuesto'){
                   $aux=strtolower(trim($aux));
                   $nombre=str_replace(' ','_',$aux);

                    if (Schema::hasColumn('lineasinformes', $nombre))
                        {
                            $nombre=$nombre.'_'.str_random(5);
                            //guardo el nombre del analisis para que se agregue en la tabla si es simple
                            Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                $table->text($nombre);
                            });
                        }else{
                             //guardo el nombre del analisis para que se agregue en la tabla si es simple
                            Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                $table->text($nombre);
                            });
                        }
                }else{
                    $aux=strtolower(trim($aux));
                    $nombre=str_replace(' ','_',$aux);
                } */

               $find=Analisis::select('nombre')->where('nombre','=',$nombre)->first();

               if($find){
                 $nombre=$nombre.'_'.str_random(5);
               }

                if($request['tipo']=='compuesto'){
                    Analisis::create([
                        'codigo'=>$request['codigo'][$i],
                        'nombre'=>$nombre,
                        'nombreFormal'=>$analisis,
                        'referencia'=>$request['referencia'][$i],
                        'unidades'=>$request['unidades'][$i]
                    ]);
                }else{
                    //para agregar notas
                    $pos = strpos($nombre, 'nota');
                    if($pos!==false){
                        $nombre=$nombre.'_'.str_random(5);
                        //guardo el nombre del analisis para que se agregue en la tabla si es simple
                        /* Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                            $table->text($nombre);
                        }); */

                        Analisis::create([
                            'codigo'=>$request['codigo'][$i],
                            'nombre'=>$nombre,
                            'nombreFormal'=>$request['nombreFormal'][$i],
                            'referencia'=>$request['referencia'][$i],
                            'unidades'=>$request['unidades'][$i]
                        ]);
                    }else{
                         Analisis::create([
                            'codigo'=>$request['codigo'][$i],
                            'nombre'=>$nombre,
                            'nombreFormal'=>$request['nombreFormal'][$i],
                            'referencia'=>$request['referencia'][$i],
                            'unidades'=>$request['unidades'][$i]
                        ]);
                    }
                }
            }

            }

            alert()->success('Valores de referencia cargados correctamente')->autoclose(3000);
                //return redirect()->route('updateValores', [$codigo]);
                return redirect()->route('analisis');

        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function listado(){
        if (Auth::check())
        {
            $seccion = 'Analisis Listado';
            $data=Tiposdeanalisis::all();
            return view('analisis.listado',compact('seccion','data'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function updateAnalisis($codigo){
        if (Auth::check())
        {
            $seccion = 'Analisis Editar';
            $data=Tiposdeanalisis::find($codigo);
            return view('analisis.editar',compact('seccion','data','codigo'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function updateValores($codigo){
        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Valores de Referencia';
            $data=Tiposdeanalisis::find($codigo);
            $tipo = $data->tipo;
            $data=Analisis::where('codigo',$codigo)->get();

            return view('analisis.editarValores',compact('seccion','tipo','data','codigo'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function update(Request $request,$id){

        if (Auth::check())//verifico que este logueado
        {
            $seccion = 'Valores de Referencia';

            $validator = Validator::make($request->all(), [
                'codigo' => 'required',
                'nombre' => 'required',
                'UB'=> 'required',
                'precioDerivantes'=> 'required',
                'tipo' => 'required',
                'referencia'=>'required',
                'grupo' => 'required',
            ]);

            if ($validator->fails()) {
                alert()->warning('Todos los campos son obligatorios, por favor complete los datos faltantes')->autoclose(3000);
                    return Redirect::to('updateAnalisis/'.$id);
            }else {
                     $tipo = Tiposdeanalisis::find($id);
                     $tipo->fill($request->all());
                     $tipo->save();
                        alert()->success('Análisis actualizados correctamente')->autoclose(3000);
                           return Redirect::to('updateValores/'.$id);
                }
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function updateVRef(Request $request){

        if (Auth::check())//verifico que este logueado
        {

            $seccion = 'Valores de Referencia';

            if($request['tipo']=='simple'){
                for($i=0; $i< count($_POST["codigo"]); $i++ ) {
                    $codigo = $request['codigo'][$i];
                    //primero busco si existe el campo
                    $find=Analisis::select('nombre')->where('codigo',$request['codigo'][$i])->where('nombre',$request['nombre'][$i])->first();
                    if($find){
                        Analisis::where('codigo',$request['codigo'][$i])
                                ->where('nombre',$request['nombre'][$i])
                                ->update(['nombreFormal'=>$request['nombreFormal'][$i],'referencia' =>$request['referencia'][$i],'unidades' =>$request['unidades'][$i]]);
                    }else{
                        $aux=eliminar_tildes($request['nombreFormal'][$i]);
                        $aux=strtolower(trim($aux));
                        $nombre=str_replace(' ','_',$aux);
                        //puede existir el nombre del analisis en otro codigo
                        $find=Analisis::select('nombre')->where('nombre','=',$nombre)->first();

                        if($find){
                            $nombre=$nombre.'_'.str_random(5);
                        }

                        Analisis::create([
                                    'codigo'=>$request['codigo'][$i],
                                    'nombre'=>$nombre,
                                    'nombreFormal'=>$request['nombreFormal'][$i],
                                    'referencia'=>$request['referencia'][$i],
                                    'unidades'=>$request['unidades'][$i]
                        ]);

                           /*  if (Schema::hasColumn('lineasinformes', $nombre))
                            {
                                $nombre=$nombre.'_'.str_random(5);
                                //guardo el nombre del analisis para que se agregue en la tabla si es simple
                                Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                    $table->text($nombre);
                                });

                            }else{
                                //para agregar notas
                                $pos = strpos($nombre, 'nota');
                                if($pos!==false){
                                    $nombre=$nombre.'_'.str_random(5);
                                    //guardo el nombre del analisis para que se agregue en la tabla si es simple
                                    Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                        $table->text($nombre);
                                    });

                                }else{
                                    //guardo el nombre del analisis para que se agregue en la tabla si es simple
                                    Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                        $table->text($nombre);
                                    });
                                }
                            } */
                    }
                }//FIN DEL FOR
            }else{
                for($i=0; $i< count($_POST["codigo"]); $i++ ) {
                    $codigo = $request['codigo'][$i];
                    //primero busco si existe el campo
                    $find=Analisis::select('nombre')->where('codigo',$request['codigo'][$i])->where('nombre',$request['nombre'][$i])->first();

                    if($find){
                        Analisis::where('codigo',$request['codigo'][$i])
                            ->where('nombre',$request['nombre'][$i])
                            ->update(['nombreFormal'=>$request['nombreFormal'][$i],'referencia' =>$request['referencia'][$i],'unidades' =>$request['unidades'][$i]]);
                    }else{
                        //segundo inserto en las lineasinformes si no existe
                        $aux=eliminar_tildes($request['nombreFormal'][$i]);
                        $aux=strtolower(trim($aux));
                        $nombre=str_replace(' ','_',$aux);

                        //puede existir el nombre del analisis en otro codigo
                        $find=Analisis::select('nombre')->where('nombre','=',$nombre)->first();

                        if($find){
                            $nombre=$nombre.'_'.str_random(5);
                        }

                        Analisis::create([
                                'codigo'=>$request['codigo'][$i],
                                'nombre'=>$nombre,
                                'nombreFormal'=>$request['nombreFormal'][$i],
                                'referencia'=>$request['referencia'][$i],
                                'unidades'=>$request['unidades'][$i]
                            ]);

                        /* if (Schema::hasColumn('lineasinformes', $nombre))
                        {
                                $nombre=$nombre.'_'.str_random(5);
                                //guardo el nombre del analisis para que se agregue en la tabla si es simple
                                Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                    $table->text($nombre);
                                });

                                Analisis::create([
                                    'codigo'=>$request['codigo'][$i],
                                    'nombre'=>$nombre,
                                    'nombreFormal'=>$request['nombreFormal'][$i],
                                    'referencia'=>$request['referencia'][$i],
                                    'unidades'=>$request['unidades'][$i]
                                ]);

                        }else {
                            //para agregar notas
                            $pos = strpos($nombre, 'nota');
                            if($pos!==false){
                                $nombre=$nombre.'_'.str_random(5);
                                //guardo el nombre del analisis para que se agregue en la tabla si es simple
                                Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                    $table->text($nombre);
                                });

                            }else{
                                //guardo el nombre del analisis para que se agregue en la tabla si es simple
                                Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                    $table->text($nombre);
                                });
                            }

                            Analisis::create([
                                'codigo'=>$request['codigo'][$i],
                                'nombre'=>$nombre,
                                'nombreFormal'=>$request['nombreFormal'][$i],
                                'referencia'=>$request['referencia'][$i],
                                'unidades'=>$request['unidades'][$i]
                            ]);
                        } */
                    }
                }
            }

            alert()->success('Valores de referencia cargados correctamente')->autoclose(3000);
                //return redirect()->route('updateValores', [$codigo]);
                return redirect()->route('analisis');

        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function delete(Request $request){
        if (Auth::check()){

            //me fijo si el codigo tiene asociado algun informe
            $find = RelacionAnalisis::where('TiposdeAnalisis_codigo','=',$request['codigo'])->first();

            if($find){
                 $data=array('msg'=>'No se puede eliminar el análisis porque tiene asociado un informe');
            }else{
                Tiposdeanalisis::where('codigo','=',$request['codigo'])
                      ->delete();
                $data=array('msg'=>'ok');
            }

            return Response()->json($data);

        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function deleteValor(Request $request)
    {
        if (Auth::check()){

            $nombre=$request['nombre'];

           /*  if (Schema::hasColumn('lineasinformes', $nombre))
            {
                Schema::table('lineasinformes', function (Blueprint $table) use($nombre) {
                                        $table->dropColumn($nombre);
                });
            } */

            Analisis::where('codigo','=',$request['codigo'])
                      ->where('nombre','=',$request['nombre'])
                      ->delete();
            $data=array('msg'=>'ok');
            return Response()->json($data);
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function search(Request $request)
    {      //traigo todas las coincidencias
            $data=Tiposdeanalisis::orderBy('nombre','asc')->get();

            //mando los datos en formato para el datatable
            return Datatables::of($data)
              ->addIndexColumn()
              ->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                  $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (Str::contains(Str::lower($row['codigo']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['nombre']), Str::lower($request->get('search')))) {
                      return true;
                    } else if (Str::contains(Str::lower($row['grupo']), Str::lower($request->get('search')))) {
                      return true;
                    }

                    return false;
                  });
                }
              })
              ->addColumn('btn',function ($data) {

                $ruta1 = route("updateAnalisis",["id"=>$data->codigo]);
                $codigo = "'".$data->codigo."'";
                $btn =  '<a href="' . $ruta1 . '" title="Editar Analisis" class="feed-card"><i class="ik ik-edit bg-blue feed-icon"></i></a>'.
                        '<a onclick="eliminar('.$codigo.')"  title="Eliminar" class="feed-card"><i class="ik ik-trash bg-danger feed-icon"></i></a>';

                return $btn;
              })->rawColumns(['btn'])
              ->make(true);

    }

}
