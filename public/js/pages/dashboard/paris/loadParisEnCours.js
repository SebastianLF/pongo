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
            table.find('.subbetclick a').click(function () {
                if ($(this).find('i').hasClass('glyphicon-chevron-right')) {
                    $(this).find('i').removeClass('glyphicon-chevron-right');
                    $(this).find('i').addClass('glyphicon-chevron-down');
                } else {
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


    $.ajax({
        url: 'dashboard/ajax/paristermine',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_4').html(data);
            var table = $("#paristerminetable");

            /* Formatting function for row details */
            function fnFormatDetails(oTable, selections) {
                //var aData = oTable.fnGetData(nTr);
                var sOut = '<table class="table table-condensed table-subrow-combine"><thead><tr class="uppercase"><th>date rencontre</th><th>sport</th><th>competition</th><th>rencontre</th><th>pari</th><th>cote</th><th>resultat</th><th>status</th></tr></thead><tbody>';

                // affichage de chaque selection dans le child table
                $.each(selections, function (key, value) {
                    var rencontre;

                    // afficher la rencontre ou pas.
                    if (value.game_name == null) {
                        rencontre = 'N/A'
                    } else {
                        rencontre = '<span><img src="img/flags/' + value.equipe1.country.shortname + '.png" class="img-flag"> ' + value.equipe1.name + ' - </span>' + '<span><img src="img/flags/' + value.equipe2.country.shortname + '.png" class="img-flag"> ' + value.equipe2.name + '</span>'
                    }

                    // affichage du status avec la bonne couleur.
                    function statusAffichage(){
                        switch (value.status) {
                            case 0:
                                return 'N/A';
                                break;
                            case 1:
                                return '<span class="bold fontsize15 font-green-sharp">gagné</span>';
                                break;
                            case 2:
                                return '<span class="bold fontsize15 font-red-haze">perdu</span>';
                                break;
                            case 3:
                                return '<span class="bold fontsize15 font-green-sharp">1/2 gagné</span>';
                                break;
                            case 4:
                                return '<span class="bold fontsize15 font-red-haze">1/2 perdu</span>';
                                break;
                            case 5:
                                return '<span class="bold fontsize15">Remboursé</span>';
                                break;
                            case 6:
                                return '<span class="bold fontsize15 font-blue">cash out</span>';
                                break;
                        }
                    }

                    // afficher N/A ou le resultat suivant ce que contient la variable resultat.
                    function statusResultat(){
                        if(value.resultat == '' || value.resultat == null){
                            return 'N/A';
                        }else{return value.resultat}
                    }

                    function affichageScore(){
                        if(value.score == '' || value.score == null){
                            return '';
                        }else{return '('+value.score+'LIVE!)'}
                    }

                    // structure de representation d'une ligne.
                    sOut +=
                        '<tr>' +
                        '<td>' + moment.tz(value.date_match, 'Europe/Paris').tz(user.timezone).format("DD/MM/YYYY HH:mm") + '</td>' +
                        '<td>' + value.sport.name + '</td>' +
                        '<td>' + value.competition.name + '</td>' +
                        '<td>' + rencontre + '</td>' +
                        '<td>' + value.pariAffichage + ' ('+ value.scope.representation + ')' + affichageScore() + '</td>' +
                        '<td>' + value.cote + '</td>' +
                        '<td>' + statusResultat() + '</td>' +
                        '<td class="uppercase">' + statusAffichage() + '</td>' +
                        '</tr>';
                });
                sOut += '</tbody></table>';

                return sOut;
            }

            /*
             * Insert a 'details' column to the table
             */
            var nCloneTh = document.createElement('th');
            nCloneTh.className = "table-checkbox";

            var nCloneTd = document.createElement('td');
            nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';

            table.find('thead tr').each(function () {
                this.insertBefore(nCloneTh, this.childNodes[0]);
            });

            table.find('tbody tr').each(function () {
                this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
            });


            var oTable = table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },

                "lengthMenu": [
                    [5, 15, 20, 100],
                    [5, 15, 20, 100] // change per page values here
                ],

                // set the initial value
                "pageLength": 5,
                "dom": "<'row' <'col-md-6 col-sm-12 margin-bot'B>><'row'<'col-md-6 col-sm-6'l><'col-md-6 col-sm-6'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>", // horizobtal scrollable datatable
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",


                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        download: 'open'

                    }
                ]

            });

            var tableWrapper = $('#paristerminetable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
            tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

            table.on('click', ' tbody td .row-details', function () {
                var nTr = $(this).parents('tr')[0];
                var selections = $(this).parents('tr').data('selections');
                if (oTable.fnIsOpen(nTr)) {
                    /* This row is already open - close it */
                    $(this).addClass("row-details-close").removeClass("row-details-open");
                    oTable.fnClose(nTr);
                } else {
                    /* Open this row */
                    $(this).addClass("row-details-open").removeClass("row-details-close");
                    oTable.fnOpen(nTr, fnFormatDetails(oTable, selections), 'details');
                }
            });
            parisTermineDelete();

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

function cashOut() {

    var modal = $('#cashoutModal');
    // passage de parametres vers le modal.
    modal.on('show.bs.modal', function (e) {

        //get data-id attribute of the clicked element
        var pari_id = $(e.relatedTarget).data('id');

        //populate the textbox
        $(e.currentTarget).find('input[name="ticket-id"]').val(pari_id);
    });

    // cash out modal
    var cashout_form = $('#cashout-update');
    var cashout_select = cashout_form.find('#cashout-select');
    var cashout_array = [{id: 'c', text: 'classic cash out'}, {id: 'p', text: 'partial cash out'}];
    cashout_select.select2({
        minimumResultsForSearch: Infinity,
        cache: true,
        data: cashout_array
    }).change(function () {

    });

    // envoi du form.
    cashout_form.submit(function (e) {
        e.preventDefault();
        var inputs = cashout_form.serialize();
        $.ajax({
            url: 'cashout',
            type: 'post',
            data: inputs,
            dataType: 'json',
            success: function (data) {
                if (data.etat) {
                    toastr.success(data.msg, data.head);
                    loadParisEnCours();
                    loadParisTermine();
                    loadBookmakersOnDashboard();
                    loadParisLongTerme();
                    loadGeneralRecapsOnDashboard();
                    modal.hide();
                } else {
                    for (key in data.msg) {
                        keyname = key;
                        toastr.error(data.msg[keyname], 'Erreur:');
                    }
                }
            },
            error: function () {

            }
        });
    });
}
