
function cb(start, end) {
    $('#defaultrange').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
}

cb(moment.tz(user.timezone).startOf('month'), moment.tz(user.timezone).endOf('month'));

$('#default-range-container').daterangepicker({
    startDate: moment.tz(user.timezone).startOf('month'),
    endDate: moment.tz(user.timezone).endOf('month'),
    opens: 'left',
    format: 'DD/MM/YYYY',
    buttonClasses: ['btn btn-default'],
    applyClass: 'btn-sm btn-primary',
    cancelClass: 'btn-sm',
    locale: {
        applyLabel: 'Choisir',
        cancelLabel: 'Annuler',
        fromLabel: 'De',
        toLabel: 'à',
        customRangeLabel: 'personnalisé',
        daysOfWeek: ['L', 'Ma', 'Me', 'J', 'V', 'S','D'],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        firstDay: 1
    },
    ranges: {
        'Aujourd\'hui': [moment.tz(user.timezone), moment.tz(user.timezone)],
        'Hier': [moment.tz(user.timezone).subtract(1, 'days'), moment.tz(user.timezone).subtract(1, 'days')],
        'Cette Semaine': [moment.tz(user.timezone).startOf('isoweek'), moment.tz(user.timezone).endOf('isoweek')],
        'Semaine Précédente': [moment.tz(user.timezone).subtract(1, 'week').startOf('isoweek'), moment.tz(user.timezone).subtract(1, 'week').endOf('isoweek')],
        'Mois en cours': [moment.tz(user.timezone).startOf('month'), moment.tz(user.timezone).endOf('month')],
        'Mois Précédent': [moment.tz(user.timezone).subtract(1, 'month').startOf('month'), moment.tz(user.timezone).subtract(1, 'month').endOf('month')]
    }
}, cb).on('apply.daterangepicker', function (ev, picker) {
    loadGeneralRecapsOnDashboard();
});



function loadGeneralRecapsOnDashboard() {
    var range = $('#default-range-container #defaultrange').text();
    $.ajax({
        url: 'generalrecap',
        type: 'get',
        data: {range: range},
        success: function (data) {
            $('#tipsters-general-recap').html(data);
            //$('#total-recap-profits-devise').html(data.total_profit_devise);
            //$('#total-recap-profits-unites').html(data.total_profit_unites);
        }
    })
}

