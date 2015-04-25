function tipsterDelete() {
    $('#tipsterstable').on('click', '.tipsterDeleteButton', function (e) {
        e.preventDefault();
        var parent = $(this).parents('tr');
        var url1 = parent.find(".idtipstertd").text();
        var url = 'tipster/' + url1;
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
                        url: url,
                        method: "DELETE",
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                toastr.success(data.tipster.name + ' supprimé avec <strong>succès</strong> !', 'Tipster');
                                loadTipstersWithPage();
                            } else {
                                toastr.error('Vous devez d\'abord supprimer les paris en cours liés à <strong>' + data.tipster.name + '</strong> !', 'Tipster');
                            }

                        },
                        error: function (data) {
                            console.log('fail!!');
                        }

                    });
                }
            });
    });
}




