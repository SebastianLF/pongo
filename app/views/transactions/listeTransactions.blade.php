<table class="table table-hover table-light">
    <thead>
    <tr>
        <th>Date</th>
        <th>bookmaker</th>
        <th>compte</th>
        <th>Type</th>
        <th>Montant</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{$transaction->created_at}}</td>
        <td><img src="{{isset($transaction->logo) ? asset('img/logos/bookmakers').'/'.$transaction->logo : ''}}" width="100px"></td>
        <td>{{$transaction->nom_compte}}</td>
        <td>{{$transaction->type}}</td>
        <td class="bold theme-font">{{$transaction->montant}}{{$user->devise}}</td>
        <td>{{$transaction->description ? $transaction->description : '-'}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
{{$transactions->links()}}