    @extends('layouts.default', array('title' => 'Bookmakers', 'page_title_small' => 'comptes, transactions...'))

    @section('content')
        @include('bookmaker_edit_modal')
        @include('bookmaker_add_modal')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">

                        <div class="portlet-body">
                            <div class="note note-danger">
                                <p>
                                    Seul le nom sera modifiable après creation. Pour les depots et les retraits, veuillez utiliser les transactions.
                                </p>
                            </div>
                            <button type="button" id="addBookmakerButton" class="btn red" data-toggle="modal"
                                    data-target="#bookmakerAddModal"> Ajouter un compte <span class="icon-book-open"></span>
                            </button>
                            <div class="">
                                <div id="bookmakers-pagination" class="">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @stop

    @section('scripts')
        @parent
        <script src="{{asset('build/js/bookmakers.js')}}" type="text/javascript"></script>
    @stop
