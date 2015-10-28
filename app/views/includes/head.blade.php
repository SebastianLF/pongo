<meta charset="utf-8"/>
<title>{{isset($title) ? $title : ''}}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
    @if(Auth::check())
        <meta name="_token" content="{{ csrf_token() }}"/>
    @endif

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
                d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
                _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
            $.src="//v2.zopim.com/?2yLYoTe7KZc5eXH3mViXVyumTMmOeU8a";z.t=+new Date;$.
                    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->

    <!-- Hotjar Tracking Code for slfweb.eu1.frbit.net
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:85094,hjsv:5};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
    </script>-->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/r/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,b-1.0.3,b-html5-1.0.3,cr-1.2.0,r-1.0.7,sc-1.3.0/datatables.min.css" rel="stylesheet" type="text/css" />


    {{ HTML::style('v4.1.0/theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}
    {{ HTML::style('v4.1.0/theme/assets/admin/layout/css/themes/darkblue.css', array('type' => 'text/css', 'id' => 'style_color', 'rel' => 'stylesheet')) }}
    {{ HTML::style('build/css/main-css.min.css') }}

            <!-- jQuery CDN -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- jQuery local fallback -->
    <script>window.jQuery || document.write('<script src="cdn-fallback/jquery.min.js"><\/script>')</script>
    <!-- Bootstrap JS CDN -->
    <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
     Bootstrap JS local fallback
    <script>if(typeof($.fn.modal) === 'undefined') {document.write('<script src="cdn-fallback/bootstrap/js/bootstrap.min.js"><\/script>')}</script> -->
    <!-- Bootstrap CSS local fallback -->
    <script>
        $(document).ready(function() {
            var bodyColor = $('body').css('color');
            if(bodyColor != 'rgb(51, 51, 51)') {
                $("head").prepend('<link rel="stylesheet" href="cdn-fallback/bootstrap/css/bootstrap.min.css">');}});
    </script>

    <!-- datatables, le script inclut en plus certaines options, voir http://datatables.net/download/index -->
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,b-1.0.3,b-html5-1.0.3,cr-1.2.0,r-1.0.7,sc-1.3.0/datatables.min.js"></script>
