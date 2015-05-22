setInterval(refresh_selections, (10 * 1000));

function refresh_selections() {
    $.ajax({
        url: 'coupon',
        method: 'post',
        data: { pick: 'ok'},
        success: function (data) {
            $('#automatic-selections').html(data);
        },
        error: function (data) {
            $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
        }
    });
}