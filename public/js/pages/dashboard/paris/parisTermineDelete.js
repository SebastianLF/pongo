/**
 * Created by sebs on 19/04/2015.
 */

function parisTermineDelete(){
    var tablename = '#paristerminetable';
    var formname = '.supprimerform';
    var url = 'historique/';
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var id = parent.find('.id').text();
        swal({
                title: "Supprimer le ticket",
                text: "Etes-vous sur?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui!",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url + id,
                        type: 'delete',
                        success: function (data) {
                            if (data.etat == 0) {
                                toastr.error(data.msg, 'Suppression');
                            } else {
                                toastr.success(data.msg, 'Suppression');
                                loadParisTermine();
                                loadBookmakersOnDashboard();
                                loadGeneralRecapsOnDashboard();
                            }
                        },
                        error: function () {
                            console.log("supprimer un pari en cours ne fonctionne pas");
                        }
                    });
                }
            });
    });
}