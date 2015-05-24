//setInterval(refresh_selections, (5 * 1000));

$('#selection-refresh').click(function (e) {
    e.preventDefault();
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


