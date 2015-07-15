<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon joli site</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300,700,400') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300')}}
    {{ HTML::style('https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
    {{ HTML::style('https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/font-awesome-4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css') }}
    {{ HTML::style('css/loader.css') }}
    {{ HTML::style('css/toastr.css') }}
    {{ HTML::style('css/bootstrap-modal.css') }}
    {{ HTML::style('css/animate.css') }}
    {{ HTML::style('css/ladda-themeless.min.css') }}
    {{ HTML::style('css/jquery-ui.min.css') }}
    <!--{{ HTML::style('css/style2.css') }} -->
    <!--{{ HTML::style('css/config.css') }} -->
    <!--{{ HTML::style('css/style.css') }}-->
    <!--[if lt IE 9]>
    {{ HTML::style('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
    {{ HTML::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}


    <![endif]-->
</head>
<body>

@yield('contenu')

<!-- inclure jquery avant jquery-ui. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>


<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="{{asset('js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-modal.js')}}" type="text/javascript"></script>

<script src="{{asset('js/getPaginationSelectedPage.js')}}"></script>
<script src="{{asset('js/paginationOnclick.js')}}"></script>

<!-- loading spinner -->
<script src="{{asset('js/spin.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ladda.min.js')}}" type="text/javascript"></script>

<!-- paris en cours -->
<script src="{{asset('js/loadParisEnCours.js')}}" type="text/javascript"></script>

<!-- tipster -->
<script src="{{asset('js/loadTipsters.js')}}" type="text/javascript"></script>
<script src="{{asset(gestionTipsters.jss')}}" type="text/javascript"></script>
<script src="{{asset('js/tipsterAdd.js')}}" type="text/javascript"></script>
<script src="{{asset('js/tipsterDelete.js')}}" type="text/javascript"></script>

<!-- bookmaker -->
<script src="{{asset(gestionBookmakers.jsjs')}}" type="text/javascript"></script>
<script src="{{asset('js/bookmakerAdd.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bookmakerUpdate.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bookmakerDelete.js')}}" type="text/javascript"></script>

<!-- transaction -->
<script src="{{asset(gestgestionTransactions.js}}" type="text/javascript"></script>
<script src="{{asset('js/transactionAdd.js')}}" type="text/javascript"></script>


<script src="{{asset('js/ajax/functions.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ajax/addbet.js')}}" type="text/javascript"></script>
<script src="{{asset('js/scripts.js')}}" type="text/javascript"></script>

<script src="{{asset('js/config.js')}}" type="text/javascript"></script>
<script src="{{asset('js/dashboard.js')}}" type="text/javascript"></script>

<script src="{{asset('js/modal_welcome.js')}}" type="text/javascript"></script>
<script src="{{asset('js/toastr.js')}}" type="text/javascript"></script>







<script>
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };


        <!-- chargements des tipsters par requete AJAX -->
        loadTipsters();

        <!-- fonction update de tipster dans une boite modal en AJAX -->
        updateTipster();

        updateBookmaker();

        loadParisEnCours();

        loadBookmakers();

        loadTransactions();

    });
</script>

</body>
</html>
