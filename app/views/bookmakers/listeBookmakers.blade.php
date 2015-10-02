<table id="bookmakerstable" class="table table-hover table-light">
    <thead>
    <tr class="uppercase">
        <th>date</th>
        <th>N° ou nom compte</th>
        <th>Bookmaker</th>
        <th>Montant actuel total</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookmakers as $bookmaker)
        <tr>
            <td><?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $bookmaker->pivot->created_at, 'Europe/Paris');
                $date->setTimezone(Auth::user()->timezone);?>
                {{{' '.$date->format('d/m/Y')}}}</td>
            <td class="name">{{$bookmaker->pivot->nom_compte}}</td>
            <td class="">{{$bookmaker->nom}}</td>
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
                <button type="button" class="bookmakerDeleteButton btn btn-danger btn-sm" data-id="{{$bookmaker->pivot->id}}"><i
                            class="fa fa-trash-o fa-2x"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
