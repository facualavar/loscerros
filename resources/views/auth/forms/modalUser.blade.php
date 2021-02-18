<!-- Modal -->

<div class="modal fade" id="myModalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Alta usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>


        {!!Form::open(['route'=>'usuario.store','method'=>'POST'])!!}

        <div class="modal-body">
            @if(isset($status))
            @php $estado = $status->prepend('Seleccione', '');  @endphp
            <div class="form-group">
                {!!Form::label('Estado:')!!}
                {!!Form::select('estado', $estado,'', ['class'=>'form-control'])!!}
            </div>
            @endif

            @if(isset($roles))
            @php  $roles = $roles->prepend('Seleccione', '');  @endphp
            <div class="form-group">
                    {!!Form::label('Tipo de usuario: *')!!}
                    {!!Form::select('Roles_idRoles',$roles,'', ['class'=>'form-control'])!!}
            </div>
            @endif

            <div class="form-group">
                    {!!Form::label('Nombre: *')!!}
                    {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del usuario'])!!}
            </div>

            <div class="form-group">
                    {!!Form::label('Correo: *')!!}
                    {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese el email del usuario'])!!}
            </div>

            <div class="form-group">
                    {!!Form::label('Contraseña: *')!!}
                    {!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese la contraseña'])!!}
            </div>

            <div class="form-group">
                    {!!Form::label('Nueva Contraseña: *')!!}
                    {!!Form::password('repassword',['class'=>'form-control','placeholder'=>'Ingrese la contraseña nuevamente'])!!}
            </div>

            <p>(*) CAMPOS OBLIGATORIOS</p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
        </div>
        {!!Form::close()!!}
    </div>
    </div>
</div>
