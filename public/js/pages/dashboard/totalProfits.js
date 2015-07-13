/**
 * Created by seb on 12/07/2015.
 */

function totalProfits(){
    $.getJSON( "totalprofit", function(data) {
        var parent = $('.dashboard-stat2');
        parent.find('.totalprofit').text(data.montantprofit);

        // gestion pour l'affichage du pourcentage ou pas.
        if($.isNumeric(data.roi)){
            parent.find('.roi').text(data.roi+' %');
        }else{
            parent.find('.roi').text(data.roi);
        }

        // taille de la barre.
        parent.find('.roi-bar').css( "width", data.roi );
    })
}