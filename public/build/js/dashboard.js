/**
 * Created by sebs on 30/06/2015.
 */

    //paris
    parisEnCoursDelete();
    getBookmakersForSelection();
    loadParisEnCours();
    loadParisLongTerme();
    loadParisABCD();
    loadParisTermine();

    // dashboard
    loadRecapsOnDashboard();
    loadBookmakersOnDashboard();

    // formulaire d'ajout de pari
    automaticBetForm();
    manualBetForm();


function loadBookmakersOnDashboard() {
    $.ajax({
        url: 'comptes',
        type:'get',
        success: function (data) {
            $('#comptes_par_bookmakers').html(data);
        },
        error: function (data){
            console.log('la récuperation des comptes bookmakers vers le dashboard n\'a pas fonctionné');
        }
    });
}
// charge sans vue.

function loadRecapsOnDashboard() {
    $.ajax({
        url: 'recaps',
        type: 'get',
        success: function (data) {
            $('[data-toggle="collapse"]').collapse();
            $('#recaps').html(data);
        },
        error: function () {
        }
    });
}

$('#WelcomeModal').modal(
    {
        keyboard: false,
        backdrop: 'static'
    }
);

function automaticBetForm() {

    var form = $('#automaticform-add');
    var form_string = '#automaticform-add';

    function ajouterTicket() {
        form.submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var linesnum = form.find('.betline').length;
            if (linesnum == '') {
                swal({
                    title: "Erreur!",
                    text: "Ajoutez au moins une selection pour pouvoir valider le ticket!",
                    type: "warning",
                    confirmButtonText: "OK"
                });
            } else if (linesnum >= 1) {
                //serialize doesnt retrieve .text() of an input
                var ticketABCD;
                var ticketGratuit;
                var ticketLongTerme;
                if (form.find("#ticketABCD").is(":checked")) {ticketABCD = 1;}else{ticketABCD = 0;}
                if (form.find("#ticketGratuit").is(":checked")) {ticketGratuit = 1;}else{ticketGratuit = 0;}
                if (form.find("#ticketLongTerme").is(":checked")) {ticketLongTerme = 1;}else{ticketLongTerme = 0;}

                $.ajax({
                    url: 'encourspari/auto',
                    type: 'post',
                    data: data + '&linesnum=' + linesnum + '&ticketABCD=' + ticketABCD + '&ticketGratuit=' + ticketGratuit + '&ticketLongTerme=' + ticketLongTerme,
                    dataType: 'json',
                    success: function (json) {
                        alert(json);
                        var keyname;
                        if (json.etat == 0) {
                            if ($.isArray(json.msg)) {
                                for (key in json.msg) {
                                    alert(key);
                                    keyname = key;
                                    toastr.error(json.msg[keyname], 'Erreur:');
                                }
                            } else {
                                toastr.error(json.msg, 'Erreur:');
                            }

                        } else if (json.etat == 1) {
                            resetAutomaticForm();
                            refreshSelections();
                            toastr.success(json.msg, 'Pari');
                            loadParisEnCours();
                            loadBookmakersOnDashboard();
                        }
                    },
                    error: function (json) {
                        console.log('erreur ajout de pari');
                    }
                });
            }
        });
    }

    // fonction de rafraichissement.
    function refreshSelections() {
        var suivi = form.find('#followtypeinputdashboard').val();
        $.ajax({
            url: 'selections',
            success: function (data){
                form.find('#automatic-selections').html(data.vue);
                supprimerSelection();
                $.ajax({
                    url: 'allbookmakers',
                    dataType: 'json',
                    success: function (data2) {
                        form.find('.bookinputdashboard').select2({
                            minimumResultsForSearch: Infinity,
                            cache: true,
                            data: data2
                        });

                        if(suivi == 'à blanc'){
                            form.find('.bookinputdashboard').val("").trigger("change");
                            form.find('#accountsinputdashboard').val("").trigger("change");
                        }else{
                            form.find('.bookinputdashboard').prop('disabled', false);
                            form.find('#accountsinputdashboard').prop('disabled', false);
                            form.find('.bookinputdashboard').val(data.bookmaker_id).trigger("change");
                        }
                        gestionTipsters(data.bookmaker_id);
                    }
                });
                if (data.msg.length > 0){
                    swal({
                        title: "Erreur!",
                        text: data.msg,
                        type: "warning",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (data) {
                form.find('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
            }
        });
    }

    // rafrachais les selections automatiquement toutes les 10 sec.
    function refreshSelectionsAuto() {
        form.find('.bookinputdashboard').val("").trigger("change");
        form.find('#accountsinputdashboard').val("").trigger("change");
    }

    // supprime la selection.
    function supprimerSelection(){
        form.find('#automatic-selections .boutonsupprimer').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var id = parent.find(".selection_id").text();
            $.ajax({
                url: 'coupon/' + id,
                method: 'delete',
                success: function (data) {
                    refreshSelections();
                    form.find('.bookinputdashboard').val(null).trigger("change");
                    form.find('select[name="accountsinputdashboard"]').val(null).trigger('change');
                },
                error: function (data) {
                }
            });
        });
    }

    // rafraichis les selections.*/
    function refreshSelectionsClick() {
        form.find('#selection-refresh').click(function (e) {
            e.preventDefault();
            refreshSelections();
        });
    }

    function typestakechoice() {
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
    }

    function gestionTipsters(bookmaker_id){
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
                        form.find('.bookinputdashboard').val(bookmaker_id).trigger("change");
                        form.find('#accountsinputdashboard').val(null).trigger("change");
                    } else if (data.followtype == 'b') {
                        followtype.val('à blanc');
                        form.find('.bookinputdashboard').val(null).trigger("change");
                        form.find('#accountsinputdashboard').val(null).trigger("change");
                        form.find('.bookinputdashboard').prop('disabled', true);
                        form.find('#accountsinputdashboard').prop('disabled', true);
                    }else{
                        form.find(".bookinputdashboard").prop("disabled", false);
                        form.find("#accountsinputdashboard").prop("disabled", false);
                        form.find('.bookinputdashboard').val(bookmaker_id).trigger("change");
                        form.find('#accountsinputdashboard').val(null).trigger("change");

                    }
                    var mt = Number(data.montant_par_unite);
                    isNaN(mt) ?  montant_par_unite.val('') : montant_par_unite.val(mt);
                },
                error: function (data) {
                }
            });
        });
    }

    function resetAutomaticForm(){
        form.find('#stakeunitinputdashboard').val(null).trigger("change");
        form.find('#amountinputdashboard').val(null).trigger("change");
        form.find('#accountsinputdashboard').val(null).trigger("change");
        form.find('input:checkbox').prop('checked', false);
    }

    var type_stake = [{ id: 'u', text: 'en unités' }, { id: 'f', text: 'en devise' }];

    form.find('#typestakeinputdashboard').select2({
        minimumResultsForSearch: Infinity,
        cache: true,
        data: type_stake
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

    form.find('#serieinputdashboard').prop('disabled', true);
    form.find('#letterinputdashboard').prop('disabled', true);
    form.find('.methodeabcdcontainer').addClass("hide");
    form.find('.bookmakercontainer').addClass("hide");

    form.find('#ticketABCD').on('click', function(){
        if ( $(this).is(':checked') ) {
            form.find('.methodeabcdcontainer').removeClass("hide");
            form.find('#serieinputdashboard').prop('disabled', false);
            form.find('#letterinputdashboard').prop('disabled', false);
        }
        else {
            form.find('.methodeabcdcontainer').addClass("hide");
            form.find('#serieinputdashboard').prop('disabled', true);
            form.find('#letterinputdashboard').prop('disabled', true);
        }
    });

    // initialisation
    //$(".bookinputdashboard").prop("disabled", true);
    //$("#accountsinputdashboard").prop("disabled", true);
    refreshSelectionsClick();
    refreshSelections();
    ajouterTicket();
    typestakechoice();
}





function loadParisABCD() {
    $.ajax({
        url: 'dashboard/ajax/parisabcd',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_3').html(data);
        },
        error: function (data) {
            $('#tab_15_3').html('<p>impossible de récuperer les paris ABCD</p>');
        }
    });
}

