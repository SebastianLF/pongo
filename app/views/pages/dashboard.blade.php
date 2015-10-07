@extends('layouts.default', array('title' => 'Tableau de bord', 'page_title_small' => 'Recapitulatifs & ajout de pari'))

@section('content')

    <!-- BEGIN PAGE HEAD -->

    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->

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
                                <i class="icon-pin theme-font"></i>
                                <span class="caption-subject theme-font bold uppercase">liste paris</span>
                            </div>
                            <ul class="nav nav-tabs ">
                                <li id="onglet_paris_en_cours" class="active">
                                    <a href="#tab_15_1" data-toggle="tab">
                                        Paris classique en cours <span class="badge badge-danger"></span></a>
                                </li>
                                <li id="onglet_paris_long_terme">
                                    <a href="#tab_15_2" data-toggle="tab">
                                        Paris long terme en cours <span
                                                class="badge badge-danger"></span></a>
                                </li>
                                <li id="onglet_paris_long_terme">
                                    <a href="#tab_15_3" data-toggle="tab">
                                        Paris Martingale en cours <span
                                                class="badge badge-danger"></span></a>
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
                    <div class="portlet light ">
                        <div class="portlet-title ">
                            <div class="caption">
                                <i class="icon-paper-plane"></i>
                                <span class="caption-subject bold uppercase">Placer le pari </span>(dernière étape)
                            </div>

                        </div>
                        <div class="portlet-body">
                            <div class="">
                                {{ Form::open(array('method' => 'post', 'id' => 'automaticform-add', 'class' => 'form-horizontal', 'role' => 'form')
                                                ) }}
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSelections">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse"
                                               data-parent="#accordion-add-ticket"
                                               href="#panier-selections-add-ticket" aria-expanded="true"
                                               aria-controls="panier-selections-add-ticket">
                                                Panier des sélections -
                                            </a>
                                            <a id="selection-refresh" type="button"> <span
                                                        class="glyphicon glyphicon-refresh glyphicon-spin"></span>Rafraichir</a>
                                            <span id="automatic-refresh"> - </span>
                                        </h4>
                                    </div>
                                    <div id="panier-selections-add-ticket" class="panel-collapse collapse"
                                         role="tabpanel"
                                         aria-labelledby="headingSelections">
                                        <div class="panel-body">
                                            <div id="automatic-selections">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default ">
                                    <div class="panel-heading red-sunglo" role="tab" id="headingInfosGenerales">
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
                                <div class="col-md-offset-5 ">
                                    <button type="submit" class="btn btn-danger ladda-button" data-style="slide-down" data-size="l"><span class="ladda-label">PLACER LE PARI</span></button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="caption selections-caption">
                                <i class="icon-paper-plane"></i>
                                <span class="caption-subject bold uppercase">Choisir selection(s) </span>(première étape)
                            </div>
                            <hr/>
                            <div class="tabbable-custom">
                                <ul class="nav nav-tabs">
                                    <li class="">
                                        <a href="#tab_automatique" data-toggle="tab" aria-expanded="true">
                                            Automatique </a>
                                    </li>
                                    <li class="active">
                                        <a href="#tab_manuel" data-toggle="tab" aria-expanded="false">
                                            Manuel </a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="tab_automatique">
                                        @if(App::environment('local'))
                                            <iframe src={{"http://stage.betbrain.com/?portalId=1312&userSessionId=".Session::getId()}} height="600"
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
                                    <div class="tab-pane active fade in" id="tab_manuel">
                                        <div class="note note-success ">
                                            <p>Les informations a remplir dépendent du sport, renseignez le champ
                                                sport avant le reste.</p>
                                        </div>
                                        <div class="note note-danger">
                                            <p>Lorsque le symbole <span class="glyphicon glyphicon-save"></span>
                                                apparaît, c'est à vous
                                                d'inscrire le nom de l'equipe (ou du joueur) dans le champ de
                                                recherche puis le selectioner.</p>
                                        </div>
                                        {{ Form::open(array('url' => 'coupon', 'method' => 'post', 'id' => 'manualselectionform-add', 'role' => 'form')) }}
                                        <div class="row">
                                            <div id="date_container" class="col-md-4 col-md-offset-4">
                                                <label for="date">Date</label>
                                                <input name="date"
                                                       class="form-control input-sm"
                                                       placeholder="date rencontre">
                                                <span id="date_error" class="help-block"></span>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div id="sport_container" class="col-md-3 col-md-offset-3">
                                                <label for="date">Sport</label>
                                                <select name="sport"
                                                        class="form-control sportinputdashboard">
                                                    <option value=""></option>
                                                </select>
                                                <span id="sport_error" class="help-block"></span>
                                            </div>

                                            <div id="competition_container" class="col-md-3">
                                                <label for="competition">Competition</label>
                                                <select name="competition"
                                                        class="form-control competitioninputdashboard ">
                                                    <option value=""></option>
                                                </select>
                                                <span id="competition_error" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <hr/>
                                            <div id="market_container" class="col-md-3 col-md-offset-3">
                                                <label for="market">Type du pari</label>
                                                <select name="market"
                                                        class="form-control marketinputdashboard input-sm">
                                                    <option value=""></option>
                                                </select>
                                                <span id="market_error" class="help-block"></span>
                                            </div>

                                            <div id="scope_container" class="col-md-3">
                                                <label for="scope">Portée du pari</label>
                                                <select name="scope"
                                                        class="form-control scopeinputdashboard input-sm">
                                                    <option value=""></option>
                                                </select>
                                                <span id="scope_error" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div id="teamsRow" class="row">

                                            <div id="team1_container" class="col-md-3 col-md-offset-3">
                                                <label for="team1">Equipe Domicile</label>
                                                <select name="team1"
                                                        class="form-control team1inputdashboard input-sm">
                                                </select>
                                                <span id="team1_error" class="help-block"></span>
                                            </div>
                                            <div id="team2_container" class="col-md-3">
                                                <label for="team2">Equipe Extérieur</label>
                                                <select name="team2"
                                                        class="form-control team2inputdashboard input-sm">
                                                </select>
                                                <span id="team2_error" class="help-block"></span>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div id="pick_container" class="col-md-2 col-md-offset-3">
                                                <label for="pick">Choix du pari</label>
                                                <select name="pick"
                                                        class="form-control pickinputdashboard input-sm">
                                                </select>
                                                <span id="pick_error" class="help-block"></span>
                                            </div>
                                            <div id="odd_doubleParam_container" class="col-md-2">
                                                <label for="odd_doubleParam"></label>
                                                <select name="odd_doubleParam"
                                                        class="form-control input-sm"></select>
                                                <span id="odd_doubleParam_error" class="help-block"></span>
                                            </div>

                                            <div id="odd_doubleParam2_container" class="col-md-2">
                                                <label for="odd_doubleParam2"></label>
                                                <select name="odd_doubleParam2"
                                                        class="form-control input-sm"></select>
                                                <span id="odd_doubleParam2_error" class="help-block"></span>
                                            </div>

                                            <div id="odd_doubleParam3_container" class="col-md-2">
                                                <label for="odd_doubleParam3"></label>
                                                <select name="odd_doubleParam3"
                                                        class="form-control input-sm"></select>
                                                <span id="odd_doubleParam3_error" class="help-block"></span>
                                            </div>

                                            <div id="odd_participantParameterName_container" class="col-md-2">
                                                <label for="odd_participantParameterName"></label>
                                                <select name="odd_participantParameterName"
                                                        class="form-control input-sm"></select>
                                                        <span id="odd_participantParameterName_error"
                                                              class="help-block"></span>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div id="bookmaker_container" class="col-md-3 col-md-offset-3">
                                                <label for="bookmaker">Bookmaker</label>
                                                <select name="bookmaker" class="form-control input-sm">
                                                    <option value=""></option>
                                                </select>
                                                <span id="bookmaker_error" class="help-block"></span>
                                            </div>
                                            <div id="odd_container" class="col-md-3">
                                                <label for="odd_value">Cote</label>
                                                <input name="odd_value"
                                                       class="form-control oddinputdashboard input-sm"
                                                       placeholder="Cote">
                                                <span id="odd_error" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <hr/>
                                            <div id="liveContainer" class="col-md-2 col-md-offset-4">
                                                <label class="checkbox-inline">
                                                    <div class="checker" id="uniform-live"><span><input
                                                                    type="checkbox" id="live"
                                                                    value="live"></span></div>
                                                    live
                                                </label>
                                            </div>

                                            <div id="score_container" class="col-md-2">
                                                <label for="score">Score (en cours)</label>
                                                <input name="score" class="form-control input-sm"
                                                       placeholder="score">
                                                <span id="score_error" class="help-block"></span>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="col-md-offset-5">
                                            <button type="submit" class="btn green uppercase">Ajouter selection
                                            </button>
                                        </div>

                                        {{ Form::close()}}
                                        <hr/>
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
                                <span class="caption-subject theme-font bold uppercase"><span
                                            class="glyphicon glyphicon-user"></span> Récap. tipsters</span>
                                <span class="caption-helper hide">stats</span>
                            </div>
                            <div class="actions col-md-6">
                                <div class="">
                                    <div class="input-group" id="defaultrange">
                                        <input type="text" class="form-control"
                                               value="{{Carbon::now(Auth::user()->timezone)->startOfMonth()->format('d/m/Y').' - '.Carbon::now(Auth::user()->timezone)->endOfMonth()->format('d/m/Y')}}"
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


@stop
@section('scripts')
    @parent
    <script src="{{asset('build/js/dashboard.js')}}" type="text/javascript"></script>
@stop