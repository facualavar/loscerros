<script type="text/javascript">
 var nextinput = 0;
 var suma = 0;
 $('#buscar').autocomplete({
    source: '{!!URL::route('autocomplete')!!}',
    minlenght:1,
    autoFocus:true,
    select:function(e,ui){
    if(nextinput==0){
       campo ='<tr id="borrar'+nextinput+'"><td><input type="text" name="codigo[]" id="c'+(nextinput)+'"></td>'+
             '<td><div id="n'+(nextinput)+'"></div></td>'+
             '<td><a onclick="borrar('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'+
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
      nextinput++;     
    }else{
      campo ='<tr id="borrar'+nextinput+'"><td><input type="text" name="codigo[]" id="c'+(nextinput)+'"></td>'+
             '<td><div id="n'+(nextinput)+'"></div></td>'+
             '<input type="hidden" id="ub'+nextinput+'" name="ub'+nextinput+'" ng-model="ub'+nextinput+'">' +
             '<td><a onclick="borrar('+nextinput+')" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>' +              
             '</td></tr>';
      campo1='<input type="hidden" name="descripcion[]" id="descripcion'+nextinput+'">'+
             '<input type="hidden" name="total[]" id="totalF'+nextinput+'">';
      $("#campo1").append(campo1);
      $("#opciones").append(campo);
      $('#c'+(nextinput)+'').val(ui.item.id);
      $('#n'+(nextinput)+'').html(ui.item.value);
      $('#descripcion'+(nextinput)+'').val(ui.item.value);
      $('#ub'+(nextinput)+'').val(ui.item.otro);
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
 function borrar(id) {
   //(id < 10) ? id='0' + id : ''; /// javascript toma 01 como 1 -.-
   document.getElementById("borrar" + id).style.display = 'none';
   $("input#borrar" + id).removeAttr( "name" );
 }
</script>

<script type="text/javascript">
    function validar() {
      document.getElementById("fvalida").submit(); 
    }
</script>