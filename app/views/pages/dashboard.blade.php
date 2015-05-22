
@extends('layouts.default')

@section('content')
    @if ($user->devise == 'Non')
        @include('modal_welcome')
        @endif

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
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                Widget settings form goes here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn blue">Save changes</button>
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-pin font-yellow-casablanca"></i>
                                    <span class="caption-subject font-yellow-casablanca bold uppercase">liste</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li id="onglet_paris_en_cours" class="active">
                                            <a href="#tab_15_1" data-toggle="tab">
                                                Ticket classique en cours <span class="badge badge-danger"></span></a>
                                        </li>
                                        <li id="onglet_paris_long_terme">
                                            <a href="#tab_15_2" data-toggle="tab">
                                                Ticket long terme en cours <span class="badge badge-default"></span></a>
                                        </li>
                                        <li id="onglet_paris_systeme_ABCD">
                                            <a href="#tab_15_3" data-toggle="tab">
                                                Ticket ABCD en cours <span class="badge badge-default"></span></a>
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
                    <div class="col-md-9">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-paper-plane font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Ajout</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tabbable-custom nav-justified">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active">
                                            <a href="#tab_1_1_1" data-toggle="tab">
                                                Automatique <span class="badge badge-default">bientot</span></a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_1_1_2" data-toggle="tab">
                                                Manuel </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1_1">
                                            @include('bet.automatic_addbet');
                                            <div class="portlet box blue-hoki">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Rechercher un pari ( ajouter une selection à l'aide du panneau ci-dessous )
                                                    </div>
                                                </div>
                                                <div class="portlet-body">

                                                    <iframe id="automatic-panel"
                                                            src="{{'http://stage.betbrain.com/?portalId=1312&userSessionId='.Session::getId()}}"
                                                            height="600" width="100%" frameborder="0">Odds service provided in
                                                        co-operation with <a href="http://www.betbrain.com"></a>

                                                    </iframe></div>
                                            </div>

                                        </div>
                                        <div class="tab-pane " id="tab_1_1_2">
                                            @include('bet.manual_addbet');
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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