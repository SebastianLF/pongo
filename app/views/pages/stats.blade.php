@extends('layouts.default')

@section('content')
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Statistiques </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row margin-top-10">
                <div class="col-md-6 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject theme-font bold uppercase">Sales Summary</span>
                                <span class="caption-helper hide">weekly stats...</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                        <input type="radio" name="options" class="toggle" id="option1">Today</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Week</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Month</label>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row list-separated">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Total Sales
                                    </div>
                                    <div class="uppercase font-hg font-red-flamingo">
                                        13,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Revenue
                                    </div>
                                    <div class="uppercase font-hg theme-font">
                                        4,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Expenses
                                    </div>
                                    <div class="uppercase font-hg font-purple">
                                        11,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="font-grey-mint font-sm">
                                        Growth
                                    </div>
                                    <div class="uppercase font-hg font-blue-sharp">
                                        9,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-separated list-inline-xs hide">
                                <li>
                                    <div class="font-grey-mint font-sm">
                                        Total Sales
                                    </div>
                                    <div class="uppercase font-hg font-red-flamingo">
                                        13,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </li>
                                <li>
                                </li>
                                <li class="border">
                                    <div class="font-grey-mint font-sm">
                                        Revenue
                                    </div>
                                    <div class="uppercase font-hg theme-font">
                                        4,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <div class="font-grey-mint font-sm">
                                        Expenses
                                    </div>
                                    <div class="uppercase font-hg font-purple">
                                        11,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <div class="font-grey-mint font-sm">
                                        Growth
                                    </div>
                                    <div class="uppercase font-hg font-blue-sharp">
                                        9,760 <span class="font-lg font-grey-mint">$</span>
                                    </div>
                                </li>
                            </ul>
                            <div id="sales_statistics" class="portlet-body-morris-fit morris-chart" style="height: 260px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="260" version="1.1" width="922" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.5px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="none" d="M0,260H922" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="none" d="M0,195H922" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="none" d="M0,130H922" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="none" d="M0,65H922" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="none" d="M0,0H922" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="#e3f5f3" stroke="none" d="M0,104C57.91364981785064,106.16666666666666,173.74094945355193,115.91593053982633,231.65459927140256,112.66666666666666C289.59448998178505,109.41593053982633,405.47427140255013,76.91099476439791,463.4141621129326,78C520.750512295082,79.07766143106457,635.4232126593807,124.04228656443121,692.75956284153,121.33333333333331C750.0696721311475,118.62561989776454,864.6898907103825,72.58333333333331,922,56.333333333333314L922,260L0,260Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#92e9dc" d="M0,104C57.91364981785064,106.16666666666666,173.74094945355193,115.91593053982633,231.65459927140256,112.66666666666666C289.59448998178505,109.41593053982633,405.47427140255013,76.91099476439791,463.4141621129326,78C520.750512295082,79.07766143106457,635.4232126593807,124.04228656443121,692.75956284153,121.33333333333331C750.0696721311475,118.62561989776454,864.6898907103825,72.58333333333331,922,56.333333333333314" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="0" cy="104" r="0" fill="#92e9dc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="231.65459927140256" cy="112.66666666666666" r="0" fill="#92e9dc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="463.4141621129326" cy="78" r="0" fill="#92e9dc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="692.75956284153" cy="121.33333333333331" r="0" fill="#92e9dc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="922" cy="56.333333333333314" r="0" fill="#92e9dc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#59aea2" stroke="none" d="M0,138.66666666666666C57.91364981785064,145.16666666666666,173.74094945355193,166.83284258210645,231.65459927140256,164.66666666666666C289.59448998178505,162.4995092487731,405.47427140255013,122.4223385689354,463.4141621129326,121.33333333333331C520.750512295082,120.25567190226874,635.4232126593807,155.45820935378043,692.75956284153,156C750.0696721311475,156.54154268711375,864.6898907103825,133.25,922,125.66666666666666L922,260L0,260Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#399a8c" d="M0,138.66666666666666C57.91364981785064,145.16666666666666,173.74094945355193,166.83284258210645,231.65459927140256,164.66666666666666C289.59448998178505,162.4995092487731,405.47427140255013,122.4223385689354,463.4141621129326,121.33333333333331C520.750512295082,120.25567190226874,635.4232126593807,155.45820935378043,692.75956284153,156C750.0696721311475,156.54154268711375,864.6898907103825,133.25,922,125.66666666666666" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="0" cy="138.66666666666666" r="0" fill="#399a8c" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="231.65459927140256" cy="164.66666666666666" r="0" fill="#399a8c" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="463.4141621129326" cy="121.33333333333331" r="0" fill="#399a8c" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="692.75956284153" cy="156" r="0" fill="#399a8c" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="922" cy="125.66666666666666" r="0" fill="#399a8c" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg>
                                <div class="morris-hover morris-default-style" style="left: 0px; top: 41px; display: none;"><div class="morris-hover-row-label">2011 Q1</div><div class="morris-hover-point" style="color: #399a8c">
                                        Sales:
                                        1,400
                                    </div><div class="morris-hover-point" style="color: #92e9dc">
                                        Profit:
                                        400
                                    </div></div></div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject theme-font bold uppercase">Member Activity</span>
                                <span class="caption-helper hide">weekly stats...</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                        <input type="radio" name="options" class="toggle" id="option1">Today</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Week</label>
                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Month</label>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row number-stats margin-bottom-30">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="stat-left">
                                        <div class="stat-chart">
                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                            <div id="sparkline_bar"><canvas width="90" height="45" style="display: inline-block; width: 90px; height: 45px; vertical-align: top;"></canvas></div>
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
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="stat-right">
                                        <div class="stat-chart">
                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                            <div id="sparkline_bar2"><canvas width="90" height="45" style="display: inline-block; width: 90px; height: 45px; vertical-align: top;"></canvas></div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title">
                                                New
                                            </div>
                                            <div class="number">
                                                719
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <thead>
                                    <tr class="uppercase">
                                        <th colspan="2">
                                            MEMBER
                                        </th>
                                        <th>
                                            Earnings
                                        </th>
                                        <th>
                                            CASES
                                        </th>
                                        <th>
                                            CLOSED
                                        </th>
                                        <th>
                                            RATE
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>
                                        <td class="fit">
                                            <img class="user-pic" src="../../assets/admin/layout3/img/avatar4.jpg">
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="primary-link">Brain</a>
                                        </td>
                                        <td>
                                            $345
                                        </td>
                                        <td>
                                            45
                                        </td>
                                        <td>
                                            124
                                        </td>
                                        <td>
                                            <span class="bold theme-font">80%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic" src="../../assets/admin/layout3/img/avatar5.jpg">
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="primary-link">Nick</a>
                                        </td>
                                        <td>
                                            $560
                                        </td>
                                        <td>
                                            12
                                        </td>
                                        <td>
                                            24
                                        </td>
                                        <td>
                                            <span class="bold theme-font">67%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic" src="../../assets/admin/layout3/img/avatar6.jpg">
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="primary-link">Tim</a>
                                        </td>
                                        <td>
                                            $1,345
                                        </td>
                                        <td>
                                            450
                                        </td>
                                        <td>
                                            46
                                        </td>
                                        <td>
                                            <span class="bold theme-font">98%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic" src="../../assets/admin/layout3/img/avatar7.jpg">
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="primary-link">Tom</a>
                                        </td>
                                        <td>
                                            $645
                                        </td>
                                        <td>
                                            50
                                        </td>
                                        <td>
                                            89
                                        </td>
                                        <td>
                                            <span class="bold theme-font">58%</span>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-pin font-yellow-casablanca"></i>
                                <span class="caption-subject font-yellow-casablanca bold uppercase">Statistiques</span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title=""
                                   title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li  class="active">
                                        <a href="#tab_general" data-toggle="tab">
                                            General</a>
                                    </li>
                                    <li  class="">
                                        <a href="#tab_tipster" data-toggle="tab">
                                            Tipsters</a>
                                    </li>
                                    <li  class="">
                                        <a href="#tab_bookmaker" data-toggle="tab">
                                            Paris</a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane active fade in" id="tab_general">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="chartPie1"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="chartDiv"></div>
                                            </div>
                                        </div>


                                        <div id="chartData2"></div>

                                    </div>
                                    <div class="tab-pane active fade in" id="tab_tipster">

                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="tipster_stats">Selectionez un tipster</label>
                                                <select name="tipster_stats" id="tipster_stats" class="form-control input-sm"></select>
                                            </div>
                                        </div>
                                        <div id="tipsters-stats-row" class="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div id="tipsterPie1">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- BEGIN Portlet PORTLET-->
                                                    <div class="portlet light bordered">
                                                        <div class="portlet-title">
                                                            <div class="caption font-green-sharp">
                                                                <i class="icon-speech font-green-sharp"></i>
                                                                <span class="caption-subject bold uppercase"> Portlet</span>
                                                                <span class="caption-helper">weekly stats...</span>
                                                            </div>
                                                            <div class="actions">
                                                                <a href="javascript:;" class="btn btn-circle btn-default btn-sm">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                                <a href="javascript:;" class="btn btn-circle btn-default btn-sm">
                                                                    <i class="fa fa-plus"></i> Add </a>
                                                                <a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd" data-initialized="1">
                                                                    <div class="table-scrollable table-scrollable-borderless">
                                                                        <table class="table table-hover table-light">
                                                                            <thead>
                                                                            <tr class="uppercase">
                                                                                <th colspan="2">
                                                                                    MEMBER
                                                                                </th>
                                                                                <th>
                                                                                    Earnings
                                                                                </th>
                                                                                <th>
                                                                                    CASES
                                                                                </th>
                                                                                <th>
                                                                                    CLOSED
                                                                                </th>
                                                                                <th>
                                                                                    RATE
                                                                                </th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody><tr>
                                                                                <td class="fit">
                                                                                    <img class="user-pic" src="../../assets/admin/layout3/img/avatar4.jpg">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="javascript:;" class="primary-link">Brain</a>
                                                                                </td>
                                                                                <td>
                                                                                    $345
                                                                                </td>
                                                                                <td>
                                                                                    45
                                                                                </td>
                                                                                <td>
                                                                                    124
                                                                                </td>
                                                                                <td>
                                                                                    <span class="bold theme-font">80%</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="fit">
                                                                                    <img class="user-pic" src="../../assets/admin/layout3/img/avatar5.jpg">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="javascript:;" class="primary-link">Nick</a>
                                                                                </td>
                                                                                <td>
                                                                                    $560
                                                                                </td>
                                                                                <td>
                                                                                    12
                                                                                </td>
                                                                                <td>
                                                                                    24
                                                                                </td>
                                                                                <td>
                                                                                    <span class="bold theme-font">67%</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="fit">
                                                                                    <img class="user-pic" src="../../assets/admin/layout3/img/avatar6.jpg">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="javascript:;" class="primary-link">Tim</a>
                                                                                </td>
                                                                                <td>
                                                                                    $1,345
                                                                                </td>
                                                                                <td>
                                                                                    450
                                                                                </td>
                                                                                <td>
                                                                                    46
                                                                                </td>
                                                                                <td>
                                                                                    <span class="bold theme-font">98%</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="fit">
                                                                                    <img class="user-pic" src="../../assets/admin/layout3/img/avatar7.jpg">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="javascript:;" class="primary-link">Tom</a>
                                                                                </td>
                                                                                <td>
                                                                                    $645
                                                                                </td>
                                                                                <td>
                                                                                    50
                                                                                </td>
                                                                                <td>
                                                                                    89
                                                                                </td>
                                                                                <td>
                                                                                    <span class="bold theme-font">58%</span>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody></table>
                                                                    </div>
                                                                </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 115.606936416185px; background: rgb(161, 178, 189);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: yellow;"></div></div>
                                                        </div>
                                                    </div>
                                                    <!-- END Portlet PORTLET-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane active fade in" id="tab_bookmaker">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

@stop

