/**
 * Created by sebs on 19/04/2015.
 */

// calcul pour l affichage du profit du ticket.
function calculMontantRetourne(table) {
    table.on('change', 'select[name="status[]"]', function () {
        var $this = $(this);
        var main_parent,montant_retourne_input,mise,montant_retourne;
        var selection_id = $(this).closest('tr').data('selection-id');

        //si combiné
        if ($this.closest('tr .details').length > 0) {
            var status = [];
            var cote_general = 1;
            var details_block = $this.closest('tr.details');
            main_parent = details_block.prev('tr');
            montant_retourne_input = main_parent.find('input[name="amount-returned"]');

            details_block.find('select[name="status[]"]').each(function () {
                var this_child_status = $(this);
                var cote = Number(this_child_status.closest('td').prev('td').text());
                console.log(cote);
                status.push($(this).val());
                cote_general *= calcul_nouvelle_cote_par_rapport_a_status(cote, $(this).val());
            });


            mise = main_parent.find('.tdsubmise').text();
            console.log('status='+status+' cote='+cote_general+' mise='+mise);
            if(status.indexOf('0') > -1 && status.indexOf('2') == -1){montant_retourne_input.val('')}
            else if(status.indexOf('0') > -1 && status.indexOf('2') > -1){montant_retourne_input.val(0)}
            else{
                montant_retourne = cote_general * mise;

                //animation affichage montant retourné.
                // how many decimal places allows
                var decimal_places = 2;
                var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);
                montant_retourne_input
                    .animateNumber(
                    {
                        number: montant_retourne * decimal_factor,

                        numberStep: function(now, tween) {
                            var floored_number = Math.floor(now) / decimal_factor,
                                target = $(tween.elem);

                            if (decimal_places > 0) {
                                // force decimal places even if they are 0
                                floored_number = floored_number.toFixed(decimal_places);

                                // replace '.' separator with ','
                                // floored_number = floored_number.toString().replace('.', ',');
                            }

                            target
                                .prop('number', now)
                                .val(parseFloat(floored_number));


                        }
                    },
                    'normal',
                    function() {
                        //ajax update montant retourne et status.
                        updateParisEnCours(status, main_parent.data('pari-id'), montant_retourne_input.val());
                    }
                );

            }

        //si simple
        }else{
            main_parent = $this.closest('tr');
            montant_retourne_input = main_parent.find('input[name="amount-returned"]');
            status = $this.val();

            var cote = main_parent.find('.tdcote').text();
            mise = main_parent.find('.tdsubmise').text();
            if(status == '0'){montant_retourne_input.val('')}
            else{var nouvelle_cote = calcul_nouvelle_cote_par_rapport_a_status(cote, status);
                montant_retourne = nouvelle_cote * mise;

                // how many decimal places allows
                var decimal_places = 2;
                var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);

                montant_retourne_input
                    .animateNumber(
                    {
                        number: montant_retourne * decimal_factor,

                        numberStep: function(now, tween) {
                            var floored_number = Math.floor(now) / decimal_factor,
                                target = $(tween.elem);

                            if (decimal_places > 0) {
                                // force decimal places even if they are 0
                                floored_number = floored_number.toFixed(decimal_places);

                                // replace '.' separator with ','
                                // floored_number = floored_number.toString().replace('.', ',');
                            }

                            target
                                .prop('number', now)
                                .val(parseFloat(floored_number));
                        }
                    },
                    'normal',
                    function() {
                        //ajax update montant retourne et status.
                        updateParisEnCours(status, main_parent.data('pari-id'), montant_retourne_input.val());
                    }
                );
            }

        }
    });
}

function calcul_nouvelle_cote_par_rapport_a_status(cote, status){
    var cote_apres_status = 1;
    if (status == 0) {
        no_selection = true
    } else if (status == 1) {
        cote_apres_status *= cote;
    } else if (status == 2) {
        cote_apres_status *= 0;
        perdu_selection = 1;
    } else if (status == 3) {
        cote_apres_status = cote_apres_status * [(cote - 1) / 2 + 1];
    } else if (status == 4) {
        cote_apres_status = cote_apres_status * 0.5;
    } else if (status == 5) {
        cote_apres_status += 0;
    }
    return cote_apres_status;
}


function updateParisEnCours(status, pari_id, montant_retour){
    $.ajax({
        method: "PUT",
        url: "encourspari/"+pari_id,
        data: { status: status, montant_retour: montant_retour },
        dataType: "json",
        success : function (){
            toastr.success('le status de la selection à ete mis à jour', 'Pari');
        },
        error : function (){
            toastr.error('Un problème est survenue, veuillez nous contacter pour résoudre le problème', 'Erreur');
        },
        complete : function (){
            montant_retourne_input.removeClass('spinner');
        }
    });
}