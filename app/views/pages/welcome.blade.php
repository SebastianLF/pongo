@extends('layouts.default', array('title' => 'Bienvenue !', 'page_title_small' => 'Beta 1.0'))

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption font-red-intense">
                    <i class="icon-speech font-red-intense"></i>
                    <span class="caption-subject bold uppercase"> N'oubliez pas !</span>

                </div>
            </div>
            <div class="portlet-body">
                <div id="context" data-toggle="context" data-target="#context-menu">
                    <p>
                    <span class="glyphicon glyphicon-exclamation-sign font-red-intense"></span> Les montants doivent être sous la forme anglaise, exemple: 10.00€ et non pas 10,00€ .
                    </p>
                    <p><span class="glyphicon glyphicon-exclamation-sign font-red-intense"></span> Lors d'un ajout de pari, un tipster doit être forcement associé.</p>
                    <span class="glyphicon glyphicon-exclamation-sign font-red-intense"></span> Dans la version beta, la devise ne pourra pas être modifiée. Choisissez bien votre devise.
                </div>
                <hr>
                <!-- BEGIN FORM-->
                {{ Form::open(array('url' => 'welcome', 'method' => 'post', 'id' => 'form-devise', 'class' => 'form-horizontal ', 'role' => 'form')) }}
                <div class="form-body">
                    <div class="{{$errors->has('devise') ? 'form-group has-error' : 'form-group'}} ">
                        <label class="control-label col-md-3 col-xs-3 col-md-offset-2 col-xs-offset-2">Devise:</label>

                        <div class="col-md-4">
                            <select name="devise" class="form-control">
                                <option value="1">US Dollar</option>
                                <option value="2">Euro</option>
                                <option value="3">British Pound</option>
                            </select>
                            <span class="help-block">{{$errors->first('devise')}}</span>
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-5 col-xs-offset-5 col-md-9">
                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Enregistrer</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}

                        <!-- Your custom menu with dropdown-menu as default styling -->
            </div>
        </div>
        <!-- END PORTLET-->
    </div>

@stop

@section('scripts')
    @parent
    <script src="{{asset('build/js/welcome.js')}}" type="text/javascript"></script>
@stop
