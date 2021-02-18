<script type="text/javascript">
 var nextinput = 0;
 var suma = 0;
 var ub = <?php echo getUB()->ub ?>;
 var nbu = <?php echo getNBU()->nbu ?>;
 var cont=0;

$('#buscar').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
    if(nextinput==0){
       campo ='<tr id="borrar'+nextinput+'"><td><input type="text" class="form-control" readonly name="codigo[]" id="c'+(nextinput)+'"></td>'+
             '<td><div id="n'+(nextinput)+'"></div></td>'+
             '<td><div><input type="checkbox" onclick="check('+nextinput+')" id="sn'+(nextinput)+'" checked><input type="hidden" id="muestra'+(nextinput)+'" name="muestra[]" value="1"></div></td>'+
             '<td><a onclick="borrar('+nextinput+','+ui.item.otro+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'+
                  '<input type="hidden" id="ub'+nextinput+'" name="ub'+nextinput+'" ng-model="ub1">' +
             '</td></tr>';
      campo1='<input type="hidden" name="descripcion[]" id="descripcion'+nextinput+'">'+
             '<input type="hidden" name="total[]" id="totalF'+nextinput+'">';
      $("#campo1").append(campo1);
      $("#opciones").append(campo);
      $('#c'+(nextinput)+'').val(ui.item.id);
      $('#n'+(nextinput)+'').html(ui.item.value);
      $('#descripcion'+(nextinput)+'').val(ui.item.value);
      $('#ub'+(nextinput)+'').val(ui.item.otro);
      //calculo para facturacion
     /*  cont=cont + 1;
      var valor1 = document.getElementById('ub'+(nextinput)+'').value;
      suma=suma + (parseFloat(valor1));
      document.getElementById("subtotal").value = cont;
      $("#cantidad").val(cont);
      document.getElementById("total").value = (suma + ub) * nbu;
      $('#totalF'+(nextinput)+'').val((parseFloat(valor1) + ub) * nbu); */
      nextinput++;
    }else{
      cont=cont + 1;
      campo ='<tr id="borrar'+nextinput+'"><td><input type="text" class="form-control" readonly name="codigo[]" id="c'+(nextinput)+'"></td>'+
             '<td><div id="n'+(nextinput)+'"></div></td>'+
             '<input type="hidden" id="ub'+nextinput+'" name="ub'+nextinput+'" ng-model="ub'+nextinput+'">' +
             '<td><div><input type="checkbox" onclick="check('+nextinput+')" id="sn'+(nextinput)+'" checked><input type="hidden" id="muestra'+(nextinput)+'" name="muestra[]" value="1"></div></td>'+
             '<td><a onclick="borrar('+nextinput+','+ui.item.otro+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>' +
             '</td></tr>';
      campo1='<input type="hidden" name="descripcion[]" id="descripcion'+nextinput+'">'+
             '<input type="hidden" name="total[]" id="totalF'+nextinput+'">';
      $("#campo1").append(campo1);
      $("#opciones").append(campo);
      $('#c'+(nextinput)+'').val(ui.item.id);
      $('#n'+(nextinput)+'').html(ui.item.value);
      $('#descripcion'+(nextinput)+'').val(ui.item.value);
      $('#ub'+(nextinput)+'').val(ui.item.otro);
      //calculo de facturacion
     /*  var valor1 = document.getElementById('ub'+(nextinput)+'').value;
      suma=suma + (parseFloat(valor1));
      document.getElementById("subtotal").value = cont;
      $("#cantidad").val(cont);
      document.getElementById("total").value = (suma + ub) * nbu;
      $('#totalF'+(nextinput)+'').val((parseFloat(valor1) + ub) * nbu); */
      nextinput++;
    }
     }
  });
</script>


