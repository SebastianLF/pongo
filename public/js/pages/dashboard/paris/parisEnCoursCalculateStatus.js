/**
 * Created by sebs on 19/04/2015.
 */

function calculProfits(grand_parent_var, profits_var, mise_var) {
    var mise = mise_var;
    var result = mise;
    var grand_parent = grand_parent_var;
    var profits = profits_var;
    grand_parent.find(".child-table-tr").each(function () {
        var cote = $(this).find('.cote-td').text();
        var status = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
        if(status == 0){
            result = '';
        }else if(status == 1) {
            result *= cote;
        }else if(status == 2) {
            result *= 0 ;

        }else if(status == 3){
            result = result * [(cote-1)/2+1];
        }else if(status == 4){
            result = result / 2;
        }else if(status == 5){
            result = Number(result + 0);
        }
    });
    if(($.inArray('2', status_array)!==-1) || ($.inArray('2', status_array) == -1 && $.inArray('0', status_array) ==-1)){
        
    }else{
        main_parent_valider.prop("disabled", true);
    }
    if(result == ''){
        result = 0;
    }
    result -= mise;
    console.log(mise);
    profits.text(result);
}

// pour desactiver ou activer le bouton valider.
function statusBoutonValider(gran_parent_var , main_parent_valider_var) {
    var grand_parent = gran_parent_var;
    var main_parent_valider =  main_parent_valider_var;
    var status_array = new Array();
    grand_parent.find(".child-table-tr").each(function () {
        var status_en_cours = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
        console.log(status_en_cours);
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

        // chargements des fonctions.
        statusBoutonValider(grand_parent, main_parent_valider);
        calculProfits(grand_parent, profits, mise);
    });


        /*var result = mise;
        grand_parent.find(".child-table-tr").each(function () {
            var cote = $(this).find('.cote-td').text();
            var status = $(this).find('select[name="resultatSelectionDashboardInput[]"]').val();
            if(status == 0){

            }else if(status == 1) {
                result *= cote;
            }else if(status == 2) {
                result *= 0 ;

            }else if(status == 3){
                result = result * [(cote-1)/2+1];
            }else if(status == 4){
                result = result / 2;
            }else if(status == 5){
                result = Number(result + 0);
            }
        });
        result -= mise;
        profits.text(result);*/

        /*$.ajax({
            url: 'selection',
            data: 'id=' + child_id + '&status=' + child_status + '&info=' + info,
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.etat == 1) {
                    //console.log(grand_parent.find(".child-table-tr").length);


                    toastr.success(data.message, 'Selection');
                }
                else {
                    toastr.error(data.message, 'Selection');
                }

            },
            error: function () {
                console.log('erreur update selection');
            }
        });*/




    // calcul du montant retour par rapport au resultat selectionné
    //$( tablename+" "+"select[name='resultatSelectionDashboardInput']").change(function (e) {


    /*switch (result = parent.find("select[name='resultatDashboardInput'] option:selected").val()) {
     case "0":
     tdsubretour.empty();
     tdretour.css("color", "black");
     break;
     case "1":
     var retour = mise * cote;
     retour = (Math.round(retour * 100) / 100).toFixed(2);

     tdretour.css("color", "green");
     parent.find('.tdretour span.subretour').text(retour);
     break;
     case "2":
     var retour = (Math.round(mise * 100) / 100).toFixed(2);
     tdretour.css("color", "red");
     parent.find('.tdretour span.subretour').text(retour);
     break;
     case "3":
     var retour = Number((mise * cote - mise) / 2) + Number(mise);
     retour = (Math.round(retour * 100) / 100).toFixed(2);
     tdretour.css("color", "green");
     parent.find('.tdretour span.subretour').text(retour);
     break;
     case "4":
     var retour = parseFloat(mise / 2);
     tdretour.css("color", "red");
     parent.find('.tdretour span.subretour').text(retour);
     break;
     case "5":
     tdretour.css("color", "black");
     var retour = parseFloat(mise);
     parent.find('.tdretour span.subretour').text(retour);
     break;
     case "6":
     tdretour.css("color", "black");
     var retour = parseFloat(mise);
     parent.find('.tdretour span.subretour').text(retour);
     break;
     }*/

}
