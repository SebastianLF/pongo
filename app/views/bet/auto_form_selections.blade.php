@if($count == 0)
    <div class="list-group">
        <div class="list-group-item">
            <h4 class="list-group-item-heading">1) List group item heading</h4>

            <p class="list-group-item-text">
                Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
            </p>
        </div>
        <div class="list-group-item">
            <h4 class="list-group-item-heading">2) List group item heading</h4>

            <p class="list-group-item-text">
                Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
            </p>
        </div>
        <div class="list-group-item">
            <h4 class="list-group-item-heading">3) List group item heading</h4>

            <p class="list-group-item-text">
                Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
            </p>
        </div>
    </div>

@else
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

            </tr>
            </thead>
            <tbody>
            @foreach($selections as $selection)
                <tr class="betline">
                    <td class="selection_id hidden">{{$selection->id}}</td>

                    <td><span class="bold">Date:</span>{{' '.$selection->game_time}}<br/><span
                                class="bold">Evenement:</span>{{' '.$selection->sport_name.' - '}}{{$selection->league_name}}
                        <br/>
                        @if($selection->isMatch)
                        <span class="bold">Match:</span>{{' '.$selection->game_name}}
                        @endif
                    </td>
                    <td><span class="bold">Bookmaker:</span>{{' '.$selection->bookmaker}}<br/><span
                                class="bold">Pari:</span>{{' '.$selection->market.' '}}{{$selection->score =! 'null' ? '('.$selection->score.')' : ''}}{{' ('.$selection->scope.') '}}<br/>
                        <span class="bold">Choix:</span>
                        @if($selection->affichage == "1")
                            {{' '.$selection->pick}}
                        @elseif($selection->affichage == "2")
                            {{' '.$selection->pick.' '.$selection->odd_doubleParam}}
                        @elseif($selection->affichage == "3")
                            {{' '.$selection->pick}}{{', '.$selection->odd_participantParameterName}}
                            @if($selection->odd_doubleParam > 0)
                                {{{' +'.$selection->odd_doubleParam}}}
                            @else
                                {{{' '.$selection->odd_doubleParam}}}
                            @endif
                        @elseif($selection->affichage == "4")
                            {{' '.$selection->pick}}{{', '.$selection->odd_doubleParam}}{{'-'.$selection->odd_doubleParam}}
                        @elseif($selection->affichage == "5")
                            {{' '.$selection->odd_participantParameterName}}
                            @if($selection->odd_doubleParam > 0)
                                {{{' +'.$selection->odd_doubleParam}}}
                            @else
                                {{{' '.$selection->odd_doubleParam}}}
                            @endif
                        @elseif($selection->affichage == "6")
                            {{' '.$selection->pick}}{{', Top '.$selection->odd_doubleParam}}
                        @elseif($selection->affichage == "7")
                            {{' '.$selection->pick}}
                            @if($selection->odd_doubleParam > 0)
                                {{{' +'.$selection->odd_doubleParam}}}
                            @else
                                {{{' '.$selection->odd_doubleParam}}}
                            @endif
                        @elseif($selection->affichage == 3)
                            {{$selection->odd_participantParameterName}}{{' '}}{{$selection->pick}}{{' '}}{{$selection->odd_doubleParam}}
                        @endif

                    </td>
                    <td><span class="bold">Cote: </span><input name="automatic-selection-cote[]" type="text"
                                                               value="{{$selection->odd_value}}"/></td>
                    <td>
                        <button class="boutonsupprimer btn btn-sm red"><i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endif

