@extends('layouts.app')
@section('content')

    <div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <a href="{{route('listado')}}" >
            <div class="widget bg-primary">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Total de Informes</h6>
                            <h2>{!! $informes !!}</h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-file-text"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <a href="{{route('pacientes')}}" >
            <div class="widget bg-success">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Total de pacientes</h6>
                            <h2>{!! $pacientes !!}</h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <a href="{{route('doctores')}}" >
            <div class="widget bg-warning">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Total de doctores</h6>
                            <h2>{!! $doctores !!}</h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        {{-- <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget bg-danger">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>New Users</h6>
                            <h2>11</h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
