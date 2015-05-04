<table id="bookmakerstable" class="table table-hover table-light">
    <thead>
    <tr class="uppercase">
        <th>N° ou nom compte</th>
        <th>Bookmaker</th>
        <th>Montant actuel total</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookmakers as $bookmaker)
    <tr>
        <td class="hidden">{{$bookmaker->id}}</td>
        <td class="idbookmakertd hidden id">{{$bookmaker->pivot->id}}</td>
        <td class="name">{{$bookmaker->pivot->nom_compte}}</td>
        <td><img src="{{isset($bookmaker->logo) ? asset('img/logos/bookmakers').'/'.$bookmaker->logo : $bookmaker->nom}}" width="100px"></td>
        <td class="bold theme-font"><span class="bankrollamountconfig">{{$bookmaker->pivot->bankroll_actuelle}} {{$user->devise}}</span>
        </td>
        <td>
            <button type="button" class="bookmakerEditButton btn bg-yellow-saffron btn-sm" data-target="#bookmakerEditModal"
                    data-toggle="modal" data-id-bookmaker="{{$bookmaker->id}}" data-id="{{$bookmaker->pivot->id}}"
                    data-name="{{$bookmaker->pivot->nom_compte}}"><i class="fa fa-pencil-square-o fa-2x"></i></button>
            <button type="button" class="bookmakerDeleteButton btn btn-danger btn-sm"><i
                        class="fa fa-trash-o fa-2x"></i></button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
{{$bookmakers->links()}}

