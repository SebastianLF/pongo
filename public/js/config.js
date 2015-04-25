function getBookmakersForSelection(bookmakersSelect, accountsSelect) {
    var books = $(bookmakersSelect);
    var accounts = $(accountsSelect);
    $.ajax({
        url: 'bookmakers',
        data: 'book',
        dataType: 'json',
        success: function (json) {
            $.each(json, function (index, value) {
                books.append('<option value="' + value.id + '">' + value.nom + '</option>');
            });
        }
    });

    books.on('change', function () {
        var val = $(this).val();
        accounts.empty();
        if (val) {
            accounts.empty();
            $.ajax({
                url: 'accounts',
                data: {book_id: val},
                dataType: 'json',
                success: function (json) {
                    $.each(json, function (index, value) {
                        accounts.append('<option value="' + value.pivot.id + '">' + value.pivot.nom_compte + '</option>');
                    });

                }
            });
        }
    });
}