function loadParisEnCours() {
    var onglet = $('#onglet_paris_en_cours span');
    $.ajax({
        url: 'dashboard/ajax/parisencours',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_1').html(data);
            featuresParisEnCours();
            paginationParisEnCours();
            cashOut();
        },
        error: function (data) {
            $('#tab_15_1').html('<p>impossible de récuperer les paris</p>');
        }
    });
}

function loadParisTermine() {
    var onglet = $('#onglet_paris_long_terme span');
    $.ajax({
        url: 'dashboard/ajax/paristermine',
        data: {page: 1},
        type: 'get',
        success: function (data) {
            $('#tab_15_4').html(data);
            parisTermineDelete();
            $("#paristerminetable .boutonsupprimer").click(function (e) {
                e.stopPropagation();
            });
        },
        error: function (data) {
            $('#tab_15_4').html('<p>impossible de récuperer les paris terminés</p>');
        }
    });
}

function featuresParisEnCours() {
    // activation des tooltip.
    $('[data-toggle="tooltip"]').tooltip();
    $("[data-hover='tooltip']").tooltip();



    // afficher le count dans le bon endroit.
    var count = $('#parisencourstable #count').text();
    if (count == '0') {
        $('#onglet_paris_en_cours span').text('');
    } else {
        $('#onglet_paris_en_cours span').text(count);
    }


    // stopper la propagation quand on click sur le choix du resultat.
    $("#parisencourstable .boutonvalider").click(function (e) {
        e.stopPropagation();
    });
    $("#parisencourstable .boutonsupprimer").click(function (e) {
        e.stopPropagation();
    });
    $("select[name='resultatDashboardInput']").click(function (e) {
        e.stopPropagation();
    });

    parisEnCoursCalculateStatus('#parisencourstable');
    parisEnCoursEnclose('#parisencourstable', '.validerform', 'historique');
    parisEnCoursDelete('#parisencourstable', '.supprimerform', 'encourspari/');
}

