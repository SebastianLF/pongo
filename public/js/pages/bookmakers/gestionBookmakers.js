
function loadBookmakers() {
    //si un numero n'est pas specifié, on affiche la premiere page.
    $.ajax({
        url: 'bettor/my-bookmakers-view-list',
        success: function (data) {
            $('#bookmakers-pagination').html(data);
            $('#bookmakerstable').dataTable({
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
                // set the initial value
                "pageLength": 10,
                "dom": "<'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>", // horizobtal scrollable datatable
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            });
            editBookmakerButton();
            deleteBookmakerButton();
        }
    });
}

function editBookmakerButton() {
    $('#bookmakerEditModal').on('show.bs.modal', function (e) {
        var invoker = $(e.relatedTarget);
        var form = $('#bookmakerform-edit');
        form.find("#idBookmakerEditInput").val(invoker.data('id-bookmaker'));
        form.find("#idAccountEditInput").val(invoker.data('id'));
        form.find("input[name='name_account']").val(invoker.data('name'));
    });
}

function deleteBookmakerButton() {
    $('#bookmakerstable').on('click', '.bookmakerDeleteButton', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
                title: "Supprimer",
                text: "Etes vous sur ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, supprimer",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: 'bookmaker/' + id,
                        method: "DELETE",
                        dataType: 'json',
                        success: function (json) {
                            if (json.state) {
                                toastr.success('Le compte ' + json.compte.nom_compte + ' à été supprimé avec succès!', 'Compte de bookmaker');
                                loadBookmakers();
                            } else {
                                swal("Attention!", "Vous devez d\'abord supprimer les paris en cours liés à ce compte.", "error");
                            }
                        }
                    });
                }
            });
    });
}

function gestionBookmakers() {

    var nameBookmakerSelect = "select[name='name_bookmaker']";
    var nameBookmakerContainer = "#bookmaker_container";
    var nameBookmakerError = "#bookmaker_error";
    var nameAccountInput = "input[name='name_account']";
    var nameAccountContainer = "#account_container";
    var nameAccountError = "#account_error";
    var amountInput = "input[name='amount_bookmaker']";
    var amountContainer = "#amount_container";
    var amountError = "#amount_error";

    var idEdit = "input[name='id']";
    var idDelete = ".idtipstertd";

    var paginationContainer = '#bookmakers-pagination';
    var url_pagination = 'pagination/ajax/bookmakers';



    function paginationOnclick() {
        // when you click on pagination numbers
        $(paginationContainer).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var pg = getPaginationSelectedPage($(this).attr('href'));
            loadBookmakers(pg);
        });
    }

    function BookmakerAdd() {
        var form = $('#bookmakerform-add');
        $('#bookmakerAddModal').on('hide.bs.modal', function () {
            // remise a zero des champs erreurs
            form.find(nameBookmakerContainer).removeClass('has-error');
            form.find(nameAccountContainer).removeClass('has-error');
            form.find(amountContainer).removeClass('has-error');

            form.find(nameBookmakerError).empty();
            form.find(nameAccountError).empty();
            form.find(amountError).empty();

            // remise a zero des champs input
            form.find(nameBookmakerSelect).val('');
            form.find(nameAccountInput).val('');
            form.find(amountInput).val('');
        });

        form.submit(function (e) {
            var ser = $(this).serialize();
            e.preventDefault();
            $.ajax({
                url: 'bookmaker',
                data: ser,
                type: 'post',
                dataType: 'json',
                success: function (json) {
                    if (!json.state) {
                        // on affiche le rouge quand ce n'est pas valide.
                        if (json.errors.name_bookmaker) {
                            form.find(nameBookmakerContainer).addClass('has-error');
                            form.find(nameBookmakerError).html(json.errors.name_bookmaker);
                        } else {
                            form.find(nameBookmakerContainer).removeClass('has-error');
                            form.find(nameBookmakerError).empty();
                        }
                        if (json.errors.name_account) {
                            form.find(nameAccountContainer).addClass('has-error');
                            form.find(nameAccountError).html(json.errors.name_account);
                        } else {
                            form.find(nameAccountContainer).removeClass('has-error');
                            form.find(nameAccountError).empty();
                        }
                        if (json.errors.amount_bookmaker) {
                            form.find(amountContainer).addClass('has-error');
                            form.find(amountError).html(json.errors.amount_bookmaker);
                        } else {
                            form.find(amountContainer).removeClass('has-error');
                            form.find(amountError).empty();
                        }

                    } else {

                        // charge la liste des bookmakers
                        loadBookmakers();

                        //fermeture du modal.
                        $('#bookmakerAddModal').modal('hide');

                        // affiche la notification de succes.
                        toastr.success('Compte ajouté', 'Compte de Bookmaker');
                    }
                }
            });
        });
    }

    function bookmakerUpdate() {
        var form = $('#bookmakerform-edit');
        var id_account = 'idAccountEditInput';

        $('#bookmakerEditModal').on('hide.bs.modal', function () {
            // remise a zero des champs erreurs
            form.find('#account_container').removeClass('has-error');
            form.find('#account_error').removeClass('has-error');
            form.find('#account_error').empty();
        });

        form.submit(function (e) {
            e.preventDefault();
            var id = $(this).find("#idAccountEditInput").val();
            $.ajax({
                url: 'bookmaker/' + id,
                method: 'PUT',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (json) {
                    if (!json.state) {
                        if (json.errors.name_account) {
                            form.find(nameAccountContainer).addClass('has-error');
                            form.find(nameAccountError).html(json.errors.name_account);
                        } else {
                            form.find(nameAccountContainer).removeClass('has-error');
                            form.find(nameAccountError).empty();
                        }
                    } else {
                        loadBookmakers();
                        toastr.success('Compte mis à jour avec <strong>succes</strong> !', 'Compte de Bookmaker');
                        $('#bookmakerEditModal').modal('hide');

                    }
                }
            });
        });
    }

    loadBookmakers();
    BookmakerAdd();
    bookmakerUpdate();
}

gestionBookmakers();
