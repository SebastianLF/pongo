@extends('layouts.default', array('title' => 'Profil') )

@section('content')


        <div class="container">
            <div class="row">
                @if(Session::has('mdp_updated'))
                    <div class="alert alert-success" role="alert">{{ Session::get('mdp_updated') }}</div>
                @endif
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
                            {{Form::open(array('route' => array('profile.store'), 'class' => 'form-horizontal form-bordered'))}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nom</label>

                                    <div class="col-md-4">
                                    <span class="form-control-static">{{Auth::user()->name}}</span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Email</label>

                                    <div class="col-md-4">
                                        <span class="form-control-static">{{Auth::user()->email}}</span>
                                    </div>
                                </div>
                                <div class="{{$errors->has('actuel_mdp') ? 'form-group has-error' : 'form-group'}}">
                                    <label class="control-label col-md-3">Mot de passe actuel</label>
                                    <div class="col-md-4">
                                        <input type="password" name="actuel_mdp" class="form-control" value="{{ Input::old('actuel_mdp') }}">
                                        <span class="help-block">{{$errors->first('actuel_mdp')}}</span>
                                    </div>
                                </div>

                                <div class="{{$errors->has('nouveau_mdp') ? 'form-group has-error' : 'form-group'}}">
                                    <label class="control-label col-md-3">Nouveau mot de passe</label>

                                    <div class="col-md-4">
                                        <input type="password" name="nouveau_mdp" class="form-control" value="">
                                        <span class="help-block">{{$errors->first('nouveau_mdp')}}</span>
                                    </div>
                                </div>
                                <div class="{{$errors->has('confirmation_mdp') ? 'form-group has-error' : 'form-group'}}">
                                    <label class="control-label col-md-3">Confirmation mot de passe</label>

                                    <div class="col-md-4">
                                        <input type="password" name="confirmation_mdp" class="form-control" value="">
                                        <span class="help-block">{{$errors->first('confirmation_mdp')}}</span>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{Form::close()}}
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-blue-hoki"></i>
                                    <span class="caption-subject font-blue-hoki bold uppercase">Abonnement</span>

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="container">
                                    <div class="row ">
                                        <!-- Pricing -->

                                        <div class="col-md-3  col-md-offset-4 text-center">
                                            <div class="panel panel-success panel-pricing">
                                                <div class="panel-heading">
                                                    <i class="fa fa-desktop"></i>

                                                    <h3>Beta 1.0</h3>
                                                </div>
                                                <div class="panel-body text-center">
                                                    <p><strong>0 {{Auth::user()->devise}} / Mois</strong></p>
                                                </div>
                                                <ul class="list-group text-center">
                                                    <li class="list-group-item"><i class="fa fa-check"></i> Toutes les fonctions
                                                    </li>
                                                </ul>
                                                <div class="panel-footer">
                                                    <a class="btn btn-lg btn-block btn-success uppercase">EN COURS</a>
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