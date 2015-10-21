/**
 * Created by sebs on 20/04/2015.
 */
function getBookmakersForSelection(bookmakersSelect, accountsSelect) {
    var books = $(bookmakersSelect);
    var accounts = $(accountsSelect);
    $.ajax({
        url: 'bettor/only-bookmakers-with-accounts',
        dataType: 'json',
        success: function (json) {
            books.html('');
            books.append('<option value=""></option>');

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
                url: 'bettor/my-bookmakers-accounts',
                data: {book_id: val},
                dataType: 'json',
                success: function (json) {
                    accounts.html('');
                    $.each(json, function (index, value) {
                        accounts.append('<option value="' + value.pivot.id + '">' + value.pivot.nom_compte + '</option>');
                    });
                }
            });
        }
    });
}

