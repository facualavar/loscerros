@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Listado de Análisis</h3></div>
                <div class="card-body table-responsive">
                    <!-- search form -->
                        <div class="input-group input-group-button">
                            <input type="text" id="q" class="form-control filter-input" placeholder="Buscar por número de código o nombre....">
                            <div class="input-group-append">
                                <button type="button" name="search" id="search-btn" class="btn1 btn-primary"><i class="ik ik-search"></i></button>
                            </div>
                        </div>
                    <!-- /.search form -->

                    <table id="tabla_analisis" class="table">
                        <thead>
                            <tr role="row">
                                <th tabindex="0"  rowspan="1" colspan="1">Código</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Nombre</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">UB</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Método</th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Precio</th>
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
            if ( $.fn.dataTable.isDataTable( '#tabla_analisis' ) ) {
                    table = $('#tabla_analisis').DataTable({
                        paginate:false,
                        paging: false
                    });
            }
            else {
            var table = $('#tabla_analisis').DataTable( {
                    processing: true,
                    serverSide: true,
                    dom: 'Bfrtip',
                     ajax: {
                        url: "{{ route('search_ana') }}",
                            data: function (d) {
                                    d.search = $('#q').val()
                                }
                    },
                    columns: [
                        {data: 'codigo', width: "10%"},
                        {data: 'nombre'},
                        {data: 'UB'},
                        {data: 'metodo',width: "15%"},
                        {data: 'precioDerivantes'},
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
                    $('#tabla_analisis').DataTable().search(
                        $('#q').val()
                    ).draw();
                });

            }
        });
    </script>

    <script>

        function eliminar(cod) {
            console.log(cod);
          swal({
            title: "Esta seguro/a que quiere eliminar este análisis?",
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
                        'codigo' : cod
                };

                $.ajax({
                data: parametros,
                url: "{{route('deleteAnalisis')}}",
                dataType: "json",
                type: 'POST',
                success:function(resp){
                    if(resp.msg=='ok'){
                        swal("El analisis se elimino corrctamente!", {
                        icon: "success",
                        });
                        location.reload();
                    }else{
                        swal( resp.msg, {
                        icon: "warning",
                        timer: 3100
                        });
                    }

                }
                });

            } else {
                swal("La operación fue cancelada!");
            }
            });
        }
    </script>

@endsection
