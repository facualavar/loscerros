@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Resultados del Protocolo: <b> {{$id}} </b> - <b> {{$pac->apellido}} {{$pac->nombre}} </b></div>
                <div class="card-body table-border-style">
                     <div class="row">
                        <div class="table-responsive">
                        {!!Form::model($result,['route'=>['resultados.update',$id],'method'=>'PUT'])!!}
                                <input type="hidden" value="{{$id}}" name="Informes_idInformes"> {{-- id del informe --}}
                                <input type="hidden" value="{{$idP}}" name="Informes_Pacientes_Personas_idPersonas"> {{-- id del paciente --}}
                                <input type="hidden" value="{{Auth::user()->id}}" name="Informes_Usuarios_Personas_idPersonas">
                                <input type="hidden" value="{{$mode}}" name="mode" id="mode">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Analisis</th>
                                        <th>Resultado</th>
                                        <th>Muestra</th>
                                        <th>Referencia</th>
                                        <th>Historial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        @if($d->tipo=='simple')
                                            <tr>
                                                <td style="width:12%"><b>{!!$d->nombre!!}</b></td>
                                                <td>
                                                    @if($d->muestra==0)
                                                        <label id="dm{{limpiarCod($d->codigo)}}" style="display:none" class="text-danger">Debe muestra </label>
                                                        @foreach(getNombre($d->codigo) as $u)
                                                        {!!Form::text($u->nombre,null,['class'=>'form-control dis class'.limpiarCod($d->codigo).'','placeholder'=>$u->nombre,'id'=>$u->nombre])!!}<br>
                                                        @endforeach
                                                    @else
                                                        <label id="dm{{limpiarCod($d->codigo)}}" style="display:none" class="text-danger">Debe muestra </label>
                                                        @foreach(getNombre($d->codigo) as $u)
                                                        {!!Form::text($u->nombre,null,['class'=>'form-control class'.limpiarCod($d->codigo).'','placeholder'=>$u->nombre,'id'=>$u->nombre])!!}<br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td style="width:2%">
                                                    {!! ($d->muestra)?
                                                    '<input type="checkbox" onclick="check('.limpiarCod($d->codigo).',1)" id="sn'.limpiarCod($d->codigo).'" checked><input type="hidden" id="muestra'.limpiarCod($d->codigo).'" name="muestra[]" value="1">' :
                                                    '<input type="checkbox" onclick="check('.limpiarCod($d->codigo).',0)" id="sn'.limpiarCod($d->codigo).'"><input type="hidden" id="muestra'.limpiarCod($d->codigo).'" name="muestra[]" value="0">' !!}
                                                    <input type="hidden" name="codigo[]" value="{{$d->codigo}}">
                                                </td>

                                                <td>
                                                      <a class="feed-card" data-toggle="modal" data-target="#myModalRef{{$d->codigo}}"><i class="ik ik-external-link bg-info feed-icon"></i></a>
                                                      @include('informes.forms.referencia')
                                                </td>

                                                <td>

                                                    <a class="feed-card" data-toggle="modal" data-target="#myModal{{$d->codigo}}"><i class="fa fa-heartbeat bg-primary feed-icon"></i></a>
                                                    @include('informes.forms.modalHistorico')
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="width:12%">
                                                   <b> {!!$d->nombre!!} </b>
                                                </td>
                                                <td>
                                                    @if($d->muestra==0)
                                                        <label id="dm{{limpiarCod($d->codigo)}}" style="display:none" class="text-danger">Debe muestra </label>
                                                        @foreach(getNombre($d->codigo) as $u)
                                                        {!!Form::text($u->nombre,null,['class'=>'form-control dis class'.limpiarCod($d->codigo).'','placeholder'=>$u->nombre,'id'=>'input'.$d->codigo,'id'=>$u->nombre])!!}<br>
                                                        @endforeach
                                                    @else
                                                     <label id="dm{{limpiarCod($d->codigo)}}" style="display:none" class="text-danger">Debe muestra </label>
                                                    <div class="row">
                                                        @foreach(getNombre($d->codigo) as $u)

                                                        @if($u->referencia!='')
                                                        <div class="col-md-5">{!!$u->nombreFormal!!}</div>
                                                            <div class="col-md-7">
                                                                {!! Form::text($u->nombre, null, ['class'=>'form-control class'.limpiarCod($d->codigo).'','placeholder'=>$u->nombre,'id'=>$u->nombre]) !!}
                                                            </div>
                                                        @else
                                                            <label class="col-md-12">{!!$u->nombreFormal!!}</label>  {!! Form::hidden($u->nombre, null, ['class'=>'form-control class'.limpiarCod($d->codigo).'','placeholder'=>$u->nombre,'id'=>$u->nombre]) !!}
                                                        @endif<br>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </td>
                                                <td style="width:2%">
                                                    {!! ($d->muestra)?
                                                    '<input type="checkbox" onclick="check('.limpiarCod($d->codigo).',1)" id="sn'.limpiarCod($d->codigo).'" checked><input type="hidden" id="muestra'.limpiarCod($d->codigo).'" name="muestra[]" value="1">' :
                                                    '<input type="checkbox" onclick="check('.limpiarCod($d->codigo).',0)" id="sn'.limpiarCod($d->codigo).'"><input type="hidden" id="muestra'.limpiarCod($d->codigo).'" name="muestra[]" value="0">' !!}
                                                    <input type="hidden" name="codigo[]" value="{{$d->codigo}}">
                                                </td>

                                                <td>
                                                    <a class="feed-card" data-toggle="modal" data-target="#myModalRef{{$d->codigo}}"><i class="ik ik-external-link bg-info feed-icon"></i></a>
                                                    @include('informes.forms.referencia')
                                                </td>
                                                <td>
                                                    <a class="feed-card" data-toggle="modal" data-target="#myModal{{$d->codigo}}"><i class="fa fa-heartbeat bg-primary feed-icon"></i></a>
                                                    @include('informes.forms.modalHistorico')
                                                </td>
                                            </tr>
                                            @if($d->grupo=='cultivo')
                                            <tr>
                                                <td></td>
                                                <td style="padding: 1.75rem;">
                                                    @if($d->grupo=='cultivo' and $d->codigo=='105')
                                                        @include('informes.resultados.antibiogramaEdit')

                                                        <br>
                                                        @include('informes.resultados.antibiograma')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='468')
                                                        @include('informes.resultados.antibioHemoEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioHemo')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='187')
                                                        @include('informes.resultados.antibioCoproEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioCopro')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='911')
                                                        @include('informes.resultados.antibioUroEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioUro')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='102')
                                                        @include('informes.resultados.antibioEspEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioEsp')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='931')
                                                        @include('informes.resultados.antibioFEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioF')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='931.1')
                                                        @include('informes.resultados.antibioChEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioCh')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='931.2')
                                                        @include('informes.resultados.antibioMyEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioMy')
                                                    @endif

                                                    @if($d->grupo=='cultivo' and $d->codigo=='931.3')
                                                        @include('informes.resultados.antibioUreEdit')

                                                        <br>
                                                        @include('informes.resultados.antibioUre')
                                                    @endif

                                                </td>
                                                <td></td>
                                            </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                <tfoot>
                                    <tr>
                                        @if($mode==0)
                                            <td><button class="btn btn-primary">Editar</button></td>
                                        @else
                                            <td><button class="btn btn-success">Validar</button></td>
                                            <td><button class="btn btn-danger" id="validadoP">Validación Parcial</button></td>
                                        @endif
                                    </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        {!!Form::close()!!}
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsextras')
 <script>

    function check(id,check) {
        if(check==0){
            $('#muestra'+id).val(1);  //el primer click (no lo cuenta sin esto)
             $(".class"+id).removeClass("dis");
             $('#dm'+id).hide();
        }else{
            $('#muestra'+id).val(0);
            $(".class"+id).addClass("dis");
            $('#dm'+id).show();
        }

        $('#sn'+id).click(function() {
                    if ($(this).is(':checked')) {
                        $('#muestra'+id).val(1);
                        $(".class"+id).removeClass("dis");
                        $('#dm'+id).hide();
                    } else {
                        $('#muestra'+id).val(0);
                        $(".class"+id).addClass("dis");
                        $('#dm'+id).show();
                    }
            });
        }
