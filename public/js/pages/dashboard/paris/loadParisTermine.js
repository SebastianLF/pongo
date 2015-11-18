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
                    function statusAffichage() {
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
                    function statusResultat() {
                        if (value.resultat == '' || value.resultat == null) {
                            return 'N/A';
                        } else {
                            return value.resultat
                        }
                    }

                    function affichageScore() {
                        if (value.score == '' || value.score == null) {
                            return '';
                        } else {
                            return '(' + value.score + 'LIVE!)'
                        }
                    }

                    // structure de representation d'une ligne.
                    sOut +=
                        '<tr>' +
                        '<td>' + moment.tz(value.date_match, 'Europe/Paris').tz(user.timezone).format("DD/MM/YYYY HH:mm") + '</td>' +
                        '<td>' + value.sport.name + '</td>' +
                        '<td>' + value.competition.name + '</td>' +
                        '<td>' + rencontre + '</td>' +
                        '<td>' + value.pariAffichage + ' (' + value.scope.representation + ')' + affichageScore() + '</td>' +
                        '<td>' + value.cote + '</td>' +
                        '<td>' + statusResultat() + '</td>' +
                        '<td class="uppercase">' + statusAffichage() + '</td>' +
                        '</tr>';
                });
                sOut += '</tbody></table>';

                return sOut;
            }

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


            var oTable = table.dataTable({

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

                "lengthMenu": [
                    [5, 15, 20, 100],
                    [5, 15, 20, 100] // change per page values here
                ],

                // set the initial value
                "pageLength": 20,
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

                var $this = $(this);
                var nTr = $(this).parents('tr')[0];

                var type = $(this).parents('tr').data('pari-type');
                if (oTable.fnIsOpen(nTr)) {
                    /* This row is already open - close it */
                    $(this).removeClass("glyphicon-triangle-top").addClass("glyphicon-triangle-bottom");
                    oTable.fnClose(nTr);

                } else {
                    /* Open this row */

                    $this.removeClass("glyphicon-triangle-bottom").addClass("glyphicon-triangle-top");
                    oTable.fnOpen(nTr, fnFormatDetailsForChildsParisTermine(oTable, $.parseJSON(data), type), 'details');
                }
            });

            parisTermineDelete();

        },
        error: function (data) {
            $('#tab_15_4').html('<p>impossible de récuperer les paris terminés</p>');
        }
    });
}
