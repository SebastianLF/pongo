


function gestionTransactions(){

    var paginationContainer = '#transactions-pagination';

    function loadTransactions(page) {
        page = page || '1';
        $.ajax({
            url: 'pagination/ajax/transactions',
            data: { page: page },
            type: 'get',
            success: function (data) {
                $('#transactions-pagination').html(data);
                getBookmakersForSelection('#transactionform-add #booknametransselect','#transactionform-add #accountnametransselect');
            }
        });
    }

    function transactionAdd(){

    }

    //inits

    loadTransactions();
    transactionAdd();

}