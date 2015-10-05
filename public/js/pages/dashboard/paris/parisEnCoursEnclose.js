/**
 * Created by sebs on 19/04/2015.
 */

function parisEnCoursEnclose(tablename, url) {
    var table = tablename;
    var bouton_valider = table.find('.boutonvalider');

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

        var tr_main = $(this).closest('tr');
        var tr_childs = tr_main.next('tr.details');
        var type_profil = $(this).data('pari-type');

        var status = [];

        if (type_profil == 's') {
            status.push(tr_main.find('select[name="status[]"]').val());
        } else {
            alert(tr_childs.html());
            status = tr_childs.find('select[name="status[]"]').each(function () {
                status.push($(this).val())
            });
        }

        alert(status);

        if(tr_childs.length == 0 && type_profil == 'c'){
            swal("Erreur", "cliquez sur la croix pour dérouler le combiné et selectionner les status.")
        }else if(tr_childs.length > 0 && type_profil == 'c'){

        }else if(type_profil == 's'){
            $.each(status, function(index, value){
                if(value == 0 || value != 2){}
            });
        }
        //si les status ont tous été bien renseigné ou alors si il y a au moins un pari perdu alors on peut finaliser le pari.
        else if ((status.indexOf(0) != -1 && status.indexOf(2) == -1)) {
            if (type_profil == 's') {
                swal("Erreur", "Vous devez selectionnez un status")
            } else {
                swal("Erreur", "Vous êtes obligé de selectionner le status pour chaque selection du combiné sauf si un des paris a le status perdu.")
            }
        } else {
            swal("OK", "OK");
            /*$.ajax({
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
             });*/
        }

    });
}
