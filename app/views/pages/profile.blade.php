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
                                            <input type="password"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Confirmation mot de passe</label>
                                        <div class="col-md-4">
                                            <input type="password"  class="form-control">

                                        </div>
                                    </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i>Enregistrer</button>
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
                            <div class="row margin-bottom-40">
                                <!-- Pricing -->


                                <div class="col-md-3 col-md-offset-5">
                                    <div class="pricing pricing-active hover-effect">
                                        <div class="pricing-head pricing-head-active">
                                            <h3>Beta <span>
											v1.0 </span>
                                            </h3>
                                            <h4><i>$</i>0<i>.00</i>
											<span>
											Par mois </span>
                                            </h4>
                                        </div>
                                        <ul class="pricing-content list-unstyled">
                                            <li>
                                                <i class="fa fa-tags"></i> At vero eos
                                            </li>
                                            <li>
                                                <i class="fa fa-asterisk"></i> No Support
                                            </li>
                                            <li>
                                                <i class="fa fa-heart"></i> Fusce condimentum
                                            </li>
                                            <li>
                                                <i class="fa fa-star"></i> Ut non libero
                                            </li>
                                            <li>
                                                <i class="fa fa-shopping-cart"></i> Consecte adiping elit
                                            </li>
                                        </ul>
                                        <div class="pricing-footer">
                                            <p>

                                            </p>
                                            <a href="javascript:;" class="btn yellow-crusta">
                                                Abonné</i>
                                            </a>
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
@stop