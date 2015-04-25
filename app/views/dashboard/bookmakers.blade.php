<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Bookmakers</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
            <a href="#portlet-config" data-toggle="modal" class="config">
            </a>
        </div>
    </div>
    <div class="portlet-body">

        <div class="panel-group accordion" id="accordion3">
            <div class="panel panel-default">
                @foreach($bookmakers as $bookmaker)
                    <?php $paris_en_attente = 0; ?>
                    @foreach($bookmaker->comptes as $compte)
                        <?php $paris_en_attente += $compte->enCoursParis->count(); ?>
                    @endforeach
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed"
                               data-toggle="collapse" data-parent="#accordion3" href="{{'#row'.$bookmaker->id}}">
                                <img width="100px"
                                     src="{{asset('img/logos/bookmakers').'/'.$bookmaker->logo}}"
                                     alt=""/> <span class="theme-font ">solde: <span
                                            class="theme-font bold">{{$bookmaker['comptes']->sum('bankroll_actuelle')}} {{$user->devise}}</span></span>
                                <span class="glyphicon glyphicon-circle-arrow-up font-green-sharp"></span>
                                <span class="pull-right mr theme-font"> {{$paris_en_attente ? 'paris: '.$paris_en_attente.' en attente' : ''}}</span>
                            </a>
                        </h4>
                    </div>
                    <div id="{{'row'.$bookmaker->id}}" class="panel-collapse collapse">
                        <div class="panel-body" style="height:200px; overflow-y:auto;">
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
                @endforeach
            </div>

        </div>
    </div>

</div>