function deleteBookmakerButton() {
    $('.bookmakerDeleteButton').click(function (e) {
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find(".idbookmakertd").text();
        console.log(id);
        swal({
                title: "Supprimer",
                text: "Etes vous sur ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, supprimer",
                cancelButtonText: "Non, annuler",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: 'bookmaker/' + id,
                        method: "DELETE",
                        data: {id: $('#idbookmakertd').text()},
                        success: function (json) {
                            //parent.fadeOut("slow");
                            if (json.success) {
                                toastr.success(json.compte.nom_compte + ' à été supprimé avec succès', 'Compte de bookmaker');
                                loadBookmakers();
                            } else {
                                toastr.error('Vous devez d\'abord supprimer les paris en cours liés à <strong>' + json.compte.nom_compte + '</strong> !', 'Compte de bookmaker');
                            }
                        },
                        error: function () {
                            console.log('la suppression du compte bookmaker n\'a pas fonctionné');
                        }
                    });
                }

            });
    });
}



