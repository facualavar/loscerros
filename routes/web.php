<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Consultas
Route::domain('consultas.' . env('APP_DOMAIN'))->middleware('cors')->group(function () {
    Route::get('/', 'ConsultasController@index')->name('consultas');
    Route::post('consultaInformes', 'ConsultasController@consultaInformes')
           ->name('consultaInformes');
});

//APP
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//analisis
Route::get('analisis', 'AnalisisController@index')->name('analisis');
Route::get('search_ana', 'AnalisisController@search')->name('search_ana');
Route::post('analisis', 'AnalisisController@store')->name('analisis');
Route::get('vreferencia', 'AnalisisController@vreferencia')->name('vreferencia');
Route::post('vreferencia', 'AnalisisController@vreferenciastore')->name('vreferencia');
Route::get('analisisListado', 'AnalisisController@listado')->name('analisisListado');
Route::get('updateAnalisis/{codigo}', 'AnalisisController@updateAnalisis')->name('updateAnalisis');
Route::get('updateValores/{codigo}', 'AnalisisController@updateValores')->name('updateValores');
Route::post('updateVRef', 'AnalisisController@updateVRef')->name('updateVRef');
Route::post('deleteAnalisis', 'AnalisisController@delete')->name('deleteAnalisis');

//usuarios
Route::get('usuarios', 'UsuariosController@index')->name('usuarios');
Route::get('usuariosPerfil/{id}', 'UsuariosController@perfil')->name('perfil');
Route::get('usuariosPermisos/{id}', 'UsuariosController@permisosuser')->name('permisosuser');
Route::get('permisos/{id}', 'UsuariosController@permisos')->name('permisos');
Route::get('tablaedit', 'UsuariosController@tablaedit')->name('tablaedit');
Route::post('tablaedit', 'UsuariosController@tablaedit')->name('tablaedit');
Route::get('roles', 'UsuariosController@roles')->name('roles');
Route::put('roles/{role}', 'UsuariosController@updateroles')->name('roles.update');
//ruta para las fotos de perfil de usuario
Route::post('fotos', 'UsuariosController@fotos')->name('fotos');
Route::get('fotos', 'UsuariosController@fotos')->name('fotos');


//informes
Route::get('informes', 'InformesController@index')->name('informes');
Route::get('search', 'InformesController@search')->name('search');
Route::get('informesResult', 'InformesController@result')->name('resultados');
Route::get('informesList', 'InformesController@list')->name('listado');
Route::get('agregar/{id}/{idP}', 'InformesController@agregar')->name('agregar');
Route::post('agregarStore', 'InformesController@agregarStore')->name('agregarStore');
Route::post('agregarStoreDer', 'DerivantesController@agregarStore')->name('agregarStoreDer');
Route::post('informesUpdate', 'InformesController@update')->name('informesUpdate');
Route::post('impreso', 'InformesController@impreso')->name('impreso');
Route::get('informepdf/{id}/{idP}/{code?}', 'PdfController@index')->name('informepdf');
Route::get('informepdfirma/{id}/{idP}/{code?}', 'PdfController@indexI')->name('informepdfirma');
Route::get('tapapdf/{id}/{idP}', 'PdfController@tapa')->name('tapapdf');
Route::get('tapaVpdf/{id}/{idP}', 'PdfController@tapaV')->name('tapaVpdf');
Route::get('tapaDerpdf/{id}/{idP}', 'PdfController@tapaDer')->name('tapaDerpdf');


//resultados
Route::get('cargarResultados/{id}/{idP}', 'ResultadosController@index')->name('cargarResultados');
Route::get('cargarResultadosDer/{id}/{idP}', 'ResultadosController@derivantesResult')->name('cargarResultadosDer');
Route::get('editarResultados/{id}/{idP}/{mode}', 'ResultadosController@edit')->name('editarResultados');
Route::get('editarResultadosDer/{id}/{idP}/{mode}', 'ResultadosController@editDer')->name('editarResultadosDer');



//pacientes
Route::get('pacientes', 'PacientesController@index')->name('pacientes');
Route::get('search_pac', 'PacientesController@search')->name('search_pac');
Route::get('pacienteedit/{id}', 'PacientesController@edit')->name('pacienteedit');
Route::get('historia/{id}/', 'PacientesController@historia')->name('historia');
Route::get('tablaeditpac', 'PacientesController@tablaedit')->name('tablaeditpac');
Route::post('tablaeditpac', 'PacientesController@tablaedit')->name('tablaeditpac');


