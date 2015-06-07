<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th></th>
            <th>
                game_time
            </th>
            <th>
                sport_id
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($selections as $selection)
        <tr>
            <td class="selection_id">{{$selection->id}}</td>
            <td>{{$selection->game_time}} - {{$selection->sport_name}} - {{$selection->league_name}} - {{$selection->game_name}}</td>
            <td></td>
            <td>
                <button class="boutonsupprimer btn btn-sm red"><i class="glyphicon glyphicon-trash"></i>
                </button>
            </td>
        </tr>
            @endforeach

        </tbody>
    </table>
</div>