@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="row">
        <div class="col-md-12">
            <div class="card">


                <div class="card-header">
                    <div class="col-md-11"><h3>Listado de Obras Sociales</h3></div>
                    <div class="col-md-2"><button class="btn1 btn-primary" data-toggle="modal" title="Agregar Obra Social" data-target="#myModal1"><i class="fa fa-plus"></i> <i class="fa fa-heartbeat"></i></button></div>
                    @include('obras.forms.modalObras')
                </div>
                <div class="card-body table-responsive">
                    <div class="">
                    <!-- search form -->
                        <div class="input-group input-group-button">
                            <input type="text" id="q" class="form-control filter-input" placeholder="Buscar por nombre....">
                            <div class="input-group-append">
                                <button type="button" name="search" id="search-btn" class="btn1 btn-primary"><i class="ik ik-search"></i></button>
                            </div>
                        </div>
                    <!-- /.search form -->
                    </div>
                    <table id="data_table_os" class="table">
                        <thead>
                            <tr>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">#</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Nombre</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">NBU</th>
                                {{-- <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Acción</th> --}}
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
        $(document).ready(function() {
            if ( $.fn.dataTable.isDataTable( '#data_table_os' ) ) {
                    table = $('#data_table_os').DataTable({
                        paginate:false,
                        paging: false
                    });
            }
            else {
            var table = $('#data_table_os').DataTable( {
                    processing: true,
                    serverSide: true,
                    dom: 'Bfrtip',
                     ajax: {
                        url: "{{ route('search_os') }}",
                            data: function (d) {
                                    d.search = $('#q').val()
                                }
                    },
                    columns: [
                        {data: 'idObrasSociales'},
                        {data: 'nombre'},
                        {data: 'nbu'},

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
                        "lengthMenu": [15, 25, 30, 35, 40 ],
                        "order": [
                            [0, "desc"]
                        ]
                } );


                $(".filter-input").on( 'keyup click', function () {
                    $('#data_table_os').DataTable().search(
                        $('#q').val()
                    ).draw();
                });

            }
        });
    </script>

    <script>
    $('#data_table_os').on( 'click', 'tbody td:not(:first-child)', function (e) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

        var parametros = {
                'token'  : "{{ csrf_token() }}"
        };

        $('#data_table_os').Tabledit({
            data: parametros,
            url: "{{route('tablaeditos')}}",
            dataType: 'json',
            type: 'POST',
            eventType: 'dblclick',
            editButton: false,
            deleteButton: false,
            columns: {
                identifier: [0, 'idObrasSociales'],
                editable: [[1, 'nombre'], [2, 'nbu']]
            },
            onSuccess: function(data) {
               swal(data.msg);
            },
            onFail: function(data) {
               swal('Ocurrio un error por favor verifique los datos');
            }
        });
    });
</script>
@endsection
