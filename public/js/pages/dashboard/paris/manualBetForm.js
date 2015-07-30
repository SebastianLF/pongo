/**
 * Created by sebs on 08/05/2015.
 */

function manualBetForm() {

    // gestion formulaire
    var form = $('#manubetform-add');
    var form_string = '#manubetform-add';
    var modal_form = $('#manualselectionform-add');
    var date = modal_form.find('input[name="date"]');
    var sport = modal_form.find('select[name="sport"]');
    var competition = modal_form.find('select[name="competition"]');
    var market = modal_form.find('select[name="market"]');
    var scope = modal_form.find('select[name="scope"]');
    var team1 = modal_form.find('select[name="team1"]');
    var team1Container = modal_form.find('#team1_container');
    var team2 = modal_form.find('select[name="team2"]');
    var team2Container = modal_form.find('#team2_container');
    var pick = modal_form.find('select[name="pick"]');
    var pickContainer = modal_form.find('#pick_container');
    var pickLabel = pickContainer.find('label');
    var oddParam = modal_form.find('select[name="odd_doubleParam"]');
    var oddParamContainer = modal_form.find('#odd_doubleParam_container');
    var oddParamLabel = oddParamContainer.find('label');
    var oddParam2 = modal_form.find('select[name="odd_doubleParam2"]');
    var oddParam2Container = modal_form.find('#odd_doubleParam2_container');
    var oddParam3 = modal_form.find('select[name="odd_doubleParam3"]');
    var oddParam3Container = modal_form.find('#odd_doubleParam3_container');
    var bookmakerContainer = modal_form.find('#bookmaker_container');
    var bookmaker = modal_form.find('select[name="bookmaker"]');
    var odd = modal_form.find('input[name="odd_value"]');

    function assignerEtatEnDebut() {
        pickContainer.addClass("hidden");
        team1Container.addClass("hidden");
        team2Container.addClass("hidden");
        oddParamContainer.addClass("hidden");
        oddParam2Container.addClass("hidden");
        oddParam3Container.addClass("hidden");
    }

    function gestionCheckboxs() {
        // gestion checkboxs
        $(form_string + ' .methodeabcdcontainer').addClass("hide");
        $(form_string + ' #ticketABCD').click(function () {
            $(form_string + ' .methodeabcdcontainer').removeClass("hide");
        });
        $(form_string + ' #parislongterme ').click(function () {
            $(form_string + ' .methodeabcdcontainer').addClass("hide");
            $(form_string + ' #letterinputdashboard').empty();
            $(form_string + ' #serieinputdashboard').val(null).trigger("change");
        });
        $(form_string + ' #aucun').click(function () {
            $(form_string + ' .methodeabcdcontainer').addClass("hide");
            $(form_string + ' #letterinputdashboard').empty();
            $(form_string + ' #serieinputdashboard').val(null).trigger("change");
        });
        $(form_string + ' #parigratuit').click(function () {
            $(form_string + ' .methodeabcdcontainer').addClass("hide");
            $(form_string + ' #letterinputdashboard').empty();
            $(form_string + ' #serieinputdashboard').val(null).trigger("change");
        });
    }

    // gestion des champs concernant les tipsters.
    function gestionTipsters() {
        form.find('#tipstersinputdashboard').select2({
            allowClear: true,
            placeholder: "Choisir un tipster",
            cache: true,
            ajax: {
                url: 'tipsters',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

        form.find('#tipstersinputdashboard').change(function () {
            var tipster_id = $(form_string + ' #tipstersinputdashboard').val();
            var followtype = $(form_string + ' #followtypeinputdashboard');
            var montant_par_unite = $(form_string + ' #amountperunit');

            // remise a zero des champs liés.
            $(form_string + ' #stakeunitinputdashboard').val('');
            $(form_string + ' #amountperunit').val('');
            $(form_string + ' #amountconversion').val('0');
            $(form_string + ' #amountinputdashboard').val('');
            $(form_string + ' #flattounitconversion').val('0');
            $.ajax({
                url: 'infosTipster',
                data: 'tipster_id=' + tipster_id,
                dataType: 'json',
                success: function (data) {
                    form.find('.bookinputdashboard').val(null).trigger("change");
                    form.find('#accountsinputdashboard').val(null).trigger("change");
                    followtype.val('');
                    if (data.followtype == 'n') {
                        followtype.val('normal');
                        form.find(".bookinputdashboard").prop("disabled", false);
                        form.find("#accountsinputdashboard").prop("disabled", false);
                    } else if (data.followtype == 'b') {
                        followtype.val('à blanc');
                        form.find('.bookinputdashboard').val(null).trigger("change");
                        form.find('#accountsinputdashboard').val(null).trigger("change");
                        form.find('.bookinputdashboard').prop('disabled', true);
                        form.find('#accountsinputdashboard').prop('disabled', true);
                    } else {
                        form.find('.bookinputdashboard').val(null).trigger("change");
                        form.find('#accountsinputdashboard').val(null).trigger("change");
                        form.find('.bookinputdashboard').prop('disabled', true);
                        form.find('#accountsinputdashboard').prop('disabled', true);
                    }
                    var mt = Number(data.montant_par_unite);
                    isNaN(mt) ? montant_par_unite.val('') : montant_par_unite.val(mt);
                },
                error: function (data) {
                }
            });
        });
    }

    // suivant le type de mise choisi.
    function gestionTypeMise() {
        var type_stake = [{id: 'u', text: 'en unités'}, {id: 'f', text: 'en devise'}];

        form.find('#typestakeinputdashboard').select2({
            minimumResultsForSearch: Infinity,
            cache: true,
            data: type_stake
        });

        var select = form.find('select[name=typestakeinputdashboard]');
        form.find('.typestakeflat').hide();
        select.on('change', function () {
            if ($(this).val() == 'f') {
                form.find('.typestakeunites').hide();
                form.find('#stakeunitinputdashboard').val('');
                form.find('.typestakeflat').show();
            } else {
                form.find('.typestakeunites').show();
                form.find('.typestakeflat').hide();
                form.find('#amountinputdashboard').val('');
            }
        });

        form.find('#stakeunitinputdashboard').keyup(function () {
            var montant_par_unite = $(form_string + ' #amountperunit').val();
            var unites = Number($(form_string + ' #stakeunitinputdashboard').val());
            var res = Number(montant_par_unite) * Number(unites);
            var res_final = Math.round(res * 100) / 100;
            isNaN(res_final) || res_final < 0 ? $(form_string + '#amountconversion').val('0') : $(form_string + ' #amountconversion').val(res_final);
        });

        form.find('#amountinputdashboard').keyup(function () {
            var montant_par_unite = $(form_string + ' #amountperunit').val();
            var montant = $(form_string + ' #amountinputdashboard').val();
            var res = Number(montant) / Number(montant_par_unite);
            var res_final = Math.round(res * 100) / 100;
            isNaN(res_final) || res_final < 0 || montant_par_unite == '' ? $(form_string + ' #flattounitconversion').val('0') : $(form_string + ' #flattounitconversion').val(res_final);
        });
    }

    function gestionBookmakers() {
        form.find('.bookinputdashboard').select2({
            allowClear: true,
            placeholder: "Choisir un bookmaker",
            cache: true,
            ajax: {
                url: 'bookmakers',
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


        form.find('#accountsinputdashboard').select2({
            allowClear: true,
            placeholder: "Choisir un compte",
            cache: true,
            minimumResultsForSearch: Infinity,
            ajax: {
                url: 'accounts',
                dataType: 'json',
                data: function (params) {
                    return {
                        book_id: $(form_string + ' .bookinputdashboard').val(),
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
    }


    function gestionABCD() {
        // checkboxs
        form.find('#ticketABCD').on('click', function () {
            if ($(this).is(':checked')) {
                form.find('#methodeabcdcontainer').removeClass("hide");
                form.find('#serieinputdashboard').prop('disabled', false);
                form.find('#letterinputdashboard').prop('disabled', false);
            }
            else {
                form.find('#methodeabcdcontainer').addClass("hide");
                form.find('#serieinputdashboard').prop('disabled', true);
                form.find('#letterinputdashboard').prop('disabled', true);
            }
        });

        // chargements des paris abcd dans le select input.
        form.find('#serieinputdashboard').select2({
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

        form.find('#letterinputdashboard').select2({
            allowClear: true,
            placeholder: "Choisir une lettre",
            cache: true,
            minimumResultsForSearch: Infinity,
            ajax: {
                url: 'lettreabcd',
                dataType: 'json',
                data: function (params) {
                    return {
                        serie_nom: $(form_string + ' #serieinputdashboard').val(),
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

        form.find("#serieinputdashboard").change(function () {
            var nom = $(form_string + "#serieinputdashboard option:selected").text();
            nom = encodeURIComponent(nom);
            form.find("#letterinputdashboard").val(null).trigger("change");
        });
    }


    function gestionSelectionsSport() {
        modal_form.find(".sportinputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir un sport",
            cache: true,
            ajax: {
                url: 'sports',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    function gestionSelectionsCompet() {
        modal_form.find(".competitioninputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir une competition",
            cache: true,
            ajax: {
                url: 'competitions',
                dataType: 'json',
                data: function (params) {
                    return {
                        sport_id: modal_form.find('.sportinputdashboard').val(),
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    function gestionSelectionsMarket() {
        modal_form.find(".marketinputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir un type de pari",
            cache: true,
            ajax: {
                url: 'markets',
                dataType: 'json',
                data: function (params) {
                    return {
                        sport_id: modal_form.find('.sportinputdashboard').val(),
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        }).change(function(){
            var picks = [];
            pick.select2({data:picks, minimumResultsForSearch: Infinity});

            pick.html('');pick.val("").trigger("change");
            team1.val("").trigger("change");team1Container.addClass("hidden");
            team2.val("").trigger("change");team2Container.addClass("hidden");
            oddParam.val("").trigger("change");oddParamContainer.addClass("hidden");
            oddParam2.val("").trigger("change");oddParam2Container.addClass("hidden");
            oddParam3.val("").trigger("change");oddParam3Container.addClass("hidden");

            var val = modal_form.find(".marketinputdashboard").val();

            if(val == ''){pickContainer.addClass("hidden");}else{pickContainer.removeClass("hidden");}

                  if(val == 7){pick.select2({tags: true});} // Winner
            else if(val == 43){team1Container.removeClass("hidden"); team2Container.removeClass("hidden"); picks = [{id:"Home", text: "Home"}, {id:"Away", text: "Away"}, {id:"Draw", text: "Draw"}]; pick.select2({data:picks, minimumResultsForSearch: Infinity});} // 1X2
            else if(val == 46){team1Container.removeClass("hidden"); team2Container.removeClass("hidden"); picks = [{id:"Home", text: "Home"}, {id:"Away", text: "Away"}]; pick.select2({data:picks, minimumResultsForSearch: Infinity});} // Match Winner / HomeAway
            else if(val == 48){team1Container.removeClass("hidden"); team2Container.removeClass("hidden"); picks = [{id:"Home", text: "Home"}, {id:"Away", text: "Away"}]; pick.select2({data:picks, minimumResultsForSearch: Infinity}); oddParamContainer.removeClass("hidden"); oddParamLabel.text('Handicap'); oddParam.select2({placeholder: "-2.5 ou 2.5", tags: true});} // Asian Handicap
            else{
                modal_form.find(".pickinputdashboard").html('');
                modal_form.find(".pickinputdashboard").val("").trigger("change");
                }
        });
    }

    function gestionSelectionsScope() {
        modal_form.find(".scopeinputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir un sous type",
            cache: true,
            ajax: {
                url: 'scopes',
                dataType: 'json',
                data: function (params) {
                    return {
                        sport_id: modal_form.find('.sportinputdashboard').val(),
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    function gestionSelectionsPick() {
        modal_form.find(".pickinputdashboard").select2();
    }

    function gestionSelectionsEquipes() {
        modal_form.find(".team1inputdashboard").select2({

            allowClear: true,
            placeholder: "Equipe n°1/Joueur n°1",
            cache: true,
            ajax: {
                url: 'equipes',
                dataType: 'json',
                data: function (params) {
                    return {
                        sport_id: modal_form.find('.sportinputdashboard').val(),
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

        modal_form.find(".team2inputdashboard").select2({
            allowClear: true,
            placeholder: "Equipe n°2/Joueur n°2",
            cache: true,
            ajax: {
                url: 'equipes',
                dataType: 'json',
                data: function (params) {
                    return {
                        sport_id: modal_form.find('.sportinputdashboard').val(),
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    bookmaker.select2({
        allowClear: true,
        placeholder: "Choisir un bookmaker",
        cache: true,
        ajax: {
            url: 'bookmakers',
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });


    function postCouponSelection() {
        modal_form.submit(function (e){
            e.preventDefault();
            var data = modal_form.serialize();
            $.ajax({
                url: 'coupon',
                type: 'post',
                data: data,
                success: function (data) {

                }
            });
        });

    }

    function resetModal(){
        $('#manualBetAddModal').on('hidden.bs.modal', function () {
            date.val(null).trigger('change');
            sport.val(null).trigger('change');
            competition.val(null).trigger('change');
            market.val(null).trigger('change');
            scope.val(null).trigger('change');
            team1.val(null).trigger('change');
            team2.val(null).trigger('change');
            pick.val(null).trigger('change');
            oddParam.val(null).trigger('change');
            oddParam2.val(null).trigger('change');
            oddParam3.val(null).trigger('change');
            odd.val(null).trigger('change');
        })
    }

    // inits
    assignerEtatEnDebut();

    // hack pour avoir le focus sur les inputs avec select2 dans les modals.
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
    };

    resetModal();
    postCouponSelection();
    gestionTipsters();
    gestionTypeMise();
    gestionBookmakers();
    gestionABCD();
    gestionSelectionsSport();
    gestionSelectionsCompet();
    gestionSelectionsMarket();
    gestionSelectionsScope();
    gestionSelectionsPick();
    gestionSelectionsEquipes();
}
