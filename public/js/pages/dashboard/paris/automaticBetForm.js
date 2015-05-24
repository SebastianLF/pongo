/*setInterval(refresh_selections, (5 * 1000));

function refresh_selections() {
    $.ajax({
        url: 'coupon',
        success: function (data) {
            $('#automatic-selections').html(data);
        },
        error: function (data) {
            $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
        }
    });
}*/

$.ajax({
    url: 'coupon',
    type: 'post',
    data: {
        param1: 'param1',
        param2: 'param2'
    },
    success: function (data) {
        $('#automatic-selections').html(data);
    },
    error: function (data) {
        $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
    }
});