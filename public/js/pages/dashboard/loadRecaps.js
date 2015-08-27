// charge sans vue.

function loadRecapsOnDashboard() {
    $.ajax({
        url: 'recaps',
        type: 'get',
        success: function (data) {
            $('[data-toggle="collapse"]').collapse();
            $('#recaps').html(data);
            $('[data-toggle="popover"]').popover();

            // ouverture de l accordeon correspondant au mois en cours.
            var now = new Date(Date.now());
            var month = now.getMonth()+1;
            var year = now.getFullYear();
            var recap = $('#recaps');
            recap.find('#collapse_'+year+'_'+month).addClass('in');
        }
    });
}