</script>

{{-- funcion para hacer salto entre inputs con el enter --}}
<script>
    $(document).ready(function() {
         var allInputs = $(':text:visible'); //(1)collection of all the inputs I want (not all the inputs on my form)
        $(":text").on("keydown", function () {//(2)When an input field detects a keydown event
            if (event.keyCode == 13) {
                event.preventDefault();
                var nextInput = allInputs.get(allInputs.index(this) + 1);//(3)The next input in my collection of all inputs
                if (nextInput) {
                    nextInput.focus(); //(4)focus that next input if the input is not null
                }
            }
        });

         $( "#validadoP" ).click(function() {
       $("#mode").val(2);
   });
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
             airMode: true
        });
    });
</script>

<script>
    $(document).ready(function() {

        $("#hemoglobina_hepatograma").change(function() {
            var ht=$("#hematocrito").val();
            var gbr=$("#globulos_rojos").val();
            var hb =$("#hemoglobina_hepatograma").val();

            var vcm = [ (parseFloat(ht)) / (parseFloat(gbr)) ] * 10;

            var hcm = [ (parseFloat(hb)) / (parseFloat(gbr)) ] * 10;

            var chcm = [ (parseFloat(hb)) / (parseFloat(ht)) ] * 100;

            $("#vcm").val(parseFloat(vcm).toFixed(0));
            $("#hcm").val(parseFloat(hcm).toFixed(0));
            $("#chcm").val(parseFloat(chcm).toFixed(0));

        });


        $("#bilirrubina_directa").change(function() {
            var bt=$("#bilirrubina_total").val();
            var bd=$("#bilirrubina_directa").val();

            var bi = (parseFloat(bt)) - (parseFloat(bd));

            $("#bilirrubina_indirecta").val(parseFloat(bi).toFixed(2));

        });


    });
