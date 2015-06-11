//setInterval(refresh_selections, (5 * 1000));
function automaticBetForm() {

    function ajouterTicket(){
        $('#automaticform-add').submit(function (e) {
            e.preventDefault();
            var form = $('#automaticform-add');
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
                            for (key in json.msg) {
                                keyname = key;
                                toastr.error(json.msg[keyname], 'Erreur:');
                            }
                        } else if (json.etat == 1) {
                            toastr.success(json.msg, 'Pari');
                            loadParisEnCoursWithPage('add');
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


    // rafrachais les selections automatiquement toutes les 10 sec.
    function refreshSelectionsAuto() {
        $.ajax({
            url: 'selections',
            success: function (data) {
                $('#automatic-selections').html(data);
                supprimerSelectionAuto();
            },
            error: function (data) {
                $('#automatic-selections').html('<p>impossible de récuperer les selections</p>');
            }
        });
    }

    // supprime la selection.
    function supprimerSelectionAuto() {
        $('#automatic-selections .boutonsupprimer').click(function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var id = parent.find(".selection_id").text();
            alert(id);
            $.ajax({
                url: 'coupon/' + id,
                method: 'delete',
                success: function (data) {
                    refreshSelectionsAuto();
                },
                error: function (data) {
                }
            });
        });
    }

    // rafraichis les selections.
    $('#selection-refresh').click(function (e) {
        e.preventDefault();
        refreshSelectionsAuto();
    });



    // gestion du formulaire concernant uniquement la partie personnalisée pour le formulaire automatique.


    // initialisation
        refreshSelectionsAuto();
        supprimerSelectionAuto();
        // gestion du formulaire concernant uniquement la partie générale.
        generalBetForm('#automaticform-add');
        ajouterTicket();
}




