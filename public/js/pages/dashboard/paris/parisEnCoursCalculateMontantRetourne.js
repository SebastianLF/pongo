/**
 * Created by sebs on 19/04/2015.
 */

// calcul pour l affichage du profit du ticket.
function calculMontantRetourne(table) {
    table.on('change', 'select[name="status[]"]', function () {
        var $this = $(this);
        var main_parent,montant_retourne_input,mise,montant_retourne;
        if ($this.closest('tr .details').length > 0) {
            var status = [];
            var cote_general = 1;
            var details_block = $this.closest('tr.details');
            main_parent = details_block.prev('tr');
            montant_retourne_input = main_parent.find('input[name="amount-returned"]');
            details_block.find('select[name="status[]"]').each(function () {
                var this_child_status = $(this);
                var cote = Number(this_child_status.closest('td').prev('td').text());
                console.log(cote);
                status.push($(this).val());
                cote_general *= calcul_nouvelle_cote_par_rapport_a_status(cote, $(this).val());
            });
            mise = main_parent.find('.tdsubmise').text();
            console.log('status='+status+' cote='+cote_general+' mise='+mise);
            if(status.indexOf('0') > -1 && status.indexOf('2') == -1){montant_retourne_input.val('')}
            else if(status.indexOf('0') > -1 && status.indexOf('2') > -1){montant_retourne_input.val(0)}
            else{montant_retourne = cote_general * mise;montant_retourne_input.val(parseFloat(Math.round(montant_retourne * 1000) / 1000))}

        }else{
            main_parent = $this.closest('tr');
            montant_retourne_input = main_parent.find('input[name="amount-returned"]');
            status = $this.val();
            var cote = main_parent.find('.tdcote').text();
            mise = main_parent.find('.tdsubmise').text();
            if(status == '0'){montant_retourne_input.val('')}
            else{var nouvelle_cote = calcul_nouvelle_cote_par_rapport_a_status(cote, status);
                montant_retourne = nouvelle_cote * mise;
                montant_retourne_input.val(parseFloat(Math.round(montant_retourne * 1000) / 1000));}

        }
    });
}

function calcul_nouvelle_cote_par_rapport_a_status(cote, status){
    var cote_apres_status = 1;
    if (status == 0) {
        no_selection = true
    } else if (status == 1) {
        cote_apres_status *= cote;
    } else if (status == 2) {
        cote_apres_status *= 0;
        perdu_selection = 1;
    } else if (status == 3) {
        cote_apres_status = cote_apres_status * [(cote - 1) / 2 + 1];
    } else if (status == 4) {
        cote_apres_status = cote_apres_status * 0.5;
    } else if (status == 5) {
        cote_apres_status += 0;
    }
    return cote_apres_status;
}


