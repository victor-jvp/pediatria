$(function() {
        $(".knob").knob({
        	'change' : function (v) { console.log(v); }
        });
    });
$('.knob')
        .val(1)
        .prop('readonly', true)
        .attr('data-fgColor', '#000')
        .attr('data-skin', 'tron')
        .attr('data-width', '15%')
        .attr('data-thickness', '.4')
        .attr('data-max', '40')
        .trigger('change');