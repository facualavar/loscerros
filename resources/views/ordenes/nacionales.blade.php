@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header"><h3>{{$seccion}} - nbu: {{$nbu}}</h3></div>
            <div class="card-body">
                {!!Form::open(['route'=>'ordenesIpss','method'=>'POST'])!!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="min-height: 200px;">
                            <div class="card-header"><h3>Seleccione Desde:</h3></div>
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="datepicker1"{{--  data-toggle="datetimepicker" data-target="#datepicker1" --}} placeholder="fecha1">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="min-height: 200px;">
                            <div class="card-header"><h3>Seleccione Hasta:</h3></div>
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="datepicker2"{{--  data-toggle="datetimepicker" data-target="#datepicker1" --}} placeholder="fecha2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row table-responsive">
                    <div id="ordenes"></div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary" onclick="dataOrden()">Enviar</button>
                    <div id="boton"></div>
                </div>

                 {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptsextras')
<script>
    $('#datepicker1').datetimepicker({
      format: 'DD-MM-YYYY',
      locale: 'es',
      useCurrent: false,
      defaultDate: false}
    );
</script>

<script>
    $('#datepicker2').datetimepicker({
      format: 'DD-MM-YYYY',
      locale: 'es',
      useCurrent: false,
      defaultDate: false}
    );
</script>

<script type="text/javascript">
    var nextinput=0;

    function dataOrden() {
        var fecha1 = $("#datepicker1").val();
        var fecha2 = $("#datepicker2").val();

        var parametros = {
            '_token'  : "{{ csrf_token() }}",
            'fecha1': moment(fecha1).format('YYYY-MM-DD'),
            "fecha2": moment(fecha2).format('YYYY-MM-DD'),
        };

        $.ajax({
            data: parametros,
            url: "{{route('ordenesNacionales')}}",
            dataType: "json",
            type: 'POST',
          success:function(resp){
              if(resp.status==1){

                var data2='';
                data1=' <div class="table-responsive">'+
                        '<table class="table table-hover" id="content">'+
                        '<tbody>'+
                        '<tr>'+
                            '<th>Fecha - N° de Informe</th>'+
                            '<th>Obra Social</th>'+
                            '<th>Paciente</th>'+
                            '<th>Análisis</th>'+
                            '<th>Precio Part</th>';

                            jQuery.each(resp.data, function(index) {
                                data2+='<tr><td><b>'+resp.data[index].fecha+'</b><br>'+resp.data[index].idInforme+'</td>'+
                                        '<td>'+resp.data[index].obra+'</td>'+
                                        '<td>'+resp.data[index].paciente+'</td>'+
                                        '<td>'+resp.data[index].analisis+'</td>'+
                                        '<td> $'+resp.data[index].precio+'</td></tr>';
                            });
                            data3='</tbody>'+'</table></div>';
                    datos=data1+data2+data3;
                    $("#ordenes").empty().append(datos);
                    var url = '{{route("ordenespdf",["fecha1"=>"'fecha1'","fecha2"=>"'fecha2'","obra"=>0])}}';
                    url = url.replace('%27fecha1%27',  moment(fecha1).format('YYYY-MM-DD'));
                    url = url.replace('%27fecha2%27',  moment(fecha2).format('YYYY-MM-DD'));
                    botton = '<a href="'+url+'" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Imprimir</a>';
                    $("#boton").empty().append(botton);
              }else{
                   $("#ordenes").empty().append('');
                   $("#boton").empty().append('');
                    swal(resp.msg);
              }
          },
          error:function(){
            var html = '<h2>Error al enviar información</h2>';
                      $("#ordenes").html(html);
          }
        });
    }

</script>

@endsection
