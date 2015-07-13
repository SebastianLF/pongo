    @extends('layouts.default')

    @section('content')
        <div class="page-head">
            <div class="container-fluid">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Bienvenue !</h1>
                </div>
                <!-- END PAGE TOOLBAR -->
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="portlet light bordered form-fit col-md-9 col-md-offset-1">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-blue-hoki"></i>
                            <span class="caption-subject font-blue-hoki bold uppercase">Bienvenue</span>
                            <span class="caption-helper">Informations</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="note note-bordered note-danger text-center">
                            <p>
                                <strong>Attention!</strong> dans la version BETA, la devise n'est pas modifiable.
                            </p>
                        </div>
                        <!-- BEGIN FORM-->
                        {{ Form::open(array('url' => 'devise', 'method' => 'post', 'id' => 'form-devise', 'class' => 'form-horizontal', 'role' => 'form')) }}
                            <div class="form-body">
                                <div class="{{$errors->has('devise') ? 'form-group has-error' : 'form-group'}}">
                                    <label class="control-label col-md-3">Devise:</label>
                                    <div class="col-md-4">
                                        <select name="devise" class="devise form-control" width="100px !important">
                                        </select>
                                        <span class="help-block">{{$errors->first('devise')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-check"></i> Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        @parent
        <script src="{{asset('build/js/welcome.js')}}" type="text/javascript"></script>

    @stop
