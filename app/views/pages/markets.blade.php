@extends('layouts.default', array('title' => 'Pongo - Glossaire'))

@section('content')
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Glossaire</h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row margin-top-10">
                <div class="col-md-AZ col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject theme-font bold uppercase">Liste</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="note note-danger">
                                <p>
                                    CTRL + F puis tapez le nom du type de pari pour le retrouver plus rapidement sur la page.
                                </p>
                            </div>
                            <table class="table table-condensed table-bordered">
                                <thead>
                                <tr class="uppercase">
                                    <th>nom</th>
                                    <th>description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($markets as $market)
                                    <tr>
                                        <td>{{$market->name}}</td>
                                        <td>{{$market->description}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>


        </div>
    </div>
@stop

