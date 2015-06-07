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

            <td><span class="bold">Date:</span>{{' '.$selection->game_time}}<br/><span class="bold">Evenement:</span>{{' '.$selection->sport_name.' - '}}{{$selection->league_name}}
                <br/><span class="bold">Match:</span>{{' '.$selection->game_name}}
            </td>
            <td>{{$selection->sport_name}}</td>
            <td></td>
            <td></td>
            <td><span class="bold">Pari:</span>{{' '.$selection->market}}{{' ('.$selection->scope.') '}}<br/><span class="bold">Choix:</span>{{' '.$selection->pick}}</td>
            <td>{{$selection->isLive ? $selection->isLive : ''}}</td>
            <td>{{$selection->odd_value}}</td>
            <td>
                <button class="boutonsupprimer btn btn-sm red"><i class="glyphicon glyphicon-trash"></i>
                </button>
            </td>
        </tr>
            @endforeach

        </tbody>
    </table>
</div>