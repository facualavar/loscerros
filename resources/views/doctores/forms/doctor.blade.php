<div class="col-md-6 offset-md-3">
<!-- content -->
    <div class="form-group">
            {!!Form::label('Nombre:')!!}
            {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre'])!!}
    </div>

    <div class="form-group">
            {!!Form::label('Apellido:')!!}
            {!!Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingrese el apellido'])!!}
    </div>

    <div class="form-group">
            {!!Form::label('Matricula:')!!}
            {!!Form::text('matricula',null,['class'=>'form-control','placeholder'=>'Ingrese la matricula'])!!}
    </div>

    <div class="form-group">
            {!!Form::label('Especialidad:')!!}
            {!!Form::text('especialidad',null,['class'=>'form-control','placeholder'=>'Ingrese la especialidad'])!!}
    </div>
    <br>

    @can('DOCTORES - editar')  {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!} @endcan
</div>