<script type="text/javascript">
  $('#buscar').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      document.getElementById("buscar").value='';
      $("#buscar").focus();
      }
});
</script>

 <script>
 function borrar(id,ub) {

  /* var total=document.getElementById("total").value;
   var sub=document.getElementById("subtotal").value; */

    document.getElementById("borrar" + id).style.display = 'none';
    document.getElementById("c" + id).value='';
   /*  document.getElementById("total").value=total - cant;
    document.getElementById("subtotal").value=sub - ub; */
}
</script>

 <script>
 function check(id) {
   $('#muestra'+id).val(0);  //el primer click (no lo cuenta sin esto)
   $('#sn'+id).click(function() {
            if ($(this).is(':checked')) {
                 $('#muestra'+id).val(1);
            } else {
                 $('#muestra'+id).val(0);
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
    appendTo: "#modalPac",
    select:function(e,ui){
      $('#mutual').val(ui.item.id);
      $("#ob").val(ui.item.id);

     // if($("#ob").val()==68){
         //  document.getElementById("afiliado").style.display = 'none';
         // document.getElementById("afiliado1").style.display = 'none'; */
         // document.getElementById("facturacion").style.display = 'block';
     // }else{
           // document.getElementById("afiliado").style.display = 'block';
           //document.getElementById("afiliado1").style.display = 'block';
          // document.getElementById("facturacion").style.display = 'none';
     // }
     }
});
</script>

<script type="text/javascript">
var nextinput = 0;
  $('#doctor').autocomplete({
    source: '{!!URL::route('autocompleteDOC')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
  if(nextinput==0){
      datos='<div class="row" id="borrarDoc'+nextinput+'">'+
            '<div class="col-md-3"><label><b>Nombre:</b></label><div id="nombre'+nextinput+'"></div></div>'+
            '<div class="col-md-3"><label><b>Apellido:</b></label><div id="apellido'+nextinput+'"></div></div>'+
            '<div class="col-md-3"><label><b>Matricula:</b></label><div id="matri'+nextinput+'"></div></div>'+
            '<a onclick="borrarDoc('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></div>';
      $("#doctorDatos").append(datos);
      $('#matri'+nextinput+'').html(ui.item.matricula);
      $('#nombre'+nextinput+'').html(ui.item.nombre);
      $('#apellido'+nextinput+'').html(ui.item.apellido);
      //datos para el controlador
      $("#mat").val(ui.item.matricula);
      $("#idPersonaD").val(ui.item.idPersonaD);
      $("#buscar").focus();
      $("#doctor").prop("readonly",true);
      $("#botonDoc").attr("disabled", "disabled");
      nextinput++;
   }else{
       datos='<div class="row" id="borrarDoc'+nextinput+'">'+
            '<div class="col-md-3"><label>Nombre:</label><div id="nombre'+nextinput+'"></div></div>'+
            '<div class="col-md-3"><label>Apellido:</label><div id="apellido'+nextinput+'"></div></div>'+
            '<div class="col-md-3"><label>Matricula:</label><div id="matri'+nextinput+'"></div></div>'+
            '<a onclick="borrarDoc('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></div>';
      $("#doctorDatos").append(datos);
      $('#matri'+nextinput+'').html(ui.item.matricula);
      $('#nombre'+nextinput+'').html(ui.item.nombre);
      $('#apellido'+nextinput+'').html(ui.item.apellido);
       //datos para el controlador
      $("#mat").val(ui.item.matricula);
      $("#idPersonaD").val(ui.item.idPersonaD);
      $("#doctor").prop("readonly",true);
      $("#botonDoc").attr("disabled", "disabled");
      $("#buscar").focus();
      nextinput++;
    }
      }
  });
</script>

<script>
 function borrarDoc(id) {
    $("#doctor").prop("readonly",false);
    document.getElementById("borrarDoc" + id).style.display = 'none';
    document.getElementById("doctor").value='';
    $("#doctor").focus();
    $("#botonDoc").attr("disabled", false);
}
</script>

<script type="text/javascript">
var nextinput=0;
  $('#paciente').autocomplete({
    source: '{!!URL::route('autocompletePAC')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
      if(nextinput==0){
      datos='<div class="row" id="borrarPac'+nextinput+'">'+
                    '<div class="col-md-3"><label><b>Nombre:</b></label><div id="nombreP'+nextinput+'"></div></div>'+
                    '<div class="col-md-3"><label><b>Apellido:</b></label><div id="apellidoP'+nextinput+'"></div></div>'+
                    '<div class="col-md-2"><label><b>DNI:</b></label><div id="dniP'+nextinput+'"></div></div>'+
                    '<div class="col-md-3"><label><b>Obra Social:</b></label><div id="obP'+nextinput+'"></div></div>'+
                    '<a onclick="borrarPac('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></div>';
      $("#pacDatos").append(datos);
      $('#nombreP'+nextinput+'').html(ui.item.nombre);
      $('#apellidoP'+nextinput+'').html(ui.item.apellido);
      $('#dniP'+nextinput+'').html(ui.item.dni);
      $('#obP'+nextinput+'').html(ui.item.os);
      /* document.getElementById("afiliado").style.display = 'block';
      $('#afiliado').html(ui.item.afiliado); */
      //datos para el controlador
      $("#mutual1").val(ui.item.idos);
      $("#idPersona").val(ui.item.idPersona);
      $("#dni1").val(ui.item.dni);
      $("#paciente").prop("readonly",true);
      $("#doctor").focus();
      $("#botonPac").attr("disabled", "disabled");
      nextinput++;
      }else{
      datos='<div class="row" id="borrarPac'+nextinput+'">'+
                    '<div class="col-md-3"><label><b>Nombre:</b></label><div id="nombreP'+nextinput+'"></div></div>'+
                    '<div class="col-md-3"><label><b>Apellido:</b></label><div id="apellidoP'+nextinput+'"></div></div>'+
                    '<div class="col-md-2"><label><b>DNI:</b></label><div id="dniP'+nextinput+'"></div></div>'+
                    '<div class="col-md-3"><label><b>Obra Social:</b></label><div id="obP'+nextinput+'"></div></div>'+
                    '<a onclick="borrarPac('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></div>';
      $("#pacDatos").append(datos);
      $('#nombreP'+nextinput+'').html(ui.item.nombre);
      $('#apellidoP'+nextinput+'').html(ui.item.apellido);
      $('#dniP'+nextinput+'').html(ui.item.dni);
      $('#obP'+nextinput+'').html(ui.item.os);
      /* document.getElementById("afiliado").style.display = 'block';
      $('#afiliado').html(ui.item.afiliado); */
      //datos para el controlador
      $("#mutual1").val(ui.item.idos);
      $("#idPersona").val(ui.item.idPersona);
      $("#dni1").val(ui.item.dni);
      $("#paciente").prop("readonly",true);
      $("#botonPac").attr("disabled", "disabled");
      $("#doctor").focus();
      nextinput++;
      }
    }
  });
