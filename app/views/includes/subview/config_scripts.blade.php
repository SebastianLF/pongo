
<script src="{{asset('js/pages/configuration/config.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/transactions/loadTransactions.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/transactions/transactionAdd.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/tipsters/loadTipsters.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/tipsters/tipsterAdd.js')}}" type="text/javascript"></script>
<script src="{{asset(gestionTipsters.jss')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/tipsters/tipsterEdit.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/tipsters/tipsterDelete.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/bookmakers/loadBookmakers.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/bookmakers/bookmakerAdd.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/bookmakers/bookmakerDelete.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/configuration/bookmakers/bookmakerUpdate.js')}}" type="text/javascript"></script>
<script>
    //tipster
    tipsterUpdate();
    tipsterAdd();
    tipsterDelete();
    tipsterEdit();

    //bookmaker
    editBookmakerButton();
    updateBookmaker();

    loadTipsters();
    loadBookmakers();
    loadTransactions();
</script>