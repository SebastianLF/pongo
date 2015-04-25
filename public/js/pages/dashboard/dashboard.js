/* pour afficher les books et compte associés en ajax*/
function showBooksAccounts(bookinput, accountinput) {
    var $books = $(bookinput);
    var $accounts = $(accountinput);

        var list_html = '<option></option>';
        $.ajax({
            url: 'bookmakers',
            data: 'book',
            dataType: 'json',
            success: function (json) {
                $.each(json, function (index, value) {
                    list_html += '<option value="' + value.id + '">' + value.nom + '</option>';
                });
                $books.html(list_html);
            }
        });

    $books.on('change', function () {
        var val = $(bookinput + ' option:selected').val(); //
        var list_html;
        if(val == ''){
            $accounts.html('');
        }else{
            console.log(val);
            $.ajax({
                url: 'accounts',
                data: {book_id: val},
                dataType: 'json',
                success: function (json) {
                    $.each(json, function (index, value) {
                        list_html += '<option value="' + value.pivot.id + '">' + value.pivot.nom_compte + '</option>';
                    });
                    $accounts.html(list_html);
                }
            });
        }

    });
}


/* pour afficher les tipsters et montant par unite et type de suivi*/
function showTipsters(tipsterinput, indiceuniteinput, followtypeinput) {
    var tipsters = $(tipsterinput);
    var indiceunite = $(indiceuniteinput);
    var followtype = $(followtypeinput);

    $.ajax({
        url: 'tipsters',
        dataType: 'json',
        success: function (json) {
            if (json.length > 0) {
                // nettoyage de la liste deroulante.
                tipsters.empty();

                // ajout des tipster dans la liste déroulante
                $.each(json, function (index, value) {
                    tipsters.append('<option value="' + value.id + '">' + value.name + '</option>');
                });

                // chargement des infos du premier tipster.
                indiceunite.val(json[0].indice_unite);
                $('#amountperunit').val(json[0].montant_par_unite);
                if (json[0].followtype == 'n') {
                    followtype.val('normal');
                } else {
                    followtype.val('à blanc');
                    $('#bookmakerrow').hide();
                }
            }
        }
    });

    tipsters.on('change', function () {
        var valtipster = $(this).val();
        indiceunite.empty();
        $('#amountinputdashboard').val('');

        // remettre a zero les select bookmaker et compte au changement de tipster.
        $('#bookinputdashboard').val('');
        $('#accountsinputdashboard').val('');
        $.ajax({
            url: 'infosTipster',
            data: {tipsterid: valtipster},
            dataType: 'json',
            success: function (json) {
                $('#stakeunitinputdashboard').val('');
                // chargement des infos du tipster selectionné.
                indiceunite.val(json.indice_unite);
                if (json.followtype == 'n') {
                    followtype.val('normal');
                    $('#bookmakerrow').fadeIn();
                } else {
                    followtype.val('à blanc');
                    $('#bookmakerrow').fadeOut();
                }
                $('#amountperunit').val(json.montant_par_unite);
            },
            error: function () {
                console.log('la recuperation du tipster dans le formulaire manuel d ajout de paris n\'a pas fonctionné');
            }
        });

    });
}

// suivant le type de mise choisi.
function typestakechoice() {
    var select = $('select[name=typestakeinputdashboard]');
    $('.typestakeflat').hide();
    select.on('change', function () {
        if ($(this).val() == 'f') {
            $('.typestakeunites').hide();
            $('#stakeunitinputdashboard').val('');
            $('.typestakeflat').show();
        } else {
            $('.typestakeunites').show();
            $('.typestakeflat').hide();
            $('#amountinputdashboard').val('');
        }
    });
}

function conversionUnitesVersMontant() {
    $('#stakeunitinputdashboard').keyup(function () {
        montant_par_unite = $('#amountperunit').val();
        indicateur_unite = parseFloat($('#stakeindicatorinputdashboard').val());
        unites = parseFloat($('#stakeunitinputdashboard').val());
        if (unites > indicateur_unite) {
            $('#stakeunitinputdashboard').val(indicateur_unite);
        } else if (unites < 0) {
            $('#stakeunitinputdashboard').val('0');
        }
        unites = $(this).val();
        var res = parseFloat(montant_par_unite) * parseFloat(unites);
        var final = isNaN(res) ? $('#amountconversion').val('0') : $('#amountconversion').val(res);
    });
}

