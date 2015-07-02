function tipsterAdd() {
    $('#addtipsterloader').css("display", "none");
    $('#tipsterform-add').submit(function (e) {
        e.preventDefault();
        var name = $('#name_tipster');
        var indice = $('#indice_tipster');
        var mt = $('#amount_tipster');
        var followtype = $('#suivi_tipster');

        var name_error = $('#nameinputerror');
        var indice_error = $('#staketypeselecterror');
        var mt_error = $('#unitnumberinputerror');
        var followtype_error = $('#followtypeselecterror');

        $.ajax({
            url: 'tipster',
            data: $('#tipsterform-add').serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                // Si il ya des erreurs.
                if (json.success == false) {
                    var errorstoastr = '<ul>';
                    if (json.errors.name_tipster) {
                        $('#name_tipster_container').addClass('has-error');
                    } else {
                        $('#name_tipster_container').removeClass('has-error');
                    }
                    if (json.errors.amount_tipster) {
                        $('#amount_tipster_container').addClass('has-error');
                    } else {
                        $('#amount_tipster_container').removeClass('has-error');
                    }
                    if (json.errors.suivi_tipster) {
                        $('#suivi_tipster_container').addClass('has-error');
                    } else {
                        $('#suivi_tipster_container').removeClass('has-error');
                    }
                    $.each(json.errors, function (key, value) {
                        errorstoastr += '<li>' + value + '</li>';
                    });
                    errorstoastr += '</ul>';
                    // affiche la notification correspondate.
                    toastr.error(errorstoastr, 'Erreur: Ajout de tipster');

                }
                // si les champs entrés sont valides
                else {

                    // quand le nouveau tipster est ajouté, on recharge les tipsters. Le nouveau tipster sera donc affiché.
                    loadTipsters();

                    // remise a zero des champs erreurs
                    $('#name_tipster_container').removeClass('has-error');
                    $('#indice_tipster_container').removeClass('has-error');
                    $('#amount_tipster_container').removeClass('has-error');
                    $('#suivi_tipster_container').removeClass('has-error');

                    // remise a zero des champs input
                    name.val('');
                    indice.find('option[value="10"]').attr("selected", true);
                    mt.val('');
                    followtype.find('option[value="n"]').attr("selected", true);

                    // afficher la notification de succes
                    toastr.success('tipster ajouté !', 'Tipster');

                    //fermer le modal
                    $('#tipsterAddModal').modal('hide');
                }
            },
            error: function () {
                console.log('fail! le tipster n\'a pas pu etre ajouté');
            },
            complete: function () {
            }
        });
    });
}





