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
    @include('includes.head', array('title' => $title))

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed head
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu el
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed  page-style-square page-sidebar-closed page-sidebar-fixed">

<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            Pongo
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="header-date username username-hide-on-mobile">
                    <span class="fa fa-calendar"></span> {{$date}}
                </li>
                <!-- BEGIN TODO DROPDOWN -->
                <li class="droddown dropdown-separator">
                    <span class="separator"></span>
                </li>

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="" class="img-circle" src="{{asset('img/ec.jpg')}}">
                        <span class="username username-hide-on-mobile">{{Auth::user()->email}}</span><i
                                class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{url('profile')}}">
                                <i class="icon-user"></i> Mon profil </a>
                        </li>
                        <li>
                            <a href="{{url('user/preferences')}}">
                                <i class="icon-user"></i> Mes preferences </a>
                        </li>

                        <li class="divider">
                        </li>
                        <li>
                            <a href="{{url('auth/logout')}}">
                                <i class="icon-key"></i>Se deconnecter </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->

            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<div class="clearfix">
</div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="true" data-auto-scroll="true"
                data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->


                <li class="start active open">
                    <a href="{{url('dashboard')}}">
                        <i class="icon-home"></i>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li class="start">
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">Configuration</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('tipsters')}}">
                                <i class="icon-users"></i> Mes tipsters </a>
                        </li>
                        <li>
                            <a href="{{url('bookmakers')}}">
                                <i class="icon-book-open"></i> Mes bookmakers </a>
                        </li>

                    </ul>
                </li>
                <li class="start">
                    <a href="javascript:;">
                        <i class="icon-home"></i>
                        <span class="title">Profil</span>
                        <span class="selected"></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="">
                            <a href="{{url('profile')}}">
                                <i class="icon-user"></i>
                                <span class="title">Mon profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('user/preferences')}}">
                                <i class="icon-user"></i>
                                <span class="title">Mes preferences</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- <li class="heading">
                    <h3 class="uppercase"> UTILITAIRES</h3>
                </li> -->
                <!--<li class="">
                    <a href="{{url('faq')}}">
                        <i class=" icon-question"></i>
                        <span class="title">FAQ</span>
                    </a>
                </li>-->
                <!--<li>
                    <a href="{{url('market')}}">
                        <i class="icon-list"></i>
                        <span class="title">Glossaire</span>
                    </a>
                </li>-->

            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title">
                {{$title}}
                <small>{{isset($page_title_small) ? $page_title_small : ''}}</small>
                @if($title == 'Tableau de bord')
                    <div style="float:right;"><span id="overall-profit-month" class="">{{ucfirst($month)}}: </span> <span id="overall-profit-container" ><span id="overall-profit-sign"></span><span id="overall-profit"></span >{{Auth::user()->devise}}</span></div>
                @endif
            </h3>
            <div class="row">
                @yield('content')
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
<script src="{{asset('v4.1.0/theme/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('v4.1.0/theme/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->


<script src="{{asset('build/js/main-plugins.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        // activate tooltip globally
        $("body").tooltip({ selector: '[data-toggle="tooltip"]' });

        //activate tooltip globally for selector with data-hover attribute (example: cash out bets)
        $("body").tooltip({ selector: '[data-hover="tooltip"]' });

        // pop-up keep session or not
        $.sessionTimeout({
            title: "Notification d\'expiration de votre session",
            message: 'Votre session va bienôt expirer',
            keepAliveUrl: '/timeout-keep-alive',
            keepAliveInterval: '20000',
            keepAliveButton: 'Rester connecté',
            logoutButton: 'Se déconnecter',
            logoutUrl: 'auth/login',
            redirUrl: 'auth/login',
            warnAfter: 3000000,
            redirAfter: 3500000
        });


        // ajouter le token a chaque requete ajax.
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        // toastr plugin configuration
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };


    });
    @include('includes.subview.inits')
</script>
@show
        <!-- END JAVASCRIPTS -->


</body>
<!-- END BODY -->
</html>