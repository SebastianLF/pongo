/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursEnclose(tablename,formname,urlgiven) {
    var table = $(tablename);
    var form = $(formname);
    var url = urlgiven;
// click sur le bouton valider du paris en cours , qui va le transferer vers historique(termineParis)
    $(tablename+' '+formname).submit(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.mainrow');
        var wrapper = $(this).closest('.wrapperRow');
        var retour = parent.find('.tdretour span.subretour');
        var id = parent.find('.id').text();
        var childrows = new Array();
        var childrowsstatus = new Array();
        var subrow = parent.next().find('.child-row input');
        var type = parent.find('.type').text();
        
        if(type == 'simple'){
            var status_val = parent.find('select[name="resultatSelectionDashboardInput[]"]').val();
            var info_val = parent.find('input[name="childrowsinput[]"]').val();
            childrows.push(info_val);
            childrowsstatus.push(status_val);
        }else{
            parent.next().find('input[name="childrowsinput[]"]').each(function () {
                childrows.push($(this).val());
            });
            parent.next().find('select[name="resultatSelectionDashboardInput[]"]').each(function () {
                childrowsstatus.push($(this).val());
            });
        }
            var ser = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                data: ser + '&ticket-id=' + id + '&childrowsinput[]=' + childrows + '&childrowsstatus[]=' + childrowsstatus,
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