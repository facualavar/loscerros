@extends('layouts.app')

@section('content')
   <!-- Main content -->
            <section class="content">
                 <!-- Small boxes (Stat box) -->
                <div class="col-sm-12">
                    <div class="box box-primary">
                            <div class="box-header">
                            <h3 class="box-title">Cargar Resultados del Protocolo {{$id}}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <div class=" form-inline dt-bootstrap">
                                <div class="row">
                                {!!Form::open(['route'=>'lineaInforme.store','method'=>'POST'])!!}  
                                <input type="hidden" value="{{$id}}" name="Informes_idInformes"> {{-- id del informe --}}
                                <input type="hidden" value="{{$idP}}" name="Informes_Pacientes_Personas_idPersonas"> {{-- id del paciente --}}
                                <input type="hidden" value="{{Auth::user()->id}}" name="Informes_Usuarios_Personas_idPersonas">
        
                                    <div class="col-sm-12 table-responsive">
                                       <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Analisis</th>
                                                <th>Resultado</th>
                                                <th>Referencia</th>
                                                <th>Unidades</th>
                                            </tr>
                                            @foreach ($data as $d)
                                            @if($d->tipo=='simple')
                                            <tr>
                                                <td>{{$d->nombre}}</td>
                                                <td>
                                                    @if($d->muestra==0)
                                                    <label>Debe muestra </label>
                                                     @foreach(getNombre($d->codigo) as $u)
                                                        <input type="text" name="{{$u->nombre}}" class="form-control" placeholder="{{$u->nombre}}" disabled><br>
                                                     @endforeach
                                                    @else
                                                     @foreach(getNombre($d->codigo) as $u)
                                                        <input type="text" name="{{$u->nombre}}" class="form-control" placeholder="{{$u->nombre}}"><br>
                                                     @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach(getValoresReferencia($d->codigo) as $u)
                                                        @php
                                                            $data=array_filter(explode(',', $u->referencia));
                                                        @endphp
                                                    @endforeach
                                                        
                                                    @for ($i = 0 ; $i < count($data) ; $i++)
                                                        {!! $data[$i] !!} <br>
                                                    @endfor
                                                        
                                                   <br> 
                                                </td>
                                                <td>
                                                    @foreach(getUnidades($d->codigo) as $u)
                                                        @php
                                                            $data=array_filter(explode(',', $u->unidades));
                                                        @endphp
                                                    @endforeach
                                                    
                                                    @for ($i = 0 ; $i < count($data) ; $i++)
                                                        {!! $data[$i] !!} <br>
                                                    @endfor
                                                    
                                                    <br>                                                   
                                                </td>
                                            </tr>  
                                            @else                                        
                                            <tr>                                                 
                                                <td style="width:12%"><b>{{$d->nombre}}</b></td>
                                                <td>
                                                    @if($d->muestra==0)
                                                    <label>Debe muestra </label>
                                                     @foreach(getNombre($d->codigo) as $u)
                                                        <input type="text" name="{{$u->nombre}}" class="form-control" placeholder="{{$u->nombre}}" disabled><br>
                                                     @endforeach
                                                    @else
                                                    <div class="row">
                                                     @foreach(getNombre($d->codigo) as $u)
                                                      @if($u->referencia!='')  <div class="col-md-6">{{$u->nombreFormal}}</div>  <input  type="text" name="{{$u->nombre}}" class="form-control col-md-6" placeholder="{{$u->nombre}}"> @else  <label class="col-md-12">{{$u->nombreFormal}}</label>  @endif<br>
                                                     @endforeach
                                                    </div>                                                    
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($d->referencia!=0)
                                                    @foreach(getValoresReferencia($d->codigo) as $u)
                                                      <div class="">
                                                            @php
                                                            $data=array_filter(explode(',', $u->referencia));
                                                            @endphp
                                                            @for ($i = 0 ; $i < count($data) ; $i++)
                                                                {{$data[$i]}} <br>
                                                            @endfor  
                                                            <br> 
                                                      </div> 
                                                    @endforeach  
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach(getUnidades($d->codigo) as $u)
                                                      <div class="">{{$u->unidades}}</div> <br> 
                                                    @endforeach                                               
                                                </td>                                                
                                            </tr> 
                                            <tr>
                                                <td></td>
                                                <td> 
                                                     @if($d->grupo=='cultivo')
                                                        @include('informes.resultados.antibiograma')
                                                    @endif   
                                                </td>
                                                <td></td>    
                                            </tr>
                                            @endif
                                            @endforeach                                            
                                         <tfoot>
                                                <tr>
                                                    <td> <button class="btn btn-primary">Cargar</button> </td>                                                   
                                                </tr>
                                        </tfoot>                                              
                                        </tbody>
                                     </table>
                                    </div>
                                {!!Form::close()!!} 
                                </div>                        
                           
                            </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->            
                </div>
                <!-- /.col-8 -->
            </section>
            <!-- /.content -->
@endsection
