@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>Ordenes Mensuales</h3></div>
            <div class="card-body">
                {!!Form::open(['route'=>'ordenesMes','method'=>'POST'])!!}
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" id="mutual" name="mutual" class="form-control" placeholder="Obra Social" required>
                            <input type="hidden" name="ob" id="ob">
                            {{-- <input type="text" name="q" id="derivante" class="form-control" placeholder="Buscar derivante por matricula o por nombre"> --}}
                                {{--  <span class="input-group-btn">
                                    <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>        --}}
                        </div>
                        <div id="mutual"></div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Selecciones el mes</label>
                                <select class="form-control select2" name="mes">
                                    <option value="01" selected="selected">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Selecciones el año</label>
                                <select class="form-control select2" name="año">
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020" selected="selected">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div id="ordenes"></div>
                </div>
                    <button type="button" class="btn btn-primary" onclick="dataOrden()">Enviar</button>
                 {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptsextras')
<script type="text/javascript">
    var nextinput=0;
    function dataOrden() {
    $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')}  });
    event.preventDefault();
        var parametros = {
            '_token'  : "{{ csrf_token() }}",
            'mes': document.getElementsByName("mes")[0].value,
            "año":document.getElementsByName("año")[0].value,
            "obra":document.getElementsByName("ob")[0].value
        };

        $.ajax({
            data: parametros,
            url: "{{route('ordenesMes')}}",
            dataType: "json",
            type: 'POST',
          success:function(data){
              var data2='';
             /*    if(resp.validation!=''){
                    swal(resp.validation); //si no completa el formulario
                }else{ */
                    data1='<table class="table table-bordered" id="content">'+
                          '<tbody>'+
                          '<tr>'+
                                '<th>Apellido y Nombre</th>'+
                                '<th>Análisis</th>'+
                                '<th>N° de informe</th>'+
                                '<th>Fecha</th>'+
                                '<th>Muestra</th>';

                                jQuery.each(data, function(index) {
                                    data2+='<tr><td>'+data[index].nombre+' '+data[index].apellido+'</td>'+
                                           '<td>'+data[index].analisis+'</td>'+
                                           '<td>'+data[index].Informes_idInformes+'</td>'+
                                           '<td>'+data[index].fecha+'</td>'+
                                           '<td>'+data[index].orden+'</td></tr>';
                                });
                                data3='</tbody>'+'</table>';
                        datos=data1+data2+data3;
                        $("#ordenes").append(datos);
              /*   }  */
          },
          error:function(){
            var html = '<h2>Error al enviar información</h2>';
                      $("#ordenes").html(html);
          }
        });
    }

</script>

<!-- autocompletes para obras sociales -->
<script type="text/javascript">
  $('#mutual').autocomplete({
    source: '{!!URL::route('autocompleteOB')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      $('#mutual').val(ui.item.id);
      $("#ob").val(ui.item.id);
     }
});
</script>
@endsection
