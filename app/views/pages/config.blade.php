@extends('layouts.default')

@section('content')
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Configuration </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('tipsters.tipsters')
                    @include('bookmakers.bookmakers')
                    @include('transactions.transactions')
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    @parent
    @include('includes.subview.config_scripts')
@stop