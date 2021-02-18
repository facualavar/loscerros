@extends('layouts.app')
@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Nomenclador Bioquimico Único</h3></div>
                <div class="card-body table-responsive">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="col-md-12">
                                   {!!Form::open(['route'=>'nbu','method'=>'POST'])!!}

                                        <p>El NBU actual es: {!! $nbu !!}</p>

                                        <div class="form-group">
                                        {!!Form::label('Nbu: *')!!}
                                        <input type="text" name="nbu" class="form-control" placeholder="Ingrese el nbu">
                                        </div>

                                        <p> Los datos marcados con (*) son obligatorios</p>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}

                                    {!!Form::close()!!}
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
    </div>
@endsection
