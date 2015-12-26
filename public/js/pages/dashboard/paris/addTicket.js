/**
 * Created by sebs on 21/08/2015.
 */



function startDecompteRefresh() {
    var counter = 10;
    var intervalId = null;

    function start() {
        counter = 10;
        intervalId = setInterval(bip, 1000);
        setTimeout(action, 11000);
    }

    function action() {
        $('#automatic-refresh').html("Rafraichissement auto !!");
        clearInterval(intervalId);
        refreshSelections();
        start();
    }

    function bip() {
        $('#automatic-refresh').html("Rafraichissement auto dans " + counter + " secondes");
        counter--;
    }

    start();
}


// fonction de rafraichissement.
function refreshSelections() {
    var form = $('#automaticform-add');
    var cote_generale_combine = 1;
    $.ajax({
        url: 'selections',
        success: function (data) {
            form.find('#automatic-selections').html(decodeURIComponent(data.vue));
            supprimerSelection();
            misAjourCompteBookmaker();
            //openOrCloseSelectionsCouponAccordeonWhenSelectionsCouponIsRefreshed(data.count);

            // calcul de la cote générale du combiné et attribution dans le input.
            if (data.count > 1) {
                form.find('#automatic-selections').find('input[name="automatic-selection-cote[]"]').each(function () {
                    cote_generale_combine *= $(this).val();
                });
                form.find('#automatic-selections table tbody').append('<tr><td></td><td>Cote combiné</td><td><input class=" form-control input-coupon-odd" name="total-cote-combine" type="text" value="' + (Math.round(cote_generale_combine * 100) / 100) + '"></td><td></td></tr>');
            }
        },
        error: function (data) {
            form.find('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
        }
    });
}

function refreshSelectionsClick() {
    $('#refresh-panier-selection-on-click').on('click', function (e) {
        e.preventDefault();
        refreshSelections();
    });
}

function openOrCloseSelectionsCouponAccordeonWhenSelectionsCouponIsRefreshed(count) {
    if (count > 0) {
        $('#panier-selections-add-ticket').collapse('show');
    } else {
        if (!$('#panier-selections-add-ticket').hasClass('in')) {
            $('#panier-selections-add-ticket').collapse('hide');
        }

    }

}

// supprime la selection.
function supprimerSelection() {
    var form = $('#automaticform-add');
    form.find('#automatic-selections .boutonsupprimer').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find(".selection_id").text();
        $.ajax({
            url: 'coupon/' + id,
            method: 'delete',
            success: function (data) {
                refreshSelections();
            }
        });
    });
}

// recherche des compte bookmaker lié au bookmaker du premier selection coupon,
// puis introduits dans le champ de choix des comptes bookmaker du formulaire 'informations genérales'.
function misAjourCompteBookmaker() {
    $.ajax({
        url: 'bettor/update-bookmaker-account-on-form',
        success: function (data) {
            $('#automaticform-add').find('#accountsinputdashboard').html('');
            if (data.length > 0) {
                $('#automaticform-add').find('#accountsinputdashboard').select2({
                    data: data,
                    minimumResultsForSearch: Infinity
                }).val(data[0]['id']).trigger('change');
            } else {
                $('#automaticform-add').find('#accountsinputdashboard').select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: 'Choisir un compte de bookmaker'
                }).val('').trigger('change').html('');
            }
        }
    })
}

