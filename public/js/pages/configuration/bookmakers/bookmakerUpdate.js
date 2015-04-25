function editBookmakerButton(){
    $('.bookmakerEditButton').click(function() {
        $("#idBookmakerEditInput").val($(this).attr('data-id-bookmaker'));
        $("#idAccountEditInput").val($(this).attr('data-id'));
        $("#nameAccountEditInput").val($(this).attr('data-name'));
    });
}
function updateBookmaker() {
    $('#bookmakerform-edit').submit(function (e) {
        e.preventDefault();
        var id = $(this).find("#idAccountEditInput").val();
        $.ajax({
            url: 'bookmaker/' + id,
            method: 'PUT',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                if (!json.success) {
                    $('#nameAccountEditContainer').addClass('has-error');
                    $('#nameAccountEditInput');
                    toastr.error('<ul><li>'+json.errors.nameAccountEditInput+'</li></ul>', 'Compte Bookmaker');
                } else {
                    loadBookmakers();
                    toastr.success('Compte mis à jour avec <strong>succes</strong> !', 'Compte Bookmaker');
                    $('#bookmakerEditModal').modal('hide');
                }
            },
            error: function (json) {
                console.log('impossible de mettre à jour le compte bookmaker');
            }
        });
    });

}