function conversionMontantVersUnites() {
    $('#amountinputdashboard').keyup(function () {
        montant_par_unite = $('#amountperunit').val();
        indicateur_unite = $('#stakeindicatorinputdashboard').val();
        amount_max = montant_par_unite * indicateur_unite;
        if ($('#amountinputdashboard').val() > amount_max) {
            $('#amountinputdashboard').val(amount_max);
        } else if ($('#amountinputdashboard').val() < 0) {
            $('#amountinputdashboard').val('0');
        }
        montant_par_unite = $('#amountperunit').val();
        montant = $(this).val();
        var res = parseFloat(montant) / parseFloat(montant_par_unite);
        if (isNaN(res)) {
            $('#flattounitconversion').val('0');
        } else {
            $('#flattounitconversion').val(res.toFixed(2));
        }
    });
}


// pour les options.
$('#manubetform-add #systemeABCD').click(function () {
    $('#methodeabcdcontainer').removeClass("hide");

});
$('#manubetform-add #parislongterme ').click(function () {
    $('#methodeabcdcontainer').addClass("hide");
    $('#letterinputdashboard').empty();
    $('#serieinputdashboard').html('');
});
$('#manubetform-add #aucun').click(function () {
    $('#methodeabcdcontainer').addClass("hide");
    $('#letterinputdashboard').empty();
    $('#serieinputdashboard').html('');



});


// suppression dun pari en cours par le bouton adequat.
$('#wrapmanubetscontainer').on('click', '.supprlinebet', function () {
    $(this).closest('.betline').remove();
});

// ajout d'une ligne de pari.
$('#addlinebet').click(function () {
    var tr = '<tr class="betline"><td><input id="" name="datematchinputdashboard[]" class="form-control datematchinputdashboard" type="date"></td><td><div class="input-group"><input id="" name="sportinputdashboard[]" class="form-control sportinputdashboard"><div class="input-group-btn "><button id="" type="button" class="sportsselect btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button></div></div></td><td><select id="countryinputdashboard" name="countryinputdashboard[]" class="form-control"><option></option><option>france</option><option>espagne</option></select></td><td><select id="competitioninputdashboard" name="competitioninputdashboard[]" class="form-control"><option></option><option>Liga</option><option>premiere league</option></select></td><td width="120"><div class="input-group"><input name="team1inputdashboard[]" type="text" class="form-control" placeholder="equipe 1"><div class="input-group-btn"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right" role="menu"></ul></div></div></td><td width="120"><div class="input-group"><input name="team2inputdashboard[]" type="text" class="form-control" placeholder="equipe 2"><div class="input-group-btn"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right" role="menu"></ul></div></div></td><td><input id="picknameinputdashboard" name="picknameinputdashboard[]" class="form-control" placeholder="ex: OVER 2.5"></td><td><input id="choiceinputdashboard" name="choiceinputdashboard[]" class="form-control" placeholder="ex: 1,X ou 2"></td><td><input id="oddinputdashboard" name="oddinputdashboard[]" class="form-control" placeholder="ex: 1.83"></td><td><button type="button" class="btn btn-danger supprlinebet"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
    $('#addbetbuttontr').before(tr);
});

