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
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Salary</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Salary</th>
                </tr>
                </tfoot>
            </table>
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
                                <span class="caption-subject font-green-sharp bold uppercase">Ajouter un ticket</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            @include('bet.automatic_addbet');
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
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
@stop
@section('scripts')
    @parent
    <script src="{{asset('build/js/dashboard.js')}}" type="text/javascript"></script>

@stop