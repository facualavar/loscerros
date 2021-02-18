<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Vistausuario;
use Auth;
use Alert;
use DB;
use Redirect;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsuariosController extends Controller
{

    public function index()
    {
        if (Auth::check()){
            $seccion = 'Usuarios';
            $users =  DB::table('vistausuarios')->get();
            $roles = DB::table('roles')->pluck('name','id');
            $status = DB::table('estados')->pluck('nombre','id');
            return view('auth.index',compact('users','seccion','roles','status'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function create()
    {

    }

    public function perfil($id)
    {
        if (Auth::check()){
            $user=Vistausuario::find($id);
            $seccion='Usuarios';
            return view('auth.perfil',compact('user','seccion'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function store(Request $request){
        if (Auth::check()){

        $validator = Validator::make($request->all(), [
            'estado'=>'required',
            'name'=>'required',
            'Roles_idRoles'=>'required',
            'email'=>'required',
            'password'=>'required',
            'repassword'=>'required'
        ]);

            if ($validator->fails()) {
                alert()->warning('Faltan completar datos del usuario!');
                return Redirect::to('usuarios');
            }else{
                $find=Vistausuario::where('email',$request['email'])->get();

                if(count($find)>0){
                     alert()->warning('El email ya existe en la base de datos!');
                    return Redirect::to('usuarios');
                }else {
                    if($request['password']!=$request['repassword']){
                        alert()->warning('Las contraseñas no coinciden');
                        return Redirect::to('usuarios');
                    }else{
                            User::create([
                            'name'=>$request['name'],
                            'Roles_idRoles'=>$request['Roles_idRoles'],
                            'email'=>$request['email'],
                            'password'=>Hash::make($request['password']),
                            'estado'=>$request['estado']
                            ]);

                            alert()->success('Usuario creado correctamete!');
                            return Redirect::to('usuarios');
                    }
                }
            }
        }
    }

    public function edit($id)
    {
        if (Auth::check()){
            $seccion='Usuarios';
            $user=Vistausuario::find($id);
            return view('usuarios.edit',compact('user','seccion'));
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function tablaedit(Request $request){
        if (Auth::check()){
            if ($request['action'] == 'edit') {
                //Se actualiza datos de la cuenta
                    $user = User::find($request['id']);
                    $user->fill($request->all());
                    $user->save();
            }
            $data=array('msg' =>'Datos actualizados con exito!');
            return Response()->json($data);
        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()){
            $seccion='Usuarios';

             //validacion
            if($request['repassword']!=''){
                if($request['repassword']==$request['password']){
                      if($request['imagen']!=''){//si cargo alguna imagen de perfil
                        User::where('id',$id)->update(['name' =>$request['name'],'Roles_idRoles' =>$request['Roles_idRoles'],'email' =>$request['email'],'password'=> Hash::make($request['password']),'estado' => $request['estado'],'imagen'=>$request['imagen']]);
                      }else {
                          User::where('id',$id)->update(['name' =>$request['name'],'Roles_idRoles' =>$request['Roles_idRoles'],'email' =>$request['email'],'password'=> Hash::make($request['password']),'estado' => $request['estado']]);
                      }
                        alert()->success('Usuario Actualizado Correctamente');
                      return Redirect::to('usuarios');
                    }else{
                         alert()->warning('Las contraseñas no coinciden');
                      return Redirect::to('usuariosPerfil/'.$id);
                    }
            }else{
                if($request['imagen']!=''){//si cargo alguna imagen de perfil
                    User::where('id',$id)->update(['name' =>$request['name'],'Roles_idRoles' =>$request['Roles_idRoles'],'email' =>$request['email'],'estado' => $request['estado'],'imagen'=>$request['imagen']]);
                }else {
                    User::where('id',$id)->update(['name' =>$request['name'],'Roles_idRoles' =>$request['Roles_idRoles'],'email' =>$request['email'],'estado' => $request['estado']]);
                }

                alert()->success('Usuario Actualizado Correctamente')->autoclose(3000);
                return Redirect::to('usuarios');
            }


        }else{
          alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Auth::check()){
            User::destroy($request['id']);
            $data=array('msg'=>'ok');
            return Response()->json($data);
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


        $ruta=env('URL_BASE_IMAGES').$name;//ruta absoluta

		if (file_exists($ruta)){
			unlink($ruta);
			if (  $name && move_uploaded_file($_FILES["file"]["tmp_name"], $ruta)){}
	   }elseif (  $name && move_uploaded_file($_FILES["file"]["tmp_name"], $ruta))
			   {
                $response['imagen'] = $name;
				echo stripslashes(json_encode($response));
			   }
    }


    public function permisos($id)
    {
        if (Auth::check()) {
            $permissions = Permission::all()->toArray();
            $rol = Role::find($id);
            $permissionsrol = $rol->getAllPermissions()->toArray();
            $per = [];

            //primero pivoteo todo en 0
            for ($i=0; $i < count($permissions) ; $i++) {
                 array_push($per, ['id'=>$permissions[$i]['id'],'name'=>$permissions[$i]['name'],'pivot'=>0]);
            }
            //despues pivoteo los permisos en 1 segun rol
            for ($i=0; $i < count($permissionsrol) ; $i++) {
                for ($j=0; $j < count($permissions); $j++) {

                    if($permissionsrol[$i]['id']==$permissions[$j]['id']){
                        $per[$j]['pivot']=1;
                    }
                }
            }

            $seccion = 'Usuarios';
            return view('auth.permisos', compact('per','rol','seccion'));
        } else {
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function roles()
    {
        if (Auth::check()) {
            $roles = Role::paginate();
            $seccion = 'Usuarios';
            return view('auth.roles', compact('roles','seccion'));
        } else {
            alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function updateroles(Request $request, $role)
    {
        $roles = Role::paginate();
        $seccion = 'Usuarios';

        DB::table('role_has_permissions')->where('role_id', '=', $role)->delete();

        for ($i=0; $i < count($request['permission']) ; $i++) {
            DB::table('role_has_permissions')->updateOrInsert(['permission_id'=>$request['permission'][$i],'role_id'=>$role]);
        }

        alert()->success('Actualización', 'Permisos actualizados correctamente!');
        return view('auth.roles', compact('roles','seccion'));
    }
}
