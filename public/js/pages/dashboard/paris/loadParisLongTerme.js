function loadParisLongTerme() {
    var table = $('#parislongtermetable');
    var onglet_span = $('#onglet_paris_long_terme').find('span');
    $.ajax({
        url: 'dashboard/ajax/parislongterme',
        type: 'get',
        success: function (data) {

            // chargement des paris long terme dans la div.
            $('#tab_15_2').html(data.vue);
            $('#parislongtermetable').dataTable();

            // afficher le count dans le bon endroit.
            if (data.count_paris_longterme == 0) {
                onglet_span.text('');
            } else {
                onglet_span.html(data.count_paris_longterme);
            }

            // activation des tooltip.
            $('[data-toggle="tooltip"]').tooltip();

            // afficher le count dans le bon endroit.
            $('#onglet_paris_long_terme span').text($('#parislongtermetable #count').text());

            // mise en variable des differentes balises.
            var table = $("#parislongtermetable");
            var boutonvalider = $("#parislongtermetable .boutonvalider");
            var bouton_supprimer = $("#parislongtermetable .boutonsupprimer");
            var form_valider = $("#parislongtermetable .validerform");
            var form_supprimer = $("#parislongtermetable .supprimerform");
            var resultat = $("#parislongtermetable select[name='resultatDashboardInput']");
            var resultat_select = $("#parislongtermetable select[name='resultatDashboardInput'] option:selected");

            // active les tooltip.
            $('[data-toggle="tooltip"]').tooltip();

            // stopper la propagation quand on click sur le bouton valider.
            boutonvalider.click(function (e) {
                e.stopPropagation();
            });

            // stopper la propagation quand on click sur le bouton supprimer.
            bouton_supprimer.click(function (e) {
                e.stopPropagation();
            });

            // stopper la propagation quand on click sur le choix du resultat.
            resultat.click(function (e) {
                e.stopPropagation();
            });

            // calcul du montant retour par rapport au resultat selectionné
            resultat.change(function (e) {
                var parent = $(this).closest('.mainrow');
                var cote = parent.find(".tdcote").text();
                var mise = parent.find(".tdmise .tdsubmise").text();
                var tdsubretour = parent.find('.tdretour span.subretour');
                var tdretour = parent.find('.tdretour');

                switch (result = parent.find("select[name='resultatDashboardInput'] option:selected").text()) {
                    case '--Selectionnez--':
                        tdsubretour.empty();
                        tdretour.css("color", "black");
                        break;
                    case "Gagné":
                        var retour = parseFloat(mise * cote);
                        tdretour.css("color", "green");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Perdu":
                        var retour = parseFloat(mise);
                        tdretour.css("color", "red");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "1/2 Gagné":
                        var retour = parseFloat((mise * cote - mise) / 2) + parseFloat(mise);
                        tdretour.css("color", "green");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "1/2 Perdu":
                        var retour = parseFloat(mise / 2);
                        tdretour.css("color", "red");
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Remboursé":
                        tdretour.css("color", "black");
                        var retour = parseFloat(mise);
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                    case "Annulé":
                        tdretour.css("color", "black");
                        var retour = parseFloat(mise);
                        parent.find('.tdretour span.subretour').text(retour);
                        break;
                }
            });

            // click sur le bouton valider du paris long terme ,
            // qui va le transferer vers historique et recharger les paris long terme.
            form_valider.submit(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.mainrow');
                var retour = parent.find('.tdretour span.subretour');
                if (retour.text().length > 0) {
                    var cote = parent.find(".tdcote").text();
                    var mise = parent.find(".tdmise .tdsubmise").text();
                    var ser = $(this).serialize();
                    $.ajax({
                        url: 'historique',
                        type: 'post',
                        data: ser + '&cote=' + cote + '&mise=' + mise + '&retour=' + retour,
                        success: function (json) {
                            loadParisLongTerme();
                        },
                        error: function () {
                            console.log("valider un pari long terme ne fonctionne pas");
                        }
                    });
                } else {
                    alert('Vous devez préciser un status pour ce pari.');
                }
            });

            // click sur le bouton supprimer qui va supprimer le pari et recharger les paris long terme.
            form_supprimer.submit(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.mainrow');
                var id = parent.find('.id').text();
                var retour = parent.find('.tdretour span.subretour');
                var cote = parent.find(".tdcote").text();
                var mise = parent.find(".tdmise .tdsubmise").text();
                var ser = $(this).serialize();
                if(confirm("Etes vous sur?")){
                    $.ajax({
                        url: 'historique/' + id,
                        type: 'delete',
                        success: function (json) {
                            loadParisLongTerme();
                        },
                        error: function () {
                            console.log("supprimer un pari long terme ne fonctionne pas");
                        }
                    });
                }
            });
        },
        error: function (data) {
            console.log("le chargement des paris long terme n\'a pas fonctionné");

        }
    });
}

