@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Listado de Informes</h3></div>
                <div class="card-body table-responsive">
                    <!-- search form -->
                        <div class="input-group input-group-button">
                            <input type="text" id="q" class="form-control filter-input" placeholder="Buscar por número de protocolo....">
                            <div class="input-group-append">
                                <button type="button" name="search" id="search-btn" class="btn1 btn-primary"><i class="ik ik-search"></i></button>
                            </div>
                        </div>
                    <!-- /.search form -->

                    <table id="tabla_3" class="table">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0"  rowspan="1" colspan="1">#</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Paciente</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Doctor</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Fecha y hora</th> {{-- seria la fecha de carga del informe no el ingreso del paciente --}}
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Usuario</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Estado</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 195px;">Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsextras')

    <script>
        function enviar(id,idP) {
          swal({
            title: "Esta seguro/a que quiere enviar el informe?",
            text: "",
            icon: "warning",
            button: {
                text: "Enviar",
                closeModal: false,
            },
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                var parametros = {
                        'token'  : "{{ csrf_token() }}",
                        'id' : id,
                        'idP' : idP
                };

                $.ajax({
                data: parametros,
                url: "{{route('mailling')}}",
                dataType: "json",
                type: 'POST',
                success:function(resp){
                    if(resp.msg=='ok'){
                        swal("El informe se envio correctamente", {
                        icon: "success",
                        timer: 2500
                        });
                    }else{
                        swal("No se pudo enviar el email, revisar el correo del paciente", {
                        icon: "warning",
                        timer: 3500
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

    <script>
        $('#tabla_3').on( 'click', 'tbody td:not(:first-child)', function (e) {
            /* edit table fecha */
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                var parametros = {
                        'token'  : "{{ csrf_token() }}"
                };

                $('#tabla_3').Tabledit({
                    data: parametros,
                    url: "{{route('tablaeditInf')}}",
                    dataType: 'json',
                    type: 'POST',
                    eventType: 'dblclick',
                    editButton: false,
                    deleteButton: false,
                    columns: {
                        identifier: [0, 'Informes_idInformes'],
                        editable: [/* [1, 'paciente'],[2,'doctor'], */[3, 'fecha']]
                    },
                    onSuccess: function(data) {
                        if(data.msg=='ok'){
                            swal("Datos actualizados con exito!", {
                            icon: "success",
                            });
                        }else{
                            swal("No se encontro el paciente ingresado!", {
                            icon: "warning",
                            timer:4800,
                            });
                            location.reload();
                        }
                    },
                    onFail: function(data) {
                        swal('Ocurrio un error por favor verifique los datos');
                    }
                });
        });
    </script>

    <script>
        function updatePac(id) {
            $('#pac'+id).autocomplete({
                source: '{!!URL::route('autocompletePAC')!!}',
                minlenght:1,
                autoFocus:true,
                appendTo: "#modalDoc"+id,
                select:function(e,ui){
                    var nombre = ui.item.apellido + ' ' + ui.item.nombre;
                    $('#pac'+id).html(nombre);
                    $("#paciente"+id).val(ui.item.idPersona);
                }
            });
        }
    </script>


    <script type="text/javascript">
        function updateDoc(id) {
             $('#doct'+id).autocomplete({
                source: '{!!URL::route('autocompleteDOC')!!}',
                minlenght:1,
                autoFocus:true,
                appendTo: "#modalDoc"+id,
                select:function(e,ui){
                    $('#doct'+id).html(ui.item.matricula);
                    $("#doctor"+id).val(ui.item.idPersonaD);
                }
            });
        }
    </script>

    <script type="text/javascript">
        function updateUser(id) {
             $('#user'+id).autocomplete({
                source: '{!!URL::route('autocompleteUSER')!!}',
                minlenght:1,
                autoFocus:true,
                appendTo: "#modalDoc"+id,
                select:function(e,ui){
                    $('#user'+id).html(ui.item.name);
                    $("#usuario"+id).val(ui.item.id);
                }
            });
        }
    </script>

    <script type="text/javascript">
        function updateInf(id) {
            console.log($("#usuario"+id).val());
        $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content')}  });
        event.preventDefault();
            var parametros = {
                '_token'  : $('#token').val(),
                'id': id,
                'afiliado': document.getElementsByName("afiliado"+id)[0].value,
                'numOrden': document.getElementsByName("numOrden"+id)[0].value,
                'diagnostico': document.getElementsByName("diagnostico"+id)[0].value,
                'obs': document.getElementsByName("obs"+id)[0].value,
                'paciente': $("#paciente"+id).val(),
                'doctor': $("#doctor"+id).val(),
                'usuario': $("#usuario"+id).val(),
            };
            $.ajax({
                data: parametros,
                url: "{{route('informesUpdate')}}",
                dataType: "json",
                type: 'POST',

                success:function(resp){
                        swal(resp.msg,{
                            timer: 2500
                        }); //si no completa el formulario
                        location.reload();
                },
                error:function(){
                    swal('Error al enviar información');
                }
            });
        }

    </script>

    <script>
            function impreso(id) {
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                    var parametros = {
                            'token'  : "{{ csrf_token() }}",
                            'id' : id
                    };

                    $.ajax({
                    data: parametros,
                    url: "{{route('impreso')}}",
                    dataType: "json",
                    type: 'POST',
                    success:function(resp){
                        $('.checkbox').each(function() { //loop through each checkbox
                            $('#impreso'+id).attr('disabled','disabled');
                        });
                        location.reload();
                    }
                    });

            }
    </script>

       <script>
        $(document).ready(function() {
            if ( $.fn.dataTable.isDataTable( '#tabla_3' ) ) {
                    table = $('#tabla_3').DataTable({
                        paginate:false,
                        paging: false
                    });
            }
            else {
            var table = $('#tabla_3').DataTable( {
                    processing: true,
                    serverSide: true,
                    paging: true,
                    dom: 'Bfrtip', //si pongo la l adelante sale el lengthMenu
                     ajax: {
                        url: "{{ route('search') }}",
                            data: function (d) {
                                    d.search = $('#q').val()
                                }
                    },
                    columns: [
                        {data: 'Informes_idInformes', width: "10%"},
                        {data: 'paciente'},
                        {data: 'doctor'},
                        {data: 'fecha',width: "15%"},
                        {data: 'usuario'},
                        {data: 'estados',width: "15%"},
                        {data: 'btn'},
                    ],
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    "language": {
                            "aria": {
                                "sortAscending": ": activar para ordenar de manera asendente",
                                "sortDescending": ": activar para ordenar de manera descendente",
                                "editable_previous": "Anterior"
                            },
                            "emptyTable": "No hay registros",
                            "sLengthMenu": " _MENU_ ",
                            "info": "",
                            "infoEmpty": "",
                            "infoFiltered": "",
                            "processing": "Cargando datos...",
                            "zeroRecords": "No hay coincidencias",
                            "paginate": {
                                    "previous": "Anterior",
                                    "next": "Siguiente"
                            }
                        },
                        "paging": true,
                        "searching": false,
                        "lengthMenu": [25, 50, 100, 150],
                        "pageLength": 25,
                        "order": [
                            [0, "desc"]
                        ]
                } );


                $(".filter-input").on( 'keyup click', function () {
                    $('#tabla_3').DataTable().search(
                        $('#q').val()
                    ).draw();
                });

            }
        });
    </script>


@endsection
