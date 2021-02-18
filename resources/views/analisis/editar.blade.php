@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Agregar Análisis</h3></div>
                <div class="card-body table-responsive">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                            {!!Form::model($data,['route'=>['analisi.update',$codigo],'method'=>'PUT'])!!}
                            @csrf
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width:15%">Codigo *</th>
                                            <th style="width:32%">Nombre *</th>
                                            <th style="width:10%">UB *</th>
                                            <th style="width:20%">Método</th>
                                            <th style="width:10%">Precio *</th>

                                        </tr>
                                        <tr>
                                            <td>{!!Form::text('codigo',null,['class'=>'form-control'])!!}</td>
                                            <td>{!!Form::text('nombre',null,['class'=>'form-control','style'=>"width:100%"])!!}</td>
                                            <td>{!!Form::text('UB',null,['class'=>'form-control'])!!}</td>
                                            <td>{!!Form::text('metodo',null,['class'=>'form-control'])!!}</td>
                                            <td>{!!Form::text('precioDerivantes',null,['class'=>'form-control'])!!}</td>
                                        </tr>
                                            <tr>
                                            <td>Grupo *</td>
                                            <td>
                                                {!!Form::select('grupo', ['' => 'Seleccione un grupo','quimica' => 'Quimica','quimica_urinaria' => 'Quimica Urinaria','endocrinologia'=>'Endocrinologia','inmunologia' => 'Serologia/Inmunologia','hemostasia'=>'Hemostasia','hematologia' => 'Hematologia','orina'=>'Orina', 'cultivo'=>'Cultivos/Microbiologia','parasitologia' => 'Parasitologia','micologia'=>'Micologia','bacteriologia'=>'Bacteriologia','citologia'=>'Citologia','toxicologia'=>'TOXICOLOGÍA','andrologia'=>'ANDROLOGÍA','biologia_molecular'=>'Biologia Molecular'],$data->grupo,['class'=>'form-control','placeholder' => ''])!!}
                                            </td>
                                        </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td> Tipo de Análisis *: </td>
                                            <td>  {!!Form::select('tipo', ['' => 'Selecciones un tipo de análisis','simple' => 'Simple','compuesto'=>'Compuesto'],$data->tipo,['class'=>'form-control','placeholder' => ''])!!} </td>
                                            <td>Tiene valor de referencia? *:</td>
                                            <td> {!!Form::select('referencia', ['' => 'Seleccione referencia','1' => 'Si','0'=>'No'],$data->referencia,['class'=>'form-control','placeholder' => ''])!!}</td>
                                            <td> <button class="btn btn-primary">Cargar</button> </td>
                                        </tr>
                                        <tr>
                                            <b>*Todos los campos son obligatorios!</b><br>
                                        </tr>
                                    </tfoot>
                                </table>
                            {!!Form::close()!!}
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsextras')
@endsection
