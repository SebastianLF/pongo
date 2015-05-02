/**
 * Created by sebs on 19/04/2015.
 */

function caclulProfits(){

}

function afficherStatusChilds(tablename){
    $(tablename+" select[name='resultatSelectionDashboardInput[]']").each(function () {
        var value = $(this).attr("data-value");
        $(this).val(value);
    });
}

function parisEnCoursCalculateStatus(tablename){

    $("select[name='resultatSelectionDashboardInput[]']").change( function(){
        var grand_parent = $(this).closest('.subrow');
        var parent = $(this).closest('.child-table-tr');
        var child_id = parent.find(".child-id").text();
        var child_status = $(this).val();
        $.ajax({
           url: 'selection',
            data: 'id='+child_id+'&status='+child_status,
            method: 'post',
            dataType: 'json',
            success : function(data){
                if(data.etat == 1){
                    toastr.success(data.message, 'Selection');
                    console.log(grand_parent.find(".child-table-tr").length);
                        grand_parent.find(".child-table-tr").each(function () {

                        });
                }
                else{
                    toastr.error(data.message, 'Selection');
                }

            },
            error: function(){
                console.log('erreur update selection');
            }
        });
    });
    var count = $("select[name='resultatSelectionDashboardInput[]']").length;


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
