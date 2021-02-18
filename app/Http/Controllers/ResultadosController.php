<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use Redirect;
use App\Informe;
use App\InformeDerivante;
use App\LineasInformes;
use App\LineasInformesDerivantes;
use App\RelacionAnalisis;
use App\RelacionInforme;
use Illuminate\Http\Request;

class ResultadosController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$idP)
    {
        if (Auth::check()){
            $seccion = 'Resultados';
            $data=Informe::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','relacionanalisis.muestra','tiposdeanalisis.tipo','tiposdeanalisis.referencia','tiposdeanalisis.grupo')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->get();

            return view('informes.resultados.index',compact('seccion','data','id','idP'));
        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }

    }

    public function derivantesResult($id,$idP)
    {
        if (Auth::check()){
            $seccion = 'Resultados';
            $data=InformeDerivante::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','tiposdeanalisis.tipo','tiposdeanalisis.referencia')
                ->join('relacionanalisisderivante','relacionanalisisderivante.Informes_idInformes','=','informesderivantes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisisderivante.TiposdeAnalisis_codigo')
                ->where('informesderivantes.idInformes','=',$id)
                ->get();

            return view('derivantes.resultados.index',compact('seccion','data','id','idP'));
        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }

    }

    public function edit($id,$idP,$mode)
    {

        if (Auth::check()){
            $seccion = 'Editar Resultados';
            $data=Informe::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','relacionanalisis.muestra','tiposdeanalisis.tipo','tiposdeanalisis.referencia','tiposdeanalisis.grupo')
                ->join('relacionanalisis','relacionanalisis.Informes_idInformes','=','informes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisis.TiposdeAnalisis_codigo')
                ->where('informes.idInformes','=',$id)
                ->get();

            $pac=RelacionInforme::select('personas.nombre','personas.apellido','personas.DNI','pacientes.ObrasSociales_idObrasSociales')
                                ->join('pacientes','pacientes.Personas_idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->join('personas','personas.idPersonas','=','relacioninforme.Pacientes_Personas_idPersonas')
                                ->where('relacioninforme.Informes_idInformes',$id)
                                ->first();

            $result=LineasInformes::find($id);//le mando los resultados al form model

            if($result->linea!=''){
                $result=json_decode($result->linea);
            }

            return view('informes.resultados.edit',compact('seccion','data','id','idP','result','mode','pac'));
        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function editDer($id,$idP,$mode)
    {
        if (Auth::check()){
            $seccion = 'Editar Resultados';
            $data=InformeDerivante::select('tiposdeanalisis.nombre','tiposdeanalisis.codigo','tiposdeanalisis.tipo','tiposdeanalisis.referencia')
                ->join('relacionanalisisderivante','relacionanalisisderivante.Informes_idInformes','=','informesderivantes.idInformes')
                ->join('tiposdeanalisis','tiposdeanalisis.codigo','=','relacionanalisisderivante.TiposdeAnalisis_codigo')
                ->where('informesderivantes.idInformes','=',$id)
                ->get();

            $result=LineasInformesDerivantes::find($id);//le mando los resultados al form model

            return view('derivantes.resultados.edit',compact('seccion','data','id','idP','result','mode'));
        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }
    }

    public function update(Request $request,$id){
        if (Auth::check()){
        //ANTIBIOGRAMAS
        $sensible=''; $resistente=''; $sensibleI=''; //cultivos
        $sensibleHemo=''; $resistenteHemo=''; $sensibleIHemo=''; //hemocultivos
        $sensibleCopro=''; $resistenteCopro=''; $sensibleICopro=''; //copro
        $sensibleUro=''; $resistenteUro=''; $sensibleIUro=''; //uro
        $sensibleEsp=''; $resistenteEsp=''; $sensibleIEsp=''; //esputo
        $sensibleF=''; $resistenteF=''; $sensibleIF=''; //flujo
        $sensibleCh=''; $resistenteCh=''; $sensibleICh=''; //chlamydia
        $sensibleMy=''; $resistenteMy=''; $sensibleIMy=''; //mycoplasma
        $sensibleUre=''; $resistenteUre=''; $sensibleIUre=''; //ureaplasma
        $testnoreactivo = ''; $testreactivodebil = ''; $testreactivofuerte = ''; //test alimentario

            /*********** CULTIVO ***************/
            if (!empty($_POST["antiS"])){
                foreach ($_POST["antiS"] as $c) {

                    if (!empty($c)){
                        $sensible.=$c.'<br>';

                        }
                }
                $request['antibiogramaS']=$sensible;
            }

            if (!empty($_POST["antiSI"])){
                foreach ($_POST["antiSI"] as $c) {

                    if (!empty($c)){
                        $sensibleI.=$c.'<br>';
                    }
                }
                $request['antibiogramaSI']=$sensibleI;
            }

            if (!empty($_POST["antiR"])){
                foreach ($_POST["antiR"] as $c) {

                    if (!empty($c)){
                        $resistente.=$c.'<br>';
                        }
                }
                $request['antibiogramaR']=$resistente;
            }

            /*********** HEMOCULTIVO ***************/
            if (!empty($_POST["antiSH"])){
                foreach ($_POST["antiSH"] as $c) {

                    if (!empty($c)){
                        $sensibleHemo.=$c.'<br>';

                        }
                }
                $request['sensibleHemo']=$sensibleHemo;

            }

            if (!empty($_POST["antiSIH"])){
                foreach ($_POST["antiSIH"] as $c) {

                    if (!empty($c)){
                        $sensibleIHemo.=$c.'<br>';
                    }
                }
                $request['sensibleIHemo']=$sensibleIHemo;
            }

            if (!empty($_POST["antiRH"])){
                foreach ($_POST["antiRH"] as $c) {

                    if (!empty($c)){
                        $resistenteHemo.=$c.'<br>';
                        }
                }
                $request['resistenteHemo']=$resistenteHemo;
            }

            /*********** COPROCULTIVO ***************/
            if (!empty($_POST["antiSCopro"])){
                foreach ($_POST["antiSCopro"] as $c) {

                    if (!empty($c)){
                        $sensibleCopro.=$c.'<br>';

                        }
                }
                $request['sensibleCopro']=$sensibleCopro;

            }

            if (!empty($_POST["antiSICopro"])){
                foreach ($_POST["antiSICopro"] as $c) {

                    if (!empty($c)){
                        $sensibleICopro.=$c.'<br>';
                    }
                }
                $request['sensibleICopro']=$sensibleICopro;
            }

            if (!empty($_POST["antiRCopro"])){
                foreach ($_POST["antiRCopro"] as $c) {

                    if (!empty($c)){
                        $resistenteCopro.=$c.'<br>';
                        }
                }
                $request['resistenteCopro']=$resistenteCopro;
            }

            /*********** UROCULTIVO ***************/
            if (!empty($_POST["antiSUro"])){
                foreach ($_POST["antiSUro"] as $c) {

                    if (!empty($c)){
                        $sensibleUro.=$c.'<br>';

                        }
                }
                $request['sensibleUro']=$sensibleUro;

            }

            if (!empty($_POST["antiSIUro"])){
                foreach ($_POST["antiSIUro"] as $c) {

                    if (!empty($c)){
                        $sensibleIUro.=$c.'<br>';
                    }
                }
                $request['sensibleIUro']=$sensibleIUro;
            }

            if (!empty($_POST["antiRUro"])){
                foreach ($_POST["antiRUro"] as $c) {

                    if (!empty($c)){
                        $resistenteUro.=$c.'<br>';
                        }
                }
                $request['resistenteUro']=$resistenteUro;
            }

            /*********** ESPUTO ***************/
            if (!empty($_POST["antiSEsp"])){
                foreach ($_POST["antiSEsp"] as $c) {

                    if (!empty($c)){
                        $sensibleEsp.=$c.'<br>';

                        }
                }
                $request['sensibleEsp']=$sensibleEsp;

            }

            if (!empty($_POST["antiSIEsp"])){
                foreach ($_POST["antiSIEsp"] as $c) {

                    if (!empty($c)){
                        $sensibleIEsp.=$c.'<br>';
                    }
                }
                $request['sensibleIEsp']=$sensibleIEsp;
            }

            if (!empty($_POST["antiREsp"])){
                foreach ($_POST["antiREsp"] as $c) {

                    if (!empty($c)){
                        $resistenteEsp.=$c.'<br>';
                        }
                }
                $request['resistenteEsp']=$resistenteEsp;
            }

            /*********** FLUJO ***************/
            if (!empty($_POST["antiSF"])){
                foreach ($_POST["antiSF"] as $c) {

                    if (!empty($c)){
                        $sensibleF.=$c.'<br>';

                        }
                }
                $request['sensibleF']=$sensibleF;

            }

            if (!empty($_POST["antiSIF"])){
                foreach ($_POST["antiSIF"] as $c) {

                    if (!empty($c)){
                        $sensibleIF.=$c.'<br>';
                    }
                }
                $request['sensibleIF']=$sensibleIF;
            }

            if (!empty($_POST["antiRF"])){
                foreach ($_POST["antiRF"] as $c) {

                    if (!empty($c)){
                        $resistenteF.=$c.'<br>';
                        }
                }
                $request['resistenteF']=$resistenteF;
            }

            /*********** CHALMYDIA ***************/
            if (!empty($_POST["antiSCh"])){
                foreach ($_POST["antiSCh"] as $c) {

                    if (!empty($c)){
                        $sensibleCh.=$c.'<br>';

                        }
                }
                $request['sensibleCh']=$sensibleCh;

            }

            if (!empty($_POST["antiSICh"])){
                foreach ($_POST["antiSICh"] as $c) {

                    if (!empty($c)){
                        $sensibleICh.=$c.'<br>';
                    }
                }
                $request['sensibleICh']=$sensibleICh;
            }

            if (!empty($_POST["antiRCh"])){
                foreach ($_POST["antiRCh"] as $c) {

                    if (!empty($c)){
                        $resistenteCh.=$c.'<br>';
                        }
                }
                $request['resistenteCh']=$resistenteCh;
            }

            /*********** MYCOPLASMA ***************/
            if (!empty($_POST["antiSMy"])){
                foreach ($_POST["antiSMy"] as $c) {

                    if (!empty($c)){
                        $sensibleMy.=$c.'<br>';

                        }
                }
                $request['sensibleMy']=$sensibleMy;

            }

            if (!empty($_POST["antiSIMy"])){
                foreach ($_POST["antiSIMy"] as $c) {

                    if (!empty($c)){
                        $sensibleIMy.=$c.'<br>';
                    }
                }
                $request['sensibleIMy']=$sensibleIMy;
            }

            if (!empty($_POST["antiRMy"])){
                foreach ($_POST["antiRMy"] as $c) {

                    if (!empty($c)){
                        $resistenteMy.=$c.'<br>';
                        }
                }
                $request['resistenteMy']=$resistenteMy;
            }

            /*********** UREAPLASMA ***************/
            if (!empty($_POST["antiSUre"])){
                foreach ($_POST["antiSUre"] as $c) {

                    if (!empty($c)){
                        $sensibleUre.=$c.'<br>';

                        }
                }
                $request['sensibleUre']=$sensibleUre;

            }

            if (!empty($_POST["antiSIUre"])){
                foreach ($_POST["antiSIUre"] as $c) {

                    if (!empty($c)){
                        $sensibleIUre.=$c.'<br>';
                    }
                }
                $request['sensibleIUre']=$sensibleIUre;
            }

            if (!empty($_POST["antiRUre"])){
                foreach ($_POST["antiRUre"] as $c) {

                    if (!empty($c)){
                        $resistenteUre.=$c.'<br>';
                        }
                }
                $request['resistenteUre']=$resistenteUre;
            }

            /*********** test de tolerancia alimentaria ***************/
            if (!empty($_POST["testnoreactivo"])) {
                foreach ($_POST["testnoreactivo"] as $c) {

                    if (!empty($c)) {
                        $testnoreactivo .= $c . '<br>';
                    }
                }
                $request['noreactivo'] = $testnoreactivo;
            }

            if (!empty($_POST["testreactivodebil"])) {
                foreach ($_POST["testreactivodebil"] as $c) {

                    if (!empty($c)) {
                        $testreactivodebil .= $c . '<br>';
                    }
                }
                $request['reactivodebil'] = $testreactivodebil;
            }

            if (!empty($_POST["testreactivofuerte"])) {
                foreach ($_POST["testreactivofuerte"] as $c) {

                    if (!empty($c)) {
                        $testreactivofuerte .= $c . '<br>';
                    }
                }
                $request['reactivofuerte'] = $testreactivofuerte;
            }
            //haciendo los calculos de formulas
            $glucemia=(isset($request['glucosa']))? $request['glucosa'] : 0;
            $insulina=(isset($request['insulina']))? $request['insulina'] : 0;
            $colesterol=(isset($request['colesterol']))? $request['colesterol'] : 0;
            $trigliceridos=(isset($request['trigliceridos']))? $request['trigliceridos'] : 0;
            $hdl=(isset($request['hdl']))? $request['hdl'] : 0;
            $microalbuminuria=(isset($request['microalbuminuria']))? $request['microalbuminuria'] : 0;
            $creatinuria=(isset($request['creatinina_en_orina']))? $request['creatinina_en_orina'] : 0;

            //calulo del indice HOMA
            if($glucemia!=0 && $insulina!=0){
                 $homa=( (int)$glucemia * (float)$insulina ) / 405 ;
                 $request['cociente_homa']=number_format((float)$homa, 2, '.', '');
            }

            //calulo de relacion colestrol
            if($colesterol!=0 && $trigliceridos!=0 && $hdl!=0){
                $ldl=(int)$colesterol - ((int)$trigliceridos/5 + (float)$hdl);
                $request['ldl']=number_format((float)$ldl, 2, '.', '');
            }

            //calulo índice Microalbuminuria/creat
            if($microalbuminuria!=0 && $creatinuria!=0){
                $indice=( (float)$microalbuminuria * 100) / (float)$creatinuria;
                $request['indicemicro_albcreat']=number_format((float)$indice, 2, '.', '');
            }

            //busco si existe la linea del informe cargada
            $lininf = LineasInformes::find($id);

            if($lininf){
                 $arrayS = array_except($request->all(), ['Informes_idInformes','Informes_Pacientes_Personas_idPersonas','Informes_Usuarios_Personas_idPersonas', 'mode','muestra','codigo','antiS','antiSI','antiR','antiSH','antiSIH','antiRH','antiSCopro','antiSICopro','antiRCopro','antiSUro','antiSIUro','antiRUro','antiSEsp','antiSIEsp','antiREsp','antiSF','antiSIF','antiRF','antiSCh','antiSICh','antiRCh','antiSMy','antiSIMy','antiRMy','antiSUre','antiSIUre','antiRUre','testnoreactivo','testreactivodebil','testreactivofuerte','_method','_token']);

                 /* $lininf->fill($arrayS);
                 $lininf->save(); */
                 $lininf->linea = json_encode($arrayS);
                 $lininf->save();
            }else{

                $arrayS = array_except($request->all(), ['mode','muestra','codigo','antiS','antiSI','antiR','antiSH','antiSIH','antiRH','antiSCopro','antiSICopro','antiRCopro','antiSUro','antiSIUro','antiRUro','antiSEsp','antiSIEsp','antiREsp','antiSF','antiSIF','antiRF','antiSCh','antiSICh','antiRCh','antiSMy','antiSIMy','antiRMy','antiSUre','antiSIUre', 'antiRUre', 'testnoreactivo', 'testreactivodebil', 'testreactivofuerte','_method','_token']);
                //Lineasinformes::create($arrayS);
                Lineasinformes::create(['linea' => json_encode($arrayS)]);
            }

            foreach ($request['codigo'] as $k => $val) {
                RelacionAnalisis::where('Informes_idInformes',$id)->where('TiposdeAnalisis_codigo', $val)->update(['muestra'=>$request['muestra'][$k]]);
            }

            $dataInf=Informe::where('idInformes',$id)->first();

            switch ($request['mode']) {
                case 0:
                   //cambio a estado informado
                   if($dataInf->estado==8){
                        $inf=Informe::where('idInformes',$id)->update(['estado' => 5]);
                    }

                    alert()->success('Resultados editados correctamente')->autoclose(3000);
                    return Redirect::to('informesList');
                    break;

                case 1:
                    $inf=Informe::where('idInformes',$id)->update(['estado' => 4]);
                    alert()->success('Resultados validados correctamente')->autoclose(3000);
                    return Redirect::to('informesList');
                    break;
                case 2:
                    $inf=Informe::where('idInformes',$id)->update(['estado' => 9]);
                    alert()->success('Resultados validados parcialmente')->autoclose(3000);
                    return Redirect::to('informesList');
                    break;
            }

        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }

    }

   /*  public function updateDerivante(Request $request,$id){
        if (Auth::check()){
            //busco si existe la linea del informe cargada
            $lininf = LineasInformesDerivantes::find($id);

            if($lininf){
                $arrayS = array_filter(
                        $request->except(['Informes_idInformes','Informes_Derivantes_Personas_idPersonas','Informes_Usuarios_Personas_idPersonas', 'mode'])
                );
                 $lininf->fill($arrayS);
                 $lininf->save();
            }else{

                $arrayS = array_filter(
                        $request->except(['mode'])
                );
               // dd($arrayS);
                LineasInformesDerivantes::create($arrayS);
            }

            if($request['mode']==0){
                Alert::success('Resultados editados correctamente')->autoclose(3000);
                return Redirect::to('derivantesList');
            }else{
                //cambio a estado valido
                $inf=InformeDerivante::where('idInformes',$id)->update(['estado' => 4]);
                Alert::success('Resultados validados correctamente')->autoclose(3000);
                return Redirect::to('derivantesList');
            }
        }else{
           alert()->warning('El sistema cerro de sesión por favor vuelva a loguearse! :)')->autoclose(3000);
            return Redirect::to('/');
        }

    } */
}
