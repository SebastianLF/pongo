// charge sans vue.

function loadRecapsOnDashboard() {
    $.ajax({
        url: 'recaps',
        type: 'get',
        success: function (data) {
            $('[data-toggle="collapse"]').collapse();
            $('#recaps').html(data);
            var now = new Date(Date.now());
            var month = now.getMonth();
            var year = now.getFullYear();
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        }
    });
}

function expand_actual_month_recap(){

}