// lors du clique sur un numero de pagination.
function paginationParisEnCours() {
    $('#tab_15_1').on('click', '.pagination a', function (e) {
        e.preventDefault();
        var pg = getPaginationSelectedPage($(this).attr('href'));
        $.ajax({
            url: 'dashboard/ajax/parisencours',
            data: {page: pg},
            success: function (data) {
                $('#tab_15_1').html(data);
                featuresParisEnCours();
            },
            error: function (data) {
                console.log('erreur: pagination par click');
            }
        });
    });
}

// quelle pagination charger, lorsque l'on ajoute ou supprimer un pari.
function loadParisEnCoursWithPage(condition) {
    var taille = $('#parisencourstable .id').length;
    var pg = $('#tab_15_1').find('.active').find('span').text();

    // quand il ne reste qu'un seul pari sur une page et quil est suprimé, ca passe diectement a la page precedente.
    if (condition == 'delete' && taille == 1) {
        pg = pg - 1;
    }

    // quand pg est egale a rien on affiche la premiere page.
    if (!pg) {
        loadParisEnCours();
    } else {
        $.ajax({
            url: 'dashboard/ajax/parisencours',
            data: {page: pg},
            type: 'get',
            success: function (data) {
                $('#tab_15_1').html(data);
                featuresParisEnCours();
            }
        });
    }
}

