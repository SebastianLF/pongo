<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Bookmakers</span>
        </div>
    </div>
    <div class="portlet-body">
        @if(!empty($bookmakers))
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
                                <img width="100px"
                                     src="{{asset('img/logos/bookmakers').'/'.$bookmaker->logo}}"
                                     alt=""/> <span
                                            class="theme-font">{{$bookmaker['comptes']->sum('bankroll_actuelle')}} {{$user->devise}}</span></span>
                                {{$paris_en_attente ? '<span class="badge badge-danger bcg-red" data-toggle="tooltip" data-original-title="Nombre de tickets actuels associés: '.$paris_en_attente.'">'.$paris_en_attente.'</span>' : ''}}
                            </a>
                        </div>
                    </div>
                    <div id="{{'row'.$bookmaker->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                @foreach($bookmaker->comptes as $compte)
                                    <tr>
                                        <td>{{$compte->nom_compte}}</td>
                                        <td>{{$compte->bankroll_actuelle}}{{$user->devise}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

            </div>
            @endforeach
        </div>
        @else

        @endif
    </div>
</div>