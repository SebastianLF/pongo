/*var Transactions = {
 form: $('#transactionform-add'),
 addButton :'#transactionAddButton',
 modal : '#transactionAddModal',

 type : 'select[name="type"]',
 typeContainer : '#type_container',
 typeError : '#type_error',
 var book = 'select[name="book"]',
 var bookContainer = '#book_container',
 var bookError = '#book_error',
 var account = 'select[name="account"]',
 var accountContainer = '#account_container',
 var accountError = '#account_error',
 var amount = 'input[name="amount"]',
 var amountContainer = '#amount_container',
 var amountError = '#amount_error',
 var description = 'input[name="description"]',
 var descriptionContainer = '#description_container',
 var descriptionError = '#description_error',

 var paginationContainer = '#transactions-pagination',

 loadTransactions = function(page){
 page = page || '1';
 $.ajax({
 url: 'transaction',
 data: { page: page },
 success: function (data) {
 $(paginationContainer).html(data);
 getBookmakersForSelection(book, account);
 }
 });
 },

 paginationOnclickTransactions = function(){
 // when you click on pagination numbers
 $(paginationContainer).on('click', '.pagination a', function (e) {
 e.preventDefault();
 var pg = getPaginationSelectedPage($(this).attr('href'));
 loadTransactions(pg);
 });
 },

 transactionAdd = function(){
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
 this.loadBookmakers();
 $(modal).modal('hide');
 toastr.success('Le transactions à été crée avec <strong>succès</strong>!', 'Transaction');
 }
 }
 });
 });
 },

 //inits
 inits = function(){
 this.loadTransactions();
 this.transactionAdd();
 this.paginationOnclickTransactions();
 }
 }*/

function gestionTransactions() {
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

    var Container = $('#transactions');

    function loadTransactions() {
        $.ajax({
            url: 'bettor/my-transactions-view-list',
            success: function (data) {
                Container.html(data);
                $('#transactionstable').dataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    language: {
                        processing:     "Traitement en cours...",
                        search:         "Rechercher&nbsp;:",
                        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        infoPostFix:    "",
                        loadingRecords: "Chargement en cours...",
                        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        emptyTable:     "Aucune donnée disponible dans le tableau",
                        paginate: {
                            first:      "Premier",
                            previous:   "Pr&eacute;c&eacute;dent",
                            next:       "Suivant",
                            last:       "Dernier"
                        },
                        aria: {
                            sortAscending:  ": activer pour trier la colonne par ordre croissant",
                            sortDescending: ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                    "ordering": false,
                    // set the initial value
                    "pageLength": 10,
                    "dom": "<'table-scrollable't><'row'<'col-md-5 col-sm-6'i><'col-md-7 col-sm-6'p>>", // horizobtal scrollable datatable
                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                    // So when dropdowns used the scrollable div should be removed.
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                }).fnPageChange( 'last' );
                getBookmakersForSelection(book, account);
            }
        });
    }

    function paginationOnclickTransactions() {
        // when you click on pagination numbers
        Container.on('click', '.pagination a', function (e) {
            e.preventDefault();
            var pg = getPaginationSelectedPage($(this).attr('href'));
            loadTransactions(pg);
        });
    }


    function transactionAdd() {
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

        form.find('button[type="submit"]').on("click", function (e) {
            e.preventDefault();
            var l = Ladda.create(this);
            l.start();
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
                        loadBookmakers();
                        $(modal).modal('hide');
                        toastr.success('Le transactions à été crée avec <strong>succès</strong>!', 'Transaction');
                    }
                },
                complete: function () {
                    l.stop();
                }
            });
        });
    }

    loadTransactions();
    transactionAdd();
}

gestionTransactions();