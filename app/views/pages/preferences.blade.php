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
                            <form action="index.html" class="form-horizontal form-row-seperated">
                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Langue</label>

                                        <div class="col-md-4">
                                            <select class="bs-select form-control" disabled="" style="display: none;">
                                                <option></option>
                                            </select>

                                            <div class="btn-group bootstrap-select bs-select form-control">
                                                <button type="button"
                                                        class="btn dropdown-toggle selectpicker disabled btn-default"
                                                        data-toggle="dropdown" tabindex="-1" title="Mustard"><span
                                                            class="filter-option pull-left">Francais</span>&nbsp;<span
                                                            class="caret"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Type de cote</label>

                                        <div class="col-md-4">
                                            <select class="bs-select form-control" disabled="" style="display: none;">
                                                <option></option>
                                            </select>

                                            <div class="btn-group bootstrap-select bs-select form-control">
                                                <button type="button"
                                                        class="btn dropdown-toggle selectpicker disabled btn-default"
                                                        data-toggle="dropdown" tabindex="-1" title="Mustard"><span
                                                            class="filter-option pull-left">europeenne</span>&nbsp;<span
                                                            class="caret"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fuseau horaire</label>

                                        <div class="col-md-4">
                                            <select class="bs-select form-control" disabled="" style="display: none;">
                                                <option>Francais</option>
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
                        <button type="submit" class="btn green disabled"><i class="fa fa-check"></i> Valider les changements
                        </button>
                        <button type="button" class="btn default disabled">Annuler</button>
                    </div>
                </div>
            </div>
            </form>
            <!-- END FORM-->



        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
@stop