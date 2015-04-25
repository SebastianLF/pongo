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
        var status = parent.find("select[name='resultatDashboardInput'] option:selected").val();
        //var childs = wrapper.find('.childrowsinput').val();
        var childrows = new Array();
        var subrow = parent.next().find('.child-row input');
        parent.next().find('input[name="childrowsinput[]"]').each(function () {
            childrows.push($(this).val());
        });
        if (retour.text().length > 0) {
            var cote = parent.find(".tdcote").text();
            var mise = parent.find(".tdmise .tdsubmise").text();
            var retour_montant = retour.text();
            var ser = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                data: ser + '&id=' + id + '&cote=' + cote + '&mise=' + mise + '&retour_montant=' + retour_montant + '&status=' + status + '&childrows=' + childrows,
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