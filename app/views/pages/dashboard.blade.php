@extends('layouts.default', array('title' => 'Pongo - Dashboard'))

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

            @include('bet/manual_bet_add_modal')
            @include('cashout_modal')

            <div class="row margin-top-10">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                </div>
            </div>

            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-pin font-yellow-casablanca"></i>
                                <span class="caption-subject font-yellow-casablanca bold uppercase">liste des tickets</span>
                            </div>
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
                        </div>
                        <div class="portlet-body">
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
            <div class="row">
                <div class="col-md-8">

                    <div class="portlet light green-haze">
                        <div class="portlet-title ">
                            <div class="caption">
                                <i class="icon-paper-plane color-white"></i>
                                <span class="caption-subject color-white bold uppercase">Ajouter un ticket</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            {{ Form::open(array('method' => 'post', 'id' => 'automaticform-add', 'class' => 'form-horizontal', 'role' => 'form')
                                            ) }}
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="glyphicon glyphicon-lock"></i>Ticket | <span
                                                class="glyphicon glyphicon-refresh glyphicon-spin"></span><a
                                                id="selection-refresh" class="" href="">Rafraichir</a>

                                    </div>
                                    <div class="actions">
                                    </div>
                                </div>

                                <div class="portlet-body form form-automatic">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingSelections">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse"
                                                   data-parent="#accordion-add-ticket"
                                                   href="#panier-selections-add-ticket" aria-expanded="true"
                                                   aria-controls="panier-selections-add-ticket">
                                                    Panier des sélections
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="panier-selections-add-ticket" class="panel-collapse collapse in"
                                             role="tabpanel"
                                             aria-labelledby="headingSelections">
                                            <div class="panel-body">
                                                <div id="automatic-selections">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingInfosGenerales">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                   data-parent="#accordion-add-ticket"
                                                   href="#infos-generales-add-ticket"
                                                   aria-expanded="false" aria-controls="infos-generales-add-ticket">
                                                    Informations générales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="infos-generales-add-ticket" class="panel-collapse collapse"
                                             role="tabpanel"
                                             aria-labelledby="headingInfosGenerales">
                                            <div class="panel-body">
                                                @include('bet/automatic_addbet')
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="form-actions form-actions-automatic-bet">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-5 ">
                                                <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i>
                                                    VALIDER LE
                                                    TICKET
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            {{ Form::close() }}
                            <div class="portlet light ">

                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="glyphicon glyphicon-lock"></i>Ajouter une selection

                                    </div>
                                    <div class="actions">
                                    </div>
                                </div>

                                <div class="portlet-body form form-automatic">
                                    <div class="tabbable-line ">
                                        <ul class="nav nav-tabs ">
                                            <li class="active">
                                                <a href="#tab_automatique" data-toggle="tab">
                                                    Recherche Automatique <span class="badge badge-danger"></span></a>
                                            </li>
                                            <li>
                                                <a href="#tab_manuel" data-toggle="tab">
                                                    Recherche Manuelle <span class="badge badge-default"></span></a>
                                            </li>

                                        </ul>


                                        <div class="tab-content green-haze">
                                            <div class="tab-pane active fade in" id="tab_automatique">
                                                @if(App::environment('local'))
                                                    <iframe src={{"http://stage.betbrain.com/?portalId=1312&userSessionId=".Session::getId()}} height="400"
                                                            width="100%" frameborder="0">Odds service provided in
                                                        co-operation
                                                        with
                                                        <a href="http://www.betbrain.com"
                                                           target="_blank"><b>BetBrain.com</b></a>
                                                    </iframe>
                                                @else
                                                    <iframe src={{"http://betbrain.com/?portalId=1326&userSessionId=".Session::getId()}} height="600"
                                                            width="100%" frameborder="0">Odds service provided in
                                                        co-operation with <a href="http://www.betbrain.com"
                                                                             target="_blank"><b>BetBrain.com</b></a>
                                                    </iframe>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="tab_manuel">
                                                <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#manualBetAddModal"><span
                                                            class="glyphicon glyphicon-plus"></span> ajouter une
                                                    sélection
                                                    manuellement
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md col-md-5">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject theme-font bold uppercase">Récapitulatif</span>
                                <span class="caption-helper hide">stats</span>
                            </div>
                            <div class="actions col-md-6">
                                <div class="">
                                    <div class="input-group" id="defaultrange">
                                        <input type="text" class="form-control"
                                               value="{{Carbon::now()->startOfMonth()->format('d/m/Y').' - '.Carbon::now()->endOfMonth()->format('d/m/Y')}}"
                                               readonly>
												<span class="input-group-btn">
												<button class="btn default date-range-toggle" type="button"><i
                                                            class="fa fa-calendar"></i></button>
												</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row number-stats margin-bottom-30">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="stat-left">
                                        <div class="stat-number">
                                            <div class="title">
                                                {{'Total profits en '.Auth::user()->devise}}
                                            </div>
                                            <div id="total-recap-profits-devise" class="number">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="stat-right">
                                        <div class="stat-number">
                                            <div class="title">
                                                {{'Total profits en U'}}
                                            </div>
                                            <div id="total-recap-profits-unites" class="number">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tipsters-general-recap">

                            </div>
                        </div>
                    </div>
                    <div id="comptes_par_bookmakers">

                    </div>
                    <div id="recaps">

                    </div>

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