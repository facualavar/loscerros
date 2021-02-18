@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="row">
    <div class="card">
        <div class="card-header">
               <h4 class="sub-title">Roles y Permisos de usuario</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-xl-12 mb-30">
                    <div class="col-sm-12 col-xl-12 mb-30">
                        <h3 class="sub-title">{{ $rol->name }}</h3>
                    {!! Form::open(['route'=> ['roles.update', $rol->id], 'method' => 'PUT', 'class' => 'form-horizontal' ]) !!}
                       @foreach ($per as $p)
                        <div class="form-check mx-sm-2">
                            <label class="custom-control custom-checkbox">
                            @if($p['pivot']==1)
                                {{ Form::checkbox('permission[]',$p['id'],null,['class'=>'custom-control-input','checked']) }}
                            @else
                                {{ Form::checkbox('permission[]',$p['id'],null,['class'=>'custom-control-input']) }}
                            @endif
                                <span class="custom-control-label">&nbsp; {{ $p['name'] }}</span>
                            </label>
                        </div>
                        @endforeach
                        <div class="form-check mx-sm-2"><br><button class="btn btn-info">Guardar</button></div>
                    {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

