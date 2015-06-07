//setInterval(refresh_selections, (5 * 1000));
$('#selection-refresh').click(function (e) {
    e.preventDefault();
    refreshSelectionsAuto();
});

function refreshSelectionsAuto() {
    $.ajax({
        url: 'selections',
        success: function (data) {
            $('#automatic-selections').html(data);
            supprimerSelectionAuto();
        },
        error: function (data) {
            $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
        }
    });
}

function supprimerSelectionAuto() {
    $('#automatic-selections .boutonsupprimer').click(function (e) {
        alert('ok');
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find(".selection_id").text();
        alert(id);
        $.ajax({
            url: 'coupon/' + id,
            method: 'delete',
            success: function (data) {
                refreshSelectionsAuto();
            },
            error: function (data) {
            }
        });
    });
}

/*$.ajax({
 url: 'coupon',
 type: 'post',
 data: {
 param1 : 'param1',
 param2 : 'param2'
 },
 success: function (data) {
 },
 error: function (data) {
 $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
 }
 });*/