//doctores
Route::get('doctores', 'DoctoresController@index')->name('doctores');
Route::get('search_doc', 'DoctoresController@search')->name('search_doc');
Route::get('doctoredit/{id}', 'DoctoresController@edit')->name('doctoredit');
Route::get('tablaeditdoc', 'DoctoresController@tablaedit')->name('tablaeditdoc');
Route::post('tablaeditdoc', 'DoctoresController@tablaedit')->name('tablaeditdoc');

//obra social
Route::get('obrassociales', 'ObrasController@index')->name('obrassociales');
Route::get('search_os', 'ObrasController@search')->name('search_os');
Route::get('obraMes','ObrasController@obraMes')->name('obraMes');
Route::post('ordenesMes','ObrasController@ordenesMes')->name('ordenesMes');

/* Controladores para autocompletes */
Route::get('/autocomplete', array('as' => 'autocomplete', 'uses' => 'AutocompleteCodigoController@autocomplete')); //codigos
Route::get('/autocompleteVal', array('as' => 'autocompleteVAL', 'uses' => 'AutocompleteController@autocomplete')); //codigos
Route::get('/autocompleteos', array('as' => 'autocompleteOB', 'uses' => 'AutoosController@autocomplete'));
Route::get('/autocompletedoc', array('as' => 'autocompleteDOC', 'uses' => 'AutoDoctorController@autocomplete'));
Route::get('/autocompleteder', array('as' => 'autocompleteDER', 'uses' => 'AutoDerivanteController@autocomplete'));
Route::get('/autocompletepac', array('as' => 'autocompletePAC', 'uses' => 'AutoPacController@autocomplete'));
Route::get('/autocompleteuser', array('as' => 'autocompleteUSER', 'uses' => 'AutoUserController@autocomplete'));


//mailling
Route::post('mailling','MaillingController@index')->name('mailling');
Route::post('maillingDer','MaillingController@indexDer')->name('maillingDer');

Route::get('tablaeditInf', 'InformesController@tablaeditInf')->name('tablaeditInf');
Route::post('tablaeditInf', 'InformesController@tablaeditInf')->name('tablaeditInf');

Route::post('tablaeditos', 'ObrasController@tablaeditos')->name('tablaeditos');
Route::post('deleteValor', 'AnalisisController@deleteValor')->name('deleteValor');

//Whastsapp
Route::post('enviarWhatsapp','InformesController@enviarWhatsapp')->name('enviarWhatsapp');

//Configuraciones
Route::get('configuracion', 'ConfigController@index')->name('configuracion');
Route::get('firmas', 'ConfigController@firmas')->name('firmas');
Route::post('firmaFotos', 'ConfigController@fotos')->name('firmaFotos');
Route::post('nbu', 'ConfigController@nbu')->name('nbu');
Route::get('indexnbu', 'ConfigController@indexnbu')->name('indexnbu');

//ordenes
Route::get('ipss', 'OrdenesController@ipss')->name('ipss');
Route::get('pami', 'OrdenesController@pami')->name('pami');
Route::get('nacionales', 'OrdenesController@nacionales')->name('nacionales');
Route::get('particulares', 'OrdenesController@particulares')->name('particulares');
Route::get('deudores', 'OrdenesController@deudores')->name('deudores');
Route::post('ordenesIpss','OrdenesController@ordenesIpss')->name('ordenesIpss');
Route::post('ordenesPami','OrdenesController@ordenesPami')->name('ordenesPami');
Route::post('ordenesNacionales','OrdenesController@ordenesNacionales')->name('ordenesNacionales');
Route::post('ordenesDeudores', 'OrdenesController@ordenesDeudores')->name('ordenesDeudores');
Route::post('ordenesParticulares','OrdenesController@ordenesParticulares')->name('ordenesParticulares');
Route::get('ordenespdf/{fecha1}/{fecha2}/{obra}', 'PdfController@ordenes')->name('ordenespdf');


Route::resource('analisi', 'AnalisisController');
Route::resource('usuario', 'UsuariosController');
Route::resource('informe', 'InformesController');
Route::resource('paciente', 'PacientesController');
Route::resource('doctor', 'DoctoresController');
Route::resource('resultados', 'ResultadosController');
Route::resource('lineaInforme', 'LineaInformeController');
Route::resource('obra', 'ObrasController');
Route::resource('lineaInformeDerivante', 'LineaInformeDerivanteController');
Route::resource('config','ConfigController');
