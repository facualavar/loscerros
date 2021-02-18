@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    
                        <div class="box">
                            <div class="box-header">
                            <h3 class="box-title">Informes del día {{getFechaActual()}}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <div id="" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="tabla2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"># Informe</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Paciente</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Fecha Ingreso Paciente</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Usuario</th>
                                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Estado</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Acción</th>
                                            </tr>
                                            </thead>
                                            <tbody>  
                                                @foreach($data as $d)
                                                <tr>
                                                    <td>{{$d->Informes_idInformes}}</td>
                                                    <td>{{$d->apellido}} {{$d->nombre}}</td>
                                                    <td>{{$d->fecha}}</td>
                                                    <td>{{$d->usuario}}</td>
                                                    <td>{{$d->estado}}</td>
                                                    <td>
                                                        <a href="{{route('cargarResultados',['id'=>$d->Informes_idInformes,'idP'=>$d->Pacientes_Personas_idPersonas,'mode'=>0])}}" title="Editar Resultados" class="btn1 btn-primary"><i class="fa fa-edit"></i></a>
                                                        <a href="{{route('agregar',['id'=>$d->Informes_idInformes,'idP'=>$d->Pacientes_Personas_idPersonas])}}" title="Agregar/Eliminar Análisis" class="btn1 btn-warning"><i class="fa fa-plus"></i></a>
                                                        <a href="{{route('tapapdf',['id'=>$d->Informes_idInformes,'idP'=>$d->Pacientes_Personas_idPersonas])}}" title="Tapa" class="btn1 btn-info" target="_blank"><i class="fa fa-sticky-note-o"></i></a>
                                                        <a href="{{route('editarResultados',['id'=>$d->Informes_idInformes,'idP'=>$d->Pacientes_Personas_idPersonas,'mode'=>1])}}" title="Validar" class="btn1 btn-success"><i class="fa  fa-check-square-o"></i></a>
                                                        @if ($d->estado=='Válido' || $d->estado=='Enviado')
                                                        <a onclick="enviar({{$d->Informes_idInformes}},{{$d->Pacientes_Personas_idPersonas}});"  title="Enviar por Mail" class="btn1 btn-danger"><i class="fa fa-envelope"></i></a>
                                                        <a href="{{route('informepdf',['id'=>$d->Informes_idInformes,'idP'=>$d->Pacientes_Personas_idPersonas])}}" title="Imprimir Informe" class="btn1 btn-default" target="_blank"><i class="fa fa-print"></i></a>
                                                        @endif
                                                    </td>
                                                   {{--  <td><a href="{{route('cargarResultados',['id'=>$d->Informes_idInformes,'idP'=>$d->Pacientes_Personas_idPersonas])}}" title="Cargar Informe" class="btn1 btn-primary">
                                                        <i class="fa fa-file-text"></i></a></td> --}}
                                                </tr>
                                                @endforeach             
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                        
                           
                            </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            <!-- /.row -->
            </section>
            <!-- /.content -->
@endsection