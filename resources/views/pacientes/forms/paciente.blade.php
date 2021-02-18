<!-- content -->
<div class="col-md-6 offset-md-3">
    <div class="form-group">
        {!!Form::label('Nombre:')!!}
        {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del paciente'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('Apellido:')!!}
        {!!Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del paciente'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('Dni:')!!}
        {!!Form::text('DNI',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del paciente'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('Sexo:')!!}
        {!!Form::select('sexo', ['Femenino' => 'Femenino','Masculino' => 'Masculino'],$data->sexo,['class'=>'form-control','placeholder' => 'Sexo'])!!}
    </div>

    <div class="form-group row">
        <div class="col-md-2"> {!!Form::label('Fecha Nac.:')!!}</div>
        <div class="col-md-4"> {!!Form::date('fechaNac',null,['class'=>'form-control','id'=>'birthday'])!!} </div>
                
        <div class="col-md-2"> {!!Form::label('Edad:')!!} </div>
        <div class="col-md-4"> {!!Form::text('edad',null,['class'=>'form-control','id'=>'age'])!!} </div>
    </div>

    <!--div class="form-group">
        {!!Form::label('Edad:')!!}
        {!!Form::text('edad',null,['class'=>'form-control','placeholder'=>'Ingrese la edad del paciente'])!!}
    </div-->

    <div class="form-group">
        {!!Form::label('Obra Social: *')!!}
        {!!Form::text('osnombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de la obra social','id'=>'mutual'])!!}
        <input type="hidden" name="ob" id="ob" value="{{$data->idObrasSociales}}"><!-- el numero de la obra social-->
    </div>

    {{-- <div class="form-group">
            {!!Form::label('Afiliado: *')!!}
            {!!Form::text('afiliado',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del paciente'])!!}
    </div> --}}

    <div class="form-group">
        {!!Form::label('Correo:')!!}
        {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese el email del paciente'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('Telefono:')!!}
        {!!Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del paciente'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('Dirección:')!!}
        {!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del paciente'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('Codigo:')!!}
        {!!Form::text('code',null,['class'=>'form-control','placeholder'=>'10000'])!!}
    </div>
    <br>
      @can('PACIENTES - editar') {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!} @endcan
</div>
