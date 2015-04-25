// charge sans vue.
$.ajax({
   url:'recaps',
   type:'get',
    dataType: 'json',
    success: function (json){
        $('[data-toggle="collapse"]').collapse();
        var container = $('#recaps .portlet-body');
        var annee = 3000;
        var mois = 30;
        var panel = '<div class="panel-group accordion" id=""><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#collapse_4_1"></a></h4></div><div id="collapse_4_1" class="panel-collapse in"><div class="panel-body"><ul></ul></div></div></div></div>';
        var panel_mois = $('.panel');
        var panel_annee = $('.panel-group');

        $.each(json, function(key ,val){
            if(annee == val.annee){

                if(mois == val.mois){

                    if(val.followtype == 'n'){var followtype = 'normal'}else if(val.followtype == 'b'){var followtype = 'à blanc'}else{console.log('type de suivi non conforme')}
                    var nouveau_tipster = '<li>'+val.tipster.name+'|'+val.montant_profit+'|<span class="label label-sm label-success label-mini">'+followtype+'</li>';
                    panel_mois.find('.panel-body ul').append(nouveau_tipster);
                }else{

                    if(val.mois == 1){mois = 'Janvier'}else if(val.mois == 2){mois = 'Février'}else if(val.mois ==3){mois = 'Mars'}else if(val.mois == 4){mois = 'Avril'}else if(val.mois == 5){mois = 'Mai'}else if(val.mois == 6){mois = 'Juin'}else if(val.mois == 7){mois = 'Juillet'}else if(val.mois == 8){mois = 'Aout'}else if(val.mois == 9){mois = 'Septembre'}else if(val.mois == 10){mois = 'Octobre'}else if(val.mois == 11){mois = 'Novembre'}else if(val.mois == 12){mois = 'Décembre'}
                    if(val.followtype == 'n'){var followtype = 'normal'}else if(val.followtype == 'b'){var followtype = 'à blanc'}else{console.log('type de suivi non conforme')}
                    panel = '<div class="panel panel-default panel-'+val.annee+'-'+val.mois+'" data-annee='+val.annee+' data-mois='+val.mois+'><div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#collapse_'+val.annee+'_'+val.mois+'">'+mois+'</a></h4></div><div  class="panel-collapse in" id="collapse_'+val.annee+'_'+val.mois+'"><div class="panel-body"><ul><li>'+val.tipster.name+'|'+val.montant_profit+'|<span class="label label-sm label-success label-mini">'+followtype+'</li></ul></div></div></div>';
                    panel_annee.append(panel);
                    panel_mois = $('.panel-'+val.annee+'-'+val.mois);
                    mois = val.mois;
                }
            }else{

                // affichage du nom du mois suivant le numero
                if(val.mois == 1){mois = 'Janvier'}else if(val.mois == 2){mois = 'Février'}else if(val.mois ==3){mois = 'Mars'}else if(val.mois == 4){mois = 'Avril'}else if(val.mois == 5){mois = 'Mai'}else if(val.mois == 6){mois = 'Juin'}else if(val.mois == 7){mois = 'Juillet'}else if(val.mois == 8){mois = 'Aout'}else if(val.mois == 9){mois = 'Septembre'}else if(val.mois == 10){mois = 'Octobre'}else if(val.mois == 11){mois = 'Novembre'}else if(val.mois == 12){mois = 'Décembre'}

                // affichage du nom du type de suivi.
                if(val.followtype == 'n'){var followtype = 'normal'}else if(val.followtype == 'b'){var followtype = 'à blanc'}else{console.log('type de suivi non conforme')}

                panel = '<div class="panel-group accordion panel-group-'+val.annee+'" >'+val.annee+'<div class="panel panel-default panel-'+val.annee+'-'+val.mois+'" data-annee='+val.annee+' data-mois='+val.mois+'><div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#collapse_'+val.annee+'_'+val.mois+'">'+mois+'</a></h4></div><div  class="panel-collapse" id="collapse_'+val.annee+'_'+val.mois+'"><div class="panel-body"><ul><li>'+val.tipster.name+'|'+val.montant_profit+'|<span class="label label-sm label-success label-mini">'+followtype+'</span></li></ul></div></div></div></div>';
                annee = val.annee;
                mois = val.mois;
                container.append(panel);
                panel_annee = $('.panel-group-'+val.annee);
                panel_mois = $('.panel-'+val.annee+'-'+val.mois);


            }
        });
    },
    error: function (){

    }
});