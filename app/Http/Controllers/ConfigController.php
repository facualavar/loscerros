<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use DB;
use Redirect;
use Validator;
use App\Config;
use App\User;

class ConfigController extends Controller
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
            $seccion = 'Configuración';
            $data = Config::find(1);
            return view('config.index',compact('seccion','data'));
        }else{
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
                        return Redirect::to('/');
        }
    }

    public function update(Request $request){
        if (Auth::check()){
             $data = Config::find(1);
             $data->fill($request->all());
             $data->save();
             alert()->success('La configuración se guardo correctamente')->autoclose(3000);
                return Redirect::to('configuracion');
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function firmas(){
         if (Auth::check()){
            $seccion = 'Firmas';
            return view('config.firmas',compact('seccion'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function fotos(Request $request) {

        $fileName = \time();
		$fileName .= '_' . \base64_encode($_FILES["file"]["name"]);
		$fileName .= '.jpg';


		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
        $name = date('ymdHis').'_'.rand(10000, 99999). "." . $extension;


        $ruta=env('URL_BASE_IMAGES_FIRMAS').$name;//ruta absoluta
        User::where('id',Auth::user()->id)->update(['firmaImagen' =>$name]);

		if (file_exists($ruta)){
			unlink($ruta);
			if (  $name && move_uploaded_file($_FILES["file"]["tmp_name"], $ruta)){}
	   }elseif (  $name && move_uploaded_file($_FILES["file"]["tmp_name"], $ruta))
			   {
                $response['imagen'] = $name;
				echo stripslashes(json_encode($response));
			   }
    }

    public function indexnbu(){
         if (Auth::check()){
            $seccion = 'NBU';
            $nbu = Config::where('id',1)->first()->nbu;

            return view('config.nbu',compact('seccion','nbu'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function nbu(Request $request){

        $validator = Validator::make($request->all(), [
                'nbu' => 'required'
        ]);

            if ($validator->fails()) {
                alert()->warning('El campo nbu es obligatorio, por favor complete el dato')->autoclose(3000);
                    return Redirect::to('home');
            }

        Config::where('id',1)->update(['nbu' =>$request['nbu']]);
         alert()->success('El nbu se guardo correctamente')->autoclose(3000);
            return Redirect::to('home');
    }
}
