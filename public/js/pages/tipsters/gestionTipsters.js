
function gestionTipsters(){

    var nameInput = "input[name='name_tipster']";
    var nameContainer = "#name_container";
    var nameError = "#name_error";
    var suiviSelect = "select[name='suivi_tipster']";
    var suiviContainer = "#suivi_container";
    var suiviError = "#suivi_error";
    var amountInput = "input[name='amount_tipster']";
    var amountContainer =  "#amount_container";
    var amountError =  "#amount_error";

    var EditModal = $('#tipsterEditModal');
    var EditForm = $('#tipsterform-edit');

    var idEdit = "input[name='id']";
    var idDelete = ".idtipstertd";

    var paginationContainer = '#tipsters-pagination';
    //var url_pagination = 'pagination/ajax/tipsters';

    function loadTipsters(){
        $.ajax({
            url: 'bettor/my-tipsters-view-list',
            type: 'get',
            success: function (data) {

                $(paginationContainer).html(data);
                $('#tipsterstable').dataTable({


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
                        [10, 15, 20, 100],
                        [10, 15, 20, 100] // change per page values here
                    ],

                    "ordering": false,

                    // set the initial value
                    "pageLength": 10,
                    "dom": "<'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>", // horizobtal scrollable datatable
                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                    // So when dropdowns used the scrollable div should be removed.
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                });
                tipsterEdit();
                tipsterDelete();
            }
        });
    }

    function paginationOnclickTipsters(){
        // when you click on pagination numbers
        $(paginationContainer).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var pg = getPaginationSelectedPage($(this).attr('href'));
            loadTipsters(pg);
        });
    }

    function tipsterAdd() {
        var form = $('#tipsterform-add');
        form.submit(function (e) {
            e.preventDefault();
            var name = form.find('#name_tipster');
            var mt = form.find('#amount_tipster');
            var followtype = form.find('#suivi_tipster');

            var name_error = form.find('#nameinputerror');
            var mt_error = form.find('#unitnumberinputerror');
            var followtype_error = form.find('#followtypeselecterror');

            $('#tipsterAddModal').on('hide.bs.modal', function () {
                // remise a zero des champs erreurs
                form.find('#name_container').removeClass('has-error');
                form.find('#amount_container').removeClass('has-error');
                form.find('#suivi_container').removeClass('has-error');

                form.find('#name_error').empty();
                form.find('#amount_error').empty();
                form.find('#suivi_error').empty();

                // remise a zero des champs input
                form.find(nameInput).val('');
                form.find(amountInput).val('');
                form.find(suiviSelect).find('option[value="n"]').attr("selected", true);
            });

            $.ajax({
                url: 'tipster',
                data: $('#tipsterform-add').serialize(),
                type: 'POST',
                dataType: 'json',
                success: function (json) {
                    // Si il ya des erreurs.
                    if (json.success == false) {

                        if (json.errors.name_tipster) {
                            form.find('#name_container').addClass('has-error');
                            form.find('#name_error').html(json.errors.name_tipster);
                        } else {
                            form.find('#name_container').removeClass('has-error');
                            form.find('#name_error').empty();
                        }
                        if (json.errors.amount_tipster) {
                            form.find('#amount_container').addClass('has-error');
                            form.find('#amount_error').html(json.errors.amount_tipster);
                        } else {
                            form.find('#amount_container').removeClass('has-error');
                            form.find('#amount_error').empty();
                        }
                        if (json.errors.suivi_tipster) {
                            form.find('#suivi_container').addClass('has-error');
                            form.find('#suivi_error').html(json.errors.suivi_tipster);
                        } else {
                            form.find('#suivi_container').removeClass('has-error');
                            form.find('#suivi_error').empty();
                        }
                    }
                    // si les champs entrés sont valides
                    else {

                        // quand le nouveau tipster est ajouté, on recharge les tipsters. Le nouveau tipster sera donc affiché.
                        loadTipsters();

                        toastr.success('Le tipster à été crée avec <strong>succès</strong>!', 'Tipster');
                        $('#tipsterAddModal').modal('hide');
                    }
                }
            });
        });
    }

    function tipsterEdit(){
        EditModal.on('show.bs.modal', function (e) {
            var invoker = $(e.relatedTarget);
            console.log(invoker.data('id'));
            var form = EditForm;
            form.find(idEdit).val(invoker.data('id'));
            form.find(nameInput).val(invoker.data('name'));
            form.find(amountInput).val(invoker.data('mt'));
            form.find(suiviSelect+' option[value="'+invoker.data('suivi')+'"]').prop('selected',true);
        });
    }


    function tipsterUpdate() {

        // mise en variable du formulaire
        var form = EditForm;

        form.submit(function (e) {
            e.preventDefault();
            var id = $(this).find(idEdit).val();
            var data = $(this).serialize();

            $('#tipsterEditModal').on('hide.bs.modal', function () {
                // remise a zero des champs erreurs
                form.find(nameContainer).removeClass('has-error');
                form.find(amountContainer).removeClass('has-error');
                form.find(suiviContainer).removeClass('has-error');

                form.find(nameError).empty();
                form.find(suiviError).empty();
                form.find(amountError).empty();

                // remise a zero des champs input
                form.find(nameInput).val('');
                form.find(amountInput).val('');
                form.find(suiviSelect).find('option[value="n"]').attr("selected", true);
            });

            $.ajax({
                url: 'tipster/'+id,
                method: 'PUT',
                data: data,
                dataType: 'json',
                success: function (json) {
                    if (json.state) {
                        loadTipsters();
                        toastr.success('Le tipster à été modifié avec <strong>succès</strong>!', 'Tipster');
                        $('#tipsterEditModal').modal('hide');

                    } else {
                        if (json.errors.name_tipster) {
                            form.find(nameContainer).addClass('has-error');
                            form.find(nameError).html(json.errors.name_tipster);
                        } else {
                            form.find(nameContainer).removeClass('has-error');
                            form.find(nameError).empty();
                        }
                        if (json.errors.amount_tipster) {
                            form.find(amountContainer).addClass('has-error');
                            form.find(amountError).html(json.errors.amount_tipster);
                        } else {
                            form.find(amountContainer).removeClass('has-error');
                            form.find(amountError).empty();
                        }
                        if (json.errors.suivi_tipster) {
                            form.find(suiviContainer).addClass('has-error');
                            form.find(suiviError).html(json.errors.suivi_tipster);
                        } else {
                            form.find(suiviContainer).removeClass('has-error');
                            form.find(suiviError).empty();
                        }
                    }
                }
            });
        });

    }


    function tipsterDelete() {
        $('#tipsterstable').on('click', '.tipsterDeleteButton', function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var url1 = $(this).data('id');
            var url = 'tipster/' + url1;
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
                            url: url,
                            method: "DELETE",
                            dataType: 'json',
                            success: function (data) {
                                if (data.state == 1) {
                                    toastr.success('supprimé avec <strong>succès</strong> !', 'Tipster');
                                    loadTipsters();
                                } else if(data.state == 2) {
                                    swal("Attention!", "Vous devez d\'abord supprimer les tickets en cours liés à ce tipster.", "error");
                                } else if(data.state == 0) {
                                    swal("Attention!", "Ce tipster n\'existe pas", "error");

                                }
                            }
                        });


                    }
                });
        });
    }

    //inits
    loadTipsters();
    tipsterAdd();
    tipsterUpdate();
    //paginationOnclickTipsters();
}

gestionTipsters();