<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.2.0
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
    <meta charset="utf-8"/>
    <title>Pongo - Partage</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css">
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/uniform/css/uniform.default.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}
    {{ HTML::style('css/toastr.css') }}
    {{ HTML::style('css/sweetalert.css') }}
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    {{ HTML::style('css/select2.css') }}
    {{ HTML::style('css/select2-bootstrap.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/admin/pages/css/pricing-table.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/icheck/skins/all.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/admin/pages/css/login.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}
    {{ HTML::style('metronic_v3.8.1/theme/assets/global/plugins/datatables/media/css/jquery.dataTables.min.css') }}

    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/css/components-rounded.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/global/css/plugins.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/admin/layout3/css/layout.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/admin/layout3/css/themes/default.css') }}
    {{ HTML::style('metronic_v3.6.2/theme/assets/admin/layout3/css/custom.css') }}

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-menu-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed1">

<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container-fluid">
            <!-- BEGIN LOGO -->
            <div class="page-logo col-xs-pull-4">
                <a href="{{url('dashboard')}}"><img
                            src="{{asset('img/pongo.jpg')}}"
                            alt="logo" class="logo" height="60px"></a>
            </div>
            <!-- END LOGO -->

        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->

    <div class="page-header-menu page-header-share-ticket">

    </div>

    <!-- END HEADER MENU -->

</div>

<div class="page-container">
    <div class="page-content page-content-share-ticket">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{var_dump($ticket)}}
                    @if(isset($ticket))
                    <table class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ticket->selections->get() as $selection)
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                        <div class="text-center">
                            Ce Ticket n'existe pas
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-footer">
    @include('includes.footer')
</div>

@section('scripts')
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery-migrate.min.js')}}"
            type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery.blockui.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery.cokie.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/uniform/jquery.uniform.min.js')}}"
            type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('js/plugin/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugin/toastr.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugin/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugin/jquery.animateNumber.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugin/html-table-search.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('js/plugin/kayalshri-tableExport.jquery.plugin-a891806/tableExport.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('js/plugin/kayalshri-tableExport.jquery.plugin-a891806/jquery.base64.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('js/plugin/tablesorter-master/jquery.tablesorter.min.js')}}" type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/layout3/scripts/layout.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/layout3/scripts/demo.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/pages/scripts/table-advanced.js')}}"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/pages/scripts/form-samples.js')}}"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/pages/scripts/components-dropdowns.js')}}"></script>
    <script src="{{asset('js/pages/getPaginationSelectedPage.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/pages/getBookmakersForSelection.js')}}" type="text/javascript"></script>
@show

@include('includes.subview.inits')

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
