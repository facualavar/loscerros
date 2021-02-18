<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Datos del Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Nombres *:</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el/los nombres">
                    </div>
                    <div class="form-group">
                        <label>Apellidos *:</label>
                        <input type="text" class="form-control" name="apellido"  placeholder="Ingrese el/los apellidos">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"> <label>Tipo *:</label> </div>
                        <div class="col-md-4"> {!!Form::select('tipo',['DNI' => 'DNI', 'LE' => 'LE','LC'=>'LC'], null,['class'=>'form-control'])!!} </div>

                        <div class="col-md-2"><label>DNI *:</label></div>
                        <div class="col-md-4"> <input type="text" name="DNI" class="form-control" placeholder="Ingrese el DNI" required pattern="[0-9]{8}"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"> <label>Fecha de Nac:</label> </div>
                        <div class="col-md-4"> {!!Form::date('fechaNac',null,['class'=>'form-control','id'=>'birthday'])!!} </div>

                        <div class="col-md-2"> <label>Edad:</label> </div>
                        <div class="col-md-4"> {!!Form::text('edad',null,['class'=>'form-control','id'=>'age'])!!} </div>
                    </div>

                    <div class="form-group">
                        <label>Sexo:</label>
                        {!!Form::select('sexo',['Femenino' => 'Femenino', 'Masculino' => 'Masculino'], null,['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group" id="modalPac">
                        <label>Obra Social *:</label>
                        <input type="text" id="mutual" name="mutual" class="form-control" placeholder="Obra Social" required>
                        <input type="hidden" name="ob" id="ob"><!-- el numero de la obra social-->
                    </div>
                    <div class="form-group">
                        <label>Telefono:</label>
                        <input type="text" class="form-control" name="telefono" placeholder="Ingrese el telefono o celular">
                    </div>
                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Ingrese la dirección">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Ingrese el email">
                    </div>
            </div>
            <div class="modal-footer">
                <p> Los datos marcados con (*) son obligatorios</p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="dataPaciente()">Guardar</button>
            </div>
        </div>
    </div>
</div>
