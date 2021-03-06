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
    @include('includes.head')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed1 page-header-top-fixed">

<div class="page-container">
    @yield('content')
</div>

@section('scripts')
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
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
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.js"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}" type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('metronic_v3.8.1/theme/assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/layout3/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/layout3/scripts/demo.js')}}" type="text/javascript"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/pages/scripts/table-advanced.js')}}"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/pages/scripts/form-samples.js')}}"></script>
    <script src="{{asset('metronic_v3.8.1/theme/assets/admin/pages/scripts/components-dropdowns.js')}}"></script>
    <script src="{{asset('js/pages/getPaginationSelectedPage.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/pages/getBookmakersForSelection.js')}}" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function () {

        });
    </script>
@show

@include('includes.subview.inits')

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>