</script>

<script>
    $(document).ready(function() {

        $("#neutrofilos_en_cayados").change(function() {
            var aux = $("#neutrofilos_segmentados").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;
            var c=$("#neutrofilos_en_cayados").val();
            var ca = [ (c * gb) / 100 ] / 1000;
            $("#neutrofilos_en_cayados_absoluto").val(parseFloat(ca).toFixed(2));

        });

        $("#neutrofilos_segmentados_G72AW").change(function() {
            var aux = $("#neutrofilos_segmentados").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;
            var n=$("#neutrofilos_segmentados_G72AW").val();
            var na = [ (n * gb) / 100 ] / 1000;
            $("#neutrofilos_segmentados_absoluto").val(parseFloat(na).toFixed(2));
        });

        $("#eosinofilos").change(function() {
            var aux = $("#neutrofilos_segmentados").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var e=$("#eosinofilos").val();
            var ea = [ (e * gb) / 100 ] / 1000;

            $("#eosinofilos_absoluto").val(parseFloat(ea).toFixed(2));
        });

        $("#basofilos").change(function() {
            var aux = $("#neutrofilos_segmentados").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var b=$("#basofilos").val();
            var ba = [ (b * gb) / 100 ] / 1000;

            $("#basofilos_absoluto").val(parseFloat(ba).toFixed(2));
        });

        $("#linfocitos").change(function() {
            var aux = $("#neutrofilos_segmentados").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var l=$("#linfocitos").val();
            var la = [ l * gb / 100 ] / 1000;

            $("#linfocitos_absoluto").val(parseFloat(la).toFixed(2));
        });

        $("#monocitos").change(function() {
            var aux = $("#neutrofilos_segmentados").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var m=$("#monocitos").val();
            var ma = [ m * gb / 100 ] / 1000;

            $("#monocitos_absoluto").val(parseFloat(ma).toFixed(2));
        });

    });
</script>

