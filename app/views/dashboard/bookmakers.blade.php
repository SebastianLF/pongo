<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">

            <span class="caption-subject bold theme-font uppercase"><i class="icon-book-open"></i> Solde Bookmakers</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        @if(empty($bookmakers))
            <div class="text-center">Aucun bookmaker.</div>
        @else
        <div class="panel-group accordion" id="accordion3">
        @foreach($bookmakers as $bookmaker)
            <div class="panel panel-default">

                    <?php $paris_en_attente = 0; ?>
                    @foreach($bookmaker->comptes as $compte)
                        <?php $paris_en_attente += $compte->enCoursParis->count(); ?>
                    @endforeach
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed"
                               data-toggle="collapse" data-parent="#accordion3" href="{{'#row'.$bookmaker->id}}">
                                <span class="theme-font blue-bookmaker">{{$bookmaker->nom.' |'}}</span>
                                     <span
                                            class="theme-font">{{$bookmaker['comptes']->sum('bankroll_actuelle')}} {{Auth::user()->devise}}</span></span>
                                {{$paris_en_attente ? '<span class="badge badge-danger bcg-red" data-toggle="tooltip" data-original-title="Nombre de paris en cours associés: '.$paris_en_attente.'">'.$paris_en_attente.'</span>' : ''}}
                            </a>
                        </div>
                    </div>
                    <div id="{{'row'.$bookmaker->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-condensed table-hover table-light table-centred table-bookmakersOnDashboard">
                                @foreach($bookmaker->comptes as $compte)
                                    <tr>
                                        <td>{{$compte->nom_compte}}</td>
                                        <td>{{$compte->bankroll_actuelle}}{{Auth::user()->devise}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>