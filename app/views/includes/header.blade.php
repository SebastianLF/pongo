<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
    <div class="container-fluid">
        <!-- BEGIN LOGO -->


        <div class="page-logo">
            PongoZ
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->

        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">

            <ul class="nav navbar-nav pull-right">
                <li class="header-date">
                    <span class="fa fa-calendar"></span> {{$date}}
                </li>
                <!-- BEGIN TODO DROPDOWN -->
                <li class="droddown dropdown-separator">
                    <span class="separator"></span>
                </li>

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="" class="img-circle" src="{{asset('img/ec.jpg')}}">
                        <span class="username name">{{Auth::user()->name}}</span>
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
</div>
<!-- END HEADER TOP -->
<!-- BEGIN HEADER MENU -->

<div class="page-header-menu page-header-share-ticket">
    <div class="container-fluid">
        <!-- BEGIN HEADER SEARCH BOX -->
        <!-- <form class="search-form" action="extra_search.html" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="query">
                <span class="input-group-btn">
                <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                </span>
            </div>
        </form> -->
        <!-- END HEADER SEARCH BOX -->
        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->

        <div class="hor-menu">

            <ul class="nav navbar-nav">
                <li>
                    <a href="{{url('dashboard')}}"><span class="glyphicon glyphicon-dashboard"></span> Tableau de
                        bord</a>
                </li>
                <li>
                    <a href="{{url('config')}}"><span class="glyphicon glyphicon-cog"></span> Configuration</a>
                </li>
                <li>
                    <a href="{{url('faq')}}"><span class="fa fa-comments"></span> FAQ</a>
                </li>
                <li>
                    <a href="{{url('market')}}"><span class="glyphicon glyphicon-th-list"></span> Glossaire Pari</a>
                </li>
                <!--<li>
                    <a href="{{url('stats')}}"><span class="glyphicon glyphicon glyphicon-stats"></span>Statistiques</a>
                </li>-->
            </ul>

        </div>
        <!-- END MEGA MENU -->
    </div>
</div>

<!-- END HEADER MENU -->
