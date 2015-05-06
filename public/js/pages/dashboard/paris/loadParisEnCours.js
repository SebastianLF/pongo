function loadParisEnCours() {
    var onglet = $('#onglet_paris_en_cours span');
    $.ajax({
        url: 'dashboard/ajax/parisencours',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_1').html(data);
            featuresParisEnCours();
            paginationParisEnCours();
        },
        error: function (data) {
            $('#tab_15_1').html('<p>impossible de récuperer les paris</p>');
        }
    });
}

function loadParisTermine() {
    var onglet = $('#onglet_paris_long_terme span');
    $.ajax({
        url: 'dashboard/ajax/paristermine',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_4').html(data);
            featuresParisEnCours();
            paginationParisEnCours();
        },
        error: function (data) {
            $('#tab_15_4').html('<p>impossible de récuperer les paris</p>');
        }
    });
}

function featuresParisEnCours(){
    // activation des tooltip.
    $('[data-toggle="tooltip"]').tooltip();

    // afficher le count dans le bon endroit.
    var count = $('#parisencourstable #count').text();
    if(count == '0'){
        $('#onglet_paris_en_cours span').text('');
    }else
    {
        $('#onglet_paris_en_cours span').text(count);
    }


    // stopper la propagation quand on click sur le choix du resultat.
    $("#parisencourstable .boutonvalider").click(function (e) {
        e.stopPropagation();
    });
    $("#parisencourstable .boutonsupprimer").click(function (e) {
        e.stopPropagation();
    });
    $("select[name='resultatDashboardInput']").click(function (e) {
        e.stopPropagation();
    });

    parisEnCoursCalculateStatus('#parisencourstable');
    parisEnCoursEnclose('#parisencourstable','.validerform','historique');
    parisEnCoursDelete('#parisencourstable','.supprimerform','encourspari/');
}

// lors du clique sur un numero de pagination.
function paginationParisEnCours(){
    $('#tab_15_1').on('click', '.pagination a', function (e) {
        e.preventDefault();
        var pg = getPaginationSelectedPage($(this).attr('href'));
        $.ajax({
            url: 'dashboard/ajax/parisencours',
            data: { page: pg },
            success: function (data) {
                $('#tab_15_1').html(data);
                featuresParisEnCours();
            },
            error: function (data) {
                console.log('erreur: pagination par click');
            }
        });
    });
}

// quelle pagination charger, lorsque l'on ajoute ou supprimer un pari.
function loadParisEnCoursWithPage(condition) {
    var taille = $('#parisencourstable .id').length;
    var pg = $('#tab_15_1').find('.active').find('span').text();

    // quand il ne reste qu'un seul pari sur une page et quil est suprimé, ca passe diectement a la page precedente.
    if(condition == 'delete' && taille == 1){
        pg = pg-1;
    }

    // quand pg est egale a rien on affiche la premiere page.
    if (!pg) {
        loadParisEnCours();
    }else{
        $.ajax({
            url: 'dashboard/ajax/parisencours',
            data: { page: pg },
            type: 'get',
            success: function (data) {
                $('#tab_15_1').html(data);
                featuresParisEnCours();
            }
        });
    }
}
