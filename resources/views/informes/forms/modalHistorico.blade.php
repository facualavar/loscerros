<!-- Modal -->

    <div class="modal fade" id="myModal{{$d->codigo}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Historial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>


              <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Fecha</th>
                            <th>Analisis</th>
                            <th>Resultado</th>
                        </tr>
                           @foreach(historico($id,$idP,$d->codigo) as $u)
                            @if($u->tipo=='simple')
                            <tr>
                                <td>{{$u->fechaIngreso}}</td>
                                <td style="width:12%"> <b>{!!$u->nombre!!}</b></td>
                                <td>
                                    @foreach(getNombre($d->codigo) as $k)
                                        @php $nombre=$k->nombre @endphp                                                                            
                                    @endforeach
                                    @php  $result=json_decode($u->linea);
                                        ($u->linea!='')? $valor = $result->$nombre : $valor =  $u->$nombre;
                                    @endphp                                                                    
                                                                        
                                    <input type="text" class=form-control placeholder="{{$nombre}}" value="{{$valor}}">                                                                                                        
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{$u->fechaIngreso}}</td>
                                <td>
                                    {!!$u->nombre!!}
                                </td>
                                <td>                                                                        
                                    <div class="row">
                                    @foreach(getNombre($d->codigo) as $k)
                                        @php $nombre=$k->nombre @endphp   
                                        @php  $result=json_decode($u->linea);
                                            if($u->linea!=''){
                                                (isset($result->$nombre))? $valor = $result->$nombre : $valor='';
                                            }else{ 
                                                 $valor =  $u->$nombre;
                                            }
                                        @endphp                                                                         
                                        
                                        @if($k->referencia!='')
                                            <div class="col-md-6">{!!$k->nombreFormal!!}</div>
                                            <input type="text" class=form-control placeholder="{{$nombre}}" value="{{$valor}}">
                                        @else
                                            <label class="col-md-12">{!!$k->nombreFormal!!}</label>
                                        @endif<br>
                                    @endforeach                                    
                                    </div>                                    
                                </td>
                            </tr>
                            @endif
                            @endforeach
                    </tbody>
                </table>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          </div>
        </div>
