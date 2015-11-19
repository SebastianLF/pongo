function loadParisTermine() {
    $.ajax({
        url: 'dashboard/ajax/paristermine',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            // chargement des paris long terme dans la div.
            $('#tab_15_4').html(data.vue);

            var table = $("#paristerminetable");

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


            var oTable = $("#paristerminetable").dataTable({

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


            var tableWrapper = $('#paristerminetable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
            tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

            table.on('click', ' tbody td .row-details', function () {

                var $this = $(this);
                var nTr = $(this).parents('tr')[0];


                var type = $(this).parents('tr').data('pari-type');
                var selections = $(this).parents('tr').data('selections');
                if (oTable.fnIsOpen(nTr)) {

                    /* This row is already open - close it */
                    $(this).removeClass("glyphicon-triangle-top").addClass("glyphicon-triangle-bottom");
                    oTable.fnClose(nTr);

                } else {

                    // structure de l'ouverture.
                    $this.removeClass("glyphicon-triangle-bottom").addClass("glyphicon-triangle-top");
                    oTable.fnOpen(nTr, fnFormatDetailsForChildsParisTermine(oTable, selections, type), 'details');

                }
            });

            parisTermineDelete();

        },
        error: function (data) {
            $('#tab_15_4').html('<p>impossible de récuperer les paris terminés</p>');
        }
    });
}
