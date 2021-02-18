 <script>
        if ( $.fn.dataTable.isDataTable( '#data_table_users' ) ) {
                table = $('#data_table_users').DataTable({
                searching:false,
                paginate:false,
                paging: false});
        }
        else {
            table = $('#data_table_users').DataTable( {
                lengthChange: true,
                "language": {
                        "aria": {
                            "sortAscending": ": activar para ordenar de manera asendente",
                            "sortDescending": ": activar para ordenar de manera descendente",
                            "editable_previous": "Anterior"
                        },
                        "emptyTable": "No hay registros",
                        "info": "",
                        "infoEmpty": "",
                        "sLengthMenu": " _MENU_ ",
                        "infoFiltered": "",
                        "search": "<strong>Buscar</strong>",
                        "zeroRecords": "No hay coincidencias",
                        "paginate": {
                            "previous": "Anterior",
                            "next": "Siguiente"
                        }
                    },
                    "lengthMenu": [ 5,10,15,20, 25, 30, 35, 40 ],
                    "order": [
                        [0, "desc"]
                    ]

            } );
        }

        /* edit table usuarios */
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

        var parametros = {
                'token'  : "{{ csrf_token() }}"
        };

        $('#data_table_users').Tabledit({
            data: parametros,
            url: "{{route('tablaedit')}}",
            dataType: 'json',
            type: 'POST',
            eventType: 'dblclick',
            editButton: false,
            deleteButton: false,
            columns: {
                identifier: [0, 'id'],
                editable: [[2, 'name'],[3, 'email'], [4, 'Roles_idRoles', '{"1": "Administrador", "2": "Bioquimico", "3": "Tecnico/a"}'],[5, 'estado', '{"1": "Activo", "2": "Inactivo"}']]
            },
            onSuccess: function(data) {
               swal(data.msg);
            },
            onFail: function(data) {
               swal('Ocurrio un error por favor verifique los datos');
            }
        });
    </script>

 {{--     <script>
        function eliminarUser(id) {
          swal({
            title: "Esta seguro/a que quiere eliminar el usuario?",
            text: "Una vez eliminado no podra recuperar el usuario!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                var parametros = {
                        'token'  : "{{ csrf_token() }}",
                        'id' : id
                };

                $.ajax({
                data: parametros,
                url: "{{route('usuariosDelete')}}",
                dataType: "json",
                type: 'POST',
                success:function(resp){
                    if(resp.msg=='ok'){
                        swal("El usuario fue eliminado exitosamente", {
                        icon: "success",
                        });
                        location.reload();
                    }
                }
                });

            } else {
                swal("La operación fue cancelada!");
            }
            });
        }
    </script> --}}
