var base_url = window.location.origin;

$(document).ready(function () {
    var table = $('#tabla_pacientes').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

    });

    $('#fecha_nacimiento').datetimepicker({
        locale: 'ES',
        format: 'DD-MM-YYYY',
        ignoreReadonly: true
    });

    $('#tabla_pacientes').on('click', 'tr', function () {
        var data = table.row(this).data();
        //Asigno nro de historia.
        var id_paciente = data[0];

        $.ajax({
            url: 'ajax-modificar-paciente',
            type: 'POST',
            //async: true,
            cache: false,
            dataType: 'json',
            data: 'id_paciente='+id_paciente,
            }).done(function(json) {

                //If json object is not empty.
                if( $.isEmptyObject(json.results[0]) == false ){
                    var i=0;
                    $.each(json.results[0], function(i, result){
                        $('#id_paciente').val(result['id_paciente']);
                        $('#paciente').val(result['paciente']);
                        $('#cedula_titular').val(result['cedula_titular']);
                        $('#titular').val(result['titular']);
                        var fecha = moment(result['fecha_nacimiento']).format("DD-MM-YYYY");
                        $('#fecha_nacimiento').val(fecha);
                        $('#ant_prenatales').val(result['ant_prenatales']);
                        $('#producto').val(result['producto']);
                        $('#complicaciones').val(result['complicaciones']);
                        $('#obtenido_por').val(result['obtenido_por']);
                        $('#semanas').val(result['semanas']);
                        $('#pan').val(result['pan']);
                        $('#tan').val(result['tan']);
                        $('#ant_personales').val(result['ant_personales']);
                        $('#ant_familiares').val(result['ant_familiares']);
                        $('#vacunas').val(result['vacunas']);
                        i++;
                    });

                    $('#modal_paciente').modal('toggle');
                }/*else{

                    $('#uuid_relacion').empty().append('<option value="">Seleccione</option>').prop('disabled', 'disabled');
                }*/

          });
    });
});

