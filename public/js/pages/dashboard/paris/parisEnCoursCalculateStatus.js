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
        status_en_attente ? profits.html(result) : profits.text(result);
    }else{
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
    }else {
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
    profits.text(result);
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
        var type = mainrow.find('.type').text();
        console.log(type);

        // pour le cas d'un pari simple.
        if(type == 'simple'){
            var cote = mainrow.find('.tdcote').text(); 
            var mise = mainrow.find('.tdsubmise').text(); 
            var profits = mainrow.find('.profits');
            var devise = mainrow.find('.devise');
            var status = $(this).val();
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
        var main_parent_valider = main_parent.find('.boutonvalider');
        var parent = $(this).closest('.child-table-tr');
        var child_id = parent.find(".child-id").text();
        var info = parent.find('input[name="childrowsinput[]"]').val();
        var mise = main_parent.find('.tdsubmise').text();
        var profits = main_parent.find('.profits');
        var devise = main_parent.find('.devise');
            // chargements des fonctions.
            statusBoutonValider(type, grand_parent, main_parent_valider);
            calculProfits(type, grand_parent, profits, mise, devise);
        }
    });
}
