@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Editar Análisis</h3></div>
                <div class="card-body table-responsive">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <div class="table-responsive">
                                {!!Form::open(['route'=>'agregarStore','method'=>'POST','id'=>'fvalida'])!!}
                                <input type="hidden" value="{{$id}}" name="Informes_idInformes"> {{-- id del informe --}}
                                <input type="hidden" value="{{$idP}}" name="Informes_Pacientes"> {{-- id del paciente --}}
                                <input type="hidden" value="{{Auth::user()->id}}" name="Informes_Usuarios_Personas_idPersonas">
                                <table class="table">
                                    <tbody id="opciones">
                                        <tr class="alert alert-dark">
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th></th>
                                        </tr>
                                        @foreach ($data as $d)
                                        <tr id="borrar{{$d->codigo}}">
                                            <td><input type="text" name="codigo[]" id="borrar{{$d->codigo}}" value="{{$d->codigo}}" readonly></td>
                                            <td>{{$d->nombre}}</td>
                                            <td><a onclick="borrar({{"'".$d->codigo."'"}})" title="Borrar"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <div id="campo1"></div>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <div class="input-group input-group-button">
                                                        <input type="text" name="q" id="buscar" class="form-control" placeholder="Buscar análisis por código o por nombre">
                                                        <div class="input-group-append">
                                                            <button type="button" name="search" id="search-btn" class="btn1 btn-primary"><i class="ik ik-search"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td> <input type="button" value="Editar" class="btn btn-primary"  onClick="validar()"></td>
                                            </tr>
                                        </tfoot>
                                    </tbody>
                                </table>
                                {!!Form::close()!!}
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsextras')
 @include('informes.agregar.scripts')

<script>
    $( function() {
        $( "#opciones" ).sortable({
        revert: true
        });

        $( "tr, td" ).disableSelection();
    } );
</script>
@endsection
