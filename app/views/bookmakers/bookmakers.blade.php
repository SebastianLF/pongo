@include('bookmaker_edit_modal')
@include('bookmaker_add_modal')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="fa fa-cogs font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Bookmakers</span>
                        <span class="caption-helper">Configuration</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="note note-danger">
                        <p>
                            Seul le nom sera modifiable après creation. Pour les depots et les retraits, veuillez utiliser les transactions.
                        </p>
                    </div>
                    <button type="button" id="addBookmakerButton" class="btn red" data-toggle="modal"
                            data-target="#bookmakerAddModal"> Ajouter un compte <span class="icon-book-open"></span>
                    </button>
                    <div class="row">
                        <div id="bookmakers-pagination" class="col-md-8 col-md-offset-2">
                            @if($bookmakers->count() == 0)
                                <div class="text-center">Aucun compte</div>
                            @else

                                <div class="table-scrollable table-scrollable-borderless" w>

                                    <table id="bookmakerstable" class="table table-hover table-light">
                                        <thead>
                                        <tr class="uppercase">
                                            <th>N° ou nom compte</th>
                                            <th>Bookmaker</th>
                                            <th>Montant actuel total</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bookmakers as $bookmaker)
                                            <tr>
                                                <td class="hidden">{{$bookmaker->id}}</td>
                                                <td class="idbookmakertd hidden id">{{$bookmaker->pivot->id}}</td>
                                                <td class="name">{{$bookmaker->pivot->nom_compte}}</td>
                                                <td class="">{{!$bookmaker->logo ? $bookmaker->nom : ''}}</td>
                                                <td class="bold theme-font"><span
                                                            class="bankrollamountconfig">{{round($bookmaker->pivot->bankroll_actuelle, 2)}} {{Auth::user()->devise}}</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="bookmakerEditButton btn bg-yellow-saffron btn-sm"
                                                            data-target="#bookmakerEditModal"
                                                            data-toggle="modal" data-id-bookmaker="{{$bookmaker->id}}"
                                                            data-id="{{$bookmaker->pivot->id}}"
                                                            data-name="{{$bookmaker->pivot->nom_compte}}"><i
                                                                class="fa fa-pencil-square-o fa-2x"></i></button>
                                                    <button type="button" class="bookmakerDeleteButton btn btn-danger btn-sm"><i
                                                                class="fa fa-trash-o fa-2x"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
