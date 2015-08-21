function Bookmakers() {

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

    this.loadBookmakers = function(page) {
        //si un numero n'est pas specifié, on affiche la premiere page.
        page = page || '1';
        $.ajax({
            url: url_pagination,
            data: {page: page},
            success: function (data) {
                $(paginationContainer).html(data);
                this.editBookmakerButton();
                this.deleteBookmakerButton();
            }
        });
    };

    this.paginationOnclick = function() {
        // when you click on pagination numbers
        $(paginationContainer).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var pg = getPaginationSelectedPage($(this).attr('href'));
            loadBookmakers(pg);
        });
    };

    this.BookmakerAdd = function() {
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
    };

    this.bookmakerUpdate = function() {
        var form = $('#bookmakerform-edit');
        var id_account = 'idAccountEditInput';
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
    };

    this.editBookmakerButton = function() {
        var form = $('#bookmakerform-edit');
        $('.bookmakerEditButton').click(function () {
            form.find("#idBookmakerEditInput").val($(this).attr('data-id-bookmaker'));
            form.find("#idAccountEditInput").val($(this).attr('data-id'));
            form.find(nameAccountInput).val($(this).attr('data-name'));
        });
    };

    this.deleteBookmakerButton = function() {
        $('.bookmakerDeleteButton').click(function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var id = parent.find(".idbookmakertd").text();
            console.log(id);
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
                                    swal("Attention!", "Vous devez d\'abord supprimer les tickets en cours liés à ce compte.", "error");
                                }
                            }
                        });
                    }
                });
        });
    };
    this.inits = function (){
        this.loadBookmakers();
        this.paginationOnclick();
        this.BookmakerAdd();
        this.bookmakerUpdate();
    }
}

var GestionBookmakers = new Bookmakers();
GestionBookmakers.inits();
