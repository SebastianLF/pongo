//setInterval(refresh_selections, (5 * 1000));

function refresh_selections() {
    $('#selection-refresh').click(function(){
        $.ajax({
            url: 'selections',
            success: function (data) {
                $('#automatic-selections').html(data);
            },
            error: function (data) {
                $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
            }
        });
    });
}

