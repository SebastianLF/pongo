/**
 * Created by seb on 04/10/2015.
 */

/* Formatting function for row details */
function fnFormatDetailsForChildsParisEnCours(oTable, selections, type) {
    //var aData = oTable.fnGetData(nTr);

    console.log(selections);

    var sOut;
    var sTdChild;

    // simple = on affiche pas le select input du tout le select input dans chacunes des selections, combine = on affiche le select input dans chacunes des selections.

    sOut = '<table class="table table-condensed table-paris-child"><thead><tr class="uppercase"><th>date</th><th>sport</th><th>competition</th><th>pari</th><th>cote</th><th>status</th></tr></thead><tbody>';

    // affichage de chaque selection dans le child table
    $.each(selections, function (key, value) {
        var rencontre;

        // afficher la rencontre ou pas.
        if (value.game_name == null) {
            rencontre = ''
        } else {
            rencontre = value.equipe1.name + ' - ' + value.equipe2.name + ' / ';
        }

        function affichageScore() {
            if (value.score == '' || value.score == null) {
                return '';
            } else {
                return value.score + ' LIVE!'
            }
        }

        console.log(value.status);

        // structure de representation d'une ligne pour les combinés.
        sOut +=
            '<tr data-selection-id="' + value.id + '">' +
            '<td>' + moment.tz(value.date_match, 'Europe/Paris').tz(user.timezone).format("DD/MM/YYYY HH:mm") + '</td>' +
            '<td>' + value.sport.name + '</td>' +
            '<td>' + value.competition.name + '</td>' +
            '<td>' + rencontre + '<span class="blue">' + value.pariAffichage + '</span>' + ' <span class="label label-sm label-danger label-mini">' + affichageScore() + '</span></td>' +
            '<td>' + parseFloat(Math.round(value.cote * 1000) / 1000) + '</td>' +
            '<td class=""><select name="status[]" data-value="" data-defaut-value="' + value.status + '" class="form-control inputs-ticket"><option value="0">-Choisir-</option><option value="1">Gagné</option><option value="2">Perdu</option><option value="3">1/2 Gagné</option><option value="4">1/2 Perdu</option><option value="5">Remboursé</option></select></td>'
            +
            '</tr>';

    });
    sOut += '</tbody></table>';

    return sOut;
}

/* Formatting function for row details */
function fnFormatDetailsForChildsParisTermine(oTable, selections, type) {
    //var aData = oTable.fnGetData(nTr);

    console.log(selections);

    var sOut;
    var sTdChild;

    // simple = on affiche pas le select input du tout le select input dans chacunes des selections, combine = on affiche le select input dans chacunes des selections.

    sOut = '<table class="table table-condensed table-paris-child"><thead><tr class="uppercase"><th>date</th><th>sport</th><th>competition</th><th>pari</th><th>cote</th><th>status</th></tr></thead><tbody>';

    // affichage de chaque selection dans le child table
    $.each(selections, function (key, value) {
        var rencontre;

        // afficher la rencontre ou pas.
        if (value.game_name == null) {
            rencontre = ''
        } else {
            rencontre = value.equipe1.name + ' - ' + value.equipe2.name + ' / ';
        }

        function affichageScore() {
            if (value.score == '' || value.score == null) {
                return '';
            } else {
                return value.score + ' LIVE!'
            }
        }

        console.log(value.status);

        // structure de representation d'une ligne pour les combinés.
        sOut +=
            '<tr data-selection-id="' + value.id + '">' +
            '<td>' + moment.tz(value.date_match, 'Europe/Paris').tz(user.timezone).format("DD/MM/YYYY HH:mm") + '</td>' +
            '<td>' + value.sport.name + '</td>' +
            '<td>' + value.competition.name + '</td>' +
            '<td>' + rencontre + '<span class="blue">' + value.pariAffichage + '</span>' + ' <span class="label label-sm label-danger label-mini">' + affichageScore() + '</span></td>' +
            '<td>' + parseFloat(Math.round(value.cote * 1000) / 1000) + '</td>' +
            '<td class=""><select name="status[]" data-value="" data-defaut-value="' + value.status + '" class="form-control inputs-ticket"><option value="0">-Choisir-</option><option value="1">Gagné</option><option value="2">Perdu</option><option value="3">1/2 Gagné</option><option value="4">1/2 Perdu</option><option value="5">Remboursé</option></select></td>'
            +
            '</tr>';

    });
    sOut += '</tbody></table>';

    return sOut;

}


function loadNeededWhenAddToHistory() {
    loadParisTermine();
    loadBookmakersOnDashboard();
    loadGeneralRecapsOnDashboard();
    totalProfits();
}

function loadNeededWhenAddToCurrentBets() {
    loadParisEnCours();
    loadParisLongTerme();
    loadParisABCD();
    loadBookmakersOnDashboard();
}

function cashOut() {

    var modal = $('#cashoutModal');
    // passage de parametres vers le modal.
    modal.on('show.bs.modal', function (e) {

        //get data-id attribute of the clicked element
        var pari_id = $(e.relatedTarget).data('id');

        //populate the textbox
        $(e.currentTarget).find('input[name="ticket-id"]').val(pari_id);
    });

    // cash out modal
    var cashout_form = $('#cashout-update');
    var cashout_select = cashout_form.find('#cashout-select');
    var cashout_array = [{id: 'c', text: 'classic cash out'}, {id: 'p', text: 'partial cash out'}];
    cashout_select.select2({
        minimumResultsForSearch: Infinity,
        cache: true,
        data: cashout_array
    });


    // envoi du form.
    cashout_form.submit(function (e) {
        e.preventDefault();
        var inputs = cashout_form.serialize();
        $.ajax({
            url: 'cashout',
            type: 'post',
            data: inputs,
            dataType: 'json',
            success: function (data) {
                if (data.etat) {
                    toastr.success(data.msg, data.head);
                    loadParisEnCours();
                    loadParisTermine();
                    loadBookmakersOnDashboard();
                    loadParisLongTerme();
                    loadGeneralRecapsOnDashboard();
                    modal.hide();

                } else {
                    for (key in data.msg) {
                        keyname = key;
                        toastr.error(data.msg[keyname], 'Erreur:');
                    }
                }
            },
            error: function () {

            }
        });
    });
}


