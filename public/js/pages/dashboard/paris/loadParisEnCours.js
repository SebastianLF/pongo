function onPageChange() {

}


function loadParisEnCours() {
    var onglet = $('#onglet_paris_en_cours');
    var onglet_span = onglet.find('span');
    $.ajax({
        url: 'dashboard/ajax/parisencours',
        type: 'get',
        success: function (data) {
            // chargement des paris long terme dans la div.
            $('#tab_15_1').html(data.vue);

            var table = $("#parisencourstable");

            /*
             * Insert a 'details' column to the table
             */

            var nCloneTh = document.createElement('th');
            nCloneTh.className = "table-checkbox";

            var nCloneTdCombine = document.createElement('td');
            nCloneTdCombine.innerHTML = '<span class="row-details glyphicon glyphicon-triangle-bottom"></span>';

            var nCloneTdSimple = document.createElement('td');
            nCloneTdSimple.innerHTML = '<span class="glyphicon glyphicon-minus"></span>';

            table.find('thead tr').each(function () {
                this.insertBefore(nCloneTh, this.childNodes[0]);
            });

            table.find('tbody tr').each(function () {
                if ($(this).data('nb-selections') > 1) {
                    this.insertBefore(nCloneTdCombine.cloneNode(true), this.childNodes[0]);
                } else {
                    this.insertBefore(nCloneTdSimple.cloneNode(true), this.childNodes[0]);
                }
            });


            var oTable = $("#parisencourstable").dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first: "Premier",
                        previous: "Pr&eacute;c&eacute;dent",
                        next: "Suivant",
                        last: "Dernier"
                    },
                    aria: {
                        sortAscending: ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
                "ordering": false,
                //stateSave: true,

                "lengthMenu": [
                    [5, 15, 20, 100],
                    [5, 15, 20, 100] // change per page values here
                ],

                buttons: [
                    {
                        extend: 'copy',
                        header: false,
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    },
                    {
                        extend: 'csv',
                        header: true,
                        exportOptions: {
                            modifier: {
                                columnDefs: [
                                    { targets: 1 }
                                ]
                            }
                        }
                    }
                ],

                // set the initial value
                "pageLength": 5,
                "dom": "<'row'<'col-md-12'Bf>><'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>" // horizobtal scrollable datatable
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            });


            var tableWrapper = $('#parisencourstable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
            tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

            table.on('click', ' tbody td .row-details', function () {

                var $this = $(this);
                var nTr = $(this).parents('tr')[0];

                var type = $(this).parents('tr').data('pari-type');
                if (oTable.fnIsOpen(nTr)) {
                    /* This row is already open - close it */
                    $(this).removeClass("glyphicon-triangle-top").addClass("glyphicon-triangle-bottom");
                    oTable.fnClose(nTr);

                } else {
                    /* Open this row */
                    var selections = '';
                    var pari_id = $(this).parents('tr').data('pari-id');

                    // recuperation des selections à chaque ouverture de combiné pour l afficher dans le data attribut 'selections' du tr combiné.
                    $.getJSON("encourspari/selectionpourcombine/" + $(this).parents('tr').data('pari-id'), function (data) {

                        // structure de l'ouverture.
                        $this.removeClass("glyphicon-triangle-bottom").addClass("glyphicon-triangle-top");
                        oTable.fnOpen(nTr, fnFormatDetailsForChildsParisEnCours(oTable, $.parseJSON(data), type), 'details');

                        //trigger le status de chaque pour le type combiné
                        table.find("tr[data-pari-id='" + pari_id + "']").next('tr').find('select[name="status[]"]').each(function () {
                            $(this).val($(this).data('defaut-value'));
                        }).select2({minimumResultsForSearch: Infinity});
                    });
                }
            });

            //trigger le status de chaque pour le type simple
            $('select[name="status[]"]').each(function () {
                $(this).val($(this).data('defaut-value'));
            }).select2({minimumResultsForSearch: Infinity});

            // afficher le count dans le bon endroit.
            if (data.count_paris_encours == 0) {
                onglet_span.text('');
            } else {
                onglet_span.html(data.count_paris_encours);}

            $('#parisencourstable_paginate').bind('click', 'a', function () {
                //trigger le status de chaque pour le type simple
                table.find('select[name="status[]"]').each(function () {
                    $(this).val($(this).data('defaut-value'));
                }).select2({minimumResultsForSearch: Infinity});
            });

            calculMontantRetourne(table);
            parisEnCoursEnclose(table, 'c');
            parisEnCoursDelete(table, 'c');

        },
        error: function (data) {
            $('#tab_15_1').html('<p>impossible de récuperer les paris</p>');
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
onPageChange();
