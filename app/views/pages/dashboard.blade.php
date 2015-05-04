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
                                            Paris classique en cours <span class="badge badge-danger"></span></a>
                                    </li>

                                    <li id="onglet_paris_long_terme">
                                        <a href="#tab_15_2" data-toggle="tab">
                                            Paris long terme en cours <span class="badge badge-default"></span></a>
                                    </li>
                                    <li>
                                        <a href="#tab_15_3" data-toggle="tab">
                                            Paris ABCD en cours <span class="badge badge-default"></span></a>
                                    </li>
                                    <li>
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
                                        <p>
                                            Howdy, I'm in Section 3.
                                        </p>

                                        <p>
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad
                                            minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl
                                            ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in
                                            hendrerit in vulputate velit esse molestie consequat
                                        </p>

                                        <p>
                                            <a class="btn yellow" href="ui_tabs_accordions_navs.html#tab_15_3"
                                               target="_blank">
                                                Activate this tab via URL </a>
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab_15_4">
                                        <p>
                                            Howdy, I'm in Section 4.
                                        </p>

                                        <p>
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad
                                            minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl
                                            ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in
                                            hendrerit in vulputate velit esse molestie consequat
                                        </p>
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
                                    <li class="">
                                        <a href="#tab_1_1_1" data-toggle="tab">
                                            Automatique <span class="badge badge-default">bientot</span></a>
                                    </li>
                                    <li class="active">
                                        <a href="#tab_1_1_2" data-toggle="tab">
                                            Manuel </a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="tab_1_1_1">

                                    </div>
                                    <div class="tab-pane active" id="tab_1_1_2">
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
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs font-yellow-crusta"></i>
                                <span class="caption-subject font-yellow-crusta bold uppercase">Tipsters</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- END PAGE CONTENT INNER -->
    </div>
    </div>
@stop