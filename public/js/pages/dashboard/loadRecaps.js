// charge sans vue.

function loadRecapsOnDashboard() {
    $.ajax({
        url: 'recaps',
        type: 'get',
        success: function (data) {
            $('[data-toggle="collapse"]').collapse();
            $('#recaps').html(data);
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}
