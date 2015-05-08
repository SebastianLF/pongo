/**
 * Created by sebs on 19/04/2015.
 */

function parisTermineDelete(){
    var tablename = '#paristerminetable';
    var formname = '.supprimerform';
    var url = 'historique';
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var id = parent.find('.id').text();
        swal({
                title: "Etes-vous sur?",
                text: "Vous allez définitivement supprimer ce pari.",
                type: "Attention",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, le supprimer!",
                cancelButtonText: "Non, ne pas le supprimer!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url + id,
                        type: 'delete',
                        success: function (data) {
                            loadParisTermine();
                            loadBookmakersOnDashboard();
                            if (data.etat == 0) {
                                toastr.error(data.msg, 'Suppression');
                            } else {
                                toastr.success(data.msg, 'Suppression');
                                loadBookmakersOnDashboard();
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