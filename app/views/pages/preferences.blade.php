@extends('layouts.default')

@section('content')
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Preferences</h1>
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
                                <i class="fa fa-cogs font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Preferences</span>
                            </div>

                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            {{Form::open(array('route' => array('preferences.update', Auth::user()->id), 'class' => 'form-horizontal form-bordered' ))}}
                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Langue</label>

                                        <div class="col-md-4">
                                            <select class="bs-select form-control" disabled>
                                                <option value="fr">Francais</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Affichage cote</label>

                                        <div class="col-md-4">
                                            <select class="bs-select form-control" disabled="" style="display: none;">
                                                <option value="dec">Décimal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fuseau horaire</label>

                                        <div class="col-md-4">
                                            <select class="bs-select form-control" disabled="" style="display: none;">
                                                <option value="UTC+2">UTC+2</option>
                                            </select>

                                            <div class="btn-group bootstrap-select bs-select form-control">
                                                <button type="button"
                                                        class="btn dropdown-toggle selectpicker disabled btn-default"
                                                        data-toggle="dropdown" tabindex="-1" title="Mustard"><span
                                                            class="filter-option pull-left"></span>&nbsp;<span
                                                            class="caret"></span></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green disabled"><i class="fa fa-check"></i>
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
        </div>
    </div>
@stop