@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>Datos del Paciente</h3></div>
            <div class="card-body">
                {!!Form::model($data,['route'=>['paciente.update',$data],'method'=>'PUT'])!!}
                    @include('pacientes.forms.paciente')
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>


@endsection

@section('scriptsextras')
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
     }
});
</script>

<script>
    $(function(){
        $('#birthday').on('change', calcularEdad);
    });

    function calcularEdad() {

        fecha = $(this).val();
        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
        $('#age').val(edad);
    }
</script>
@endsection
