$(function () {
    $('#depotAddButton').click(function () {
        $('#typetransinput').val('depot');
        $('#amountTransactionContainer').removeClass('has-error');
        $('#booknameTransContainer').removeClass('has-error');
        $('#accountnameTransContainer').removeClass('has-error');
        $('#describeTransContainer').removeClass('has-error');
    });
    $('#retraitAddButton').click(function () {
        $('#typetransinput').val('retrait');
        $('#amountTransactionContainer').removeClass('has-error');
        $('#booknameTransContainer').removeClass('has-error');
        $('#accountnameTransContainer').removeClass('has-error');
        $('#describeTransContainer').removeClass('has-error')
    });
    $('#bonusAddButton').click(function () {
        $('#typetransinput').val('bonus');
        $('#amountTransactionContainer').removeClass('has-error');
        $('#booknameTransContainer').removeClass('has-error');
        $('#accountnameTransContainer').removeClass('has-error');
        $('#describeTransContainer').removeClass('has-error')
    });

    var transactionAddModal = $('#transactionAddModal');
    $('#transactionform-add').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'transaction',
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {

                if (!json.success) {
                    // debut de creation de la notification avec les erreurs.
                    var errorstoastr = '<ul>';

                    // on affiche le rouge quand ce n'est pas valide.
                    if (json.errors.amounttransinput) {
                        $('#amountTransactionContainer').addClass('has-error');
                    } else {
                        $('#amountTransactionContainer').removeClass('has-error');
                    }
                    // if (json.errors.typetransselect) {$('#typeTransContainer').addClass('has-error');}else {$('#typeTransContainer').removeClass('has-error');}
                    if (json.errors.booknametransselect) {
                        $('#booknameTransContainer').addClass('has-error');
                    } else {
                        $('#booknameTransContainer').removeClass('has-error');
                    }
                    if (json.errors.accountnametransselect) {
                        $('#accountnameTransContainer').addClass('has-error');
                    } else {
                        $('#accountnameTransContainer').removeClass('has-error');
                    }
                    if (json.errors.describetranstext) {
                        $('#describeTransContainer').addClass('has-error');
                    } else {
                        $('#describeTransContainer').removeClass('has-error');
                    }

                    // erreur si le retrait est superieur au montant actuelle du compte.
                    if (json.errors.retraitNonDispo) {
                    }

                    // boucle pour afficher les erreurs dans la notification.
                    $.each(json.errors, function (key, value) {
                        errorstoastr += '<li>' + value + '</li>';
                    });

                    // fin.
                    errorstoastr += '</ul>';

                    // affiche la notification correspondate.
                    toastr.error(errorstoastr, 'Transaction non ajouté');
                } else {

                    // on refresh les transactions et les bookmakers.
                    loadTransactions();
                    loadBookmakers();
                    toastr.success('transaction crée avec succès', 'Transaction');
                }
            }
        });

    });

});