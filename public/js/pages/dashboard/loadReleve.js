
function cb_releve(start, end) {
    $('#defaultrange-releve').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
}

cb_releve(moment.tz(user.timezone).subtract(7,'days'), moment.tz(user.timezone).endOf('day'));

$('#default-range-container-releve').daterangepicker({
    startDate: moment.tz(user.timezone).subtract(7,'days'),
    endDate: moment.tz(user.timezone).endOf('day'),
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
        '7 derniers jours': [moment.tz(user.timezone).subtract(7,'days'), moment.tz(user.timezone).endOf('day')],
        'Hier': [moment.tz(user.timezone).subtract(1, 'days'), moment.tz(user.timezone).subtract(1, 'days')],
        'Cette Semaine': [moment.tz(user.timezone).startOf('isoweek'), moment.tz(user.timezone).endOf('isoweek')],
        'Semaine Précédente': [moment.tz(user.timezone).subtract(1, 'week').startOf('isoweek'), moment.tz(user.timezone).subtract(1, 'week').endOf('isoweek')],
        'Ce Mois-ci': [moment.tz(user.timezone).startOf('month'), moment.tz(user.timezone).endOf('month')],
        'Mois Précédent': [moment.tz(user.timezone).subtract(1, 'month').startOf('month'), moment.tz(user.timezone).subtract(1, 'month').endOf('month')]
    }
}, cb_releve).on('apply.daterangepicker', function (ev, picker) {
    loadReleveOnDashboard();
});

var ranges_container = $('.ranges');


function loadReleveOnDashboard() {
    var range = $('#default-range-container-releve #defaultrange-releve').text();

    $.ajax({
        url: 'releve',
        type: 'get',
        data: {range: range},
        success: function (data) {
            $('#releve-recap').html(data);

            // details expand
            /*$('#table-releve-recap').on('click', '.button-releve-details', function(){
                var tr = $(this).closest('tr');
                $.ajax({
                    url: 'releve-details/'+$(this).data('date'),
                    type: 'get',
                    success: function (data) {

                    },
                    complete: function () {

                    }
                })
            });*/
        }
    })
}