</script>

<script>
 function borrarPac(id) {
    $("#paciente").focus();
    document.getElementById("borrarPac" + id).style.display = 'none';
    document.getElementById("paciente").value='';
    document.getElementById("mutual").value='';
   /*  document.getElementById("afiliado").style.display = 'none'; */
    $("#paciente").prop("readonly",false);
    $("#botonPac").attr("disabled", false);
}
</script>

<script type="text/javascript">
var nextinput=0;
    function dataDoctor() {
    $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')}  });
    event.preventDefault();
        var parametros = {
            '_token'  : $('#tokenDoc').val(),
            'nombreD': document.getElementsByName("nombreD")[0].value,
            "apellidoD":document.getElementsByName("apellidoD")[0].value,
            "matriculaD":document.getElementsByName("matriculaD")[0].value,
            "especialidad":document.getElementsByName("especialidad")[0].value,
            "idPersonaD":document.getElementsByName("idPersonaD")[0].value
        };
        $.ajax({
            data: parametros,
            url: "{{route('doctor.store')}}",
            dataType: "json",
            type: 'POST',
          success:function(resp){
                if(resp.validation!=''){
                    swal(resp.validation); //si no completa el formulario
                }else{
                        if(resp.msg!=''){
                            swal(resp.msg);
                            $("#doctor").prop("readonly",true);
                        }

                        datos='<div class="row" id="borrarDoc'+nextinput+'">'+
                        '<div class="col-md-3"><label>Nombre:</label><div id="nombre'+nextinput+'"></div></div>'+
                        '<div class="col-md-3"><label>Apellido:</label><div id="apellido'+nextinput+'"></div></div>'+
                        '<div class="col-md-3"><label>Matricula:</label><div id="matri'+nextinput+'"></div></div>'+
                        '<a onclick="borrarDoc('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></div>';

                        $("#doctorDatos").append(datos);
                        $('#matri'+nextinput+'').html(resp.matricula);
                        $('#nombre'+nextinput+'').html(resp.nombre);
                        $('#apellido'+nextinput+'').html(resp.apellido);
                        $('#mat').val(resp.matricula);
                        $("#idPersonaD").val(resp.idPersonaD);
                        $("#botonDoc").attr("disabled", "disabled");
                        $("#doctor").prop("readonly",true);
                        nextinput++;
                }
          },
          error:function(){
            var html = '<h2>Error al enviar información</h2>';
                      $("#doctorDatos").html(html);
          }
        });
    }

</script>

