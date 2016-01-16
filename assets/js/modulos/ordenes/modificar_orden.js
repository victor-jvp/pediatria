var base_url = window.location.origin;

$(document).ready(function () {
    var table = $('#tabla_ordenes').DataTable({
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

    $("#paciente").chosen({
        no_results_text: "No hay resultados para:",
        width: "100%"
    });


    $('#fecha_consulta').datetimepicker({
        locale: 'ES',
        format: 'DD-MM-YYYY',
        ignoreReadonly: true
    });

    $('#tabla_ordenes').on('click', 'tr', function () {
        var data = table.row(this).data();
        //Asigno nro de orden.
        var id_orden = data[0];
        var id_paciente = 0;
        $('#medicamento0').find('option:eq(0)').prop('selected', true);
        $('#indicacion0').val('');

        $.ajax({
            url: 'ajax-tabla-ordenes',
            type: 'POST',
            //async: true,
            cache: false,
            dataType: 'json',
            data: 'id_orden='+id_orden,
        }).done(function(json) {

            //If json object is not empty.
            if( $.isEmptyObject(json.results[0]) == false ){

                $.each(json.results[0], function(i, result){
                    $('#id_orden').val(result['id_orden']);
                    $('#paciente').val(result['id_paciente']).trigger("chosen:updated");
                    $('#id_paciente').val(result['id_paciente']);
                    var fecha = moment(result['fecha_consulta']).format("DD-MM-YYYY");
                    $('#fecha_consulta').val(fecha);
                    $('#peso').val(result['peso']);
                    $('#altura').val(result['altura']);
                    $('#sintomas').val(result['sintomas']);
                    $('#diagnostico').val(result['diagnostico']);
                    $('#cc').val(result['cc']);
                    $('#observaciones').val(result['observaciones']);

                    //LLenar campos del Recipe
                    //limpio los campos creados
                    limpiarRecipe();

                    var indice = 0;
                    $.each(result['recipe'], function(i, resul){

                        if(i == 0){
                            $('#medicamento0').val(resul['id_medicamento']).prop('selected', true);
                            $('#indicacion0').val(resul['indicacion']);
                        }else{
                            indice = i;
                            var select = document.getElementById("medicamento0");
                            var tr = document.getElementById("heredar0");
                            var tr2 = tr.cloneNode(true);
                            
                            var inpu = document.getElementById("indicacion0");
                            var table = document.getElementById("tablaMed");
                            var row = table.tBodies[0].insertRow(-1);

                            row.setAttribute("id", "heredar" + indice);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);

                            var selectC = select.cloneNode(true);
                            selectC.setAttribute("name", "recipes["+indice+"][id_medicamento]");
                            selectC.setAttribute("id", "medicamento" + indice);
                            selectC.value = resul['id_medicamento'];

                            var input2 = inpu.cloneNode(true);
                            input2.setAttribute("id", "indicacion" + indice);
                            input2.setAttribute("name", "recipes["+indice+"][indicacion]");
                            input2.value = resul['indicacion'];

                            cell1.appendChild(selectC);
                            cell2.appendChild(input2);
                            cell3.innerHTML = '<button class="btn btn-danger" type="button" id="eliminar" data-index="' + indice + '">Eliminar</button>';
                            
                            $('#agregar').attr("value", indice);
                        }
                    });

                    //Llenar fecha de nacimiento y edad
                    id_paciente = result['id_paciente'];
                });
                //datos del paciente.
                $.ajax({
                    url: 'ajax-informacion-paciente',
                    type: 'POST',
                    //async: true,
                    cache: false,
                    dataType: 'json',
                    data: 'id_paciente='+id_paciente,
                }).done(function(json) {

                    //If json object is not empty.
                    if( $.isEmptyObject(json.results[0]) == false ){

                        $.each(json.results[0], function(i, result){
                            var fecha = moment(result['fecha_nacimiento']).format("DD-MM-YYYY");
                            $('#fecha_nacimiento').val(fecha);
                            var edad = calcAge(result['fecha_nacimiento']);
                            $('#edad').val(edad);
                        });
                    }
                });
            }

            $('#modal_orden').modal('toggle');

          });
    });

    //Agregar Row
    $('#agregar').on("click", function () {
        insertRow();
    });

    //Eliminar Row
    $('#tablaMed').on("click", "#eliminar", function () {

        var table = $(this).closest('table');
        var row = $(this).closest('tr');
        var agrupador_campos = $(row).attr("id").replace(/[0-9]/g, '');

        //obtener tamaño de la tabla
        var element = document.getElementById("agregar");
        var filas = parseInt(element.getAttribute("value"));
        var fila = parseInt((this).getAttribute("data-index"));
        //eliminar la fila seleccionada
        var parent = $(this).parent().parent().get(0);
        $(parent).remove();
        //asignar tamaño nuevo a la tabla
        filas = filas - 1;
        $('#agregar').prop("value", filas);

        //cambiar valores a los atributos de la tabla
        $.each( $(table).find('tbody').find('tr[id*="'+ agrupador_campos +'"]'), function(i, obj1){
            var nindex = i;
            $(this).prop("id", agrupador_campos + nindex);

            $.each( $(this).find('td'), function(j, obj2){

                if($(this).find('input').attr('name')){
                    var name = $(this).find('input').attr('name');
                    name = name.replace(/([\d])/, nindex);

                    var id = $(this).find('input').attr('id');
                    id = id.replace(/(\d)/, nindex);

                    $(this).find('input').attr("name", name).attr("id", id);
                }
                if($(this).find('select').attr('name')){
                    var name = $(this).find('select').attr('name');
                    name = name.replace(/([\d])/, nindex);

                    var id = $(this).find('select').attr('id');
                    id = id.replace(/(\d)/, nindex);

                    $(this).find('select').attr("name", name).attr("id", id);
                }
                if($(this).find('button').attr('data-index')){
                    var index = $(this).find('button').attr('data-index');
                    index = index.replace(/([\d])/, nindex);

                    $(this).find('button').attr("data-index", index);
                }
            });
        });
    });
});

/* Calculate Age
With this function you can calculate the age of a person
 */
function calcAge(birthday) {
    var year, month, day, age, year_diff, month_diff, day_diff;
    var myBirthday = new Date();
    var today = new Date();
    var array = birthday.split("-");
    year = array[0];
    month = array[1];
    day = array[2];
    year_diff = today.getFullYear() - year;
    month_diff = (today.getMonth() + 1) - month;
    day_diff = today.getDate() - day;
    if (month_diff < 0) {
        year_diff--;
    } else if ((month_diff === 0) && (day_diff < 0)) {
        year_diff--;
    }
    return year_diff;
}

function limpiarRecipe(){

    var rows = parseInt($('#agregar').attr("value"));    
    for (var i = rows; i > 0; i--) {
        
        if(i == 0){
            break;
        }else{

            var id = "heredar" + i;
            var tr = document.getElementById(id);
            tr.remove();             
        }
    }
    $('#agregar').attr("value", 0);
}

function insertRow() {

    var indice = 0;
    indice = parseInt($('#agregar').val()) + 1;
    var select = document.getElementById("medicamento0");
    var tr = document.getElementById("heredar0");
    var tr2 = tr.cloneNode(true);
    //tr.remove();
    var inpu = document.getElementById("indicacion0");
    var table = document.getElementById("tablaMed");
    var row = table.tBodies[0].insertRow(-1);

    row.setAttribute("id", "heredar" + indice);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    //var input = document.createElement("input");

    var selectC = select.cloneNode(true);
    selectC.setAttribute("name", "recipes["+indice+"][id_medicamento]");
    selectC.setAttribute("id", "medicamento" + indice);
    selectC.setAttribute("value", "0");
    var input2 = inpu.cloneNode(true);
    input2.setAttribute("id", "indicacion" + indice);
    input2.setAttribute("name", "recipes["+indice+"][indicacion]");
    input2.value = "";


    cell1.appendChild(selectC);
    cell2.appendChild(input2);
    cell3.innerHTML = '<button class="btn btn-danger" type="button" id="eliminar" data-index="' + indice + '">Eliminar</button>';

    $('#agregar').attr("value", indice);

};