@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>Datos del Doctor</h3></div>
            <div class="card-body">
                {!!Form::model($data,['route'=>['doctor.update',$data],'method'=>'PUT'])!!}
                     @include('doctores.forms.doctor')
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>

@endsection
