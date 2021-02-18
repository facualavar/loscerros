@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="row">
        <div class="col-md-12">
            <div class="card">


                <div class="card-header"><h3>Doctores</h3></div>
                <div class="card-body table-responsive">
                    <!-- search form -->
                        <div class="input-group input-group-button">
                            <input type="text" id="q" class="form-control filter-input" placeholder="Buscar por Apellido, Nombre, Maticula o Especialidad....">
                            <div class="input-group-append">
                                <button type="button" name="search" id="search-btn" class="btn1 btn-primary"><i class="ik ik-search"></i></button>
                            </div>
                        </div>
                    <!-- /.search form -->
                    <table id="data_table_doc" class="table">
                        <thead>
                            <tr>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Apellido</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Nombre</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Matricula</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Especialidad</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Acción</th>
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
            if ( $.fn.dataTable.isDataTable( '#data_table_doc' ) ) {
                    table = $('#data_table_doc').DataTable({
                        paginate:false,
                        paging: false
                    });
            }
            else {
            var table = $('#data_table_doc').DataTable( {
                    processing: true,
                    serverSide: true,
                    dom: 'Bfrtip',
                     ajax: {
                        url: "{{ route('search_doc') }}",
                            data: function (d) {
                                    d.search = $('#q').val()
                                }
                    },
                    columns: [
                        {data: 'apellido'},
                        {data: 'nombre'},
                        {data: 'matricula',width: "15%"},
                        {data: 'especialidad'},
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
                        "lengthMenu": [15, 25, 30, 35, 40 ],
                        "order": [
                            [0, "desc"]
                        ]
                } );


                $(".filter-input").on( 'keyup click', function () {
                    $('#data_table_doc').DataTable().search(
                        $('#q').val()
                    ).draw();
                });

            }
        });
    </script>
@endsection
