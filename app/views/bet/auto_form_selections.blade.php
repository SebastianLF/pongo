<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th></th>
            <th>type</th>
            <th>
                infos selection
            </th>
            <th>
                infos pari
            </th>

            <th>cote</th>
        </tr>
        </thead>
        <tbody>
        @foreach($selections as $selection)
        <tr>
            <td class="selection_id hidden">{{$selection->id}}</td>
            <td>{{$selection->isLive ? $selection->isLive : ''}}</td>
            <td>{{$selection->game_time}} - {{$selection->sport_name}} - {{$selection->league_name}} - {{$selection->game_name}}</td>
            <td>{{$selection->market}} - {{$selection->scope}} - {{$selection->pick}}</td>
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