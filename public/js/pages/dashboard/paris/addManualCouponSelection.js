/**
 * Created by sebs on 08/05/2015.
 */

function addManualCouponSelection() {

    // gestion formulaire
    var form = $('#automaticform-add');
    var form_string = '#automaticform-add';
    var modal_form = $('#manualselectionform-add');
    var modal = $('#manualBetAddModal').modal('hide');

    var date = modal_form.find('input[name="date"]');
    var dateContainer = modal_form.find('#date_container');
    var dateError = modal_form.find('#date_error');

    var sport = modal_form.find('select[name="sport"]');
    var sportContainer = modal_form.find('#sport_container');
    var sportError = modal_form.find('#sport_error');

    var competition = modal_form.find('select[name="competition"]');
    var competitionContainer = modal_form.find('#competition_container');
    var competitionError = modal_form.find('#competition_error');

    var market = modal_form.find('select[name="market"]');
    var marketContainer = modal_form.find('#market_container');
    var marketError = modal_form.find('#market_error');

    var scope = modal_form.find('select[name="scope"]');
    var scopeContainer = modal_form.find('#scope_container');
    var scopeError = modal_form.find('#scope_error');

    var team1 = modal_form.find('select[name="team1"]');
    var team1Container = modal_form.find('#team1_container');
    var team1Error = modal_form.find('#team1_error');

    var team2 = modal_form.find('select[name="team2"]');
    var team2Container = modal_form.find('#team2_container');
    var team2Error = modal_form.find('#team2_error');

    var pick = modal_form.find('select[name="pick"]');
    var pickContainer = modal_form.find('#pick_container');
    var pickLabel = pickContainer.find('label');
    var pickError = modal_form.find('#pick_error');

    var oddParam = modal_form.find('select[name="odd_doubleParam"]');
    var oddParamContainer = modal_form.find('#odd_doubleParam_container');
    var oddParamLabel = oddParamContainer.find('label');
    var oddParamError = modal_form.find('#odd_doubleParam_error');

    var oddParam2 = modal_form.find('select[name="odd_doubleParam2"]');
    var oddParam2Container = modal_form.find('#odd_doubleParam2_container');
    var oddParam2Error = modal_form.find('#odd_doubleParam2_error');

    var oddParam3 = modal_form.find('select[name="odd_doubleParam3"]');
    var oddParam3Container = modal_form.find('#odd_doubleParam3_container');
    var oddParam3Error = modal_form.find('#odd_doubleParam3_error');

    var oddParticipantParameterName = modal_form.find('select[name="odd_participantParameterName"]');
    var oddParticipantParameterNameContainer = modal_form.find('#odd_participantParameterName_container');
    var oddParticipantParameterNameLabel = oddParticipantParameterNameContainer.find('label');
    var oddParticipantParameterNameError = modal_form.find('#odd_participantParameterName_error');

    var bookmakerContainer = modal_form.find('#bookmaker_container');
    var bookmaker = modal_form.find('select[name="bookmaker"]');
    var bookmakerError = modal_form.find('#bookmaker_error');

    var odd = modal_form.find('input[name="odd_value"]');
    var oddError = modal_form.find('#odd_error');
    var oddContainer = modal_form.find('#odd_container');

    var liveCheckBox = modal_form.find('#live');

    var score = modal_form.find('input[name="score"]');
    var scoreError = modal_form.find('#score_error');
    var scoreContainer = modal_form.find('#score_container');


    function assignerEtatEnDebut() {
        pickContainer.addClass("hidden");
        scopeContainer.addClass("hidden");
        oddParamContainer.addClass("hidden");
        oddParam2Container.addClass("hidden");
        oddParam3Container.addClass("hidden");
        oddParticipantParameterNameContainer.addClass("hidden");
        scoreContainer.addClass("hidden");
        score.prop("disabled", true);
    }



    function gestionCheckboxs() {
        liveCheckBox.click(function () {
            scoreContainer.toggleClass("hidden");
            if (liveCheckBox.is(':checked')) {
                score.prop("disabled", false);
                liveCheckBox.parents('span').addClass("checked");
            }else{
                score.prop("disabled", true);
                liveCheckBox.parents('span').removeClass("checked");
            }
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
        }).change(function () {
            pick.html('');
            competition.val("").trigger("change");
            market.val("").trigger("change");
            scope.val("").trigger("change");
            pick.val("").trigger("change");
            team1.val("").trigger("change");
            team2.val("").trigger("change");
            oddParam.val("").trigger("change");
            oddParam2.val("").trigger("change");
            oddParam3.val("").trigger("change");
            oddParticipantParameterName.val('').trigger("change");
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
        }).change(function () {
            hideMarketParams();
            /*var picks = [];
             pick.select2({data: picks, minimumResultsForSearch: Infinity});*/
            resetTeamsInputs();


            // valeur de market pour la gestion de l affichage des parametres du market.
            var val = modal_form.find(".marketinputdashboard").val();

            // cacher scope et pick input quand le market n est pas seletionné.
            if (val == '') {
                scopeContainer.fadeOut().addClass("hidden");
                pickContainer.fadeOut().addClass("hidden");
            } else {
                scopeContainer.fadeIn().removeClass("hidden");
                pickContainer.fadeIn().removeClass("hidden");
            }

            if (val == 7) { // Winner
                pick.select2({tags: true, allowClear: true, placeholder: "Nom de l\'équipe ou du joueur vainqueur"});
                pickLabel.html("Vainqueur <span class='glyphicon glyphicon-save'></span>");
            }
            else if (val == 8) { // 1X2 European handicap
                team1.html('<option value=""></option>').val("").trigger("change").prop("disabled", false);
                team2.html('<option value=""></option>').val("").trigger("change").prop("disabled", false);
                pickContainer.fadeIn().removeClass("hidden");
                picks = [{id: "1", text: "Domicile"}, {id: "2", text: "Exterieur"}, {
                    id: "X",
                    text: "Match Nul"
                }];
                pick.select2({data: picks, minimumResultsForSearch: Infinity});
                pickLabel.html("Résultat du match");
                oddParticipantParameterNameLabel.text('Equipe Handicap');
                oddParticipantParameterNameContainer.fadeIn().removeClass("hidden");
                oddParticipantParameterNameContainer.addClass("col-md-6");
                participantNameList = [{id: "1", text: "Domicile"}, {id: "2", text: "Exterieur"}];
                oddParticipantParameterName.select2({
                    data: participantNameList,
                    minimumResultsForSearch: Infinity,
                    placeholder: 'Equipe/Joueur'
                });
                oddParamLabel.html('Handicap <span class="glyphicon glyphicon-save"></span>');
                oddParamContainer.fadeIn().removeClass("hidden");
                oddParamContainer.addClass("col-md-6");
                oddParam.html('<option value=""></option>');
                oddParam.select2({tags: true, allowClear: true, placeholder: '2.5 ou -2.5'})
            }
            else if (val == 9) { // Double Chance
                picks = [{id: "1X", text: "1X"}, {id: "X2", text: "X2"}, {id: "12", text: "12"}];
                pick.select2({data: picks, minimumResultsForSearch: Infinity});
                team1.html('<option value=""></option>').val("").trigger("change").prop("disabled", false);
                team2.html('<option value=""></option>').val("").trigger("change").prop("disabled", false);
                pickLabel.html("Choix");
            }
            else if (val == 11) { // Half-Time / Full-Time
                picks = [{id: "1/1", text: "1/1"}, {id: "1/X", text: "1/X"}, {id: "1/2", text: "1/2"}, {id: "X/1", text: "X/1"}, {id: "X/X", text: "X/X"}, {id: "X/2", text: "X/2"}, {id: "2/1", text: "2/1"}, {id: "2/X", text: "2/X"}, {id: "2/2", text: "2/2"}];
                pick.select2({data: picks, minimumResultsForSearch: Infinity});
                team1.html('<option value=""></option>').val("").trigger("change").prop("disabled", false);
                team2.html('<option value=""></option>').val("").trigger("change").prop("disabled", false);
                pickLabel.html("Choix");
            }
            else if (val == 43) { // 1X2
                team1Container.removeClass("hidden");
                team2Container.removeClass("hidden");
                picks = [{id: "1", text: "Home"}, {id: "2", text: "Away"}, {id: "X", text: "Draw"}];
                pick.select2({data: picks, minimumResultsForSearch: Infinity});
            }
            else if (val == 46) { // Match Winner / HomeAway
                team1Container.removeClass("hidden");
                team2Container.removeClass("hidden");
                picks = [{id: "1", text: "Home"}, {id: "2", text: "Away"}];
                pick.select2({data: picks, minimumResultsForSearch: Infinity});
            }
            else if (val == 48) { // Asian Handicap
                team1Container.removeClass("hidden");
                team2Container.removeClass("hidden");
                picks = [{id: "1", text: "Home"}, {id: "2", text: "Away"}];
                pick.select2({data: picks, minimumResultsForSearch: Infinity});
                oddParamContainer.removeClass("hidden");
                oddParamLabel.text('Handicap');
                oddParam.select2({placeholder: "-2.5 ou 2.5", tags: true});
            }
            else {
                modal_form.find(".pickinputdashboard").html('');
                modal_form.find(".pickinputdashboard").val("").trigger("change");
            }
        });
    }

    function gestionSelectionsScope() {
        modal_form.find(".scopeinputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir une portée",
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
            placeholder: "Equipe/Joueur Domicile",
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
            placeholder: "Equipe/Joueur Exterieur",
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
        modal_form.submit(function (e) {
            e.preventDefault();
            var data = modal_form.serialize();
            var selectionlive;

            if (modal_form.find("#live").is(":checked")) {
                selectionlive = 1;
            } else {
                selectionlive = 0;
            }

            $.ajax({
                url: 'manualcoupon',
                type: 'post',
                data: data + '&live=' + selectionlive,
                success: function (data) {
                    if (data.etat == false) {
                        if (data.errors.date) {
                            modal_form.find('#date_container').addClass('has-error');
                            modal_form.find('#date_error').html(data.errors.date);
                        } else {
                            modal_form.find('#date_container').removeClass('has-error');
                            modal_form.find('#date_error').empty();
                        }
                        if (data.errors.sport) {
                            modal_form.find('#sport_container').addClass('has-error');
                            modal_form.find('#sport_error').html(data.errors.sport);
                        } else {
                            modal_form.find('#sport_container').removeClass('has-error');
                            modal_form.find('#sport_error').empty();
                        }
                        if (data.errors.competition) {
                            modal_form.find('#competition_container').addClass('has-error');
                            modal_form.find('#competition_error').html(data.errors.competition);
                        } else {
                            modal_form.find('#competition_container').removeClass('has-error');
                            modal_form.find('#competition_error').empty();
                        }
                        if (data.errors.market) {
                            modal_form.find('#market_container').addClass('has-error');
                            modal_form.find('#market_error').html(data.errors.market);
                        } else {
                            modal_form.find('#market_container').removeClass('has-error');
                            modal_form.find('#market_error').empty();
                        }
                        if (data.errors.scope) {
                            modal_form.find('#scope_container').addClass('has-error');
                            modal_form.find('#scope_error').html(data.errors.scope);
                        } else {
                            modal_form.find('#scope_container').removeClass('has-error');
                            modal_form.find('#scope_error').empty();
                        }
                        if (data.errors.team1) {
                            modal_form.find('#team1_container').addClass('has-error');
                            modal_form.find('#team1_error').html(data.errors.team1);
                        } else {
                            modal_form.find('#team1_container').removeClass('has-error');
                            modal_form.find('#team1_error').empty();
                        }
                        if (data.errors.team2) {
                            modal_form.find('#team2_container').addClass('has-error');
                            modal_form.find('#team2_error').html(data.errors.team2);
                        } else {
                            modal_form.find('#team2_container').removeClass('has-error');
                            modal_form.find('#team2_error').empty();
                        }
                        if (data.errors.pick) {
                            modal_form.find('#pick_container').addClass('has-error');
                            modal_form.find('#pick_error').html(data.errors.pick);
                        } else {
                            modal_form.find('#pick_container').removeClass('has-error');
                            modal_form.find('#pick_error').empty();
                        }
                        if (data.errors.odd_doubleParam) {
                            modal_form.find('#odd_doubleParam_container').addClass('has-error');
                            modal_form.find('#odd_doubleParam_error').html(data.errors.odd_doubleParam);
                        } else {
                            modal_form.find('#odd_doubleParam_container').removeClass('has-error');
                            modal_form.find('#odd_doubleParam_error').empty();
                        }
                        if (data.errors.odd_doubleParam2) {
                            modal_form.find('#odd_doubleParam2_container').addClass('has-error');
                            modal_form.find('#odd_doubleParam2_error').html(data.errors.odd_doubleParam2);
                        } else {
                            modal_form.find('#odd_doubleParam2_container').removeClass('has-error');
                            modal_form.find('#odd_doubleParam2_error').empty();
                        }
                        if (data.errors.odd_doubleParam3) {
                            modal_form.find('#odd_doubleParam3_container').addClass('has-error');
                            modal_form.find('#odd_doubleParam3_error').html(data.errors.odd_doubleParam3);
                        } else {
                            modal_form.find('#odd_doubleParam3_container').removeClass('has-error');
                            modal_form.find('#odd_doubleParam3_error').empty();
                        }
                        if (data.errors.bookmaker) {
                            modal_form.find('#bookmaker_container').addClass('has-error');
                            modal_form.find('#bookmaker_error').html(data.errors.bookmaker);
                        } else {
                            modal_form.find('#bookmaker_container').removeClass('has-error');
                            modal_form.find('#bookmaker_error').empty();
                        }
                        if (data.errors.odd_value) {
                            modal_form.find('#odd_container').addClass('has-error');
                            modal_form.find('#odd_error').html(data.errors.odd_value);
                        } else {
                            modal_form.find('#odd_container').removeClass('has-error');
                            modal_form.find('#odd_error').empty();
                        }

                    }
                    // si les champs entrés sont valides
                    else {

                        // quand le nouveau tipster est ajouté, on recharge les tipsters. Le nouveau tipster sera donc affiché.
                        refreshSelections();
                        modal.modal('hide');
                    }
                }
            });
        });
    }

    function hideMarketParams() {
        scope.html('').val("").trigger("change");
        scopeContainer.addClass("hidden");
        scopeContainer.removeClass('has-error');
        scopeError.empty();
        pick.html('').val("").trigger("change");
        pickContainer.addClass("hidden");
        pickContainer.removeClass('has-error');
        pickError.empty();
        oddParam.html('').val("").trigger("change");
        oddParamContainer.addClass("hidden");
        oddParamContainer.removeClass('has-error');
        oddParamError.empty();
        oddParam2.html('').val("").trigger("change");
        oddParam2Container.addClass("hidden");
        oddParam2Container.removeClass('has-error');
        oddParam2Error.empty();
        oddParam3.html('').val("").trigger("change");
        oddParam3Container.addClass("hidden");
        oddParam3Container.removeClass('has-error');
        oddParam3Error.empty();
        oddParticipantParameterName.html('').val('').trigger("change");
        oddParticipantParameterNameContainer.addClass("hidden");
        oddParticipantParameterNameContainer.removeClass('has-error');
        oddParticipantParameterNameError.empty();

    }

    function resetTeamsInputs() {
        team1.html('').val("").trigger("change").prop("disabled", true);
        team2.html('').val("").trigger("change").prop("disabled", true);
    }

    function resetModal() {
        $('#manualBetAddModal').on('hidden.bs.modal', function () {
            date.val(null).trigger('change');
            dateContainer.removeClass('has-error');
            dateError.empty();
            sport.val(null).trigger('change');
            sportContainer.removeClass('has-error');
            sportError.empty();
            competition.val(null).trigger('change');
            competitionContainer.removeClass('has-error');
            competitionError.empty();
            market.val(null).trigger('change');
            marketContainer.removeClass('has-error');
            marketError.empty();
            scope.val(null).trigger('change');
            scopeContainer.removeClass('has-error');
            scopeError.empty();
            team1.val(null).trigger('change');
            team1Container.removeClass('has-error');
            team1Error.empty();
            team2.val(null).trigger('change');
            team2Container.removeClass('has-error');
            team2Error.empty();
            pick.val(null).trigger('change');
            pickContainer.removeClass('has-error');
            pickError.empty();
            oddParam.val(null).trigger('change');
            oddParamContainer.removeClass('has-error');
            oddParamError.empty();
            oddParam2.val(null).trigger('change');
            oddParam2Container.removeClass('has-error');
            oddParam2Error.empty();
            oddParam3.val(null).trigger('change');
            oddParam3Container.removeClass('has-error');
            oddParam3Error.empty();
            oddParticipantParameterName.val(null).trigger('change');
            oddParticipantParameterNameContainer.removeClass('has-error');
            oddParticipantParameterNameError.empty();
            odd.val(null).trigger('change');
            oddContainer.removeClass('has-error');
            oddError.empty();
            bookmaker.val(null).trigger('change');
            bookmakerContainer.removeClass('has-error');
            bookmakerError.empty();
            bookmaker.val(null);
            scoreContainer.removeClass('has-error').addClass("hidden");
            scoreError.empty();
            score.val('').prop("disabled", true);
            liveCheckBox.parents('span').removeClass("checked");
            liveCheckBox.prop('checked', false);
        })
    }

    // inits
    assignerEtatEnDebut();

    // hack pour avoir le focus sur les inputs avec select2 dans les modals.
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
    };

    // parametre pour l input datetime.
    date.datetimepicker({
        format: 'dd-mm-yyyy hh:ii',
        autoclose: true,
        todayBtn: true,
        language: 'fr',
        pickerPosition: "bottom-left"
    });

    resetModal();
    postCouponSelection();
    gestionCheckboxs();
    gestionSelectionsSport();
    gestionSelectionsCompet();
    gestionSelectionsMarket();
    gestionSelectionsScope();
    gestionSelectionsPick();
    gestionSelectionsEquipes();
}
