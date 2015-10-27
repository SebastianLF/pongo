
function loadBookmakersOnDashboard() {
    $.ajax({
        url: 'bettor/comptes-for-dashboard',
        type:'get',
        success: function (data) {
            $('#comptes_par_bookmakers').html(data);
            $('a[data-toggle="collapse"]').click(function () {
                $(this).find('span.glyphicon').toggleClass('glyphicon-chevron-down glyphicon-chevron-right');
            });
        },
        error: function (data){
            console.log('la récuperation des comptes bookmakers vers le dashboard n\'a pas fonctionné');
        }
    });
}