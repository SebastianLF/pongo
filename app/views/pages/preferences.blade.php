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
                                <i class="fa fa-cogs"></i>informations
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <!-- BEGIN FORM-->
                            <form action="javascript:;" class="form-horizontal form-row-sepe">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Langue</label>
                                        <div class="col-md-8">
                                            <select class="form-control select2me select2-offscreen" data-placeholder="Select..." disabled="" tabindex="-1" title="">
                                                <option value="AL">Francais</option>
                                            </select>
                                            <!-- /input-group -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Multi-Value Select</label>
                                        <div class="col-md-4">

                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop