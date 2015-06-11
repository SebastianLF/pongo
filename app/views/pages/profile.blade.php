@extends('layouts.default')

@section('content')
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Profil</h1>
            </div>
            <!-- END PAGE TOOLBAR -->
        </div>
    </div>
    <div class="page-content">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-blue-hoki"></i>
                                <span class="caption-subject font-blue-hoki bold uppercase">Compte</span>
                                <span class="caption-helper">Infos perso</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            {{Form::open(array('route' => 'profile.store', 'class' => 'form-horizontal form-bordered'))}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nom</label>

                                    <div class="col-md-4">
                                        {{Form::text('name', $user->name ,array('class' => 'form-control'))}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Mot de passe</label>

                                    <div class="col-md-4">
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Confirmation mot de passe</label>

                                    <div class="col-md-4">
                                        <input type="password" class="form-control">

                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i>Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{Form::close()}}
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs"></i>Abonnement
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="container">
                                    <div class="row ">
                                        <!-- Pricing -->

                                        <div class="col-md-4 text-center">
                                            <div class="panel panel-success panel-pricing">
                                                <div class="panel-heading">
                                                    <i class="fa fa-desktop"></i>

                                                    <h3>Beta 1.0</h3>
                                                </div>
                                                <div class="panel-body text-center">
                                                    <p><strong>0 {{$user->devise}} / Mois</strong></p>
                                                </div>
                                                <ul class="list-group text-center">
                                                    <li class="list-group-item"><i class="fa fa-check"></i> Creation de compte
                                                    </li>
                                                    <li class="list-group-item"><i class="fa fa-check"></i> Toutes les fonctions
                                                    </li>
                                                    <li class="list-group-item"><i class="fa fa-check"></i> Support
                                                    </li>
                                                </ul>
                                                <div class="panel-footer">
                                                    <a class="btn btn-lg btn-block btn-success" href="#">EN COURS</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!--//End Pricing -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@stop