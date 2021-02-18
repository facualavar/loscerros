@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Editar Valores de Referencia </h3></div>
                <div class="card-body table-responsive">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                            {!!Form::model($data,['route'=>['updateVRef'],'method'=>'POST'])!!}
                            @csrf
                                <table class="table table-bordered" id="contenido">
                                    <tbody id="opciones">
                                        <tr>
                                            <th style="width:4%">Codigo</th>
                                            <th style="width:22%">Nombre</th>
                                            <th style="width:50%">Valor(es) de Referencia(s)</th>
                                            <th style="width:10%">Unidad</th>
                                            <th style="width:5%; {{ ($tipo=='simple')? 'display:"none"' : '' }}"></th>

                                        </tr>
                                        @if($tipo=='simple')
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>
                                                    {{$d->codigo}} 
                                                    <input type="hidden" id="cod" name="codigo[]" class="form-control" value="{{$d->codigo}}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="nombre[]" value="{{$d->nombre}}" class="form-control" readonly>
                                                    <textarea type="text" name="nombreFormal[]" id="contentMini">{{$d->nombreFormal}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="referencia[]" id="content">{{$d->referencia}}</textarea>
                                                </td>
                                                <td>
                                                    <input type="text" name="unidades[]" class="form-control" value="{{$d->unidades}}">
                                                </td>
                                                <td style="{{ ($tipo=='simple')? 'display:"none"' : '' }}">
                                                    <input type="hidden" name="tipo" value="{{$tipo}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        @foreach ($data as $d)

                                        <tr>
                                            <td> 
                                                {{$d->codigo}} 
                                                <input type="hidden" id="cod" name="codigo[]" class="form-control" value="{{$d->codigo}}">
                                            </td>
                                            <td> 
                                                <input type="hidden" name="nombre[]" value="{{$d->nombre}}" class="form-control" readonly> 
                                                <textarea type="text" name="nombreFormal[]" id="contentMini">{{$d->nombreFormal}}</textarea>
                                            </td>
                                            <td> 
                                                <textarea name="referencia[]" rows="4" style="width:100%" id="content">{{$d->referencia}}</textarea>
                                            </td>
                                            <td>
                                                <input type="text" name="unidades[]" class="form-control" value="{{$d->unidades}}">
                                            </td>
                                                <input type="hidden" name="tipo" value="{{$tipo}}">
                                            <td>
                                                <a onclick="eliminar({{'"'.$d->codigo.'"'}},{{'"'.$d->nombre.'"'}});"  title="Eliminar" class="feed-card"><i class="ik ik-trash bg-danger feed-icon"></i></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td> <button data-repeater-create="" type="button" class="btn1 btn-success btn-icon ml-2 mb-2" onclick="AgregarCampos('{{$tipo}}');" title="Agregar fila"><i class="ik ik-plus"></i></button></td>
                                            <td></td>
                                            <td></td>
                                            <td> <button class="btn btn-primary">Cargar</button> </td>
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
@include('analisis.scripts')

    <script>
        function eliminar(cod,nombre) {
          swal({
            title: "Esta seguro/a que quiere eliminar esta linea?",
            text: "",
            icon: "warning",
            button: {
                text: "Eliminar",
                closeModal: false,
            },
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                var parametros = {
                        'token'  : "{{ csrf_token() }}",
                        'codigo' : cod,
                        'nombre' : nombre
                };

                $.ajax({
                data: parametros,
                url: "{{route('deleteValor')}}",
                dataType: "json",
                type: 'POST',
                success:function(resp){
                    if(resp.msg=='ok'){
                        swal("El analisis se modifico corrctamente!", {
                        icon: "success",
                        });
                    }
                    location.reload();
                }
                });

            } else {
                swal("La operación fue cancelada!");
            }
            });
        }
    </script>

@endsection
