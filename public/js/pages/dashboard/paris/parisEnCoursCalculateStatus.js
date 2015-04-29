/**
 * Created by sebs on 19/04/2015.
 */


function parisEnCoursCalculateStatus(tablename){
    // calcul du montant retour par rapport au resultat selectionné
    $( tablename+" "+"select[name='resultatDashboardInput']").change(function (e) {
        var parent = $(this).closest('.mainrow');
        var cote = parent.find(".tdcote").text();
        var mise = parent.find(".tdmise .tdsubmise").text();
        var tdsubretour = parent.find('.tdretour span.subretour');
        var tdretour = parent.find('.tdretour');
        switch (result = parent.find("select[name='resultatDashboardInput'] option:selected").val()) {
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
        }
    });
}
