//setInterval(refresh_selections, (5 * 1000));
function automaticBetForm() {

    var form = $('#automaticform-add');
    var form_string = '#automaticform-add';

    function ajouterTicket() {
        form.submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var linesnum = form.find('.betline').length;
            if (linesnum == '') {
                swal({
                    title: "Erreur!",
                    text: "Ajoutez au moins une selection pour pouvoir valider le ticket!",
                    type: "warning",
                    confirmButtonText: "OK"
                });
            } else if (linesnum >= 1) {
                //serialize doesnt retrieve .text() of an input
                var tipstername = form.find("#tipstersinputdashboard option:selected").text();
                var bookname = form.find("#bookinputdashboard option:selected").text();
                $.ajax({
                    url: 'encourspari/auto',
                    type: 'post',
                    data: data + '&linesnum=' + linesnum + '&tipstername=' + tipstername + '&bookname=' + bookname,
                    dataType: 'json',
                    success: function (json) {

                        var keyname;
                        if (json.etat == 0) {
                            if ($.isArray(json.msg)) {
                                for (key in json.msg) {
                                    alert(key);
                                    keyname = key;
                                    toastr.error(json.msg[keyname], 'Erreur:');
                                }
                            } else {
                                toastr.error(json.msg, 'Erreur:');
                            }

                        } else if (json.etat == 1) {
                            toastr.success(json.msg, 'Pari');
                            loadParisEnCours();
                            loadBookmakersOnDashboard();
                        }
                    },
                    error: function (json) {
                        console.log('erreur ajout de pari');
                    }
                });
            }
        });
    }

    // fonction de rafraichissement.
    function refreshSelections() {
        $.ajax({
            url: 'selections',
            success: function (data) {
        console.log(data);
                form.find('#automatic-selections').html(data.vue);
                $.ajax({
                    url: 'allbookmakers',
                    dataType: 'json'
                }).done(function(data2){
                    form.find('.bookinputdashboard').select2({
                        allowClear: true,
                        placeholder: "Choisir un bookmaker",
                        minimumResultsForSearch: Infinity,
                        cache: true,
                        data: data2
                    });

                    if(data.etat == 0){
                        if(data.bookmaker_id.length == 0){
                            data.msg.push("Aucun compte n\'a été crée pour ce bookmaker, rendez vous dans la page configuration pour le créer.");
                            form.find('.bookinputdashboard').val(null).trigger("change");
                        }else{
                            form.find('.bookinputdashboard').val(data.bookmaker_id).trigger("change");
                        }
                    }
                });
                if (data.etat == 0){
                    swal({
                        title: "Erreur!",
                        text: data.msg,
                        type: "warning",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (data) {
                form.find('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
            }
        });
    }

    // rafrachais les selections automatiquement toutes les 10 sec.
    function refreshSelectionsAuto() {

    }

    // supprime la selection.
    function supprimerSelectionAuto() {
        form.find('#automatic-selections .boutonsupprimer').click(function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var id = parent.find(".selection_id").text();
            $.ajax({
                url: 'coupon/' + id,
                method: 'delete',
                success: function (data) {
                    refreshSelections();
                },
                error: function (data) {
                }
            });
        });
    }

    // rafraichis les selections.*/
    function refreshSelectionsClick() {
        form.find('#selection-refresh').click(function (e) {
            e.preventDefault();
            refreshSelections();
        });
    }


    // initialisation
    refreshSelectionsClick();
    refreshSelections();
    ajouterTicket();
}




