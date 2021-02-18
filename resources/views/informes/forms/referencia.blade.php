<!-- Modal -->

    <div class="modal fade" id="myModalRef{{$d->codigo}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Referencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>


              <div class="modal-body">
                  @if($d->tipo=='simple')
                    {!!  $u->referencia !!}
                  @else
                    @if($d->referencia!=0)
                        @foreach(getValoresReferencia($d->codigo) as $u)
                        <div class="col-md-6"> <b> {!!$u->nombreFormal!!} </b> </div>
                        <div class="col-md-6"> {!!  $u->referencia !!} </div> <br>
                        @endforeach
                    @endif
                  @endif
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          </div>
        </div>
