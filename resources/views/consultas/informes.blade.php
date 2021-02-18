@extends('layouts.api')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>{{ $persona->apellido . ', ' . $persona->nombre }}</h2>
                    <h5>{{ $persona->DNI }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Fecha y Hora</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="data">
                    @foreach($informes as $informe)
                    <tr>
                        <th>{{ $informe->Informes_idInformes }}</th>
                        <th>{{ $informe->doctor }}</th>
                        <th>{{ $informe->fecha }}</th>
                        <th><b class="badge badge-pill badge-secondary mb-1">{{ $informe->estado }}</b></th>
                        <th>{{ $informe->observaciones }}</th>
                        <th>
                            <a href="{{ $informe->imprimir }}" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Imprimir</a>
                        </th>
                    </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
@endsection