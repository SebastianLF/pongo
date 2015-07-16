


function gestionTransactions(){
    var form = $('#transactionform-add');
    var addButton = '#transactionAddButton';
    var modal = '#transactionAddModal';

    var type = 'select[name="type"]';
    var typeContainer = '#type_container';
    var typeError = '#type_error';
    var book = 'select[name="book"]';
    var bookContainer = '#book_container';
    var bookError = '#book_error';
    var account = 'select[name="account"]';
    var accountContainer = '#account_container';
    var accountError = '#account_error';
    var amount = 'input[name="amount"]';
    var amountContainer = '#amount_container';
    var amountError = '#amount_error';
    var description = 'input[name="description"]';
    var descriptionContainer = '#description_container';
    var descriptionError = '#description_error';

    var paginationContainer = '#transactions-pagination';

    function loadTransactions(page) {
        page = page || '1';
        $.ajax({
            url: 'transaction',
            data: { page: page },
            success: function (data) {
                $(paginationContainer).html(data);
                getBookmakersForSelection(book, account);
            }
        });
    }

    function paginationOnclickTransactions(){
        // when you click on pagination numbers
        $(paginationContainer).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var pg = getPaginationSelectedPage($(this).attr('href'));
            loadTransactions(pg);
        });
    }

    function transactionAdd(){
        $(modal).on('hide.bs.modal', function () {
            // remise a zero des champs erreurs
            form.find(typeContainer).removeClass('has-error');
            form.find(bookContainer).removeClass('has-error');
            form.find(accountContainer).removeClass('has-error');
            form.find(amountContainer).removeClass('has-error');
            form.find(descriptionContainer).removeClass('has-error');

            form.find(typeError).empty();
            form.find(bookError).empty();
            form.find(accountError).empty();
            form.find(amountError).empty();
            form.find(descriptionError).empty();

            // remise a zero des champs input
            form.find(type).val(null).trigger('change');
            form.find(book).val(null).trigger('change');
            form.find(account).val(null).trigger('change');
            form.find(amount).val('');
            form.find(description).val('');
        });

        form.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'transaction',
                data: form.serialize(),
                type: 'POST',
                dataType: 'json',
                success: function (json) {
                    if (json.state == false) {

                        if (json.errors.type) {
                            form.find(typeContainer).addClass('has-error');
                            form.find(typeError).html(json.errors.type);
                        } else {
                            form.find(typeContainer).removeClass('has-error');
                            form.find(typeError).empty();
                        }
                        if (json.errors.book) {
                            form.find(bookContainer).addClass('has-error');
                            form.find(bookError).html(json.errors.book);
                        } else {
                            form.find(bookContainer).removeClass('has-error');
                            form.find(bookError).empty();
                        }
                        if (json.errors.account) {
                            form.find(accountContainer).addClass('has-error');
                            form.find(accountError).html(json.errors.account);
                        } else {
                            form.find(accountContainer).removeClass('has-error');
                            form.find(accountError).empty();
                        }
                        if (json.errors.amount) {
                            form.find(amountContainer).addClass('has-error');
                            form.find(amountError).html(json.errors.amount);
                        } else {
                            form.find(amountContainer).removeClass('has-error');
                            form.find(amountError).empty();
                        }
                        if (json.errors.description) {
                            form.find(descriptionContainer).addClass('has-error');
                            form.find(descriptionError).html(json.errors.description);
                        } else {
                            form.find(descriptionContainer).removeClass('has-error');
                            form.find(descriptionError).empty();
                        }
                    }
                    else {
                        loadTransactions();
                        $(modal).modal('hide');
                        toastr.success('Le transactions à été crée avec <strong>succès</strong>!', 'Transaction');
                    }
                }
            });
        });
    }

    //inits
    loadTransactions();
    transactionAdd();
    paginationOnclickTransactions();
}