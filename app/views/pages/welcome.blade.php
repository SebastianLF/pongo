    @extends('layouts.welcome_template')

    @section('content')

        <div class="page-content">
            <div class="container">
                <div class="portlet light bordered form-fit col-md-8 col-md-offset-2">
                    <div class="portlet-title">
                        <div class="caption">

                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="note note-bordered note-danger text-center">
                            <p>
                               Attention! dans la version BETA, la devise n'est pas modifiable.
                            </p>
                        </div>
                        <!-- BEGIN FORM-->
                        {{ Form::open(array('url' => 'welcome', 'method' => 'post', 'id' => 'form-devise', 'class' => 'form-horizontal ', 'role' => 'form')) }}
                            <div class="form-body">
                                <div class="{{$errors->has('devise') ? 'form-group has-error' : 'form-group'}} ">
                                    <label class="control-label col-md-3 col-xs-3 col-md-offset-2 col-xs-offset-2">Devise:</label>
                                    <div class="col-md-4">
                                        <select name="devise" class="form-control" >
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