<script type="text/javascript">
var nextinput=0;
    function dataPaciente() {
    $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')}  });
    event.preventDefault();
        var parametros = {
            '_token'  : $('#tokenPac').val(),
            'nombre': document.getElementsByName("nombre")[0].value,
            "apellido":document.getElementsByName("apellido")[0].value,
            "DNI":document.getElementsByName("DNI")[0].value,
            "sexo":document.getElementsByName("sexo")[0].value,
            "fechaNac":document.getElementsByName("fechaNac")[0].value,
            "telefono":document.getElementsByName("telefono")[0].value,
            "direccion":document.getElementsByName("direccion")[0].value,
            "email":document.getElementsByName("email")[0].value,
            "mutual":document.getElementsByName("mutual")[0].value,
            "ob":document.getElementsByName("ob")[0].value,
            "edad":document.getElementsByName("edad")[0].value,
            /* "diagnostico":document.getElementsByName("diagnostico")[0].value, */
            "fechaIngreso":document.getElementsByName("fechaIngreso")[0].value,
            "idPersona":document.getElementsByName("idPersona")[0].value,
            /* "afiliado":document.getElementsByName("afiliado")[0].value */
        };
        $.ajax({
            data: parametros,
            url: "{{route('paciente.store')}}",
            dataType: "json",
            type: 'POST',
          success:function(resp){
                if(resp.validation!=''){
                    swal(resp.validation); //si no completa el formulario
                }else{
                    if(resp.status!='0'){
                        if(resp.msg!=''){
                            swal(resp.msg);
                            $("#paciente").prop("readonly",true);
                        }

                        datos='<div class="row" id="borrarPac'+nextinput+'">'+
                        '<div class="col-md-3"><label><b>Nombre:</b></label><div id="nombreP'+nextinput+'"></div></div>'+
                        '<div class="col-md-3"><label><b>Apellido:</b></label><div id="apellidoP'+nextinput+'"></div></div>'+
                        '<div class="col-md-2"><label><b>DNI:</b></label><div id="dniP'+nextinput+'"></div></div>'+
                        '<div class="col-md-3"><label><b>Obra Social:</b></label><div id="obP'+nextinput+'"></div></div>'+
                        '<a onclick="borrarPac('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></div>';
                        $("#pacDatos").append(datos);
                        $('#nombreP'+nextinput+'').html(resp.nombre);
                        $('#apellidoP'+nextinput+'').html(resp.apellido);
                        $('#dniP'+nextinput+'').html(resp.DNI);
                        $('#obP'+nextinput+'').html(resp.mutual);
                        /* document.getElementById("afiliado").style.display = 'block';
                        $('#afiliado').html(resp.afiliado); */
                        $("#dni1").val(resp.DNI);
                        $("#mutual1").val(resp.obrasocial);
                        $("#fechaIngreso").val(resp.fechaIngreso);
                        $("#idPersona").val(resp.idPersona);
                        /* $("#diagnostico").val(resp.diagnostico); */
                        $("#botonPac").attr("disabled", "disabled");
                        $("#paciente").prop("readonly",true);
                        nextinput++;

                    }else{
                          swal(resp.msg);
                    }
                }
          },
          error:function(){
            var html = '<h2>Error al enviar información</h2>';
                      $("#pacDatos").html(html);
          }
        });
    }

</script>

<script type="text/javascript">
    function validar() {

        document.getElementById("fvalida").submit();

    }

</script>

{{-- <script>
   function factura() {
    /* guardo el array de inputs */
    var idp= document.getElementsByName("idPersona")[0].value;
    var aux=[],aux1=[];
    var tama=document.getElementsByName("descripcion[]").length;
    for (i = 0; i < tama; i++) {
      aux[i]= document.getElementsByName("descripcion[]")[i].value;
      aux1[i]=document.getElementsByName("total[]")[i].value;
    }

    $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')}  });
    event.preventDefault();
        var parametros = {
            '_token'  : $('#tokenFac').val(),
            'idPersona': document.getElementsByName("idPersona")[0].value,
            "cantidad": document.getElementsByName("cantidad")[0].value,
            "descripcion":JSON.stringify(aux),/*debo enviarlo de esta forma para que lo procese ajax/json*/
            "total":JSON.stringify(aux1)
        };
        $.ajax({
            data: parametros,
            url: "{{route('factura.store')}}",
            dataType: "json",
            type: 'POST',
            success:function(resp){

            var ventana= window.open();
            ventana.document.location='{!!URL::to("factura/'+resp.idFactura+'/mostrar")!!}';
            /*var parametros = {
                '_token'  : $('#tokenFac').val(),
                "id": resp.idFactura
            };
            $.ajax({
                data: parametros,
                url: "{!!URL::to('factura/mostrar')!!}",
                type: 'POST'

            });*/


            }

        });

    }
</script>

<script>
   function factura1() {
    /* guardo el array de inputs */
    var idp= document.getElementsByName("idPersona")[0].value;
    var aux=[],aux1=[];
    var tama=document.getElementsByName("descripcion[]").length;
    for (i = 0; i < tama; i++) {
      aux[i]= document.getElementsByName("descripcion[]")[i].value;
      aux1[i]=document.getElementsByName("total[]")[i].value;
    }

    $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')}  });
    event.preventDefault();
        var parametros = {
            '_token'  : $('#tokenFac').val(),
            'idPersona': document.getElementsByName("idPersona")[0].value,
            "cantidad": document.getElementsByName("cantidad")[0].value,
            "descripcion":JSON.stringify(aux),/*debo enviarlo de esta forma para que lo procese ajax/json*/
            "total":JSON.stringify(aux1)
        };
        $.ajax({
            data: parametros,
            url: "{{route('factura.store')}}",
            dataType: "json",
            type: 'POST',
            success:function(resp){
               document.getElementById("fvalida").submit();
               // location.href='{!!URL::to("informe")!!}';
          }

        });

    }
</script> --}}