// calcul pour l affichage du profit du ticket.
/*function calculProfits(type, status, grand_parent_var, profits_var, mise_var, devise_var) {
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
 var positive_color = 'font-green-sharp';
 var negative_color = 'font-red-haze';
 if (type == 'simple') {
 //console.log('type= '+type+' status= '+status+' mainrow= '+grand_parent+' profits='+profits+' mise= '+mise+' devise= '+devise);
 var cote = Number(grand_parent.find('.tdcote').text());
 if (status == 0) {
 no_selection = 1;
 } else if (status == 1) {
 cotes *= cote;
 } else if (status == 2) {
 cotes *= 0;
 perdu_selection = 1;
 } else if (status == 3) {
 cotes = cotes * [(cote - 1) / 2 + 1];
 } else if (status == 4) {
 cotes = cotes * 0.5;
 } else if (status == 5) {
 cotes += 0;
 }

 if (no_selection && !perdu_selection) {
 result = '';
 afficher_devise = false;
 status_en_attente = true;
 } else {
 afficher_devise = true;
 result = cotes * mise;
 result -= mise;
 result = Number(Math.round(result * 100) / 100);
 }
 if (result > 0) {
 profits.addClass(positive_color);
 devise.addClass(positive_color);
 profits.removeClass(negative_color);
 devise.removeClass(negative_color);
 profits.removeClass('font-gray');
 devise.removeClass('font-gray');
 } else if (result < 0) {
 profits.addClass(negative_color);
 devise.addClass(negative_color);
 profits.removeClass(positive_color);
 devise.removeClass(positive_color);
 profits.removeClass('font-gray');
 devise.removeClass('font-gray');
 } else {
 profits.addClass('font-gray');
 devise.addClass('font-gray');
 profits.removeClass(positive_color);
 devise.removeClass(positive_color);
 profits.removeClass(negative_color);
 devise.removeClass(negative_color);
 }
 if (afficher_devise) {
 devise.removeClass('hide');
 } else {
 devise.addClass('hide');
 }
 if (result > 0) {
 status_en_attente ? profits.html('+' + result) : profits.text('+' + result);
 } else {
 status_en_attente ? profits.html(result) : profits.text(result);
 }
 } else {
 //console.log('type= ' + type + ' status= ' + status + ' mainrow= ' + grand_parent + ' profits=' + profits + ' mise= ' + mise + ' devise= ' + devise);

 grand_parent.find(".child-table-tr").each(function () {
 var cote = Number($(this).find('.cote-td').text());
 var status = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
 if (status == 0) {
 no_selection = 1;
 } else if (status == 1) {
 cotes *= cote;
 } else if (status == 2) {
 cotes *= 0;
 perdu_selection = 1;
 } else if (status == 3) {
 cotes = cotes * [(cote - 1) / 2 + 1];
 } else if (status == 4) {
 cotes = cotes * 0.5;
 } else if (status == 5) {
 cotes += 0;
 }
 });

 if (no_selection && !perdu_selection) {
 result = '';
 afficher_devise = false;
 } else {
 afficher_devise = true;
 result = cotes * mise;
 result -= mise;
 result = Number(Math.round(result * 100) / 100);
 }

 if (result > 0) {
 profits.addClass(positive_color);
 devise.addClass(positive_color);
 profits.removeClass(negative_color);
 devise.removeClass(negative_color);
 profits.removeClass('font-gray');
 devise.removeClass('font-gray');
 } else if (result < 0) {
 profits.addClass(negative_color);
 devise.addClass(negative_color);
 profits.removeClass(positive_color);
 devise.removeClass(positive_color);
 profits.removeClass('font-gray');
 devise.removeClass('font-gray');
 } else {
 profits.addClass('font-gray');
 devise.addClass('font-gray');
 profits.removeClass(positive_color);
 devise.removeClass(positive_color);
 profits.removeClass(negative_color);
 devise.removeClass(negative_color);
 }

 if (afficher_devise) {
 devise.removeClass('hide');
 } else {
 devise.addClass('hide');
 }
 if (result > 0) {
 profits.text('+' + result);
 } else {
 profits.text(result);
 }
 }


 }

 // pour desactiver ou activer le bouton valider.
 function statusBoutonValider(type, gran_parent_var, main_parent_valider_var) {
 var grand_parent = gran_parent_var;
 var main_parent_valider = main_parent_valider_var;
 var status_array = new Array();
 if (type == 'simple') {
 var status_en_cours = grand_parent.find('select[name="resultatSelectionDashboardInput[]"]').val();
 console.log(status_en_cours);
 if (status_en_cours == '0') {
 main_parent_valider.prop("disabled", true);
 } else {
 main_parent_valider.prop("disabled", false);
 }
 } else {
 grand_parent.find(".child-table-tr").each(function () {
 var status_en_cours = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
 status_array.push(status_en_cours);
 });
 if (($.inArray('2', status_array) !== -1) || ($.inArray('2', status_array) == -1 && $.inArray('0', status_array) == -1)) {
 main_parent_valider.prop("disabled", false);
 } else {
 main_parent_valider.prop("disabled", true);
 }
 }
 }

 // fonction générale pour definir le status du ticket. Il regroupe toutes les autres fonctions.
 function parisEnCoursCalculateStatus(tablename) {
 $(tablename + " select[name='resultatSelectionDashboardInput[]']").change(function () {

 var table = $(tablename);
 var mainrow = $(this).closest('.mainrow');
 var status = $(this).val();

 // connaitre le type de suivi suivant le type de pari.
 var hasSubrow = $(this).parents().hasClass('subrow');
 var type;
 if (!hasSubrow) {
 type = 'simple';
 } else {
 type = 'combine';
 }
 //console.log(hasSubrow);
 //console.log(type);
 // pour le cas d'un pari simple.
 if (type == 'simple') {
 var type = mainrow.find('.type').text() == 'S' ? 'simple' : ''; // la condition correspond au string contenu dans le span correspondant au type de ticket dans la ligne du ticket
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
 else {
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
 */