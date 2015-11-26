/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursEnclose(tablename, type) {
    var table = tablename;
    var bouton_valider = table.find('.boutonvalider');

// click sur le bouton valider du paris en cours , qui va le transferer vers historique(termineParis)
    table.on('click', '.boutonvalider', function (e) {
        e.preventDefault();
        var l = Ladda.create(this);
        var tr_main = $(this).closest('tr');
        var tr_childs = tr_main.next('tr.details');
        var type_profil = $(this).data('pari-type');
        var amount_returned = tr_main.find('input[name="amount-returned"]').val();

        var status = [];

        if (type_profil == 's') {
            status.push(tr_main.find('select[name="status[]"]').val());
        } else if(type_profil == 'c'){
            tr_childs.find('select[name="status[]"]').each(function () {
                status.push($(this).val())
            });
        }

        //si les status ont tous Ã©tÃ© bien renseignÃ© ou alors si il y a au moins un pari perdu alors on peut finaliser le pari.
        if ((status.indexOf('0') != -1 && status.indexOf('2') == -1)) {
            if (type_profil == 's') {
                swal("Erreur", "Vous devez selectionnez un status !")
            }
            if (type_profil == 'c') {
                swal("Erreur", "Vous êtes obligé de selectionner le status pour chaque pari du combiné. Si vous souhaitez valider le combiné plus rapidement il faut qu'au moins un des paris ait le status 'perdu', les status des autres paris n'ont alors pas besoin d'être renseignés.");
            }
        } else {
            l.start();
            $.ajax({
                url: 'pari/'+$(this).data('id'),
                type: 'PUT',
                data: 'amount-returned='+amount_returned,
                dataType: 'json',
                success: function (data) {
                    if (data.etat == 0) {
                        var errorString = '';
                        $.each( data.msg, function( key, value) {
                            errorString += value + '</br>';
                        });
                        toastr.error(errorString, 'Erreur:');
                    } else {
                        toastr.success(data.msg, 'Validation');
                        if(type == 'lt'){loadParisLongTerme();}else if(type == 'm'){loadParisABCD();}else if(type == 'c'){loadParisEnCours();}
                        loadNeededWhenAddToHistory();
                    }
                },
                complete: function () {
                    l.stop();
                }
            });
        }
    });
}