function cashOut(){

    // passage de parametres vers le modal.
    $('#cashoutModal').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var pari_id = $(e.relatedTarget).data('id');

        //populate the textbox
        $(e.currentTarget).find('input[name="pari-id"]').val(pari_id);
    });

    // cash out modal
    var cashout_form = $('#cashout-update');
    var cashout_array = [{ id: 'c', text: 'classic cash out' }];
    cashout_form.find('#cashout-select').select2({
        minimumResultsForSearch: Infinity,
        cache: true,
        data: cashout_array
    }).change(function(){
        cashout_form.find('.classic-cash-out-group').toggleClass('hide');
        //cashout_form.find('.partial-cash-out-group').toggleClass('hide');
    });

    // envoi du form.
    cashout_form.submit(function(e){
        e.preventDefault();
        var inputs = cashout_form.serialize();
        $.ajax({
            url : 'cashout',
            type : 'post',
            data : inputs,
            dataType : 'json',
            success: function(data){
                if(data.etat){
                    toastr.success(data.msg, 'Pari');
                }else{
                    for (key in data.msg) {
                        keyname = key;
                        toastr.error(data.msg[keyname], 'Erreur:');
                    }
                }
            },
            error: function(){

            }
        });
    });

}

function loadParisLongTerme() {

    $.ajax({
        url: 'dashboard/ajax/parislongterme',
        data: {page: '1'},
        type: 'get',
        success: function (msg) {

            // chargement des paris long terme dans la div.
            $('#tab_15_2').html(msg);

            // activation des tooltip.
            $('[data-toggle="tooltip"]').tooltip();

            // afficher le count dans le bon endroit.
            $('#onglet_paris_long_terme span').text($('#parislongtermetable #count').text());

            // mise en variable des differentes balises.
            var table = $("#parislongtermetable");
            var boutonvalider = $("#parislongtermetable .boutonvalider");
            var bouton_supprimer = $("#parislongtermetable .boutonsupprimer");
            var form_valider = $("#parislongtermetable .validerform");
            var form_supprimer = $("#parislongtermetable .supprimerform");
            var resultat = $("#parislongtermetable select[name='resultatDashboardInput']");
            var resultat_select = $("#parislongtermetable select[name='resultatDashboardInput'] option:selected");

            // active les tooltip.
            $('[data-toggle="tooltip"]').tooltip();

            // stopper la propagation quand on click sur le bouton valider.
            boutonvalider.click(function (e) {
                e.stopPropagation();
            });

            // stopper la propagation quand on click sur le bouton supprimer.
            bouton_supprimer.click(function (e) {
                e.stopPropagation();
            });

            // stopper la propagation quand on click sur le choix du resultat.
            resultat.click(function (e) {
                e.stopPropagation();
            });

            // calcul du montant retour par rapport au resultat selectionné
            resultat.change(function (e) {
                var parent = $(this).closest('.mainrow');
                var cote = parent.find(".tdcote").text();
                var mise = parent.find(".tdmise .tdsubmise").text();
                var tdsubretour = parent.find('.tdretour span.subretour');
                var tdretour = parent.find('.tdretour');

                switch (result = parent.find("select[name='resultatDashboardInput'] option:selected").text()) {
                    case '--Selectionnez--':
                        tdsubretour.empty();
                        tdretour.css("color", "black");
                        break;
                    case "Gagné":
                        var retour = parseFloat(mise * cote);
                        tdretour.css("color", "green");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Perdu":
                        var retour = parseFloat(mise);
                        tdretour.css("color", "red");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "1/2 Gagné":
                        var retour = parseFloat((mise * cote - mise) / 2) + parseFloat(mise);
                        tdretour.css("color", "green");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "1/2 Perdu":
                        var retour = parseFloat(mise / 2);
                        tdretour.css("color", "red");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Remboursé":
                        tdretour.css("color", "black");
                        var retour = parseFloat(mise);
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Annulé":
                        tdretour.css("color", "black");
                        var retour = parseFloat(mise);
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                }
            });

            // click sur le bouton valider du paris long terme ,
            // qui va le transferer vers historique et recharger les paris long terme.
            form_valider.submit(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.mainrow');
                var retour = parent.find('.tdretour span.subretour');
                if (retour.text().length > 0) {
                    var cote = parent.find(".tdcote").text();
                    var mise = parent.find(".tdmise .tdsubmise").text();
                    var ser = $(this).serialize();
                    $.ajax({
                        url: 'historique',
                        type: 'post',
                        data: ser + '&cote=' + cote + '&mise=' + mise + '&retour=' + retour,
                        success: function (json) {
                            loadParisLongTerme();
                        },
                        error: function () {
                            console.log("valider un pari long terme ne fonctionne pas");
                        }
                    });
                } else {
                    alert('Vous devez préciser un status pour ce pari.');
                }
            });

            // click sur le bouton supprimer qui va supprimer le pari et recharger les paris long terme.
            form_supprimer.submit(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.mainrow');
                var id = parent.find('.id').text();
                var retour = parent.find('.tdretour span.subretour');
                var cote = parent.find(".tdcote").text();
                var mise = parent.find(".tdmise .tdsubmise").text();
                var ser = $(this).serialize();
                if(confirm("Etes vous sur?")){
                    $.ajax({
                        url: 'historique/' + id,
                        type: 'delete',
                        success: function (json) {
                            loadParisLongTerme();
                        },
                        error: function () {
                            console.log("supprimer un pari long terme ne fonctionne pas");
                        }
                    });
                }
            });
        },
        error: function (data) {
            console.log("le chargement des paris long terme n\'a pas fonctionné");

        }
    });
}


