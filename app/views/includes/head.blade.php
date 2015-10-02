<meta charset="utf-8"/>
<title>{{isset($title) ? $title : 'Pongo'}}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
@if(Auth::check())
    <meta name="_token" content="{{ csrf_token() }}" />
@endif
<!--ZingChart Script-->
<!--<script src="http://cdn.zingchart.com/zingchart.min.js"></script>-->
<!--Start of Zopim Live Chat Script
<!--<script type="text/javascript">
      window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
              d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
              _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
            $.src="//v2.zopim.com/?2yLYoTe7KZc5eXH3mViXVyumTMmOeU8a";z.t=+new Date;$.
                    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>-->
<!--End of Zopim Live Chat Script-->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
      type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,b-1.0.3,b-html5-1.0.3,cr-1.2.0,r-1.0.7,sc-1.3.0/datatables.min.css"/>

{{ HTML::style('dist/ladda-themeless.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/uniform/css/uniform.default.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}
{{ HTML::style('css/toastr.css') }}
{{ HTML::style('css/sweetalert.css') }}
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
{{ HTML::style('css/select2.css') }}
{{ HTML::style('css/select2-bootstrap.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}
{{ HTML::style('js/plugin/bootstrap-daterangepicker-master/daterangepicker-bs3.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}
{{ HTML::style('v4.1.0/theme/assets/admin/pages/css/pricing-table.css') }}
{{ HTML::style('v4.1.0/theme/assets/global/plugins/icheck/skins/all.css') }}
{{ HTML::style('v4.1.0/theme/assets/admin/pages/css/login.css') }}
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE STYLES -->
    {{ HTML::style('v4.1.0/theme/assets/admin/pages/css/tasks.css') }}
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
{{ HTML::style('v4.1.0/theme/assets/global/css/components.css', array('id' => 'style_components')) }}
{{ HTML::style('v4.1.0/theme/assets/global/css/plugins.css') }}
{{ HTML::style('v4.1.0/theme/assets/admin/layout/css/layout.css') }}
{{ HTML::style('v4.1.0/theme/assets/admin/layout/css/themes/darkblue.css', array('type' => 'text/css', 'id' => 'style_color', 'rel' => 'stylesheet')) }}
{{ HTML::style('metronic_v3.8.1/theme/assets/admin/layout3/css/custom.css') }}

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>