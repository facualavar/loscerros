<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Datos del Medico solicitante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('Nombres: *')!!}
                    <input type="text" name="nombreD" class="form-control" placeholder="Ingrese el/los nombres" id="nombreD">
                </div>

                <div class="form-group">
                    {!!Form::label('Apellidos: *')!!}
                        <input type="text" name="apellidoD" class="form-control" placeholder="Ingrese el/los apellidos" id="">
                </div>

                <div class="form-group">
                {!!Form::label('Matricula: *')!!}
                    <input type="text" name="matriculaD" class="form-control" placeholder="Ingrese la matricula" id="">
            </div>


                <div class="form-group">
                {!!Form::label('Especialidad:')!!}
                <input type="email" name="especialidad" class="form-control" placeholder="Ingrese la especialidad" id="">
            </div>

            </div>
            <div class="modal-footer">
            <p> Los datos marcados con (*) son obligatorios</p>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="dataDoctor()">Guardar</button>
            </div>

        </div>
    </div>
</div>

