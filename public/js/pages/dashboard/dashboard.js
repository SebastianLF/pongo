

$("#bookinputdashboard").prop("disabled", true);
$("#accountsinputdashboard").prop("disabled", true);
$('#methodeabcdcontainer').addClass("hide");

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
    var form = $('#automaticform-add');
    form.find('#stakeunitinputdashboard').keyup(function () {
        var montant_par_unite = form.find('#amountperunit').val();
        var unites = Number(form.find('#stakeunitinputdashboard').val());
        if (unites < 0) {
            form.find('#stakeunitinputdashboard').val('0');
        }
        unites = $(this).val();
        var res = Number(montant_par_unite) * Number(unites);

        var final = isNaN(res) ? form.find('#amountconversion').val('0') : form.find('#amountconversion').val(res);
    });
}

function conversionMontantVersUnites() {
    $('#amountinputdashboard').keyup(function () {
        var montant_par_unite = $('#amountperunit').val();
        var indicateur_unite = $('#stakeindicatorinputdashboard').val();
        var amount_max = montant_par_unite * indicateur_unite;
        if ($('#amountinputdashboard').val() > amount_max) {
            $('#amountinputdashboard').val(amount_max);
        } else if ($('#amountinputdashboard').val() < 0) {
            $('#amountinputdashboard').val('0');
        }
        montant_par_unite = $('#amountperunit').val();
        var montant = $(this).val();
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
    $('#serieinputdashboard').val(null).trigger("change");
});
$('#manubetform-add #aucun').click(function () {
    $('#methodeabcdcontainer').addClass("hide");
    $('#letterinputdashboard').empty();
    $('#serieinputdashboard').val(null).trigger("change");
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



$('.tipstersinputdashboard').select2({
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

$('#tipstersinputdashboard').change(function () {
    var tipster_id = $('#tipstersinputdashboard').val();
    var followtype = $('#followtypeinputdashboard');
    var montant_par_unite = $('#amountperunit');

    // remise a zero des champs liés.
    $('#stakeunitinputdashboard').val('');
    $('#amountconversion').val('0');
    $('#amountinputdashboard').val('');
    $('#flattounitconversion').val('0');
    $.ajax({
        url: 'infosTipster',
        data: 'tipster_id=' + tipster_id,
        dataType: 'json',
        success: function (data) {
            $('#bookinputdashboard').val(null).trigger("change");
            $('#accountsinputdashboard').val(null).trigger("change");
            followtype.val('');
            if (data.followtype == 'n') {
                followtype.val('normal');
                $("#bookinputdashboard").prop("disabled", false);
                $("#accountsinputdashboard").prop("disabled", false);
            } else if (data.followtype == 'b') {
                followtype.val('à blanc');
                $("#bookinputdashboard").prop("disabled", true);
                $("#accountsinputdashboard").prop("disabled", true);
            }
            montant_par_unite.val(data.montant_par_unite);
        },
        error: function (data) {
        }
    });
});

$('#bookinputdashboard').select2({
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

$('#accountsinputdashboard').select2({
    allowClear: true,
    placeholder: "Choisir un compte",
    cache: true,
    minimumResultsForSearch: Infinity,
    ajax: {
        url: 'accounts',
        dataType: 'json',
        data: function (params) {
            return {
                book_id: $('#bookinputdashboard').val(),
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
$('#letterinputdashboard').select2({
    allowClear: true,
    placeholder: "Choisir une lettre",
    cache: true,
    minimumResultsForSearch: Infinity,
    ajax: {
        url: 'lettreabcd',
        dataType: 'json',
        data: function (params) {
            return {
                serie_nom: $('#serieinputdashboard').val(),
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
$("#serieinputdashboard").change(function () {
    var nom = $("#serieinputdashboard option:selected").text();
    nom = encodeURIComponent(nom);
    console.log(nom);
    $("#letterinputdashboard").val(null).trigger("change");
    $.ajax({
        url: "lettreabcd",
        data: 'serie_nom=' + nom,
        dataType: 'json',
        success: function (data) {
            /* $('#letterinputdashboard').html('');
             if (data == '') {
             $('#letterinputdashboard').append('<option value="terminé">terminé</option>');
             } else {
             $.each(data, function (index, value) {
             console.log(value);
             $('#letterinputdashboard').push({ id: value, text: value });
             });
             }*/
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
    }
    //templateResult: formatSport
});

$('.sportinputdashboard').change(function () {
    $('.competitioninputdashboard').val(null).trigger("change");
    $('.team1inputdashboard').val(null).trigger("change");
    $('.team2inputdashboard').val(null).trigger("change");
});
$('.competitioninputdashboard').change(function () {
    $('.team1inputdashboard').val(null).trigger("change");
    $('.team2inputdashboard').val(null).trigger("change");
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
                sport_id: $('.sportinputdashboard').val(),
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
    //templateResult: formatLeague
});
function formatSport(data) {
    if (!data.id) {
        return data.text;
    }
    var $data = $(
        '<span><img width="25px" class="" src=""/>' + data.text + '</span>'
    );
    return $data;
}
function formatLeague(data) {
    if (!data.id) {
        return data.text;
    }
    console.log(data.logo);
    var $data = $(
        '<span><img width="25px" class="" src=""/>' + data.text + '</span>'
    );
    return $data;
}

$('.team1inputdashboard').select2({
    allowClear: true,
    placeholder: "Choisir une équipe",
    cache: true,
    ajax: {
        url: 'equipes',
        dataType: 'json',
        data: function (params) {
            return {
                adversaire_id: $('.team2inputdashboard').val(),
                competition_id: $('.competitioninputdashboard').val(),
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
    //templateResult: formatLeague
});
$('.team2inputdashboard').select2({
    allowClear: true,
    placeholder: "Choisir une équipe",
    cache: true,
    ajax: {
        url: 'equipes',
        dataType: 'json',
        data: function (params) {
            return {
                adversaire_id: $('.team1inputdashboard').val(),
                competition_id: $('.competitioninputdashboard').val(),
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
    //templateResult: formatLeague
});
$('.picknameinputdashboard').select2();