/**
 * Created by sebs on 08/05/2015.
 */

function manualBetForm() {

    // gestion formulaire
    var form = $('#manubetform-add');
    var form_string = '#manubetform-add';


    function assignerEtatEnDebut(){
    }

    function gestionCheckboxs(){
        // gestion checkboxs
        $(form_string+' .methodeabcdcontainer').addClass("hide");
        $(form_string+' #ticketABCD').click(function () {
            $(form_string+' .methodeabcdcontainer').removeClass("hide");
        });
        $(form_string+' #parislongterme ').click(function () {
            $(form_string+' .methodeabcdcontainer').addClass("hide");
            $(form_string+' #letterinputdashboard').empty();
            $(form_string+' #serieinputdashboard').val(null).trigger("change");
        });
        $(form_string+' #aucun').click(function () {
            $(form_string+' .methodeabcdcontainer').addClass("hide");
            $(form_string+' #letterinputdashboard').empty();
            $(form_string+' #serieinputdashboard').val(null).trigger("change");
        });
        $(form_string+' #parigratuit').click(function () {
            $(form_string+' .methodeabcdcontainer').addClass("hide");
            $(form_string+' #letterinputdashboard').empty();
            $(form_string+' #serieinputdashboard').val(null).trigger("change");
        });
    }

    // gestion des champs concernant les tipsters.
    function gestionTipsters(){
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
                    }else{
                        form.find('.bookinputdashboard').val(null).trigger("change");
                        form.find('#accountsinputdashboard').val(null).trigger("change");
                        form.find('.bookinputdashboard').prop('disabled', true);
                        form.find('#accountsinputdashboard').prop('disabled', true);
                    }
                    var mt = Number(data.montant_par_unite);
                    isNaN(mt) ?  montant_par_unite.val('') : montant_par_unite.val(mt);
                },
                error: function (data) {
                }
            });
        });
    }

    // suivant le type de mise choisi.
    function gestionTypeMise(){
        var type_stake = [{ id: 'u', text: 'en unités' }, { id: 'f', text: 'en devise' }];

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

    function gestionBookmakers(){
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


    function gestionABCD(){
        // checkboxs
        form.find('#ticketABCD').on('click', function(){
            if ( $(this).is(':checked') ) {
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


    function gestionSelectionsSport(){
        form.find(".sportinputdashboard").select2({
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

    function gestionSelectionsCompet(){
        form.find(".competitioninputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir une competition",
            cache: true,
            ajax: {
                url: 'competitions',
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

    function gestionSelectionsMarket(){
        form.find(".marketinputdashboard").select2({
            allowClear: true,
            placeholder: "Choisir un type de pari",
            cache: true,
            ajax: {
                url: 'markets',
                dataType: 'json',
                data: function (params) {
                    return {
                        sport_id: $('.sportinputdashboard').val(),
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



    // inits
    assignerEtatEnDebut();

    gestionTipsters();
    gestionTypeMise();
    gestionBookmakers();
    gestionABCD();
    gestionSelectionsSport();
    gestionSelectionsCompet();
    gestionSelectionsMarket();
}

/**
 * Created by sebs on 19/04/2015.
 */

// calcul pour l affichage du profit du ticket.
function calculProfits(type, status, grand_parent_var, profits_var, mise_var, devise_var) {
    var mise = mise_var;
    var result = mise;
    var grand_parent = grand_parent_var;
    var profits = profits_var;
    var devise = devise_var;
    var no_selection;
    var perdu_selection;
    var afficher_devise = false;
    var status_en_attente = false;
    var cotes = 1;
    console.log(profits);
    if(type == 'simple'){
        //console.log('type= '+type+' status= '+status+' mainrow= '+grand_parent+' profits='+profits+' mise= '+mise+' devise= '+devise);
        var cote = Number(grand_parent.find('.tdcote').text());
        if(status == 0){
            no_selection = 1;
        }else if(status == 1) {
            cotes *= cote;
        }else if(status == 2) {
            cotes *= 0 ;
            perdu_selection = 1;
        }else if(status == 3){
            cotes = cotes * [(cote-1)/2+1];
        }else if(status == 4){
            cotes = cotes * 0.5;
        }else if(status == 5){
            cotes += 0;
        }

        if(no_selection && !perdu_selection){
        result = '';
        afficher_devise = false;
        status_en_attente = true;
        }else{
            afficher_devise = true;
            result = cotes * mise;
            result -= mise;
            result = Number(Math.round(result * 100) / 100);
        }
        if(result > 0){
            profits.addClass('font-green');
            devise.addClass('font-green');
            profits.removeClass('font-red');
            devise.removeClass('font-red');
            profits.removeClass('font-gray');
            devise.removeClass('font-gray');
        }else if(result < 0){
            profits.addClass('font-red');
            devise.addClass('font-red');
            profits.removeClass('font-green');
            devise.removeClass('font-green');
            profits.removeClass('font-gray');
            devise.removeClass('font-gray');
        }else{
            profits.addClass('font-gray');
            devise.addClass('font-gray');
            profits.removeClass('font-green');
            devise.removeClass('font-green');
            profits.removeClass('font-red');
            devise.removeClass('font-red');
        }
        if(afficher_devise){
            devise.removeClass('hide');
        }else{
            devise.addClass('hide');
        }
        if(result > 0){
            status_en_attente ? profits.html('+'+result) : profits.text('+'+result);
        }else{
            status_en_attente ? profits.html(result) : profits.text(result);
        }
    }else{
        console.log('type= '+type+' status= '+status+' mainrow= '+grand_parent+' profits='+profits+' mise= '+mise+' devise= '+devise);

        grand_parent.find(".child-table-tr").each(function () {
            var cote = Number($(this).find('.cote-td').text());
            var status = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
            if(status == 0){
                no_selection = 1;
            }else if(status == 1) {
                cotes *= cote;
            }else if(status == 2) {
                cotes *= 0 ;
                perdu_selection = 1;
            }else if(status == 3){
                cotes = cotes * [(cote-1)/2+1];
            }else if(status == 4){
                cotes = cotes * 0.5;
            }else if(status == 5){
                cotes += 0;
            }
        });

    if(no_selection && !perdu_selection){
        result = '';
        afficher_devise = false;
    }else{
        afficher_devise = true;
        result = cotes * mise;
        result -= mise;
        result = Number(Math.round(result * 100) / 100);
    }

    if(result > 0){
        profits.addClass('font-green');
        devise.addClass('font-green');
        profits.removeClass('font-red');
        devise.removeClass('font-red');
        profits.removeClass('font-gray');
        devise.removeClass('font-gray');
    }else if(result < 0){
        profits.addClass('font-red');
        devise.addClass('font-red');
        profits.removeClass('font-green');
        devise.removeClass('font-green');
        profits.removeClass('font-gray');
        devise.removeClass('font-gray');
    }else{
        profits.addClass('font-gray');
        devise.addClass('font-gray');
        profits.removeClass('font-green');
        devise.removeClass('font-green');
        profits.removeClass('font-red');
        devise.removeClass('font-red');
    }

     if(afficher_devise){
        devise.removeClass('hide');
    }else{
        devise.addClass('hide');
    }
    if(result > 0){
        profits.text('+'+result);
    }else{
        profits.text(result);   
    }
    }
 

}

// pour desactiver ou activer le bouton valider.
function statusBoutonValider(type, gran_parent_var , main_parent_valider_var) {
    var grand_parent = gran_parent_var;
    var main_parent_valider =  main_parent_valider_var;
    var status_array = new Array();
    if(type == 'simple'){
        status_en_cours = grand_parent.find('select[name="resultatSelectionDashboardInput[]"]').val();
        console.log(status_en_cours);
        if(status_en_cours == '0'){
            main_parent_valider.prop("disabled", true);
        }else{
            main_parent_valider.prop("disabled", false);
        }
    }else{
        grand_parent.find(".child-table-tr").each(function () {
            var status_en_cours = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
            status_array.push(status_en_cours);
        });
        if(($.inArray('2', status_array)!==-1) || ($.inArray('2', status_array) == -1 && $.inArray('0', status_array) ==-1)){
            main_parent_valider.prop("disabled", false);
        }else{
            main_parent_valider.prop("disabled", true);
        }
    }
}

// fonction générale pour definir le status du ticket. Il regroupe toutes les autres fonctions.
function parisEnCoursCalculateStatus(tablename) {
    $(tablename+" select[name='resultatSelectionDashboardInput[]']").change(function () {

        var table = $(tablename);
        var mainrow = $(this).closest('.mainrow');
        var status = $(this).val();
        
        // connaitre le type de suivi suivant le type de pari.
        var hasSubrow = $(this).parents().hasClass('subrow');
            var type;
        if(!hasSubrow){
            type = 'simple';
        }else{
            type = 'combine';
        }
        console.log(hasSubrow);
        console.log(type);
        // pour le cas d'un pari simple.
        if(type == 'simple'){
            var type = mainrow.find('.type').text();
            var cote = mainrow.find('.tdcote').text(); 
            var mise = mainrow.find('.tdsubmise').text(); 
            var profits = mainrow.find('.profits');
            var devise = mainrow.find('.devise');
            
            var main_parent_valider = mainrow.find('.boutonvalider');
            
            // chargements des fonctions.
            //console.log('type= '+type+' status= '+status+' mainrow= '+mainrow+' profits='+profits+' mise= '+mise+' devise= '+devise);
            statusBoutonValider(type, mainrow, main_parent_valider);
            calculProfits(type, status, mainrow, profits, mise, devise);
        }
        else{
            // declaration des variables.
        var grand_parent = $(this).closest('.subrow');
        var main_parent = grand_parent.prev();
        var type = main_parent.find('.mainrow').text();
        var main_parent_valider = main_parent.find('.boutonvalider');
        var parent = $(this).closest('.child-table-tr');
        var child_id = parent.find(".child-id").text();
        var info = parent.find('input[name="childrowsinput[]"]').val();
        var mise = main_parent.find('.tdsubmise').text();
        var profits = main_parent.find('.profits');
        var devise = main_parent.find('.devise');
            
            // chargements des fonctions.
            statusBoutonValider(type, grand_parent, main_parent_valider);
            calculProfits(type, '', grand_parent, profits, mise, devise);
        }
    });
}

/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursDelete(tablename,formname,urlgiven){
    var table = $(tablename);
    var form = $(formname);
    var url = urlgiven;
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var id = parent.find('.id').text();
        var retour = parent.find('.tdretour span.subretour');
        var cote = parent.find(".tdcote").text();
        var mise = parent.find(".tdmise .tdsubmise").text();
        var ser = $(this).serialize();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url + id,
                        type: 'delete',
                        success: function (data) {
                            loadParisEnCoursWithPage('delete');
                            loadBookmakersOnDashboard();
                            if (data.etat == 0) {
                                toastr.error(data.msg, 'Suppression');
                            } else {
                                toastr.success(data.msg, 'Suppression');
                                loadBookmakersOnDashboard();
                            }
                        },
                        error: function () {
                            console.log("supprimer un pari en cours ne fonctionne pas");
                        }
                    });
                }
            });
    });
}
/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursEnclose(tablename,formname,urlgiven) {
    var table = $(tablename);
    var form = $(formname);
    var url = urlgiven;
// click sur le bouton valider du paris en cours , qui va le transferer vers historique(termineParis)
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var wrapper = $(this).closest('.wrapperRow');
        var retour = parent.find('.tdretour span.subretour');
        var id = parent.find('.id').text();
        var childrows = new Array();
        var childrowsstatus = new Array();
        var subrow = parent.next().find('.child-row input');
        var type = parent.find('.type').text();
        
        if(type == 'simple'){
            var status_val = parent.find('select[name="resultatSelectionDashboardInput[]"]').val();
            var info_val = parent.find('input[name="childrowsinput[]"]').val();
            childrows.push(info_val);
            childrowsstatus.push(status_val);
        }else{
            parent.next().find('input[name="childrowsinput[]"]').each(function () {
                childrows.push($(this).val());
            });
            parent.next().find('select[name="resultatSelectionDashboardInput[]"]').each(function () {
                childrowsstatus.push($(this).val());
            });
        }
            var ser = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                data: ser + '&ticket-id=' + id + '&childrowsinput[]=' + childrows + '&childrowsstatus[]=' + childrowsstatus,
                dataType: 'json',
                success: function (data) {

                    if (data.etat == 0) {
                        toastr.error(data.msg, 'Validation');
                    } else {
                        toastr.success(data.msg, 'Validation');
                        loadParisEnCours();
                        loadParisTermine();
                        loadBookmakersOnDashboard();
                        loadRecapsOnDashboard();
                    }
                },
                error: function () {
                    console.log("valider un pari en cours ne fonctionne pas");
                }
            });
    });
}
/**
 * Created by sebs on 19/04/2015.
 */

function parisTermineDelete(){
    var tablename = '#paristerminetable';
    var formname = '.supprimerform';
    var url = 'historique';
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var id = parent.find('.id').text();
        swal({
                title: "Etes-vous sur?",
                text: "Vous allez définitivement supprimer ce pari.",
                type: "Attention",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, le supprimer!",
                cancelButtonText: "Non, ne pas le supprimer!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url + id,
                        type: 'delete',
                        success: function (data) {
                            if (data.etat == 0) {
                                toastr.error(data.msg, 'Suppression');
                            } else {
                                toastr.success(data.msg, 'Suppression');
                                loadBookmakersOnDashboard();
                                loadRecapsOnDashboard();
                            }
                        },
                        error: function () {
                            console.log("supprimer un pari en cours ne fonctionne pas");
                        }
                    });
                }
            });
    });
}