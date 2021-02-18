@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Configuración del laboratorio</h3></div>
                <div class="card-body table-responsive">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="col-md-12">
                                    {!!Form::model($data,['route'=>['config.update',$data],'method'=>'PUT'])!!}
                                    @include('config.forms.config')
                                    <hr>
                                    {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
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
