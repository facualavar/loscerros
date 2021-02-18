@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Agregar Análisis</h3></div>
                <div class="card-body table-responsive">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <form method="POST" action="{{ route('analisis') }}">
                            @csrf
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width:15%">Codigo *</th>
                                            <th style="width:39%">Nombre *</th>
                                            <th style="width:10%">UB *</th>
                                            <th style="width:20%">Método</th>
                                            <th style="width:10%">Precio *</th>

                                        </tr>
                                        <tr>
                                            <td><input type="text" name="codigo" class="form-control"></td>
                                            <td><input type="text" name="nombre" style="width:100%" class="form-control"></td>
                                            <td><input type="text" name="ub" class="form-control"></td>
                                            <td><input type="text" name="metodo" class="form-control"></td>
                                            <td><input type="text" name="precioDerivantes" class="form-control" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Grupo *</td>
                                            <td>
                                                <select name="grupo" class="form-control">
                                                   <option value="">Selecciones un grupo</option>
                                                    <option value="quimica">Quimica</option>
                                                    <option value="quimica_urinaria">Quimica Urinaria</option>
                                                    <option value="endocrinologia">Endocrinologia</option>
                                                    <option value="inmunologia">Serologia/Inmunologia</option>
                                                    <option value="hemostasia">Hemostasia</option>
                                                    <option value="hematologia">Hematologia</option>
                                                    <option value="cultivo">Cultivos/Microbiologia</option>
                                                    <option value="parasitologia">Parasitologia</option>
                                                    <option value="micologia">Micologia</option>
                                                    <option value="orina">Orina</option>
                                                    <option value="bacteriologia">Bacteriologia</option>
                                                    <option value="citologia">Citologia</option>
                                                    <option value="toxicologia">Toxicologia</option>
                                                    <option value="andrologia">Andrología</option>
                                                    <option value="biologia_molecular">Biologia Molecular</option>
                                                    </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td> Tipo de Análisis *: </td>
                                            <td> <select name="tipo" class="form-control">
                                                    <option value="">Selecciones un tipo de análisis</option>
                                                    <option value="simple">Simple</option>
                                                    <option value="compuesto">Compuesto</option>
                                                    </select>
                                            </td>
                                            <td>Tiene valor de referencia? *:</td>
                                            <td><select name="referencia" class="form-control">
                                                    <option value="">Seleccione referencia</option>
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                                    </select></td>
                                            <td> <button class="btn btn-primary">Cargar</button> </td>
                                        </tr>
                                        <tr>
                                            <b>*Todos los campos son obligatorios!</b><br>
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
@endsection
