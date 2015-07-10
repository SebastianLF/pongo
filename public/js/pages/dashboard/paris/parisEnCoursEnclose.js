/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursEnclose(tablename, formname, urlgiven) {
    var table = $(tablename);
    var form = $(formname);
    var url = urlgiven;
// click sur le bouton valider du paris en cours , qui va le transferer vers historique(termineParis)
    $(tablename + ' ' + formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var wrapper = $(this).closest('.wrapperRow');
        var retour = parent.find('.tdretour span.subretour');
        var id = parent.find('.id').text();
        var childrows = [];
        var childrowsstatus = [];
        var subrow = parent.next().find('.child-row input');
        var type = parent.find('.type').text();


            childrows = parent.next().find('select[name="resultatSelectionDashboardInput[]"]').serialize();
            childrowsstatus = parent.next().find('input[name="childrowsinput[]"]').serialize();


        $.ajax({
            url: url,
            type: 'post',
            data: childrows + '&' + childrowsstatus + '&ticket-id=' + id,
            dataType: 'json',
            success: function (data) {

                if (data.etat == 0) {
                    toastr.error(data.msg, 'Validation');
                } else {
                    toastr.success(data.msg, 'Validation');
                    loadParisEnCours();
                    loadParisTermine();
                    loadBookmakersOnDashboard();
                    loadRecapsOnDashboard();
                }
            },
            error: function () {
                console.log("valider un pari en cours ne fonctionne pas");
            }
        });
    });
}