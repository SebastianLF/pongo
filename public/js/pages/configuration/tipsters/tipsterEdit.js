/**
 * Created by sebs on 14/04/2015.
 */

function tipsterEdit(){
    $('.tipsterEditButton').click(function() {
        var indice = $(this).attr('data-indice');
        var suivi = $(this).attr('data-suivi');
        $("#idTipsterEditInput").val($(this).attr('data-id'));
        $("#nameTipsterEditInput").val($(this).attr('data-name'));
        $('#indiceTipsterEditSelect option[value="'+indice+'"]').prop('selected',true);
        $('#mtTipsterEditInput').val($(this).attr('data-mt'));
        $('#suiviTipsterEditSelect option[value="'+suivi+'"]').prop('selected',true);
    });
}
