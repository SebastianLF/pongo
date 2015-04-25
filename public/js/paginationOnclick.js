function paginationOnclick(url,contentContainer){
    // when you click on pagination numbers
    $(contentContainer).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var pg = getPaginationSelectedPage($(this).attr('href'));
        $.ajax({
            url: url,
            data: { page: pg },
            success: function (data) {
                $(contentContainer).html(data);
                editBookmakerButton();
                deleteBookmakerButton();
                tipsterEdit();
                tipsterDelete();
            },
            error: function (data) {
                console.log('erreur: pagination par click');
            }
        });
    });
}
