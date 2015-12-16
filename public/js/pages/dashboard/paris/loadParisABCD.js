function loadParisABCD() {
    var onglet_span = $('#onglet_paris_martingale').find('span');
    $.ajax({
        url: 'dashboard/ajax/parisabcd',
        type: 'get',
        success: function (data) {
            // chargement des paris long terme dans la div.
            $('#tab_15_3').html(data.vue);

            var table = $("#parisabcdtable");

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


            var oTable = $("#parisabcdtable").dataTable({

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

                // set the initial value
                "pageLength": 5,
                "dom": "<'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>" // horizobtal scrollable datatable
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            });


            var tableWrapper = $('#parisabcdtable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
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
            if (data.count_paris_abcd == 0) {
                onglet_span.text('');
            } else {
                onglet_span.html(data.count_paris_abcd);
            }

            $('#parisencourstable_paginate').bind('click', 'a', function () {
                //trigger le status de chaque pour le type simple
                table.find('select[name="status[]"]').each(function () {
                    $(this).val($(this).data('defaut-value'));
                }).select2({minimumResultsForSearch: Infinity});
            });

            calculMontantRetourne(table);
            parisEnCoursEnclose(table, 'm');
            parisEnCoursDelete(table, 'm');

        },
        error: function (data) {
            $('#tab_15_1').html('<p>impossible de récuperer les paris</p>');
        }
    });
}
