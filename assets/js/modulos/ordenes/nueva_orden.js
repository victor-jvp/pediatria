/**
 * Created by VJ15 on 8/12/2015.
 */
var base_url = window.location.origin;

$(document).ready(function () {

    $('#fecha_consulta').datetimepicker({
        locale: 'ES',
        format: 'DD-MM-YYYY',
        //ignoreReadonly: true
    });

    //Cargar chosens
    $("#paciente").chosen({
        no_results_text: "No hay resultados para:",
        width: "100%"
    });

    $("#medicamento").chosen({
        no_results_text: "No hay resultados para:",
        width: "100%"
    });

    $(".med").on('change', function(){
        var id_med = $(this).val();
        if(id_med != 0){
            $.ajax({
                url: 'ajax-medicamento-info',
                type: 'POST',
                //async: true,
                cache: false,
                dataType: 'json',
                data: 'id_med=' + id_med,
            }).done(function (json) {

                //If json object is not empty.
                if ($.isEmptyObject(json.results[0]) == false) {
                    $.each(json.results[0], function (i, result) {

                    });
                }
            });
        }
    });

    //Obtener fecha actual
    var today = moment().format("DD-MM-YYYY");
    $('#fecha_consulta').val(today);

    $('#paciente').on("change", function (e) {

        var id_paciente = $('#paciente').val();

        if (id_paciente != 0) {
            $.ajax({
                url: 'ajax-informacion-paciente',
                type: 'POST',
                //async: true,
                cache: false,
                dataType: 'json',
                data: 'id_paciente=' + id_paciente,
            }).done(function (json) {

                //If json object is not empty.
                if ($.isEmptyObject(json.results[0]) == false) {
                    //var i = 0;
                    $.each(json.results[0], function (i, result) {

                        $('#id_paciente').val(result['id_paciente']);
                        var fecha = moment(result['fecha_nacimiento']).format("DD-MM-YYYY");
                        $('#fecha_nacimiento').val(fecha);
                        var edad = calcAge(result['fecha_nacimiento']);
                        $('#edad').val(edad);

                    });

                    //$('#modal_paciente').modal('toggle');
                }
            });
        } else {

            $('#fecha_nacimiento').val('');
            $('#edad').val('');
            $('#id_paciente').val('');
        }
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
    };

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

    function insertRow() {

        var indice = 0;
        indice = parseInt($('#agregar').val()) + 1;
        var select = document.getElementById("medicamento0");
        var selectU = document.getElementById("unidad0");
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
        var cell4 = row.insertCell(3);

        var selectC = select.cloneNode(true);
        selectC.setAttribute("name", "recipes["+indice+"][id_medicamento]");
        selectC.setAttribute("id", "medicamento" + indice);
        selectC.setAttribute("value", "0");
        var selectC2 = selectU.cloneNode(true);
        selectC2.setAttribute("name", "recipes["+indice+"][id_unidad]");
        selectC2.setAttribute("id", "unidad" + indice);
        selectC2.setAttribute("value", "0");
        var input2 = inpu.cloneNode(true);
        input2.setAttribute("id", "indicacion" + indice);
        input2.setAttribute("name", "recipes["+indice+"][indicacion]");
        input2.value = "";

        cell1.appendChild(selectC);
        cell2.appendChild(selectC2);
        cell3.appendChild(input2);
        cell4.innerHTML = '<button class="btn btn-danger" type="button" id="eliminar" data-index="' + indice + '">Eliminar</button>';

        $('#agregar').attr("value", indice);

    };
});