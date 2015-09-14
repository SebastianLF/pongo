<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
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
    @include('includes.head', array('title' => 'Pongo'))
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">

<!-- BEGIN LOGO -->
<div class="logo color-white">
    <a href="{{url('dashboard')}}">
        <img src="{{asset('img/pongo-logo.png')}}" alt=""/>
    </a>
    <h1>Pongo</h1>
    <h2>Application de suivi de paris, de tipsters et de bookmakers pour les parieurs sportifs.</h2>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">

    <!-- BEGIN LOGIN FORM -->
    {{ Form::open(array('url' => 'auth/login', 'method' => 'post', 'class' => '')) }}
    <h3 class="form-title">Se connecter</h3>
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <small class="text-danger">{{ $errors->first('name') }}</small>
    <label class="control-label visible-ie8 visible-ie9">Nom</label>
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {{ Form::text('name', null, array('class' => 'form-control form-control-solid placeholder-no-fix', 'placeholder' => 'Nom')) }}
    </div>

    <small class="text-danger">{{ Session::get('pass') }}</small>
    <div class="form-group {{ Session::has('pass') ? 'has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">Mot de passe</label>
        {{ Form::password('password', array('class' => 'form-control form-control-solid placeholder-no-fix', 'placeholder' => 'Mot de passe')) }}
    </div>

    <div class="form-actions">
        {{ Form::submit('GO !', array('class' => 'btn btn-success uppercase')) }}
        <a href="{{url('password/remind')}}" id="forget-password" class="forget-password">Mot de passe oublié?</a>
    </div>

    <div class="create-account">
        <p>
            <a href="{{url('auth/inscription')}}" id="register-btn" class="uppercase">Creer un compte</a>
        </p>
    </div>
    {{ Form::close() }}
    <!-- END LOGIN FORM -->
</div>
<div class="copyright">
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery-migrate.min.js')}}"
        type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery.blockui.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/jquery.cokie.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/global/plugins/uniform/jquery.uniform.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('metronic_v3.6.2/theme/assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/admin/layout3/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/admin/layout3/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{asset('metronic_v3.6.2/theme/assets/admin/pages/scripts/login.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>