{{-- hemograma pediatrico --}}
<script>
    $(document).ready(function() {

        $("#neutrofilos_en_cayados_6rBfx").change(function() {
            var aux = $("#leucocitos_AK51H").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;
            var c=$("#neutrofilos_en_cayados_6rBfx").val();
            var ca = [ (c * gb) / 1000 ] / 1000;           
            $("#neutrofilos_en_cayados_absoluto_fZGCx").val(parseFloat(ca).toFixed(2));

        });

        $("#neutrofilos_segmentados_a2X1U").change(function() {
            var aux = $("#neutrofilos_segmentados_a2X1U").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;
            var n=$("#neutrofilos_segmentados_a2X1U").val();
            var na = [ (n * gb) / 1000 ] / 1000;            
            $("#neutrofilos_segmentados_absoluto_xeUsJ").val(na.toFixed(2));
        });

        $("#eosinofilos_WPXDK").change(function() {
            var aux = $("#neutrofilos_segmentados_a2X1U").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var e=$("#eosinofilos_WPXDK").val();
            var ea = [ (e * gb) / 1000 ] / 1000;

            $("#eosinofilos_absoluto_Sd1Y1").val(parseFloat(ea).toFixed(2));
        });

        $("#basofilos_exjjG").change(function() {
            var aux = $("#neutrofilos_segmentados_a2X1U").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var b=$("#basofilos_exjjG").val();
            var ba = [ (b * gb) / 1000 ] / 1000;

            $("#basofilos_absoluto_A9G8Y").val(parseFloat(ba).toFixed(2));
        });

        $("#linfocitos_my8MV").change(function() {
            var aux = $("#neutrofilos_segmentados_a2X1U").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var l=$("#linfocitos_my8MV").val();
            var la = [ l * gb / 1000 ] / 1000;
                  
            $("#linfocitos_absoluto_H3IU8").val(la.toFixed(2));
        });

        $("#monocitos_xXzHq").change(function() {
            var aux = $("#neutrofilos_segmentados_a2X1U").val();
            var gb = parseFloat(aux).toFixed(2) * 1000;

            var m=$("#monocitos_xXzHq").val();
            var ma = [ m * gb / 1000 ] / 1000;

            $("#monocitos_absoluto_X9348").val(parseFloat(ma).toFixed(2));
        });

    });
</script>

<script>
    $(document).ready(function() {

        $("#colesterol_hdl").change(function() {
            var col = $("#colesterol_total").val();
            var hdl = $("#colesterol_hdl").val();
            var aux  = col - hdl;

            $("#colesterol_no_hdl").val(aux);
        });

        $("#insulina").change(function() {
            var glu = $("#glucemia").val();
            var ins = $("#insulina").val();
            var aux1  = [glu * ins] / 405;

            $("#homa").val(parseFloat(aux1).toFixed(2));
        });


        $("#colesterol_hdl").change(function() {
            var col = $("#colesterol_total").val();
            var hdl = $("#colesterol_hdl").val();
            var aux2  = col / hdl;

            $("#relacion_hdlcolesterol").val(parseFloat(aux2).toFixed(1));
        });

        $("#trigliceridos_De935").change(function() {
            var colt = $("#colesterol_total").val();
            var hdlc = $("#colesterol_hdl").val();
            var trg = $("#trigliceridos_De935").val();
            var vldl = trg / 5;
            var aux = parseFloat(hdlc) + parseFloat(vldl);            
            var ldlc  = colt - parseFloat(aux).toFixed(1);            
            $("#ldl_xpDmH").val(parseFloat(ldlc).toFixed(1));
        });
    });
</script>

<!-- autocompletes para valores de analisis -->
<script type="text/javascript">
  $('.class711').autocomplete({
    source: '{!!URL::route('autocompleteVAL')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $(this).val(ui.item.id);
     }
    });

    /*  $('#aspecto_wVPJ6').autocomplete({
    source: '{!!URL::route('autocompleteVAL')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#aspecto_wVPJ6').val(ui.item.id);
     }
    });


     $('#mucus_cfNJK').autocomplete({
    source: '{!!URL::route('autocompleteVAL')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#mucus_cfNJK').val(ui.item.id);
     }
    }); */
</script>

@endsection
