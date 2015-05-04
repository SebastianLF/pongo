/**
 * Created by sebs on 19/04/2015.
 */

// calcul pour l affichage du profit du ticket.
function calculProfits(grand_parent_var, profits_var, mise_var, devise_var) {
    var mise = mise_var;
    var result = mise;
    var grand_parent = grand_parent_var;
    var profits = profits_var;
    var devise = devise_var;
    var no_selection;
    var perdu_selection;
    var cotes = 1;
    grand_parent.find(".child-table-tr").each(function () {
        var cote = Number($(this).find('.cote-td').text());
        console.log(cote);
        cotes = cote * cotes;
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
        console.log(cotes);
    });

    if(no_selection && !perdu_selection){
        result = '';
    }else {
        result = cotes * mise;
        result -= mise;
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
    profits.text(result);
}

// pour desactiver ou activer le bouton valider.
function statusBoutonValider(gran_parent_var , main_parent_valider_var) {
    var grand_parent = gran_parent_var;
    var main_parent_valider =  main_parent_valider_var;
    var status_array = new Array();
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

// fonction générale pour definir le status du ticket. Il regroupe toutes les autres fonctions.
function parisEnCoursCalculateStatus(tablename) {
    $(tablename+" select[name='resultatSelectionDashboardInput[]']").change(function () {

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
        statusBoutonValider(grand_parent, main_parent_valider);
        calculProfits(grand_parent, profits, mise, devise);
    });
}
