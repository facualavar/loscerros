@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
   <div class="row">
        <div class="col-md-12">
            <div class="card">


                <div class="card-header"><h3>Pacientes</h3></div>
                <div class="card-body table-responsive">
                    <div class="">
                    <!-- search form -->
                        <div class="input-group input-group-button">
                            <input type="text" id="q" class="form-control filter-input" placeholder="Buscar por Apellido, Nombre, DNI u Obra Social....">
                            <div class="input-group-append">
                                <button type="button" name="search" id="search-btn" class="btn1 btn-primary"><i class="ik ik-search"></i></button>
                            </div>
                        </div>
                    <!-- /.search form -->
                    </div>
                    <table id="data_table_pac" class="table">
                        <thead>
                            <tr>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Apellido</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Nombre</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Dni</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Obra Social</th>
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
            if ( $.fn.dataTable.isDataTable( '#data_table_pac' ) ) {
                    table = $('#data_table_pac').DataTable({
                        paginate:false,
                        paging: false
                    });
            }
            else {
            var table = $('#data_table_pac').DataTable( {
                    processing: true,
                    serverSide: true,
                    dom: 'Bfrtip',
                     ajax: {
                        url: "{{ route('search_pac') }}",
                            data: function (d) {
                                    d.search = $('#q').val()
                                }
                    },
                    columns: [
                        {data: 'apellido'},
                        {data: 'nombre'},
                        {data: 'DNI',width: "15%"},
                        {data: 'osnombre'},
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
                    $('#data_table_pac').DataTable().search(
                        $('#q').val()
                    ).draw();
                });

            }
        });
    </script>
@endsection
