

function loadParisEnCours() {
    var onglet = $('#onglet_paris_en_cours');
    var onglet_span = onglet.find('span');
    var table = $('#parisencourstable');
    $.ajax({
        url: 'dashboard/ajax/parisencours',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_1').html(data.vue);
            table.find('.subbetclick a').click(function(){
                if($(this).find('i').hasClass('glyphicon-chevron-right')){
                    $(this).find('i').removeClass('glyphicon-chevron-right');
                    $(this).find('i').addClass('glyphicon-chevron-down');
                }else{
                    $(this).find('i').removeClass('glyphicon-chevron-down');
                    $(this).find('i').addClass('glyphicon-chevron-right');
                }
            });

            // afficher le count dans le bon endroit.
            if (data.count_paris_encours == 0) {
                onglet_span.text('');
            } else {
                onglet_span.html(data.count_paris_encours);
            }

            featuresParisEnCours();
            paginationParisEnCours();
        },
        error: function (data) {
            $('#tab_15_1').html('<p>impossible de récuperer les paris</p>');
        }
    });
}

function loadParisTermine() {

    var table = $("#paristerminetable");
    $.ajax({
        url: 'dashboard/ajax/paristermine',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_4').html(data);
            $('#paristerminetable').DataTable({
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Copy all data',
                        exportOptions: {
                            modifier: {
                                search: 'none'
                            }
                        }
                    }
                ]
            });
            /* parisTermineDelete();
            table.find(".boutonsupprimer").click(function (e) {
                e.stopPropagation();
            });

            // chevron changes icon on click for combiné/parlay.
            $('.subbetclick a').click(function(){
                if($(this).find('i').hasClass('glyphicon-chevron-right')){
                    $(this).find('i').removeClass('glyphicon-chevron-right');
                    $(this).find('i').addClass('glyphicon-chevron-down');
                }else{
                    $(this).find('i').addClass('glyphicon-chevron-right');
                    $(this).find('i').removeClass('glyphicon-chevron-down');
                }
            });

            // barre de défilement vertical pour les paris terminés.
            $(function(){
                $('.slimScrollTermine').slimScroll({
                    height: '350px',
                    allowPageScroll: false,
                    wheelStep: 10,
                    alwaysVisible: true
                });
            });

            // table search
            $('#paristerminetable').tableSearch({}); // sans les crochets-parenthese ca ne marche pas, il faut bien les laisser.*/
        },
        error: function (data) {
            $('#tab_15_4').html('<p>impossible de récuperer les paris terminés</p>');
        }
    });
}

function featuresParisEnCours() {
    // activation des tooltip.
    $('[data-toggle="tooltip"]').tooltip();
    $("[data-hover='tooltip']").tooltip();

    // stopper la propagation quand on click sur le choix du resultat.
    $("#parisencourstable .boutonvalider").click(function (e) {
        e.stopPropagation();
    });
    $("#parisencourstable .boutonsupprimer").click(function (e) {
        e.stopPropagation();
    });
    $("#parisencourstable .boutoncashout").click(function (e) {
        e.stopPropagation();
    });
    $("#parisencourstable .boutonshowticket").click(function (e) {
        e.stopPropagation();
    });
    $("select[name='resultatDashboardInput']").click(function (e) {
        e.stopPropagation();
    });

    parisEnCoursCalculateStatus('#parisencourstable');
    parisEnCoursEnclose('#parisencourstable', '.validerform', 'historique');
    parisEnCoursDelete('#parisencourstable', '.supprimerform', 'encourspari/');
}

// lors du clique sur un numero de pagination.
function paginationParisEnCours() {
    $('#tab_15_1').on('click', '.pagination a', function (e) {
        e.preventDefault();
        var pg = getPaginationSelectedPage($(this).attr('href'));
        $.ajax({
            url: 'dashboard/ajax/parisencours',
            data: {page: pg},
            success: function (data) {
                $('#tab_15_1').html(data.vue);
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
    if (condition == 'delete' && taille == 1) {
        pg = pg - 1;
    }

    // quand pg est egale a rien on affiche la premiere page.
    if (!pg) {
        loadParisEnCours();
    } else {
        $.ajax({
            url: 'dashboard/ajax/parisencours',
            data: {page: pg},
            type: 'get',
            success: function (data) {
                $('#tab_15_1').html(data);
                featuresParisEnCours();
            }
        });
    }
}

function cashOut(){

    var modal = $('#cashoutModal');
    // passage de parametres vers le modal.
    modal.on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var pari_id = $(e.relatedTarget).data('id');

        //populate the textbox
        $(e.currentTarget).find('input[name="ticket-id"]').val(pari_id);
    });

    // cash out modal
    var cashout_form = $('#cashout-update');
    var cashout_select = cashout_form.find('#cashout-select');
    var cashout_array = [{ id: 'c', text: 'classic cash out' },{ id: 'p', text: 'partial cash out' }];
    cashout_select.select2({
        minimumResultsForSearch: Infinity,
        cache: true,
        data: cashout_array
    }).change(function(){

    });

    // envoi du form.
    cashout_form.submit(function(e){
        e.preventDefault();
        var inputs = cashout_form.serialize();
        $.ajax({
            url : 'cashout',
            type : 'post',
            data : inputs,
            dataType : 'json',
            success: function(data){
                if(data.etat){
                    toastr.success(data.msg, data.head);
                    loadParisEnCours();
                    loadParisTermine();
                    loadBookmakersOnDashboard();
                    loadParisLongTerme();
                    loadGeneralRecapsOnDashboard();
                    modal.hide();
                }else{
                    for (key in data.msg) {
                        keyname = key;
                        toastr.error(data.msg[keyname], 'Erreur:');
                    }
                }
            },
            error: function(){

            }
        });
    });
}
