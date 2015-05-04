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
        parent.next().find('input[name="childrowsinput[]"]').each(function () {
            childrows.push($(this).val());
        });
        parent.next().find('select[name="resultatSelectionDashboardInput[]"]').each(function () {
            childrowsstatus.push($(this).val());
        });

        console.log(childrows);
        console.log(childrowsstatus);
        if (retour.text().length > 0) {
            var ser = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                data: ser + '&ticket-id=' + id + '&childrowsinput[]=' + childrows + '&childrowsstatus[]=' + childrowsstatus,
                dataType: 'json',
                success: function (data) {
                    loadParisEnCours();
                    if (data.etat == 0) {
                        toastr.error(data.msg, 'Validation');
                    } else {
                        toastr.success(data.msg, 'Validation');
                        loadBookmakersOnDashboard();
                    }
                },
                error: function () {
                    console.log("valider un pari en cours ne fonctionne pas");
                }
            });
            $.ajax({
                url: 'mtmoistipster',
                type: 'post',
                data: id,
                dataType: 'json',
                success: function () {
                },
                error: function () {
                    console.log('probleme lors de la validation d un pari en cours pour le rajout du mt mois tipster')
                }
            });
        } else {
            alert('Vous devez préciser un status pour ce pari.');
        }
    });
}