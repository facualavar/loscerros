<!-- Modal -->

        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Alta Obra Social</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>


              {!!Form::open(['route'=>'obra.store','method'=>'POST'])!!}
              <div class="modal-body">
                <div class="form-group">
                      {!!Form::label('Nombre: *')!!}
                      {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del la obra social'])!!}
                </div>

                <div class="form-group">
                      {!!Form::label('NBU:')!!}
                      {!!Form::text('nbu',null,['class'=>'form-control','placeholder'=>'Ingrese el nbu'])!!}
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
