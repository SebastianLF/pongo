/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursEnclose(tablename,url) {
    var table = tablename;
    var bouton_valider = $('.boutonvalider');

// click sur le bouton valider du paris en cours , qui va le transferer vers historique(termineParis)
    bouton_valider.on('click', function (e) {
        e.preventDefault();
        /*
        var parent = $(this).closest('.mainrow');
        var wrapper = $(this).closest('.wrapperRow');
        var retour = parent.find('.tdretour span.subretour');
        var id = parent.find('.id').text();
        var childrows = [];
        var childrowsstatus = [];
        var subrow = parent.next().find('.child-row input');
        var type = parent.find('.type').text();

        if (type == 'S') {
            childrows = parent.find('select[name="resultatSelectionDashboardInput[]"]').serialize();
            childrowsstatus = parent.find('input[name="childrowsinput[]"]').serialize();
        } else {
            childrows = parent.next().find('select[name="resultatSelectionDashboardInput[]"]').serialize();
            childrowsstatus = parent.next().find('input[name="childrowsinput[]"]').serialize();
        }
        console.log(childrows);
        console.log(childrowsstatus);*/


        var tr_main = bouton_valider.parent('tr');
        var tr_childs = tr_main.next('tr.details');
        var type_profil = $(this).data('pari-type');
        var status = [];
        if(type_profil == 's'){
            alert(tr_main);
            var length = tr_main.find('select[name="status[]"]').length;
            alert(length);
            console.log(length);
        }else{
            var length = tr_childs.find('select[name="status[]"]').length;
            alert(length);
            console.log(length);
        }

        $.ajax({
            url: url,
            type: 'post',
            data: '',
            dataType: 'json',
            success: function (data) {
                if (data.etat == 0) {
                    toastr.error(data.msg, 'Validation');
                } else {
                    toastr.success(data.msg, 'Validation');
                    loadParisEnCours();
                    loadParisTermine();
                    loadBookmakersOnDashboard();
                    loadGeneralRecapsOnDashboard();
                }
            }
        });
    });
}
