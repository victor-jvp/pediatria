$("#id_medicamento").chosen({
        no_results_text: "No hay resultados para:",
        width: "100%"
});

$('#id_medicamento').on("change", function(e){
    var selected = $('#id_medicamento option:selected').html()

    if(selected != "Seleccione...") {

        var id_med = $('#id_medicamento').val();

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
                //var i = 0;
                $.each(json.results[0], function (i, result) {
                    $('#medicamento').val(result['medicamento']);
                    $('#status').val(result['status']).prop('selected', true);
                });
            }
        });
    }else {
        $('#medicamento').val('');
        $('#status').val('activo').prop('selected', true);
    }
});

$('#limpiar').on("click", function(){
    $('#id_medicamento').val('0').trigger("chosen:updated");
});