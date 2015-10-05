function loadParisLongTerme() {

    var onglet_span = $('#onglet_paris_long_terme').find('span');
    $.ajax({
        url: 'dashboard/ajax/parislongterme',
        type: 'get',
        success: function (data) {

            // chargement des paris long terme dans la div.
            $('#tab_15_2').html(data.vue);

            var table = $("#parislongtermetable");

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


            var oTable = $("#parislongtermetable").dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher&nbsp;:",
                    lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                    info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "Pr&eacute;c&eacute;dent",
                        next:       "Suivant",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },

                "lengthMenu": [
                    [5, 15, 20, 100],
                    [5, 15, 20, 100] // change per page values here
                ],

                // set the initial value
                "pageLength": 5,
                "dom": "<'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>" // horizobtal scrollable datatable
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            });

            var tableWrapper = $('#parislongtermetable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
            tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

            table.on('click', ' tbody td .row-details', function () {
                var nTr = $(this).parents('tr')[0];
                var selections = $(this).parents('tr').data('selections');
                var type = $(this).parents('tr').data('pari-type');
                if (oTable.fnIsOpen(nTr)) {
                    /* This row is already open - close it */
                    $(this).addClass("row-details-close").removeClass("row-details-open");
                    oTable.fnClose(nTr);
                } else {
                    /* Open this row */
                    $(this).addClass("row-details-open").removeClass("row-details-close");
                    oTable.fnOpen(nTr, fnFormatDetailsForChildsParisEnCours(oTable, selections, type), 'details');
                }
            });

            // afficher le count dans le bon endroit.
            if (data.count_paris_longterme == 0) {
                onglet_span.text('');
            } else {
                onglet_span.html(data.count_paris_longterme);
            }

            // activation des tooltip.
            $('[data-toggle="tooltip"]').tooltip();

            parisEnCoursEnclose(table, 'historique');

            /* stopper la propagation quand on click sur le bouton valider.
            boutonvalider.click(function (e) {
                e.stopPropagation();
            });

            // stopper la propagation quand on click sur le bouton supprimer.
            bouton_supprimer.click(function (e) {
                e.stopPropagation();
            });

            // stopper la propagation quand on click sur le choix du resultat.
            resultat.click(function (e) {
                e.stopPropagation();
            });*/

            // calcul du montant retour par rapport au resultat selectionné
            /*resultat.change(function (e) {
                var parent = $(this).closest('.mainrow');
                var cote = parent.find(".tdcote").text();
                var mise = parent.find(".tdmise .tdsubmise").text();
                var tdsubretour = parent.find('.tdretour span.subretour');
                var tdretour = parent.find('.tdretour');

                switch (result = parent.find("select[name='resultatDashboardInput'] option:selected").text()) {
                    case '--Selectionnez--':
                        tdsubretour.empty();
                        tdretour.css("color", "black");
                        break;
                    case "Gagné":
                        var retour = parseFloat(mise * cote);
                        tdretour.css("color", "green");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Perdu":
                        var retour = parseFloat(mise);
                        tdretour.css("color", "red");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "1/2 Gagné":
                        var retour = parseFloat((mise * cote - mise) / 2) + parseFloat(mise);
                        tdretour.css("color", "green");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "1/2 Perdu":
                        var retour = parseFloat(mise / 2);
                        tdretour.css("color", "red");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Remboursé":
                        tdretour.css("color", "black");
                        var retour = parseFloat(mise);
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Annulé":
                        tdretour.css("color", "black");
                        var retour = parseFloat(mise);
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                }
            });*/

            // click sur le bouton valider du paris long terme ,
            // qui va le transferer vers historique et recharger les paris long terme.
            /*form_valider.submit(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.mainrow');
                var retour = parent.find('.tdretour span.subretour');
                if (retour.text().length > 0) {
                    var cote = parent.find(".tdcote").text();
                    var mise = parent.find(".tdmise .tdsubmise").text();
                    var ser = $(this).serialize();
                    $.ajax({
                        url: 'historique',
                        type: 'post',
                        data: ser + '&cote=' + cote + '&mise=' + mise + '&retour=' + retour,
                        success: function (json) {
                            loadParisLongTerme();
                        },
                        error: function () {
                            console.log("valider un pari long terme ne fonctionne pas");
                        }
                    });
                } else {
                    alert('Vous devez préciser un status pour ce pari.');
                }
            });

            // click sur le bouton supprimer qui va supprimer le pari et recharger les paris long terme.
            form_supprimer.submit(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.mainrow');
                var id = parent.find('.id').text();
                var retour = parent.find('.tdretour span.subretour');
                var cote = parent.find(".tdcote").text();
                var mise = parent.find(".tdmise .tdsubmise").text();
                var ser = $(this).serialize();
                if (confirm("Etes vous sur?")) {
                    $.ajax({
                        url: 'historique/' + id,
                        type: 'delete',
                        success: function (json) {
                            loadParisLongTerme();
                        },
                        error: function () {
                            console.log("supprimer un pari long terme ne fonctionne pas");
                        }
                    });
                }
            });*/
        },
        error: function (data) {
            console.log("le chargement des paris long terme n\'a pas fonctionné");

        }
    });
}

