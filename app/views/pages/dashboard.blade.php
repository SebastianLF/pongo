@extends('layouts.default')

@section('content')

    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Tableau de bord </h1>
            </div>
            <!-- END PAGE TITLE -->
            <div class="row pull-right">
                <div class="pull-right">

                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row margin-top-10">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                </div>


            </div>
            @include('cashout_modal')
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row">

                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-pin font-yellow-casablanca"></i>
                                <span class="caption-subject font-yellow-casablanca bold uppercase">liste</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li id="onglet_paris_en_cours" class="active">
                                        <a href="#tab_15_1" data-toggle="tab">
                                            Tickets classique en cours <span class="badge badge-danger"></span></a>
                                    </li>
                                    <li id="onglet_paris_long_terme">
                                        <a href="#tab_15_2" data-toggle="tab">
                                            Tickets long terme en cours <span
                                                    class="badge badge-default"></span></a>
                                    </li>
                                    <li id="onglet_paris_systeme_ABCD">
                                        <a href="#tab_15_3" data-toggle="tab">
                                            Tickets ABCD en cours <span class="badge badge-default"></span></a>
                                    </li>
                                    <li id="onglet_paris_termine">
                                        <a href="#tab_15_4" data-toggle="tab">
                                            Historique </a>
                                    </li>
                                </ul>
                                <div class="tab-content">


                                    <div class="tab-pane active fade in" id="tab_15_1">

                                    </div>
                                    <div class="tab-pane fade" id="tab_15_2">

                                    </div>
                                    <div class="tab-pane fade" id="tab_15_3">

                                    </div>
                                    <div class="tab-pane fade" id="tab_15_4">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-paper-plane font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Ajout</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tabbable-custom nav-justified">

                                <div class="tab-pane active" id="tab_1_1_1">
                                    @include('bet.automatic_addbet');
                                    <div class="portlet box blue-hoki">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Rechercher un pari ( ajouter une
                                                selection à l'aide du panneau ci-dessous )
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            {{App::environment()}}
                                            @if(App::environment('local'))
                                                <iframe src={{"http://stage.betbrain.com/?portalId=1312&userSessionId=".Session::getId()}} height="1090" width="100%" frameborder="0">Odds service provided in co-operation with <a href="http://www.betbrain.com" target="_blank"><b>BetBrain.com</b></a></iframe>
                                            @else
                                                <iframe src={{"http://betbrain.com/?portalId=1326&userSessionId=".Session::getId()}} height="1090"
                                                        width="100%" frameborder="0">Odds service provided in
                                                    co-operation with <a href="http://www.betbrain.com" target="_blank"><b>BetBrain.com</b></a>
                                                </iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-green-sharp"><span class="totalprofit"></span>
                                    <small class="font-green-sharp">{{' '.$user->devise}}</small>
                                </h3>
                                <small>TOTAL PROFIT</small>
                            </div>
                            <div class="icon">
                                <i class="icon-pie-chart"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
								<span class="progress-bar progress-bar-success green-sharp roi-bar">
								<span class="sr-only"></span>
								</span>
                            </div>
                            <div class="status">
                                <div class="status-title">
                                    ROI
                                </div>
                                <div class="status-number roi">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject theme-font bold uppercase">Récapitulatif</span>
                                <span class="caption-helper hide">stats</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                        <input type="radio" name="options" class="toggle" id="option1">Aujourd'hui</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Cette semaine</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Ce mois</label>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row number-stats margin-bottom-30">
                                <div class="col-md-12 col-sm-6 col-xs-6 ">
                                    <div class="stat-right ">
                                        <div class="stat-number">
                                            <div class="title">
                                                Total
                                            </div>
                                            <div class="number">
                                                2460
                                            </div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title">
                                                Total
                                            </div>
                                            <div class="number">
                                                2460
                                            </div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title">
                                                Total
                                            </div>
                                            <div class="number">
                                                2460
                                            </div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title">
                                                Total
                                            </div>
                                            <div class="number">
                                                2460
                                            </div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title">
                                                Total
                                            </div>
                                            <div class="number">
                                                2460
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <thead>
                                    <tr class="uppercase">
                                        <th colspan="">
                                            NOM
                                        </th>
                                        <th>
                                            COTE MOY.
                                        </th>
                                        <th>
                                            MISE MOY.
                                        </th>
                                        <th>
                                            EFFICACITE
                                        </th>
                                        <th>
                                            PROFITS
                                        </th>
                                        <th>
                                            ROI
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>

                                        <td>
                                            <a href="javascript:;" class="primary-link">Brain</a>
                                        </td>
                                        <td>
                                            0
                                        </td>

                                        <td>
                                            $345
                                        </td>
                                        <td>
                                            220% (2/0/0)
                                        </td>
                                        <td>
                                            124
                                        </td>
                                        <td>
                                            <span class="bold theme-font">80%</span>
                                        </td>
                                    </tr>

                                    </tbody></table>
                            </div>
                        </div>
                    </div>


                    <div id="comptes_par_bookmakers">

                    </div>
                    <div id="recaps">

                    </div>

                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
@stop
@section('scripts')
    @parent
    <script src="{{asset('build/js/dashboard.js')}}" type="text/javascript"></script>

@stop