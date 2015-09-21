

//nouvelle version


$('#defaultrange').daterangepicker({
        opens: 'left',
        format: 'DD/MM/YYYY',
        ranges: {
            'Aujourd\'hui': [moment.tz(user.timezone), moment.tz(user.timezone)],
            'Hier': [moment.tz(user.timezone).subtract(1, 'days'), moment.tz(user.timezone).subtract(1, 'days')],
            'Cette Semaine': [moment.tz(user.timezone).startOf('isoweek'),moment.tz(user.timezone).endOf('isoweek')],
            'Semaine Précédente': [moment.tz(user.timezone).subtract(1, 'week').startOf('isoweek'), moment.tz(user.timezone).subtract(1, 'week').endOf('isoweek')],
            'Ce Mois': [moment.tz(user.timezone).startOf('month'), moment.tz(user.timezone).endOf('month')],
            'Mois Précédent': [moment.tz(user.timezone).subtract(1, 'month').startOf('month'), moment.tz(user.timezone).subtract(1, 'month').endOf('month')]
        }
    },
    function (start, end) {
        $('#defaultrange input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
).on('apply.daterangepicker', function (ev, picker) {
        loadGeneralRecapsOnDashboard();
    });


function loadGeneralRecapsOnDashboard() {
    var range = $('#defaultrange input').val();
    $.ajax({
        url: 'generalrecap',
        type: 'get',
        data: {range: range},
        success: function (data) {
            $('#tipsters-general-recap').html(data.tipsters_view);
            $('#total-recap-profits-devise').html(data.total_profit_devise);
            $('#total-recap-profits-unites').html(data.total_profit_unites);
        }
    })
}

// ancienne version
/*function loadRecapsOnDashboard() {
    $.ajax({
        url: 'recaps',
        type: 'get',
        success: function (data) {
            $('[data-toggle="collapse"]').collapse();
            $('#recaps').html(data);
            $('[data-toggle="popover"]').popover();

            // ouverture de l accordeon correspondant au mois en cours.
            var now = new Date(Date.now());
            var month = now.getMonth() + 1;
            var year = now.getFullYear();
            var recap = $('#recaps');
            recap.find('#collapse_' + year + '_' + month).addClass('in');
        }
    });
}*/
