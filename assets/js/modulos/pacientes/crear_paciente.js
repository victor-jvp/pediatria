/**
 * Created by VJ15 on 5/12/2015.
 */
$(function () {
    $('#fecha_nacimiento').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
        ignoreReadonly: true,
    });

    /*$('form#nuevoPaciente').find('button[name="guardar"]').on("click", function(){
        var fecha_nacimiento = $('#fecha_nacimiento').val();
        if(fecha_nacimiento == ""){
            alert("Fecha de nacimiento Vacio");
        }
    });*/
});
