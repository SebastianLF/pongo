/**
 * Created by sebs on 19/04/2015.
 */

function parisTermineDeleteDelete(tablename,formname,urlgiven){
    var table = $(tablename);
    var form = $(formname);
    var url = urlgiven;
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var id = parent.find('.id').text();
        var retour = parent.find('.tdretour span.subretour');
        var cote = parent.find(".tdcote").text();
        var mise = parent.find(".tdmise .tdsubmise").text();
        var ser = $(this).serialize();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url + id,
                        type: 'delete',
                        success: function (data) {
                            loadParisEnCoursWithPage('delete');
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