/**
 * Created by seb on 04/10/2015.
 */

/* Formatting function for row details */
function fnFormatDetailsForChildsParisEnCours(oTable, selections, type) {
    //var aData = oTable.fnGetData(nTr);

    var sOut;
    var sTdChild;

    // simple = on affiche pas le select input du tout le select input dans chacunes des selections, combine = on affiche le select input dans chacunes des selections.
    if(type == 'c'){
        sOut = '<table class="table table-condensed table-paris-child"><thead><tr class="uppercase"><th>date rencontre</th><th>sport</th><th>competition</th><th>rencontre</th><th>pari</th><th>cote</th><th>status</th></tr></thead><tbody>';
        sTdChild = '<td class="uppercase"><select name="status[]" data-value="" class="form-control inputs-ticket"><option value="0">-Choisir-</option><option value="1">Gagné</option><option value="2">Perdu</option><option value="3">1/2 Gagné</option><option value="4">1/2 Perdu</option><option value="5">Remboursé</option></select></td>';
    }else if(type == 's'){
        sOut = '<table class="table table-condensed table-paris-child"><thead><tr class="uppercase"><th>date rencontre</th><th>sport</th><th>competition</th><th>rencontre</th><th>pari</th><th>cote</th></tr></thead><tbody>';
        sTdChild = '';
    }else{
        sOut = '';
    }

    // affichage de chaque selection dans le child table
    $.each(selections, function (key, value) {
        var rencontre;

        // afficher la rencontre ou pas.
        if (value.game_name == null) {
            rencontre = 'N/A'
        } else {
            rencontre = '<span><img src="img/flags/' + value.equipe1.country.shortname + '.png" class="img-flag"> ' + value.equipe1.name + ' - </span>' + '<span><img src="img/flags/' + value.equipe2.country.shortname + '.png" class="img-flag"> ' + value.equipe2.name + '</span>'
        }

        function affichageScore(){
            if(value.score == '' || value.score == null){
                return '';
            }else{return '('+value.score+'LIVE!)'}
        }

        // structure de representation d'une ligne.
        sOut +=
            '<tr>' +
            '<td>' + moment.tz(value.date_match, 'Europe/Paris').tz(user.timezone).format("DD/MM/YYYY HH:mm") + '</td>' +
            '<td>' + value.sport.name + '</td>' +
            '<td>' + value.competition.name + '</td>' +
            '<td>' + rencontre + '</td>' +
            '<td>' + value.pariAffichage + ' ('+ value.scope.representation + ')' + affichageScore() + '</td>' +
            '<td>' + value.cote + '</td>' +
            sTdChild +
            '</tr>';
    });
    sOut += '</tbody></table>';

    return sOut;
}
