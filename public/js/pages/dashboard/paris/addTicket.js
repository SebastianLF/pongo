/**
 * Created by sebs on 21/08/2015.
 */



function startDecompteRefresh() {
    var counter = 4;
    var intervalId = null;

    function start() {
        counter = 4;
        intervalId = setInterval(bip, 1000);
        setTimeout(action, 5000);
    }

    function action() {
        $('#automatic-refresh').html("- Rafraichissement auto !!");
        clearInterval(intervalId);
        refreshSelections();
        start();
    }

    function bip() {
        $('#automatic-refresh').html("- Rafraichissement auto dans " + counter + " secondes");
        counter--;
    }

    start();
}


// fonction de rafraichissement.
function refreshSelections() {
    var form = $('#automaticform-add');
    $.ajax({
        url: 'selections',
        success: function (data) {
            form.find('#automatic-selections').html(data.vue);
            supprimerSelection();
            misAjourCompteBookmaker();
            openOrCloseSelectionsCouponAccordeonWhenSelectionsCouponIsRefreshed(data.count);
        },
        error: function (data) {
            form.find('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
        }
    });
}

function openOrCloseSelectionsCouponAccordeonWhenSelectionsCouponIsRefreshed(count) {
    if (count > 0) {
        $('#panier-selections-add-ticket').collapse('show');
        $('#infos-generales-add-ticket').collapse('show');
    } else {
        $('#panier-selections-add-ticket').collapse('hide');
        $('#infos-generales-add-ticket').collapse('hide');
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
    var typestake_container = form.find('#typestakecontainer');

    function assignerEtatEnDebut() {
        resetGeneralForm();
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


            followtype.prop('disabled', false); // sinon le follwotype n est pas evnoye puisqu il ne peut pas y avoir de readonly pour les select. Le followtype est remis en disabled avec le callback 'complete' de la requete ajax d'ajout.
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
                var ticketABCD;
                var ticketGratuit;
                var ticketLongTerme;
                if (abcd_checkbox.is(":checked")) {
                    ticketABCD = 1;
                } else {
                    ticketABCD = 0;
                }
                if (gratuit_checkbox.is(":checked")) {
                    ticketGratuit = 1;
                } else {
                    ticketGratuit = 0;
                }
                if (longterme_checkbox.is(":checked")) {
                    ticketLongTerme = 1;
                } else {
                    ticketLongTerme = 0;
                }

                l.start();
                $.ajax({
                    url: 'encourspari/auto',
                    type: 'post',
                    data: data + '&linesnum=' + linesnum + '&ticketABCD=' + ticketABCD + '&ticketGratuit=' + ticketGratuit + '&ticketLongTerme=' + ticketLongTerme,
                    dataType: 'json',
                    success: function (json) {
                        var keyname;
                        if (json.etat == 0) {
                            console.log(json.msg);
                            console.log($.isArray(json.msg));
                            if ($.isArray(json.msg)) {
                                for (key in json.msg) {
                                    keyname = key;
                                    toastr.error(json.msg[keyname], 'Erreur:');
                                }
                            } else {

                                toastr.error(json.msg, 'Erreur:');

                            }

                        } else if (json.etat == 1) {
                            tipster.val(null).trigger('change');
                            resetGeneralForm();
                            refreshSelections();
                            toastr.success(json.msg, 'Pari');
                            loadParisEnCours();
                            loadBookmakersOnDashboard();
                        }
                    },
                    error: function (json) {
                        console.log('erreur ajout de pari');
                    },
                    complete: function () {
                        followtype.prop('disabled', true); // remettre le followtype sur disabled.
                        l.stop();
                    }
                });
            }
        });
    }

    function resetGeneralForm() {
        followtype.val(null).trigger('change').prop('disabled', true);
        amount_per_unit.val(null);
        typestake.val('u').trigger("change");
        conversion_to_devise.val(0).prop('disabled', true);
        devise_stake.val(0).prop('disabled', true);
        unit_stake.val(0);
        bookmaker_account.val(null).trigger("change").html('').prop('disabled', true);
        containerABCD.addClass("hide");
        serieABCD.val(null).trigger("change").prop('disabled', true);
        letterABCD.val(null).trigger("change").prop('disabled', true);
        options_container.addClass('hidden');
        bookmaker_container.addClass('hidden');
        typestake_container.addClass('hidden');
        resetCheckboxs();
    }

    function resetCheckboxs() {
        abcd_checkbox.prop('checked', false);
        abcd_checkbox.parents('span').removeClass("checked");
        gratuit_checkbox.prop('checked', false);
        gratuit_checkbox.parents('span').removeClass("checked");
        longterme_checkbox.prop('checked', false);
        longterme_checkbox.parents('span').removeClass("checked");
    }

    function refreshSelectionsClick() {
        form.find('#selection-refresh').click(function (e) {
            e.preventDefault();
            refreshSelections();
        });
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
        }).change(function () {
            // informations du tipster.
            var tipster_infos = tipster.select2('data');

            // remise à zero
            conversion_to_devise.val(0);
            devise_stake.val(0);
            unit_stake.val(0);

            if (tipster.val() == '') {
                resetGeneralForm();
                followtype.val(null).trigger('change');
                amount_per_unit.val(null);
                options_container.addClass('hidden');
                bookmaker_container.addClass('hidden');
                typestake_container.addClass('hidden');

            } else {
                options_container.fadeIn().removeClass('hidden');
                bookmaker_container.fadeIn().removeClass('hidden');
                typestake_container.fadeIn().removeClass('hidden');
                if (tipster_infos[0]['followtype'] == 'n') {
                    followtype.val('n').trigger('change');
                    bookmaker_account.prop('disabled', false);
                    bookmaker_container.removeClass('hidden');
                    misAjourCompteBookmaker();
                }
                else if (tipster_infos[0]['followtype'] == 'b') {
                    followtype.val('b').trigger('change');
                    bookmaker_account.prop('disabled', true);
                    bookmaker_container.addClass('hidden');
                }
            }
            var mt = Number(tipster_infos[0]['montant_par_unite']);
            isNaN(mt) ? amount_per_unit.val('') : amount_per_unit.val(mt);

        });
        followtype.select2({
            cache: true,
            minimumResultsForSearch: Infinity,
            data: [{id: "", text: ""}, {id: "n", text: "normal"}, {id: "b", text: "à blanc"}]
        }).prop("disabled", true);
    }


    function typestakechoice() {
        var types = [{id: 'u', text: 'en unités'}, {id: 'f', text: 'en devise'}];
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
    typestakechoice();
    conversionMises();
    gestionBookmakerAccount();
    gestionABCD();


}