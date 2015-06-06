
function loadBookmakersOnDashboard() {
    $.ajax({
        url: 'comptes',
        type:'get',
        success: function (data) {
            $('#comptes_par_bookmakers').html(data);
        },
        error: function (data){
            console.log('la récuperation des comptes bookmakers vers le dashboard n\'a pas fonctionné');
        }
    });
}