function gestionTicket() {
    var form = $('#automaticform-add');
    var form_string = '#automaticform-add';
    var tipster = form.find('#tipstersinputdashboard');
    var cote_tipster = form.find('#cote-tipster');
    var cote_tipster_container = form.find('#cote-tipster-container');
    var followtype = form.find('#followtypeinputdashboard');
    var amount_per_unit = form.find('#amountperunit');
    var typestake = form.find('#typestakeinputdashboard');
    var unit_stake_container = form.find('.typestakeunites');
    var unit_stake = form.find('#stakeunitinputdashboard');
    var conversion_to_devise = form.find('#amountconversion');
    var devise_stake_container = form.find('.typestakeflat');
    var devise_stake = form.find('#amountinputdashboard');
    var bookmaker_account = form.find('#accountsinputdashboard');
    var containerABCD = form.find('#methodeabcdcontainer');
    var serieABCD = form.find('#serieinputdashboard');
    var letterABCD = form.find('#letterinputdashboard');
    var abcd_checkbox = form.find("#ticketABCD");
    var gratuit_checkbox = form.find("#ticketGratuit");
    var longterme_checkbox = form.find("#ticketLongTerme");

    var options_container = form.find('#optionscontainer');
    var bookmaker_container = form.find('#bookmakercontainer');
    var bookmaker_account_container = form.find('#bookmaker_account_container');
    var typestake_container = form.find('#typestakecontainer');

    var submit_container = form.find('#submitboutoncontainer');

    var montant_par_unite_info_span = $('#montant-par-unite-span');
    var montant_par_unite_info_value = $('#montant-par-unite-value');


    function assignerEtatEnDebut() {
        cote_tipster_container.addClass('hidden');
        cote_tipster.val('');
        montant_par_unite_info_value.text(parseFloat(user.mon_mt_par_unite));
        followtype.val(null).trigger('change');
        amount_per_unit.val(user.mon_mt_par_unite);
        typestake.val('f').trigger("change");
        conversion_to_devise.val(0).prop('disabled', true);
        devise_stake.val(0).prop('disabled', true);
        unit_stake.val(0);
        bookmaker_account.val(null).trigger("change").html('');
        containerABCD.addClass("hide");
        serieABCD.val(null).trigger("change").prop('disabled', true);
        letterABCD.val(null).trigger("change").prop('disabled', true);
        resetCheckboxs();
        abcd_checkbox.on('click', function () {
            if ($(this).is(':checked')) {
                containerABCD.removeClass("hide");
                serieABCD.val(null).trigger("change").prop('disabled', false);
                letterABCD.val(null).trigger("change").prop('disabled', false);
            }
            else {
                containerABCD.addClass("hide");
                serieABCD.val(null).trigger("change").prop('disabled', true);
                letterABCD.val(null).trigger("change").prop('disabled', true);
            }
        });
    }

    function ajouterTicket() {
        var submit_button = form.find('button[type="submit"]');
        submit_button.click(function (e) {
            e.preventDefault();

            // button animation
            var l = Ladda.create(this);

            var data = form.serialize();
            var linesnum = form.find('.betline').length;
            if (linesnum == '') {
                swal({
                    title: "Erreur!",
                    text: "Ajoutez au moins une selection pour pouvoir valider le pari!",
                    type: "warning",
                    confirmButtonText: "OK"
                });
            } else if (linesnum >= 1) {
                //serialize doesnt retrieve .text() of an input
                var ticketABCD, ticketLongTerme;
                if (abcd_checkbox.is(":checked")) {
                    ticketABCD = 1;
                } else {
                    ticketABCD = 0;
                }
                if (longterme_checkbox.is(":checked")) {
                    ticketLongTerme = 1;
                } else {
                    ticketLongTerme = 0;
                }

                var optionlt = [];
                $('#automaticform-add').find('input[name="optionlt[]"]').each(function () {
                    if ($(this).is(":checked")) {
                        optionlt.push(1);
                    } else {
                        optionlt.push(0);
                    }
                });

                l.start();
                $.ajax({
                    url: 'pari',
                    type: 'post',
                    data: data + '&linesnum=' + linesnum + '&ticketABCD=' + ticketABCD + '&ticketLongTerme=' + ticketLongTerme,
                    dataType: 'json',
                    success: function (json) {
                        var keyname;
                        if (json.etat == 0) {
                            if ($.isArray(json.msg)) {
                                for (key in json.msg) {
                                    keyname = key;
                                    toastr.error(json.msg[keyname], 'Erreur:');
                                }
                            } else {
                                toastr.error(json.msg, 'Erreur:');
                            }
                        } else if (json.etat == 1) {
                            bookmaker_account.val(null).trigger("change").html('').prop('disabled', true);
                            containerABCD.addClass("hide");
                            serieABCD.val(null).trigger("change").prop('disabled', true);
                            letterABCD.val(null).trigger("change").prop('disabled', true);
                            resetCheckboxs();
                            unit_stake.val(0);
                            devise_stake.val(0);
                            cote_tipster.val('');
                            refreshSelections();
                            loadNeededWhenAddToCurrentBets();
                            toastr.success(json.msg, 'Pari');
                        }
                    },
                    error: function (json) {
                        console.log('erreur ajout de pari');
                    },
                    complete: function () {
                        l.stop();
                    }
                });
            }
        });
    }

    function resetGeneralForm() {
        followtype.val(null).trigger('change');
        amount_per_unit.val(null);
        typestake.val('u').trigger("change");
        conversion_to_devise.val(0).prop('disabled', true);
        devise_stake.val(0).prop('disabled', true);
        unit_stake.val(0);
        bookmaker_account.val(null).trigger("change").html('');
        containerABCD.addClass("hide");
        serieABCD.val(null).trigger("change").prop('disabled', true);
        letterABCD.val(null).trigger("change").prop('disabled', true);
        options_container.addClass('hidden');
        bookmaker_container.addClass('hidden');
        typestake_container.addClass('hidden');
        submit_container.fadeOut();
        resetCheckboxs();
    }

    function resetCheckboxs() {
        abcd_checkbox.prop('checked', false);
        abcd_checkbox.parents('span').removeClass("checked");
        longterme_checkbox.prop('checked', false);
        longterme_checkbox.parents('span').removeClass("checked");
    }


    function gestionTipsters() {
        tipster.select2({
            allowClear: true,
            placeholder: "Choisir un tipster",
            cache: true,
            ajax: {
                url: 'ajax/tipsters',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term // search ter+m
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                }
            }
        }).on('change', function () {

            // informations du tipster.
            var tipster_infos = tipster.select2('data');
            var mt = '';
            // remise à zero
            conversion_to_devise.val(0);
            devise_stake.val(0);
            unit_stake.val(0);

            if (tipster.val() == '') {
                followtype.val('n').trigger('change');
                cote_tipster.val('');
                cote_tipster_container.addClass('hidden');

                //affichage des infos (montant par unité) du tipster dans le span.
                // how many decimal places allows
                var decimal_places = 2;
                var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);

                montant_par_unite_info_value
                    .animateNumber(
                    {
                        number: user.mon_mt_par_unite * decimal_factor,

                        numberStep: function (now, tween) {
                            var floored_number = Math.floor(now) / decimal_factor,
                                target = $(tween.elem);

                            if (decimal_places > 0) {
                                // force decimal places even if they are 0
                                floored_number = floored_number.toFixed(decimal_places);

                                // replace '.' separator with ','
                                // floored_number = floored_number.toString().replace('.', ',');
                            }

                            target.text(parseFloat(floored_number));
                        }
                    }
                );
                montant_par_unite_info_span.fadeIn();

                mt = Number(user.mon_mt_par_unite);
                isNaN(mt) ? amount_per_unit.val('') : amount_per_unit.val(mt);

            } else {

                cote_tipster.val('');
                cote_tipster_container.fadeIn().removeClass('hidden');

                //affichage des infos (montant par unité) du tipster dans le span.
                // how many decimal places allows
                var decimal_places = 2;
                var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);

                montant_par_unite_info_value
                    .animateNumber(
                    {
                        number: tipster_infos[0]['montant_par_unite'] * decimal_factor,

                        numberStep: function (now, tween) {
                            var floored_number = Math.floor(now) / decimal_factor,
                                target = $(tween.elem);

                            if (decimal_places > 0) {
                                // force decimal places even if they are 0
                                floored_number = floored_number.toFixed(decimal_places);

                                // replace '.' separator with ','
                                // floored_number = floored_number.toString().replace('.', ',');
                            }

                            target.text(parseFloat(floored_number));
                        }
                    }
                );
                montant_par_unite_info_span.fadeIn();

                if (tipster_infos[0]['followtype'] == 'n') {
                    followtype.val('n').trigger('change');
                }
                else if (tipster_infos[0]['followtype'] == 'b') {
                    followtype.val('b').trigger('change');
                }

                mt = Number(tipster_infos[0]['montant_par_unite']);
                isNaN(mt) ? amount_per_unit.val('') : amount_per_unit.val(mt);
            }
        });
    }

    function gestionFollowtype() {
        followtype.on('change', function () {

            if (followtype.val() == 'n') {
                bookmaker_account_container.prop('disabled', false);
                bookmaker_account_container.fadeIn().removeClass('hidden');
                misAjourCompteBookmaker();
            } else {
                bookmaker_account_container.prop('disabled', true);
                bookmaker_account_container.fadeOut().addClass('hidden');
            }

        }).select2({
            cache: true,
            minimumResultsForSearch: Infinity,
            data: [{id: "n", text: "normal"}, {id: "b", text: "à blanc"}]
        });
    }


    function typestakechoice() {
        var types = [{id: 'u', text: 'en unités'}, {id: 'f', text: 'libre (devise)'}];
        typestake.select2({
            minimumResultsForSearch: Infinity,
            cache: true,
            data: types
        });
        devise_stake_container.hide();
        typestake.on('change', function () {
            if (typestake.val() == 'f') {
                unit_stake.val(0).prop('disabled', true);
                conversion_to_devise.val(0);
                devise_stake.val(0).prop('disabled', false);
                unit_stake_container.hide();
                devise_stake_container.show();
            }
            else {
                devise_stake.val(0).prop('disabled', true);
                unit_stake.val(0).prop('disabled', false);
                conversion_to_devise.val(0);
                unit_stake_container.show();
                devise_stake_container.hide();
            }
        });
    }

    function gestionBookmakerAccount() {
        bookmaker_account.select2({
            allowClear: true,
            placeholder: "Choisir un compte",
            cache: true,
            minimumResultsForSearch: Infinity,
            ajax: {
                url: 'accounts',
                dataType: 'json',
                data: function (params) {
                    return {book_id: $(form_string + ' .bookinputdashboard').val(), q: params.term};
                },
                processResults: function (data) {
                    return {results: data};
                }
            }
        });
    }

    function gestionABCD() {
        // chargements des paris abcd dans le select input.
        serieABCD.select2({
            allowClear: true,
            placeholder: "Choisir une serie",
            tags: true,
            cache: true,
            ajax: {
                url: 'parisabcd',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    /* var newData = [];
                     $.each(data, function (index,value) {
                     newData.push({
                     id:value.id,  //id part present in data
                     text: value.text  //string to be displayed
                     });
                     });*/
                    return {
                        results: data
                    };
                }
            }
        });

        letterABCD.select2({
            allowClear: true,
            placeholder: "Choisir une lettre",
            cache: true,
            minimumResultsForSearch: Infinity,
            ajax: {
                url: 'lettreabcd',
                dataType: 'json',
                data: function (params) {
                    return {
                        serie_nom: serieABCD.val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    var newData = [];
                    $.each(data, function (index, value) {
                        newData.push({
                            id: value,  //id part present in data
                            text: value  //string to be displayed
                        });
                    });
                    return {
                        results: newData
                    };
                }
            }
        });
    }

    function conversionMises() {
        unit_stake.keyup(function () {
            var montant_par_unite = amount_per_unit.val();
            var unites = Number(unit_stake.val());
            var res = Number(montant_par_unite) * Number(unites);
            var res_final = Math.round(res * 100) / 100;
            isNaN(res_final) || res_final < 0 ? conversion_to_devise.val(0) : conversion_to_devise.val(res_final);
        });

        /*form.find('#amountinputdashboard').keyup(function () {
         var montant_par_unite = $(form_string + ' #amountperunit').val();
         var montant = $(form_string + ' #amountinputdashboard').val();
         var res = Number(montant) / Number(montant_par_unite);
         var res_final = Math.round(res * 100) / 100;
         isNaN(res_final) || res_final < 0 || montant_par_unite == '' ? $(form_string + ' #flattounitconversion').val('0') : $(form_string + ' #flattounitconversion').val(res_final);
         });*/
    }

    assignerEtatEnDebut();
    refreshSelectionsClick();
    refreshSelections();
    ajouterTicket();
    gestionTipsters();
    gestionFollowtype();
    typestakechoice();
    conversionMises();
    gestionBookmakerAccount();
    gestionABCD();
    //startDecompteRefresh();
}