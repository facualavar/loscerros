@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Valores de Referencia del Código: {{$codigo}} Análisis: {{$analisis}}</h3></div>
                <div class="card-body table-responsive">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                             <form method="POST" action="{{ route('vreferencia') }}">
                                @csrf
                                <table class="table table-bordered" id="contenido">
                                    <tbody>
                                        <tr>
                                            <th style="width:10%">Codigo</th>
                                            <th style="width:20%">Nombre</th>
                                            <th style="width:50%">Valor(es) de Referencia(s)</th>
                                            <th style="width:10%">Unidad</th>

                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" id="cod" name="codigo[]" class="form-control" value="{{$codigo}}">
                                            </td>
                                            <td>
                                                 @if($tipo=='simple')
                                                    <textarea name="nombreFormal[]" id="contentMini">{{$analisis}}</textarea>
                                                    <input type="hidden" name="nombre[]" value="{{$nombre}}" readonly class="form-control">
                                                 @else
                                                    <textarea name="nombreFormal[]" id="contentMini">{{$analisis}}</textarea>
                                                    <input type="hidden" name="nombre[]"  readonly class="form-control">
                                                 @endif
                                            </td>
                                            <td>
                                                @if($tipo=='simple')
                                                    <textarea  name="referencia[]"  id="content" rows="4" style="width:100%"></textarea>
                                                @else
                                                    <textarea name="referencia[]"  id="content" rows="4" style="width:100%"></textarea>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" name="unidades[]" class="form-control">
                                            </td>
                                            <input type="hidden" name="tipo" value="{{$tipo}}">
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                 <button data-repeater-create="" type="button" class="btn1 btn-success btn-icon ml-2 mb-2" onclick="AgregarCampos('{{$tipo}}');" title="Agregar fila"><i class="ik ik-plus"></i></button>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td> <button class="btn btn-primary">Cargar</button> </td>
                                        </tr>
                                    </tfoot>
                                </table>
                             </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsextras')
  @include('analisis.scripts')

  {{-- <script>
        $( function() {
            $( "#opciones" ).sortable({
            revert: true
            });

            $( "tr, td" ).disableSelection();
        } );
    </script> --}}
@endsection
