@php $b1=0; $b2=0; $b3=0; $b4=0; $b5=0; $b6=0; $b7=0; $b8=0; $b9=0; $b10=0;
$b11=0; $b12=0; $b13=0; $b14=0; $b15=0; $b16=0; $b17=0; $b18=0; $b19=0; $cont=0;  $contI=0;
$break=0; $break1=0; $break2=0; $break3=0; $break4=0; $met=0; $resulq=0; @endphp

{{-- ************** GRUPO HEMOGRAMA ****************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='hematologia')
<div class="saltos">
@if($b1==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">HEMATOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b1=1; @endphp
@endif

<div class="row">
   @if($d->codigo=='475')

       <div class="col-xs-4">
           <b> {!!$d->nombre!!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
           <br>   <small style="font-size:8.5px;"> Método: {{getMetodo($d->codigo)->metodo}} </small> <br><br>
           @else
               <br><br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if ($u->nombre!='serie_blanca' && $u->nombre!='neutrofilos_segmentados')
                   @if($u->abs=='' and $u->rel=='')
                       @if($u->referencia!='' and $result->$nombre!='')
                           {!!$u->nombreFormal!!}  <br><br>  @if ($u->nombre=='hematocrito' || $u->nombre=='hemoglobina') <br>@endif
                       @else
                       <b>  {!!$u->nombreFormal!!} </b> <br>
                       @endif
                   @endif
               @endif
           @endforeach
       </div>



           <div class="col-xs-3" style="line-height:17.3px;font-style: italic;">
               <br><br><br><br>
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if(isset($result->$nombre))
                   @if ($u->nombre!='serie_blanca' && $u->nombre!='neutrofilos_segmentados')
                       @if($u->abs=='' and $u->rel=='')
                               {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br><br>
                               @if ($u->nombre=='hematocrito' || $u->nombre=='hemoglobina') <br>@endif
                       @endif
                   @endif
               @endif
               @endforeach
           </div>



           <div class="col-xs-6" style="line-height:16.3px">
               <br><br>
               @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if ($u->nombre!='serie_blanca' && $u->nombre!='neutrofilos_segmentados')
               @if($u->abs=='' and $u->rel=='')

                       @if($u->referencia!='-')
                           @if ($u->nombre=='hematocrito' || $u->nombre=='hemoglobina')
                               {!!  $u->referencia !!} <br>
                           @else
                               {!!  $u->referencia !!} <br><br>
                           @endif
                       @else
                           <br><br><br><br>
                       @endif

               @endif
               @endif
               @endforeach
           </div>
   @endif
</div>

<div class="row">
   @if($d->codigo=='475')

       <div class="col-xs-4">
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if ($u->nombre=='serie_blanca' || $u->nombre=='neutrofilos_segmentados')
                   @if($u->abs=='' and $u->rel=='')
                       @if($u->referencia!='' and $result->$nombre!='')
                           {!!$u->nombreFormal!!}  <br>
                       @else
                       <b>  {!!$u->nombreFormal!!} </b> <br>
                       @endif
                   @endif
               @endif
           @endforeach
       </div>



           <div class="col-xs-3" style="font-style: italic;">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if(isset($result->$nombre))
                   @if ($u->nombre=='serie_blanca' || $u->nombre=='neutrofilos_segmentados')
                       @if($u->abs=='' and $u->rel=='')
                             <br> {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                       @endif
                   @endif
               @endif
               @endforeach
           </div>



           <div class="col-xs-6" >
               @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if ($u->nombre=='serie_blanca' || $u->nombre=='neutrofilos_segmentados')
               @if($u->abs=='' and $u->rel=='')

                       @if($u->referencia!='-')
                               {!!  $u->referencia !!} <br>
                       @endif

               @endif
               @endif
               @endforeach
           </div>
   @endif
</div>

@if($d->codigo=='475')
   <div class="row">
       <br>
           <div class="col-xs-4" style="line-height:15.5px;margin-left:0px;">
               <b>FÓRMULA LEUCOCITARIA</b>

                   <br>
                   @foreach(getNombre($d->codigo) as $u)
                       @if($u->rel==1)
                           @if($u->referencia!='')
                               {!!$u->nombreFormal!!}  <br><br>
                           @else
                           <b>  {!!$u->nombreFormal!!} </b> <br> <br>
                           @endif
                       @endif
                   @endforeach

           </div>

           <div class="col-xs-4" style="line-height:15.5px">
               <b>VALOR RELATIVO %</b>

                   <br>
                   @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                       @if($u->rel==1)
                           <span style="line-height:15.5px; font-style: italic;">
                               {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!}
                           </span>

                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if(strlen($result->$nombre)==1) &nbsp; @endif</span>

                           @if($u->referencia!='-')
                                       {!!  $u->referencia !!} <br>  <br>
                           @endif

                       @endif
                   @endforeach



           </div>

           <div class="col-xs-4" style="line-height:15.5px;margin-left:-48px;">
               <b>VALOR ABSOLUTO  x10⁹/L</b>

                   <br>
                   @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                       @if($u->abs==1 && $u->nombre!='plaquetas' && $u->nombre!='observaciones')
                               <span style="line-height:15.5px; font-style: italic;">
                                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!}
                               </span>

                               <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if(strlen($result->$nombre)==1) &nbsp; @endif</span>

                               @if($u->referencia!='-')
                                       {!!  $u->referencia !!} <br>  <br>
                               @endif

                       @endif
                   @endforeach


           </div>

   </div>

@endif

<div class="row">
   @if($d->codigo=='475')

       <div class="col-xs-4">

           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->abs==1 && $u->nombre=='plaquetas' && $result->$nombre!='')
               @if($u->referencia!='')
                   {!!$u->nombreFormal!!}  <br>
               @else
               <b>  {!!$u->nombreFormal!!} </b> <br>
               @endif
           @endif
           @endforeach
       </div>

       <div class="col-xs-3" style="line-height:15.5px; font-style: italic;">

           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->abs==1 && $u->nombre=='plaquetas' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
               @endif

           @endforeach
       </div>

       <div class="col-xs-6">

           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->abs==1 && $u->nombre=='plaquetas' && $result->$nombre!='')
               @php
                       $referencia=explode(',', $u->referencia);
               @endphp

               @for ($i = 0 ; $i < count($referencia) ; $i++)
                   @if($referencia[$i]!='-') {!!$referencia[$i]!!}  <br> @else <br> @endif
               @endfor
               @endif
           @endforeach
       </div>

   @endif
</div>

@if($d->codigo=='475')
   @foreach(getNombre($d->codigo) as $u)
       @if($u->abs==1 && $u->nombre=='observaciones')
               @php $nombre=$u->nombre  @endphp
               @if($result->$nombre!='')
               <div class="row">
                   <div class="col-xs-4">
                       <br><br>
                       {!!$u->nombreFormal!!}  <br>
                   </div>
               @endif
       @endif
   @endforeach

   @foreach(getNombre($d->codigo) as $u)
   @php $nombre=$u->nombre  @endphp
       @if($u->abs==1 && $u->nombre=='observaciones' && $result->$nombre!='')
           <div class="col-xs-8" style="font-style: italic;">
           <br><br>
               {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
           </div>
           </div>
       @endif
   @endforeach
   <div><br></div>
@endif
</div>
@endif
@endif
@endforeach



{{-- *************************hemograma pediatrico ******************--}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='hematologia')
<div class="saltos">
@if($b1==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">HEMATOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b1=1; @endphp
@endif

<div class="row">
   @if($d->codigo=='475-P')

       <div class="col-xs-4">
           <b> {!!$d->nombre!!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
           <br>   <small style="font-size:8.5px;"> Método: {{getMetodo($d->codigo)->metodo}} </small> <br><br>
           @else
               <br><br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if ($u->nombre!='serie_blanca_r8R7s' && $u->nombre!='leucocitos_AK51H')
                   @if($u->abs=='' and $u->rel=='')
                       @if($u->referencia!='' and $result->$nombre!='')
                           {!!$u->nombreFormal!!}  <br><br>  @if ($u->nombre=='hematocrito_k5lLW' || $u->nombre=='hemoglobina_PfoUv') <br>@endif
                       @else
                       <b>  {!!$u->nombreFormal!!} </b> <br>
                       @endif
                   @endif
               @endif
           @endforeach
       </div>



       <div class="col-xs-3" style="line-height:17.5px;font-style: italic;">
           <br><br> <br><br>
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if(isset($result->$nombre))
               @if ($u->nombre!='serie_blanca_r8R7s' && $u->nombre!='leucocitos_AK51H')
                   @if($u->abs=='' and $u->rel=='')
                           {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br><br>
                           @if ($u->nombre=='hematocrito_k5lLW' || $u->nombre=='hemoglobina_PfoUv') <br>@endif
                   @endif
               @endif
           @endif
           @endforeach
       </div>



       <div class="col-xs-6" style="line-height:16.3px">
           <br><br>
           @foreach(getValoresReferencia($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if ($u->nombre!='serie_blanca_r8R7s' && $u->nombre!='leucocitos_AK51H')
           @if($u->abs=='' and $u->rel=='')

                   @if($u->referencia!='-')
                       @if ($u->nombre=='hematocrito_k5lLW' || $u->nombre=='hemoglobina_PfoUv')
                           {!!  $u->referencia !!} <br>
                       @else
                           {!!  $u->referencia !!} <br><br>
                       @endif
                   @else
                       <br>
                   @endif

           @endif
           @endif
           @endforeach
       </div>
   @endif
</div>


<div class="row">
   @if($d->codigo=='475-P')

       <div class="col-xs-4">
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if ($u->nombre=='serie_blanca_r8R7s' || $u->nombre=='leucocitos_AK51H')
                   @if($u->abs=='' and $u->rel=='')
                       @if($u->referencia!='' and $result->$nombre!='')
                           {!!$u->nombreFormal!!}  <br>
                       @else
                       <b>  {!!$u->nombreFormal!!} </b> <br>
                       @endif
                   @endif
               @endif
           @endforeach
       </div>

       <div class="col-xs-3" style="font-style: italic;">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if(isset($result->$nombre))
               @if ($u->nombre=='serie_blanca_r8R7s' || $u->nombre=='leucocitos_AK51H')
                   @if($u->abs=='' and $u->rel=='')
                      <br> {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @endif
               @endif
           @endif
           @endforeach
       </div>

       <div class="col-xs-6" >
           @foreach(getValoresReferencia($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if ($u->nombre=='serie_blanca_r8R7s' || $u->nombre=='leucocitos_AK51H')
           @if($u->abs=='' and $u->rel=='')

                   @if($u->referencia!='-')
                       {!!  $u->referencia !!} <br>
                   @endif

           @endif
           @endif
           @endforeach
       </div>
   @endif
</div>

@if($d->codigo=='475-P')
   <div class="row">
       <br>
       <div class="col-xs-4" style="line-height:15.5px;margin-left:0px;">
           <b>FÓRMULA LEUCOCITARIA</b>

               <br>
               @foreach(getNombre($d->codigo) as $u)
                   @if($u->rel==1)
                       @if($u->referencia!='')
                       {!!$u->nombreFormal!!}  <br><br>
                       @else
                       <b>  {!!$u->nombreFormal!!} </b> <br> <br>
                       @endif
                   @endif
               @endforeach

       </div>

       <div class="col-xs-4" style="line-height:15.5px">
           <b>VALOR RELATIVO %</b>
               <br>
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->rel==1)
                       <span style="line-height:15.5px; font-style: italic;">
                           {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!}
                       </span>

                       <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if(strlen($result->$nombre)==1) &nbsp; @endif</span>

                       @if($u->referencia!='-')
                                   {!!  limpiar($u->referencia) !!} <br>  <br>
                       @endif

                   @endif
               @endforeach
       </div>

       <div class="col-xs-4" style="line-height:15.5px;margin-left:-48px;">
           <b>VALOR ABSOLUTO  x10⁹/L</b>

               <br>
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->abs==1 && $u->nombre!='plaquetas_To0zk' && $u->nombre!='observaciones')
                           <span style="line-height:15.5px; font-style: italic;">
                               {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!}
                           </span>

                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if(strlen($result->$nombre)==1) &nbsp; @endif</span>

                           @if($u->referencia!='-')
                                   {!!  limpiar($u->referencia) !!} <br>  <br>
                           @endif

                   @endif
               @endforeach


       </div>
   </div>
@endif

<div class="row">
   @if($d->codigo=='475-P')
       <div class="col-xs-4">

           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->abs==1 && $u->nombre=='plaquetas_To0zk' && $result->$nombre!='')
               @if($u->referencia!='')
                   {!!$u->nombreFormal!!}  <br>
               @else
               <b>  {!!$u->nombreFormal!!} </b> <br>
               @endif
           @endif
           @endforeach
       </div>

       <div class="col-xs-3" style="line-height:15.5px; font-style: italic;">

           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->abs==1 && $u->nombre=='plaquetas_To0zk' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
               @endif

           @endforeach
       </div>

       <div class="col-xs-6">

           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->abs==1 && $u->nombre=='plaquetas_To0zk' && $result->$nombre!='')
                   @if($u->referencia!='-') {!!$u->referencia!!}  <br> @else <br> @endif
               @endif
           @endforeach
       </div>
   @endif
</div>

@if($d->codigo=='475-P')
   @foreach(getNombre($d->codigo) as $u)
       @if($u->abs==1 && $u->nombre=='observaciones')
               @php $nombre=$u->nombre  @endphp
               @if($result->$nombre!='')
               <div class="row">
                   <div class="col-xs-4">
                       <br><br>
                       {!!$u->nombreFormal!!}  <br>
                   </div>
               @endif
       @endif
   @endforeach

   @foreach(getNombre($d->codigo) as $u)
   @php $nombre=$u->nombre  @endphp
       @if($u->abs==1 && $u->nombre=='observaciones' && $result->$nombre!='')
           <div class="col-xs-8" style="font-style: italic;">
           <br><br>
               {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
           </div>
           </div>
       @endif
   @endforeach
@endif
</div>
@endif
@endif
@endforeach


@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='hematologia')
<div class="saltos">
@if($b1==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">HEMATOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b1=1; @endphp
@endif

<div class="row">
   @if($d->codigo!='475' and $d->codigo!='475-P')
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:15.5px">
               @foreach(getNombre($d->codigo) as $u)
                       <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:8.5px;">  Método: {{getMetodo($d->codigo)->metodo}} </small> <br>
                       @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4">
           <br><b> {{$d->nombre}} </b>
           @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:8.5px;">  Método: {{getMetodo($d->codigo)->metodo}} </small>
           @else
               <br>
           @endif <br>

           @foreach(getNombre($d->codigo) as $u)
               @if($u->referencia!='')
                   {!!$u->nombreFormal!!}  <br>
               @else
               <b>  {!!$u->nombreFormal!!} </b> <br>
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3" style="line-height:15.5px; font-style: italic;">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
           @endforeach
           </div>
       @else
           <div class="col-xs-3" style="font-style: italic;">
               <br><br><br>
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if(isset($result->$nombre))
               {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
           @endif
           @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6" style="line-height:16px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
               @endforeach
               <div><br></div>
           </div>
       @endif
   @endif
</div>
</div>
@endif
@endif
@endforeach


@foreach ($data as $d)
@if($d->grupo=='quimica' || $d->grupo=='citologia' || $d->grupo=='inmunologia' || $d->grupo=='endocrinologia' || $d->grupo=='hemostasia' || $d->grupo=='cultivo' || $d->grupo=='orina' || $d->grupo=='parasitologia')
       @php $b10=1; @endphp
@endif
@endforeach

@foreach ($data as $d)
@if((($d->codigo=='475' || $d->codigo=='475-P')  && $b10==1) && $d->muestra==1)
   <div style="page-break-after:always;"></div>
@endif
@endforeach

{{-- ******************** GRUPO HEMOSTASIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='hemostasia')
<div class="saltos">
@if($b2==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">HEMOSTASIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b2=1; @endphp
@endif

<div class="row">
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='')
                       <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
                   @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4">
           <b> {!!$d->nombre!!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
               <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
           @else
               <br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!$u->nombreFormal!!}  <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3 italica" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-3 italica">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp

                   @if($u->referencia!='' && $result->$nombre!='')
                       {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
                   @endif

               @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6" style="line-height:16px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
               @endforeach
               <div><br></div>
           </div>
       @endif
</div>
</div>
@endif
@endif
@endforeach

@foreach ($data as $d)
@if($d->codigo=='174')
       @php $break4=1; @endphp
@endif
@endforeach

{{-- ******************** GRUPO QUIMICA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='quimica')
@php $cont=$cont + 1; @endphp
<div class="saltos">
@if($b3==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">QUÍMICA </span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b3=1; @endphp
@endif
<div class="row">
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='' && $result->$nombre!='')
                       <b>{!!limpiar($u->nombreFormal)!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
                   @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4">
           <b> {!! limpiar($d->nombre) !!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
               <br> <small style="font-size:10px;"> Método: {{getMetodo($d->codigo)->metodo}} </small> <br>
           @else
               <br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!$u->nombreFormal!!}  <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3 italica" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-3 italica">
               <br>  @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @if(strlen(limpiar($d->nombre)) > 28) <br> @endif
               @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 40) <br> @endif
                   @if($u->referencia!='' && $result->$nombre!='')
                       {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
                   @endif
               @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6" style="line-height:16px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if(limpiar($u->referencia)!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @if(strlen(limpiar($d->nombre)) > 28) <br> @endif
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 40) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='')<br><br> @endif
               @endif
               @endforeach
               <div><br></div>
           </div>
       @endif
</div>
</div>
{{-- @if($d->codigo=='481' && $break4==1)  <div style="page-break-after:always;"></div>  @endif --}}
@endif
@endif
@endforeach

@foreach ($data as $d)
@if($d->grupo=='quimica' || $d->grupo=='hemostasia')
       @php $break2=1; @endphp
@endif
@endforeach

@foreach ($data as $d)
@if($d->codigo=='481' && $break2==1 && $cont==10)
    <div style="page-break-after:always;"></div>
@endif
@endforeach

{{-- ******************** GRUPO ENDOCRINOLOGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='endocrinologia')
<div class="saltos">
@if($b4==0)
{{-- @if($break2==1)  <div style="page-break-after:always;"></div>  @endif --}}
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">ENDOCRINOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b4=1; @endphp
@endif
<div class="row">
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                    @if($u->referencia!='-' && $result->$nombre!='')
                       <b>{!!limpiar($u->nombreFormal)!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @endif
                    @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4" style="line-height: 1.75857143;">
           <b> {!!$d->nombre!!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
               <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
           @else
               <br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!limpiar($u->nombreFormal)!!}  <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3 italica" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
                   {!!menorQueCambio(limpiar($result->$nombre))!!}  {!! $u->unidades!!}<br>
               @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-3 italica" style="line-height: 1.75857143;">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif       
               @if(strlen(limpiar($d->nombre)) > 33) <br> @endif
               @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif                   
                   @if($u->referencia!='' && $result->$nombre!='')
                       {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
                   @endif

               @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6" style="line-height:16px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='')
                    @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
                    {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6" style="line-height: 1.75857143;">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif               
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
               @endforeach
               <div><br></div>
           </div>
       @endif
</div>
</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO INMUNOLOGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='inmunologia')
<div class="saltos">
@if($b5==0)
   {{-- @if($b4==1)  <div style="page-break-after:always;"></div>  @endif --}}
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">INMUNOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b5=1; @endphp
@endif

<div class="row">
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   <b>{!!limpiar($u->nombreFormal)!!}</b>
                   @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                   @else
                   <br>
                   @endif
               @endif
           @endforeach
       </div>
   @else
   <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
               {!!$u->nombreFormal!!}  <br>
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
   </div>
   @endif

   @if($d->tipo=='simple')
       <div class="{{ ($d->referencia==1)? 'col-xs-3' : 'col-xs-7'}} italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio(limpiar($result->$nombre))!!}  {!! $u->unidades!!}<br>
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-3 italica">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               {{-- si el titulo ocupa 2 rengolones --}}
               @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio(limpiar($result->$nombre))!!} {!! $u->unidades!!} <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
           @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
           @endif
           @endforeach
           <div><br></div>
       </div>
   @endif
</div>

@if($d->codigo=='sarscov19')
<div class="row">
    <div class="col-xs-12"><br>
        <b>Sensibilidad del método: 97% </b>
        <b>Especificidad del método: 96% </b>
        <p>La determinación de anticuerpos no es diagnóstico.
        Los resultados se deben evaluar en el contexto clínico y epidemiológico del paciente.<br>
        Los resultados negativos no excluirán la infección por SARS – CoV-2, y no pueden utilizarse como la base única
        para decisión de tratamiento o de otro manejo del paciente. <br>
        Los pacientes inmunodeprimidos que sufran COVID - 19 pueden presentar una demora en la respuesta
        de los anticuerpos y generar niveles que no sean detectables como positivos en el ensayo.  
    </div>  
</div>
@endif

@if($d->codigo=='AgSARS')
<div class="row">
    <div class="col-xs-12"><br>
        <b>Sensibilidad del método: 93,3% </b><br>
        <b>Especificidad del método: 99.4% </b><br>
        La prueba proporciona resultados preliminares. Los resultados negativos no excluyen
        la infección por SARS – CoV – 2 y no pueden usarse como la única base para el tratamiento
         u otras decisiones de manejo. Los resultados negativos deben combinarse con observaciones 
         clínicas, historial del paciente e información epidemiológica. La prueba no está destinada 
         a utilizarse como prueba de detección de donantes para el SARS – CoV – 2  
    </div>  
</div>
@endif

</div>
@endif
@endif
@endforeach


{{-- ******************** GRUPO BIOLOGIA MOLECULAR ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='biologia_molecular')
<div class="saltos">
@if($b19==0)
   {{-- @if($b4==1)  <div style="page-break-after:always;"></div>  @endif --}}
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">BIOLOGIA MOLECULAR</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b19=1; @endphp
@endif

<div class="row">
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   <b>{!!limpiar($u->nombreFormal)!!}</b>
                   @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                   @else
                   <br>
                   @endif
               @endif
           @endforeach
       </div>
   @else
   <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
               {!!$u->nombreFormal!!}  <br>
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
   </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-3 italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio(limpiar($result->$nombre))!!}  {!! $u->unidades!!}<br>
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-3 italica">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               {{-- si el titulo ocupa 2 rengolones --}}
               @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio(limpiar($result->$nombre))!!} {!! $u->unidades!!} <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
           @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
           @endif
           @endforeach
           <div><br></div>
       </div>
   @endif
</div>
</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO QUIMICA URINARIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='quimica_urinaria')
<div class="saltos">
@if($b17==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">QUÍMICA URINARIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b17=1; @endphp
@endif
<div class="row">
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='' && $result->$nombre!='')
                       <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
                   @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4">
           <b> {!! limpiar($d->nombre) !!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
               <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
           @else
               <br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!! limpiar($u->nombreFormal)!!}  <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
               @endif
	        {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 35) <br> @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3 italica" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-3 italica">
               <br>  @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 35) <br> @endif
                   @if($u->referencia!='' && $result->$nombre!='')
                       {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
                   @endif		   
               @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6" style="line-height:16px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 36) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='')<br><br> @endif
               @endif
               @endforeach
           </div>
       @endif
</div>
</div>
@endif
@endif
@endforeach


@foreach ($data as $d)
@if( ($d->grupo=='henatologia' || $d->grupo=='quimica' || $d->grupo=='inmunologia' || $d->grupo=='endocrinologia' || $d->grupo=='hemostasia') && $d->muestra==1)
       @php $b13=1; @endphp
@endif
@endforeach

@foreach ($data as $d)
@if($d->codigo=='711' and $b13!=0)
    <div style="page-break-after:always;"></div>
@endif
@endforeach

{{-- ******************** GRUPO ORINA ************** --}}

@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='orina')
@if($b6==0)
<hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-6px">ORINA COMPLETA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-6px">Resultados</span> </b>
<hr class="linea3"> @php $b6=1; @endphp
@endif
<div class="row" style="line-height: 1.75857143;">
@if($d->codigo=='711')

   <div class="col-xs-4">
       @foreach(getNombre($d->codigo) as $u)
        @php $nombre=$u->nombre  @endphp

           @if($u->referencia!='')
              @if ($result->$nombre!='')  {!!$u->nombreFormal!!}  <br> @endif
           @else
               {!!$u->nombreFormal!!} <br>
           @endif

       @endforeach
   </div>

   <div class="col-xs-6" style="font-style: italic;">
       @foreach(getNombre($d->codigo) as $u)
       @php $nombre=$u->nombre  @endphp
       @if($u->referencia!='')
           @if ($result->$nombre!='')  {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br> @endif
       @else
               <br>
       @endif
       @endforeach
   </div>

   @if($d->referencia!=0)
       <div class="col-xs-6">
       @foreach(getValoresReferencia($d->codigo) as $u)
           {{$u->referencia}} <br>
       @endforeach
       </div>
   @endif
          <div><br><br></div>
@endif
</div>
@endif
@endif
@endforeach

@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='orina')
<div class="saltos">
@if($b6==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-6px">ORINA COMPLETA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-6px">Resultados</span> </b>
   <hr class="linea3"> @php $b6=1; @endphp
@endif
<div class="row">
@if($d->codigo!='711')
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
                   <b>{!!$u->nombreFormal!!}</b>
                   @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                   @else
                   <br>
                   @endif
           @endforeach
       </div>
   @else
   <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
               {!!$u->nombreFormal!!}  <br>
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
   </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-3 italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
           @endforeach
       </div>
   @else
       <div class="col-xs-3 italica">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

           @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
           @endif
           @endforeach
           <div><br></div>
       </div>
   @endif
@endif
</div>
</div>
@endif
@endif
@endforeach

@foreach ($data as $d)
@if(($d->grupo=='andrologia' && $b13==1) && $d->muestra==1)
   <div style="page-break-after:always;"></div>
@endif
@endforeach

{{-- ******************** GRUPO andrologia ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='andrologia')
<div class="saltos">
@if($b18==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">ANDROLOGÍA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span></b>
   <hr class="linea3"> @php $b18=1; @endphp
@endif

        <div class="row">
            {{-- cont1 --}}
            @if($d->codigo=='4858')                
                <div class="row">
                    <div class="col-xs-11" style="margin-left:14px">
                        <br> <b>{{$d->nombre}} </b>
                        @if(getMetodo($d->codigo)->metodo!='')
                        <br> <small style="font-size:8.5px;">  Método: {{getMetodo($d->codigo)->metodo}} </small>
                        @else
                            <br>
                        @endif <br>

                        <p>Evaluado según criterios recomendados por la OMS 2010. El límite inferior de referencia (LI) corresponde al percentil 5. El resto de los valores de referencia (VR) fueron establecidos por consenso.</p>
                    </div>
                </div>

                <div class="col-xs-5">
                    @foreach(getNombre($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->cont1==1)
                        @if( ($result->$nombre!='-' || $result->$nombre!=''))
                            {!!$u->nombreFormal!!}  <br>
                        @else
                        {!! $u->nombreFormal!!} <br>
                        @endif
                        @endif
                    @endforeach
                </div>
                                
                <div class="col-xs-3" style="line-height:16px; font-style: italic;">
                    @foreach(getNombre($d->codigo) as $u)
                    @php $nombre=$u->nombre  @endphp
                    @if($u->cont1==1)
                        @if(($result->$nombre!='-' || $result->$nombre!='' ) )
                            {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                            @if ($u->referencia=='') <br> @endif
                        @endif
                    @endif
                    @endforeach
                </div>
                              
                @if($d->referencia!=0)
                    <div class="col-xs-4" style="line-height:16.5px">
                        @foreach(getValoresReferencia($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->cont1==1)
                        @if(($result->$nombre!='-' || $result->$nombre!='' ) )

                            @if ($u->referencia!="-") {!! $u->referencia !!} <br>  @else <br> @endif
                            @if ($u->referencia=="") <br>  @endif
                        @endif
                        @endif
                        @endforeach
                    </div>
                @endif
                <br>                
            @endif

            {{-- cont2 --}}
            @if($d->codigo=='4858')             
	    55                              
                <div class="col-xs-5" style="line-height:16.8px;">
                    @foreach(getNombre($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->cont2==1)
                        @if( ($result->$nombre!='-' || $result->$nombre!=''))
                            {!!$u->nombreFormal!!}  <br>
                        @else
                        {!! $u->nombreFormal!!} <br>
                        @endif
                        @endif
                    @endforeach
                </div>
                                
                <div class="col-xs-3" style="line-height:17.1px; font-style: italic;">
                    @foreach(getNombre($d->codigo) as $u)
                    @php $nombre=$u->nombre  @endphp
                    @if($u->cont2==1)
                        @if($u->nombre=='concentracion_espermatica_camara_makler®') <br> @endif
                        @if(($result->$nombre!='-' || $result->$nombre!='' ) )
                            {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>                            
                        @endif
                        @if ($u->nombre=="motilidad_espermatica") <br>  @endif 
                    @endif
                    @endforeach
                </div>
                              
                @if($d->referencia!=0)
                    <div class="col-xs-4" style="line-height:16.5px">
                        @foreach(getValoresReferencia($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->cont2==1)
                        @if(($result->$nombre!='-' || $result->$nombre!='' ) )

                            @if ($u->referencia!="-") {!! $u->referencia !!} <br>  @else <br> @endif
                            @if ($u->nombre=="motilidad_espermatica") <br>  @endif 
                        @endif
                        @endif
                        @endforeach
                    </div>
                @endif
                <br>                
            @endif
            
            {{-- cont3 --}}
            @if($d->codigo=='4858')             
	    55                              
                <div class="col-xs-5" style="line-height:17.2px;">
                    @foreach(getNombre($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->cont3==1)
                        @if( ($result->$nombre!='-' || $result->$nombre!=''))
                            {!!$u->nombreFormal!!}  <br>
                        @else
                        {!! $u->nombreFormal!!} <br>
                        @endif
                        @endif
                    @endforeach
                </div>
                                
                <div class="col-xs-3" style="line-height:17.1px; font-style: italic;">
                    @foreach(getNombre($d->codigo) as $u)
                    @php $nombre=$u->nombre  @endphp
                    @if($u->cont3==1)
                        @if($u->nombre=='concentracion_de_espermatozoides_moviles') <br> @endif
                        @if($u->nombre=='vitalidad_espermatica_eosina') <br> @endif
                        @if($u->nombre=='celulas_redondas') <br> @endif
                        @if($u->nombre=='diferenciacion_de_celulas_ortotoluidina') <br> @endif
                        @if(($result->$nombre!='-' || $result->$nombre!='' ) )
                            {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>                            
                        @endif                        
                    @endif
                    @endforeach
                </div>
                              
                @if($d->referencia!=0)
                    <div class="col-xs-4" style="">
                        @foreach(getValoresReferencia($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->cont3==1)
                        @if(($result->$nombre!='-' || $result->$nombre!='' ) )                        
                            @if ($u->referencia!="-") {!! $u->referencia !!} <br>  @else <br> @endif                            
                            @if($u->nombre=='concentracion_de_espermatozoides_moviles') <br> @endif
                                {{-- @if($u->nombre=='vitalidad_espermatica_eosina') <br> @endif --}}
                            {{-- @if($u->nombre=='celulas_redondas') <br> @endif --}}
                            @if($u->nombre=='diferenciacion_de_celulas_ortotoluidina') <br> @endif
                        @endif
                        @endif
                        @endforeach
                    </div>
                @endif
                <br>                
            @endif

            {{-- cont4 --}}
            @if($d->codigo=='4858')
                <div style="page-break-after:always;"></div>
                <div class="col-xs-5">
                    @foreach(getNombre($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->rel==1)
                        @if( ($result->$nombre!='-' || $result->$nombre!=''))
                            {!!$u->nombreFormal!!}  <br>
                        @else
                            {!! $u->nombreFormal!!} <br>
                        @endif
                        @endif
                    @endforeach
                </div>

            @if($d->tipo=='simple')
                <div class="col-xs-3" style="line-height:15.5px; font-style: italic;">
                @foreach(getNombre($d->codigo) as $u)
                @php $nombre=$u->nombre  @endphp
                    {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
                @endforeach
                </div>
            @else
                <div class="col-xs-3" style="line-height:16px;font-style: italic;">
                @foreach(getNombre($d->codigo) as $u)
                @php $nombre=$u->nombre  @endphp
                @if($u->rel==1)
                    @if(($result->$nombre!='-' || $result->$nombre!='' ) )
                        @if($u->nombre=='normales')  <br><br> @endif {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                        @if ($u->referencia=="") <br> @endif
                    @endif
                @endif
                @endforeach
                </div>
            @endif

            @if($d->tipo=='simple')
                <div class="col-xs-6" style="line-height:15.5px">
                    @foreach(getValoresReferencia($d->codigo) as $u)
                        @php
                            $referencia=explode(',', $u->referencia);
                            $uni=explode(',', $u->unidades);
                        @endphp
                    @endforeach

                    @for ($i = 0 ; $i < count($referencia) ; $i++)
                        {!! $referencia[$i] !!}  <br>
                    @endfor
                </div>
            @else
                @if($d->referencia!=0)
                    <div class="col-xs-4" style="line-height:13px;">
                        @foreach(getValoresReferencia($d->codigo) as $u)
                        @php $nombre=$u->nombre  @endphp
                        @if($u->rel==1)
                            @if(($result->$nombre!='-' || $result->$nombre!='' ) )
                                @if ($u->referencia!="-") {!! $u->referencia !!} <br> @endif
                                @if ($u->referencia=='-')
                                    <br> <br>
                                @endif
                            @endif
                            @endif
                        @endforeach
                    </div>
                @endif
                <br>
            @endif
   @endif
</div>
</div>
@endif
@endif
@endforeach


@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='andrologia')
<div class="saltos">
@if($b18==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">ANDROLOGÍA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span></b>
   <hr class="linea3"> @php $b18=1; @endphp
@endif

<div class="row">
   @if($d->codigo!='4858' and $d->codigo!='TR')
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:15.5px">
               @foreach(getNombre($d->codigo) as $u)
                       {!!$u->nombreFormal!!}
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:8.5px;">  Método: {{getMetodo($d->codigo)->metodo}} </small>
                       @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-5">
            <!-- <b>{{$d->nombre}} </b -->
           @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:8.5px;">  Método: {{getMetodo($d->codigo)->metodo}} </small>
           @else
               <br>
           @endif 

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' and $result->$nombre!='')
                   {!!$u->nombreFormal!!}  <br>
               @else
                   @if($u->referencia=='')  <b>  {!!$u->nombreFormal!!} </b> <br>  @endif
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3" style="line-height:15.5px; font-style: italic;">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
           @endforeach
           </div>
       @else
           <div class="col-xs-3" style="font-style: italic;">
               <br><br>
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' and $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br> @else
                   @if($u->referencia=='')   <br> @endif
               @endif
           @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:15.5px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php
                       $referencia=explode(',', $u->referencia);
                       $uni=explode(',', $u->unidades);
                   @endphp
               @endforeach

               @for ($i = 0 ; $i < count($referencia) ; $i++)
                   {!! $referencia[$i] !!}  <br>
               @endfor
           </div>
       @else
       @if($d->referencia!=0)
           <div class="col-xs-6">
               <br><br>
           @foreach(getValoresReferencia($d->codigo) as $u)
               @if($u->referencia!='-') {!!$u->referencia!!} <br> @endif
           @endforeach
           </div>
       @endif
       <br>
       @endif
   @endif

    @if($d->codigo=='TR')
    <div  style="line-height: 1.75857143;">
        <div class="col-xs-3">    
            @foreach(getNombre($d->codigo) as $u)
                @php $nombre=$u->nombre  @endphp
                @if($u->rel!=1)
                @if($u->referencia!='' and $result->$nombre!='')
                    {!!$u->nombreFormal!!}  <br>
                @else
                    @if($u->referencia=='')  <b>  {!!$u->nombreFormal!!} </b> <br>  @endif
                @endif
                @endif
            @endforeach
        </div>
        
        
        <div class="col-xs-2" style="font-style: italic;">            
            @foreach(getNombre($d->codigo) as $u)
            @php $nombre=$u->nombre  @endphp
            @if($u->rel!=1)
                @if($u->referencia!='' and $result->$nombre!='')
                    {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br> @else
                    @if($u->referencia=='')   <br> @endif
                @endif
            @endif
            @endforeach
        </div>
        
        <div class="col-xs-4">      
            <br>
            @foreach(getNombre($d->codigo) as $u)
                @php $nombre=$u->nombre  @endphp
                @if($u->rel==1)
                @if($u->referencia!='' and $result->$nombre!='')
                    {!!$u->nombreFormal!!}  <br>
                @else
                    @if($u->referencia=='')  <b>  {!!$u->nombreFormal!!} </b> <br>  @endif
                @endif
                @endif
            @endforeach
        </div>

        <div class="col-xs-3" style="font-style: italic;">    
            <br>        
            @foreach(getNombre($d->codigo) as $u)
            @php $nombre=$u->nombre  @endphp
            @if($u->rel==1)
                @if($u->referencia!='' and $result->$nombre!='')
                    {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br> @else
                    @if($u->referencia=='')   <br> @endif
                @endif
            @endif
            @endforeach
        </div>
    </div>
@endif
</div>

@if($d->codigo=='TR')
<div class="row">
    <div class="col-xs-12"><br>
        Si para esta técnica se hubiera utilizado toda la muestra para un volumen a inseminar (0,4ml)
    </div>  
</div>
@endif

</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO CULTIVOS ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='cultivo')
<div class="saltos">
@if($b7==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">MICROBIOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span></b>
   <hr class="linea3"> @php $b7=1; @endphp
@endif
<div class="row" style="line-height: 1.75857143;">
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   <b>{!!limpiar($u->nombreFormal)!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
              {!!$u->nombreFormal!!}  <br> @if(strlen($result->$nombre) > 35) <br> @endif 
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="{{ ($d->referencia==1)? 'col-xs-3' : 'col-xs-7'}} italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
               {!!menorQueCambio(limpiar($result->$nombre))!!}  {!! $u->unidades!!}<br>
               @endif
           @endforeach
       </div>
   @else
       <div class="{{ ($d->referencia==1)? 'col-xs-3' : 'col-xs-7'}} italica">
           <br>
	   @if(strlen($d->nombre)>36) <br> @endif
	   @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio(limpiar($result->$nombre))!!} {!! $u->unidades!!} <br>
		   @if(strlen(html_entity_decode(limpiar($u->nombreFormal))) > 40) <br> @endif
               @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
           @endforeach           
       </div>
   @endif
</div>

@if($d->codigo=='105')
   @if(isset(getAntibiograma($protocolo)->antibiogramaS) || isset(getAntibiograma($protocolo)->antibiogramaSI) || isset(getAntibiograma($protocolo)->antibiogramaR) )
   @if(getAntibiograma($protocolo)->antibiogramaS!='' || getAntibiograma($protocolo)->antibiogramaSI!='' || getAntibiograma($protocolo)->antibiogramaR!='')
       <div class="row">

           <div class="col-xs-3">
               <br><b> ANTIBIOGRAMA</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiograma($protocolo)->antibiogramaS; ?>
           </div>


           <?php
           if (getAntibiograma($protocolo)->antibiogramaSI!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiograma($protocolo)->antibiogramaSI;
               echo '</div>';
           }
           ?>

           @if(getAntibiograma($protocolo)->antibiogramaR!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiograma($protocolo)->antibiogramaR; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='468')
   @if(isset(getAntibiogramaHemo($protocolo)->sensibleHemo) || isset(getAntibiogramaHemo($protocolo)->sensibleIHemo) || isset(getAntibiogramaHemo($protocolo)->resistenteHemo) )
   @if(getAntibiogramaHemo($protocolo)->sensibleHemo!='' || getAntibiogramaHemo($protocolo)->sensibleIHemo!='' || getAntibiogramaHemo($protocolo)->resistenteHemo!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaHemo($protocolo)->sensibleHemo; ?>
           </div>


           <?php
           if (getAntibiogramaHemo($protocolo)->sensibleIHemo!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaHemo($protocolo)->sensibleIHemo;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaHemo($protocolo)->resistenteHemo!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaHemo($protocolo)->resistenteHemo; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='187')
   @if(isset(getAntibiogramaCopro($protocolo)->sensibleCopro) || isset(getAntibiogramaCopro($protocolo)->sensibleICopro) || isset(getAntibiogramaCopro($protocolo)->resistenteCopro) )
   @if(getAntibiogramaCopro($protocolo)->sensibleCopro!='' || getAntibiogramaCopro($protocolo)->sensibleICopro!='' || getAntibiogramaCopro($protocolo)->resistenteCopro!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaCopro($protocolo)->sensibleCopro; ?>
           </div>


           <?php
           if (getAntibiogramaCopro($protocolo)->sensibleICopro!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaCopro($protocolo)->sensibleICopro;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaCopro($protocolo)->resistenteCopro!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaCopro($protocolo)->resistenteCopro; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='911')
   @if(isset(getAntibiogramaUro($protocolo)->sensibleUro) || isset(getAntibiogramaUro($protocolo)->sensibleIUro) || isset(getAntibiogramaUro($protocolo)->resistenteUro) )
   @if(getAntibiogramaUro($protocolo)->sensibleUro!='' || getAntibiogramaUro($protocolo)->sensibleIUro!='' || getAntibiogramaUro($protocolo)->resistenteUro!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaUro($protocolo)->sensibleUro; ?>
           </div>


           <?php
           if (getAntibiogramaUro($protocolo)->sensibleIUro!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaUro($protocolo)->sensibleIUro;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaUro($protocolo)->resistenteUro!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaUro($protocolo)->resistenteUro; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='102')
   @if(isset(getAntibiogramaEsp($protocolo)->sensibleEsp) || isset(getAntibiogramaEsp($protocolo)->sensibleIEsp) || isset(getAntibiogramaEsp($protocolo)->resistenteEsp) )
   @if(getAntibiogramaEsp($protocolo)->sensibleEsp!='' || getAntibiogramaEsp($protocolo)->sensibleIEsp!='' || getAntibiogramaEsp($protocolo)->resistenteEsp!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaEsp($protocolo)->sensibleEsp; ?>
           </div>


           <?php
           if (getAntibiogramaEsp($protocolo)->sensibleIEsp!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaEsp($protocolo)->sensibleIEsp;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaEsp($protocolo)->resistenteEsp!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaEsp($protocolo)->resistenteEsp; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='931')
   @if(isset(getAntibiogramaF($protocolo)->sensibleF) || isset(getAntibiogramaF($protocolo)->sensibleIF) || isset(getAntibiogramaF($protocolo)->resistenteF) )
   @if(getAntibiogramaF($protocolo)->sensibleF!='' || getAntibiogramaF($protocolo)->sensibleIF!='' || getAntibiogramaF($protocolo)->resistenteF!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA Flujo Vag.</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaF($protocolo)->sensibleF; ?>
           </div>


           <?php
           if (getAntibiogramaF($protocolo)->sensibleIF!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaF($protocolo)->sensibleIF;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaF($protocolo)->resistenteF!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaF($protocolo)->resistenteF; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='931.1')
   @if(isset(getAntibiogramaCh($protocolo)->sensibleCh) || isset(getAntibiogramaCh($protocolo)->sensibleICh) || isset(getAntibiogramaCh($protocolo)->resistenteCh) )
   @if(getAntibiogramaCh($protocolo)->sensibleCh!='' || getAntibiogramaCh($protocolo)->sensibleICh!='' || getAntibiogramaCh($protocolo)->resistenteCh!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA Chlamydia</b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaCh($protocolo)->sensibleCh; ?>
           </div>


           <?php
           if (getAntibiogramaCh($protocolo)->sensibleICh!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaCh($protocolo)->sensibleICh;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaCh($protocolo)->resistenteCh!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaCh($protocolo)->resistenteCh; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='931.2')
   @if(isset(getAntibiogramaMy($protocolo)->sensibleMy) || isset(getAntibiogramaMy($protocolo)->sensibleIMy) || isset(getAntibiogramaMy($protocolo)->resistenteMy) )
   @if(getAntibiogramaMy($protocolo)->sensibleMy!='' || getAntibiogramaMy($protocolo)->sensibleIMy!='' || getAntibiogramaMy($protocolo)->resistenteMy!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA Mycoplasma </b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaMy($protocolo)->sensibleMy; ?>
           </div>


           <?php
           if (getAntibiogramaMy($protocolo)->sensibleIMy!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaMy($protocolo)->sensibleIMy;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaMy($protocolo)->resistenteMy!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaMy($protocolo)->resistenteMy; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

@if($d->codigo=='931.3')
   @if(isset(getAntibiogramaUre($protocolo)->sensibleUre) || isset(getAntibiogramaUre($protocolo)->sensibleIUre) || isset(getAntibiogramaUre($protocolo)->resistenteUre) )
   @if(getAntibiogramaUre($protocolo)->sensibleUre!='' || getAntibiogramaUre($protocolo)->sensibleIUre!='' || getAntibiogramaUre($protocolo)->resistenteUre!='')
       <div class="row">

           <div class="col-xs-3">
               <b><br> ANTIBIOGRAMA Ureaplasma </b> <br>
               <b>SENSIBLE</b>
               <?php echo '<br>'.getAntibiogramaUre($protocolo)->sensibleUre; ?>
           </div>


           <?php
           if (getAntibiogramaUre($protocolo)->sensibleIUre!='') {
               echo '<div class="col-xs-4" style="margin-left: 0%;">';
               echo '<br><br><b> SENSIBLE INTERMEDIA</b>';
               echo '<br>'.getAntibiogramaUre($protocolo)->sensibleIUre;
               echo '</div>';
           }
           ?>

           @if(getAntibiogramaUre($protocolo)->resistenteUre!='')
           <div class="col-xs-4">
               <br><br>
               <b>RESISTENTE</b>
               <?php echo '<br>'.getAntibiogramaUre($protocolo)->resistenteUre; ?>
           </div>
           @endif
       </div>
   @endif
   @endif
@endif

<div><br><br></div>
</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO MICOLOGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='micologia')
<div class="saltos">
@if($b15==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">MICOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span> </b>
   <hr class="linea3"> @php $b15=1; @endphp
@endif
<div class="row" style="line-height: 1.75857143;">
       @if($d->tipo=='simple')
           <div class="col-xs-4">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='')
                       <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
                   @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4">
           <b> {!! limpiar($d->nombre) !!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
               <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
           @else
               <br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!! limpiar($u->nombreFormal)!!}  <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-3 italica">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='-' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-3 italica">
               <br>  @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
                   @if($u->referencia!='' && $result->$nombre!='')
                       {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
                   @endif
               @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 36) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='')<br><br> @endif
               @endif
               @endforeach               
           </div>
       @endif
       <div><br><br></div>
</div>
</div>
@endif
@endif
@endforeach


{{-- ******************** GRUPO BACTERIOLOGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='bacteriologia')
<div class="saltos">
@if($b8==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">BACTERIOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span> </b>
   <hr class="linea3"> @php $b8=1; @endphp
@endif
<div class="row">
       @if($d->tipo=='simple')
           <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='' && $result->$nombre!='')
                       <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                           <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
                   @endif
               @endforeach
           </div>
       @else
       <div class="col-xs-4">
           <b> {!! limpiar($d->nombre) !!} </b>
           @if(getMetodo($d->codigo)->metodo!='')
               <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
           @else
               <br>
           @endif

           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!! limpiar($u->nombreFormal)!!}  <br>
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
               @endif
           @endforeach
       </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6 italica" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
                   {!!menorQueCambio(limpiar($result->$nombre))!!}  {!! $u->unidades!!}<br>
               @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-3 italica">
               <br>  @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getNombre($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   {{-- si el titulo ocupa 2 rengolones --}}
                   @if(strlen(limpiar($u->nombreFormal)) > 37) <br> @endif
                   @if($u->referencia!='' && $result->$nombre!='')
                       {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
                   @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
                   @endif
               @endforeach
           </div>
       @endif

       @if($d->tipo=='simple')
           <div class="col-xs-6" style="line-height:16px">
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
                   @if($u->referencia!='' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
               @endforeach
           </div>
       @else
           <div class="col-xs-6">
               <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
               @foreach(getValoresReferencia($d->codigo) as $u)
                   @php $nombre=$u->nombre  @endphp
               @if(strlen(limpiar($u->nombreFormal)) > 36) <br> @endif
               @if($u->referencia!='' && $result->$nombre!='')
                       @if($u->referencia!='-')
                           {!! limpiar($u->referencia)!!} <br>
                       @else
                           <br>
                       @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='')<br><br> @endif
               @endif
               @endforeach               
           </div>
       @endif
       <div><br><br></div>
</div>
</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO TOXICOLOGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='toxicologia')
<div class="saltos">
@if($b16==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">TOXICOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span>
   <span  class="col-xs-4" style="display:block; margin-left:64%; margin-top:-7px">Valores de Referencia</span></b>
   <hr class="linea3"> @php $b16=1; @endphp
@endif
<div class="row">
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
               {!!$u->nombreFormal!!}  <br>
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="{{ ($d->referencia==1)? 'col-xs-3' : 'col-xs-7'}} italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
               {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-3 italica">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
               @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
           @endforeach           
       </div>
   @endif
   <div><br><br></div>
</div>
</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO PARASITOLOGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='parasitologia')
<div class="saltos">
@if($b8==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">PARASITOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span> </b>
   <hr class="linea3"> @php $b8=1; @endphp
@endif

<div class="row">
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
               {!!$u->nombreFormal!!}  <br>
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="{{ ($d->referencia==1)? 'col-xs-3' : 'col-xs-7'}} italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
               {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-8 italica">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
               @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
           @endforeach           
       </div>
   @endif
   <div><br><br></div>
</div>
</div>
@endif
@endif
@endforeach

{{-- ******************** GRUPO CITOLGIA ************** --}}
@foreach ($data as $d)
@if($d->muestra==1)
@if($d->grupo=='citologia')
<div class="saltos">
@if($b9==0)
   <hr class="linea2">
   <b><span class="col-xs-3" style="display:block; margin-left:-13px; margin-top:-7px">CITOLOGIA</span>
   <span  class="col-xs-4" style="display:block; margin-left:36%; margin-top:-7px">Resultados</span> </b>
   <hr class="linea3"> @php $b9=1; @endphp
@endif
<div class="row">
   @if($d->tipo=='simple')
       <div class="col-xs-4" style="line-height:16px">
               @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
                   <b>{!!$u->nombreFormal!!}</b>
                       @if(getMetodo($d->codigo)->metodo!='')
                       <br> <small style="font-size:9px;">  Método: {{getMetodo($d->codigo)->metodo}} </small><br><br>
                       @else
                       <br>
                       @endif
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-4">
       <b> {!!$d->nombre!!} </b>
       @if(getMetodo($d->codigo)->metodo!='')
           <br> <small style="font-size:10px;">{{getMetodo($d->codigo)->metodo}} </small> <br>
       @else
           <br>
       @endif

       @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
           @if($u->referencia!='' && $result->$nombre!='')
               {!!$u->nombreFormal!!}  <br>
           @else
               @if($u->referencia=='' && $result->$nombre=='') <br><b> {!!$u->nombreFormal!!} </b> <br> @endif
           @endif
       @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="{{ ($d->referencia==1)? 'col-xs-3' : 'col-xs-7'}} italica" style="line-height:16px">
           @foreach(getNombre($d->codigo) as $u)
           @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='' && $result->$nombre!='')
               {!!menorQueCambio($result->$nombre)!!}  {!! $u->unidades!!}<br>
               @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-3 italica">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getNombre($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                   {!!menorQueCambio($result->$nombre)!!} {!! $u->unidades!!} <br>
               @else
                       @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif

           @endforeach
       </div>
   @endif

   @if($d->tipo=='simple')
       <div class="col-xs-6" style="line-height:16px">
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp
               @if($u->referencia!='-' && $result->$nombre!='') {!! limpiar($u->referencia) !!} <br><br> @endif
           @endforeach
       </div>
   @else
       <div class="col-xs-6">
           <br> @if(getMetodo($d->codigo)->metodo!='') <br> @endif
           @foreach(getValoresReferencia($d->codigo) as $u)
               @php $nombre=$u->nombre  @endphp

               @if($u->referencia!='' && $result->$nombre!='')
                   @if($u->referencia!='-')
                       {!! limpiar($u->referencia)!!} <br>
                   @else
                       <br>
                   @endif
               @else
                   @if($u->referencia=='' && $result->$nombre=='') <br><br> @endif
               @endif
           @endforeach           
       </div>
   @endif
</div>
</div>
@endif
@endif
@endforeach
