paginationOnclick('pagination/ajax/tipsters','#tipsters-pagination');
// quand la page config se charge, elle charge aussi les popover tipster
function loadTipsters() {
    $.ajax({
        url: 'pagination/ajax/tipsters',
        data: { page: '1' },
        type: 'get',
        success: function (data) {
            $('#tipsters-pagination').html(data);
            tipsterEdit();
            tipsterDelete();
        }
    });
}
function loadTipstersWithPage() {

    // numero de page en cours
    var pg = $('#tipsters-pagination').find('.active').find('span').text();

    // si il ya encore un tipster on reste sur la meme page sinon si il n'en reste pas, on affiche la page precedente.
    var taille = $('.idtipstertd').length-1;

    // si pg = rien, ca veut dire qu'il n'y a pas de pagination donc on affiche les tipsters de la premiere page.
    // si taille == 0 , ca veut dire qu'il n'y a plus qu'un seul tipster sur la derniere page donc il faut afficher la page inferieur(ici on affiche la premiere page, le script n'est pas encore fait).
    if (!pg || ( taille == 0)) {

        loadTipsters();
    }else{
        $.ajax({
            url: 'pagination/ajax/tipsters',
            data: { page: pg },
            type: 'get',
            success: function (data) {
                console.log(data);
                $('#tipsters-pagination').html(data);
                tipsterEdit();
                tipsterDelete();
            }
        });
    }
}




