<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>

        </tr>
        </thead>
        <tbody>
        @foreach($selections as $selection)
            <tr>
                <td class="selection_id hidden">{{$selection->id}}</td>

                <td><span class="bold">Date:</span>{{' '.$selection->game_time}}<br/><span
                            class="bold">Evenement:</span>{{' '.$selection->sport_name.' - '}}{{$selection->league_name}}
                    <br/><span class="bold">Match:</span>{{' '.$selection->game_name}}
                </td>
                <td><span class="bold">Bookmaker:</span>{{' '.$selection->bookmaker}}<br/><span
                            class="bold">Pari:</span>{{' '.$selection->market}}{{' ('.$selection->scope.') '}}<br/>
                    <span class="bold">Choix:</span>
                    @if($selection->affichage == "1")
                        {{' '.$selection->pick}}
                    @elseif($selection->affichage == "2")
                        {{' '.$selection->pick}}
                        @if($selection->odd_doubleParam > 0)
                            {{{' +'.$selection->odd_doubleParam}}}
                        @else
                            {{{' '.$selection->odd_doubleParam}}}
                        @endif
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
                    @endif
                </td>
                <td><span class="bold">Cote: </span><input type="text" value="{{$selection->odd_value}}"/></td>
                <td>
                    <button class="boutonsupprimer btn btn-sm red"><i class="glyphicon glyphicon-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>