// ajout de pari.
$('#manubetform-add').submit(function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    var linesnum = $('#tablemanubetlines').find('.betline').length;
    if (linesnum == '') {

        swal({
            title: "Erreur!",
            text: "Remplissez au moins une selection pour pouvoir valider le ticket!",
            type: "warning",
            confirmButtonText: "Cool"
        });

    } else if (linesnum >= 1) {
        //serialize doesnt retrieve .text() of an input
        var tipstername = $("#tipstersinputdashboard option:selected").text();
        var bookname = $("#bookinputdashboard option:selected").text();
        $.ajax({
            url: 'encourspari',
            type: 'post',
            data: data + '&linesnum=' + linesnum + '&tipstername=' + tipstername + '&bookname=' + bookname,
            dataType: 'json',
            success: function (json) {

                var keyname;
                if (json.etat == 0) {
                    for (key in json.msg) {
                        keyname = key;
                        toastr.error(json.msg[keyname], 'Erreur:');
                    }
                } else if (json.etat == 1) {
                    toastr.success(json.msg, 'Pari');
                    loadParisEnCoursWithPage('add');
                    loadBookmakersOnDashboard();
                }


                /*for (var i = 0; i<linesnum; i++) {
                 console.log(i);
                 var tr = '<tr><td></td><td>'+json.typename+'</td><td>'+json.matchdate[i]+'</td><td>'+json.sport[i]+'</td><td>'+json.country[i]+'</td><td>'+json.competition[i]+'</td><td>'+json.matchname[i]+'</td><td>'+json.pickname[i]+'</td><td>'+json.stakeunit+'/'+json.stakeindicator+'</td><td>'+json.stakeamounttotal+'</td><td>'+json.odd[i]+'</td><td>'+json.bookname+'</td><td>'+json.tipstername+'</td><td class="etat"> <select><option></option><option>gagné</option><option>perdu</option><option>remboursé</option><option>annulé</option><option>1/2 victoire</option><option>1/2 defaite</option></select> </td><td>+ 40 €</td></tr>';
                 $('#lastbetstable').append(tr);
                 }*/
            },
            error: function (json) {
                console.log('erreur ajout de pari');
            }
        });

    }


});


// récuperation des noms et lettres des paris abcd dans le formulaire d'ajout de pari.
function getParisABCD() {

    /*$('#serieinputdashboard').click(function () {
     $.ajax({
     url: 'parisabcd',
     dataType: 'json',
     success: function (data) {
     $.each(data, function (index, value) {
     $('#serieinputdashboard').append('<option value="' + value.id + '">' + value.nom_abcd + '</option>');
     });
     },
     error: function () {
     console.log('probleme chargement paris abcd ');
     }
     });
     });
     $('#serieinputdashboard').change(function () {
     var nom = $('#serieinputdashboard').text();
     $.each({
     url: 'lettreabcd',
     data: nom,
     dataType: 'json',
     success: function (data) {
     console.log(data);
     $.each(data, function (index, value) {
     $('#letterinputdashboard').append('<option value="' + value.id + '">' + value.lettreabcd + '</option>');
     });
     },
     error: function () {
     console.log('probleme chargement lettre abcd ');
     }
     });
     });*/
}

// chargements des paris abcd dans le select input.
$('#serieinputdashboard').select2({
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
$("#serieinputdashboard").change(function () {
    var nom = $("#serieinputdashboard option:selected").text();
    nom = encodeURIComponent(nom);
    console.log(nom);
    $.ajax({
        url: "lettreabcd",
        data: 'serie_nom=' + nom,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#letterinputdashboard').html('');
            if(data == ''){
                $('#letterinputdashboard').append('<option value="terminé">terminé</option>');
            }else{
                $.each(data, function (index, value) {
                    $('#letterinputdashboard').append('<option value="' + value + '">' + value + '</option>');
                });
            }


        },
        error: function () {
            console.log('probleme chargement lettre systeme abcd')
        }
    });
});

$('.sportinputdashboard').select2({
    allowClear: true,
    placeholder: "Choisir un sport",
    cache: true,

    dropdownCssClass: 'bigdrop',
    ajax: {
        url: 'sports',
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
            return {
                results: data
            };
        }
    },
    templateResult: formatSport
});
$('.competitioninputdashboard').select2({
    allowClear: true,
    placeholder: "Choisir une competition",
    cache: true,

    ajax: {
        url: 'competitions',
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
            return {
                results: data
            };
        }
    }
    //templateResult: formatSport
});
function formatSport(data) {
    if (!data.id) {
        return data.text;
    }
    console.log(data.logo);

    var $data = $(
        '<span><img width="25px" class="" src="' + data.logo + '"/>' + data.text + '</span>'
    );
    return $data;
}
function formatLeague(data) {
    if (!data.id) {
        return data.text;
    }
    var $data = $(
        '<span><img src="img/logos/sports/' + data.text.toLowerCase() + '/' + data.text.toLowerCase() + '.jpg" width="25px" class="" /> ' + data.text + '</span>'
    );
    return $data;
}

$('.team1inputdashboard').select2();
$('.team2inputdashboard').select2();
$('.picknameinputdashboard').select2();
$('.choiceinputdashboard').select2();
