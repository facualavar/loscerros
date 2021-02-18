@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3>Cargar o buscar Pacientes</h3></div>
            <div class="card-body">
                {!!Form::open(['route'=>'paciente.store','method'=>'POST','class'=>'forms-sample'])!!}
                <input type="hidden" name="_token" id="tokenPac" value="{!! csrf_token() !!}">
                    <div class="col-sm-12">
                        <div class="input-group input-group-button">
                            <input type="text" class="form-control" placeholder="Buscar Paciente" id="paciente">
                            <div class="input-group-append">
                                <button class="btn1 btn-primary" data-toggle="modal" data-target="#myModal" title="Agregar Paciente" id="botonPac" type="button"><i class="fa fa-plus"></i> <i class="fa fa-user fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="pacDatos"></div>
                @include('informes.forms.modalPaciente')
                {!!Form::close()!!}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3>Cargar o buscar Doctores</h3></div>
            <div class="card-body">
                {!!Form::open(['route'=>'doctor.store','method'=>'POST'])!!}
                <input type="hidden" name="_token" id="tokenDoc" value="{!! csrf_token() !!}">
                   <div class="col-sm-12">
                        <div class="input-group input-group-button">
                            <input type="text" class="form-control" placeholder="Buscar Doctores" id="doctor">
                            <div class="input-group-append">
                                <button class="btn1 btn-primary" data-toggle="modal" data-target="#myModal1" title="Agregar Doctores" id="botonDoc" type="button"><i class="fa fa-plus"></i> <i class="fa fa-user-md fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="doctorDatos"></div>
                @include('informes.forms.modalDoctor')
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>

{!!Form::open(['route'=>'informe.store','method'=>'POST','id'=>'fvalida'])!!}
<input type="hidden" name="matricula1" id="mat">
<input type="hidden" name="dniP" id="dni1">
<input type="hidden" name="mutual1" id="mutual1">
<input type="hidden" name="idPersona" id="idPersona">
<input type="hidden" name="idPersonaD" id="idPersonaD">
<input type="hidden" name="fechaIngreso" id="fechaIngreso">

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><h3>Carga de Análisis</h3></div>
            <div class="card-body">
                <div class="sidebar-form">
                    <div class="input-group">
                    <input type="text" name="q" id="buscar" class="form-control" placeholder="Buscar análisis por código o por nombre">
                        <span class="input-group-btn">
                            <button type="button" name="search" id="search-btn" class="btn1 btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Muestra</th>
                                    <th>Acciones</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody id="opciones">

                        </tbody>
                </table>
                <div id="campo1"></div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><h3>Detalle de la orden {{getFechaActual()}}</h3></div>

            <div class="card-body">

                <div class="form-radio row">
                    <label class="col-sm-6" style="margin-left:-9px">Debe o trajo muestra?</label>
                    <div class="col-sm-6 border-checkbox-section">
                         <div class="border-checkbox-group border-checkbox-group-primary">
                                <input class="border-checkbox" type="checkbox" id="checkbox1" name="si" checked>
                                <label class="border-checkbox-label" for="checkbox1">Trajo</label>
                        </div>
                         <div class="border-checkbox-group border-checkbox-group-primary">
                                <input class="border-checkbox" type="checkbox" name="no" id="checkbox2">
                                <label class="border-checkbox-label" for="checkbox2">Debe</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">N° de orden:</label>
                     <input type="text" name="orden" class="form-control">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">N° de afiliado:</label>
                     <input type="text" name="afiliado" class="form-control">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Diagnostico:</label>
                    <input type="text" name="diagnostico" class="form-control">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Observaciones:</label>
                    <textarea name="observaciones" cols="30" rows="2" class="form-control"></textarea>
                </div>


            </div>

        </div>
    </div>
</div>



<div class="col-sm-4">
    <input type="button" name="cargar" value="Cargar" class="btn btn-primary col-sm-3" id="btt"  onClick="validar()">
</div>
<!-- /.col-4 -->
{!!Form::close()!!}
@endsection


@section('scriptsextras')
    @include('informes.scripts')

    <script>
        $( function() {
            $( "#opciones" ).sortable({
            revert: true
            });

            $( "tr, td" ).disableSelection();
        } );
    </script>

    <script>
        $('#datepicker').dateDropper({
            format: 'd-m-Y',
            lang: 'es'
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
