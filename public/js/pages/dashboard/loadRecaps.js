

//nouvelle version


$('#defaultrange').daterangepicker({
        opens: 'left',
        format: 'DD/MM/YYYY',
        timeZone: moment($.cookie('timezone')),
        ranges: {
            'Aujourd\'hui': [moment(), moment()],
            'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Cette Semaine': [moment().startOf('isoweek'),moment().endOf('isoweek')],
            'Semaine Précédente': [moment().subtract(1, 'week').startOf('isoweek'), moment().subtract(1, 'week').endOf('isoweek')],
            'Ce Mois': [moment().startOf('month'), moment().endOf('month')],
            'Mois Précédent': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
