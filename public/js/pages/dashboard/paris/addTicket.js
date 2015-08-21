/**
 * Created by sebs on 21/08/2015.
 */


function addTicket() {
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
    var bookmaker = form.find('select[name="bookinputdashboard"]');
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
                letterABCD.val(null).trigger("change").prop('disabled', false);}
            else {
                containerABCD.addClass("hide");
                serieABCD.val(null).trigger("change").prop('disabled', true);
                letterABCD.val(null).trigger("change").prop('disabled', true);}
        });}

    function resetGeneralForm() {
        tipster.val(null).trigger('change');
        followtype.val(null).trigger('change');
        amount_per_unit.val(null);
        bookmaker_account.val(null).trigger("change");
        containerABCD.addClass("hide");
        serieABCD.val(null).trigger("change").prop('disabled', true);
        letterABCD.val(null).trigger("change").prop('disabled', true);
        typestake.val('u').trigger("change");
        conversion_to_devise.val(0).prop('disabled', true);
        devise_stake.val(0);
        unit_stake.val(0);
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

    function gestionTipsters() {
        tipster.select2({
            allowClear: true,
            placeholder: "Choisir un tipster",
            cache: true,
            ajax: {
                url: 'tipsters',
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
            var tipster_infos = tipster.select2('data');
            if (tipster.val() == '') {
                resetGeneralForm();
            } else {
                options_container.fadeIn().removeClass('hidden');
                bookmaker_container.fadeIn().removeClass('hidden');
                typestake_container.fadeIn().removeClass('hidden');
                if (tipster_infos[0]['followtype'] == 'n') {
                    followtype.val('n').trigger('change');
                }
                else if (tipster_infos[0]['followtype'] == 'b') {
                    followtype.val('b').trigger('change');
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
        var types = [{ id: 'u', text: 'en unités' }, { id: 'f', text: 'en devise' }];

        typestake.select2({
            minimumResultsForSearch: Infinity,
            cache: true,
            data: types
        });

        devise_stake_container.hide();
        typestake.on('change', function () {
            if (typestake.val() == 'f') {
                unit_stake.val(0);
                conversion_to_devise.val(0);
                devise_stake.val(0);
                unit_stake_container.hide();
                devise_stake_container.show();}
            else {
                devise_stake.val(0);
                unit_stake.val(0);
                conversion_to_devise.val(0);
                unit_stake_container.show();
                devise_stake_container.hide();}});
    }

    function gestionBookmakerAccount(){
        bookmaker_account.select2({
            allowClear: true,
            placeholder: "Choisir un compte",
            cache: true,
            minimumResultsForSearch: Infinity,
            ajax: {
                url: 'accounts',
                dataType: 'json',
                data: function (params) {return {book_id: $(form_string + ' .bookinputdashboard').val(), q: params.term };
                },
                processResults: function (data) {return {results: data};}}});
    }

    function gestionABCD(){
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

    function conversionMises(){
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
    gestionTipsters();
    typestakechoice();
    conversionMises();
    gestionBookmakerAccount();
    gestionABCD();
}