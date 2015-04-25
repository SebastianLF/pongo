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
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>informations
                            </div>
                        </div>
                        <div class="portlet-body">

                            {{Form::open(array('route' => 'profile.store', 'class' => 'col-md-offset-5'))}}
                            <div class="row">
                                {{Form::label('name', 'Nom de compte', array('class' => ''))}}
                                {{Form::text('name', $user->name ,array('class' => 'form-control'))}}
                            </div>
                            <div class="row">
                                {{Form::label('email', 'Email', array('class' => ''))}}
                                {{Form::text('email',  $user->email ,array('class' => 'form-control'))}}
                            </div>
                            <div class="row">
                                <a href="">Changer le mot de passe</a>
                            </div>
                            {{Form::close()}}
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