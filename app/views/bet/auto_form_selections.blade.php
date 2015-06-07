<div class="table-responsive">
    <table class="table table-bordered ">
        <thead>
        <tr>
            <th class="hidden"></th>
            <th colspan="4">
                infos selection
            </th>
            <th colspan="3">
                infos pari
            </th>

            <th>cote</th>
        </tr>
        </thead>
        <tbody>
        @foreach($selections as $selection)
        <tr>
            <td class="selection_id hidden">{{$selection->id}}</td>

            <td>{{$selection->game_time}}</td>
            <td>{{$selection->sport_name}}</td>
            <td>{{$selection->league_name}}</td>
            <td>{{$selection->game_name}}</td>
            <td><span class="bold">Pari:</span>{{$selection->market}}{{' ('.$selection->scope.') | '}}<span class="bold">Choix:</span>{{' '.$selection->pick}}</td>
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