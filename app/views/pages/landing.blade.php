<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css">
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/uniform/css/uniform.default.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}
    {{ HTML::style('css/pages/landing/landing.css') }}

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">Pongo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden active">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="{{url('auth/login')}}">Se connecter</a>
                </li>
                <li class="page-scroll">
                    <a href="{{url('')}}">S'inscrire</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--<img class="img-responsive" src="{{asset('img/logo-pongo-blanc.jpg')}}" alt="illustration">-->
                <div class="intro-text">
                    <span class="name">pongo beta 1.0</span>
                    <span class="skills">Tableau de bord pour parieur sportif</span><br>
                    <hr class="star-light">
                    <span class="subskills">Gestion de vos paris, tipsters, bookmakers.<br> Consultez simplement, controlez efficacement.</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="{{url('auth/inscription')}}" class="btn btn-lg btn-outline">
                     S'inscrire
                </a>
            </div>
        </div>
    </div>
</header>
<section class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3><span class="glyphicon glyphicon-list-alt"></span> Liste des paris</h3>
                    <p>Liste des paris simple,combiné,long terme,martingale en cours et historique commun de vos paris avec les différents tipsters et les différents bookmakers associés.</p>
                </div>
                <div class="footer-col col-md-4">
                    <h3><span class="glyphicon glyphicon-user"></span> Tipsters</h3>
                    <p>Gestion du montant par unité et du type de suivi normal ou à blanc. Consultation du bilan annuel,mensuel,hebdomadaire ou quotidien.</p>
                </div>
                <div class="footer-col col-md-4">
                    <h3><span class="icon-book-open"></span> Bookmakers</h3>
                        <p>Profil actuel des vos comptes de bookmakers ( solde,depots,retraits,bonus ), fonctionne aussi si vous avez plusieurs comptes chez le meme bookmaker. </p>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    Copyright © Pongo 2015
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery-migrate.min.js')}}"
        type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>