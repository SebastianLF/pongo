/*$('#newAccountButton').click(function () {
    $('#bankrollInvestedBookmakerContainer').show();
    $('#bonusBookmakerContainer').show();
    $('#bankrollAmountBookmakerContainer').hide();
    $('#typeAccountInput').val('new');
});

$('#oldAccountButton').click(function () {
    $('#bankrollInvestedBookmakerContainer').hide();
    $('#bonusBookmakerContainer').hide();
    $('#bankrollAmountBookmakerContainer').show();
    $('#typeAccountInput').val('old');
});*/


$('#addBookmakerButton').click(function(){
        // pour enlever le rouge sir il y a eu des erreurs lors d'une ouverture precedente de ce modal.
        $('#bookmakerListOnBookmakerContainer').removeClass('has-error');
        $('#accountNameBookmakerContainer').removeClass('has-error');
        $('#bankrollAmountBookmakerContainer').removeClass('has-error');
});

$('#bookmakerform-add').submit(function (e) {

    var ser = $(this).serialize();
    //var typeAccount = $(this).find('#typeAccountInput').val();
    e.preventDefault();
    $.ajax({
        url: 'bookmaker',
        data: ser ,
        type: 'post',
        dataType: 'json',
        success: function (json) {
            if (!json.success) {

                // debut de creation de la notification avec les erreurs.
                var errorstoastr = '<ul>';

                // on affiche le rouge quand ce n'est pas valide.
                if (json.errors.booknameselect) {
                    $('#bookmakerListOnBookmakerContainer').addClass('has-error');
                } else {
                    $('#bookmakerListOnBookmakerContainer').removeClass('has-error');
                }
                if (json.errors.accountnameinput) {
                    $('#accountNameBookmakerContainer').addClass('has-error');
                } else {
                    $('#accountNameBookmakerContainer').removeClass('has-error');
                }
                if (json.errors.bankrollamountinput) {
                    $('#bankrollAmountBookmakerContainer').addClass('has-error');
                } else {
                    $('#bankrollAmountBookmakerContainer').removeClass('has-error');
                }

                // boucle pour afficher les erreurs dans la notification.
                $.each(json.errors, function (key, value) {
                    errorstoastr += '<li>' + value + '</li>';
                });

                // fin.
                errorstoastr += '</ul>';

                // affiche la notification correspondate.
                toastr.error(errorstoastr, 'Compte bookmaker non ajouté');
            } else {

                // enleve le contour rouge.
                $('#bookmakerListOnBookmakerContainer').removeClass('has-error');
                $('#accountNameBookmakerContainer').removeClass('has-error');
                $('#bankrollInvestedBookmakerContainer').removeClass('has-error');
                $('#bonusBookmakerContainer').removeClass('has-error');
                $('#bankrollAmountBookmakerContainer').removeClass('has-error');

                // remet a zero les champs
                $('#accountnameinput').val('');
                $('#bankrollinvestedinput').val('');
                $('#bonusinput').val('');
                $('#bankrollamountinput').val('');

                // charge la liste des bookmakers
                loadBookmakers();

                //fermeture du modal.
                $('#bookmakerAddModal').modal('hide');

                // affiche la notification de succes.
                toastr.success('Compte ajouté', 'Compte Bookmaker');
            }

        },
        error: function (json) {
            console.log('fail:' + json);
        }
    });
});