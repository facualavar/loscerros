            {!! Form::hidden('company', null, ['class'=>'form-control']) !!}
            <div class="form-group">
                  <b>Nombre: </b>
                  {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del usuario'])!!}
            </div>

            <div class="form-group">
                  <b>Dirección: </b>
                  {!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la direccion'])!!}
            </div>

            <div class="form-group">
                  <b>Telefono: </b>
                  {!!Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Ingrese la contraseña'])!!}
            </div>

            <div class="form-group">
                  <b>Celular: </b>
                  {!!Form::text('celular',null,['class'=>'form-control','placeholder'=>'Ingrese la contraseña nuevamente'])!!}
            </div>

            <div class="form-group">
                  <b>Correo: </b>
                  {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese el email del usuario'])!!}
            </div>

            <div class="form-group">
                  <b>Facebook: </b>
                  {!!Form::text('facebook',null,['class'=>'form-control','placeholder'=>'Página de facebook'])!!}
            </div>

            <div class="form-group">
                  <b>Twitter: </b>
                  {!!Form::text('twitter',null,['class'=>'form-control','placeholder'=>'Página de Twitter'])!!}
            </div>

            <div class="form-group">
                  <b>Instagram: </b>
                  {!!Form::text('instagram',null,['class'=>'form-control','placeholder'=>'Página de Instagram'])!!}
            </div>

