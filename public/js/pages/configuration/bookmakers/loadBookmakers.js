
paginationOnclick('pagination/ajax/bookmakers','#bookmakers-pagination');

function loadBookmakers(page) {
    //si un numero n'est pas specifié, on affiche la premiere page.
    page = page || '1';

    $.ajax({
        url: 'pagination/ajax/bookmakers',
        data: { page: page },
        type: 'get',
        success: function (data) {
            $('#bookmakers-pagination').html(data);
            editBookmakerButton();
            deleteBookmakerButton();
        },
        error: function (data){
            console.log('l\'affichage des bookmakers n\'a pas fonctionné');
        }
    });
}
/*function loadBookmakersWithPage(condition) {

    // taille = nombre de td avec la classe .id puisque chaque element a un td avec ".id" .
    var taille = $('#bookmakerstable .id').length;
    var pg = $('#bookmakers-pagination').find('.active').find('span').text();

    // quand il ne reste qu'un seul pari sur une page et quil est suprimé, ca passe diectement a la page precedente.
    if(condition == 'delete' && taille == 1){
        pg = pg-1;
    }

    // quand pg est egale a rien on affiche la premiere page.
    if (!pg) {
        loadBookmakers();
    }else{
        $.ajax({
            url: 'dashboard/ajax/bookmakers',
            data: { page: pg },
            type: 'get',
            success: function (data) {
                $('#bookmakers-pagination').html(data);
                editBookmakerButton();
                deleteBookmakerButton();

            }
        });
    }
}*/
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