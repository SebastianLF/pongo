/**
 * Created by sebs on 19/04/2015.
 */

function parisTermineDelete(){
    var tablename = $('#paristerminetable');
    tablename.find('.bouton-supprimer-historique-pari').click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        var l = Ladda.create(this);

        // pop-up de confirmation
        swal({
                title: "Supprimer le pari",
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

                    // ladda animation.
                    l.start();
                    $.ajax({
                        url: 'historique/' + id,
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
                        complete: function (){
                            l.stop();
                        }
                    });
                }
            });
    });
}