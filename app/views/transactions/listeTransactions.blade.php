<table id="transactionstable" class="table table-hover table-light">
    <thead>
    <tr class="uppercase">
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
            <td><?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at, 'Europe/Paris');
                $date->setTimezone(Auth::user()->timezone);?>
                {{{' '.$date->format('d/m/Y')}}}</td>
            <td class="">{{$transaction->compte->bookmaker->nom}}</td>
            <td class="">{{$transaction->compte->nom_compte}}</td>
            <td>
                @if($transaction->type == 'd')
                    <span class="theme-font">{{'depot'}}</span>
                @elseif($transaction->type == 'r')
                    <span class="font-red-haze">{{'retrait'}}</span>
                @elseif($transaction->type == 'b')
                    <span class="theme-font">{{'bonus'}}</span>
                @elseif($transaction->type == 'pc')
                    <span class="theme-font">{{'partial cash out'}}</span>
                @endif
            </td>
            <td class="bold">
                @if($transaction->type == 'd')
                    <span class="theme-font">{{round($transaction->montant,2)}}{{Auth::user()->devise}}</span>
                @elseif($transaction->type == 'r')
                    <span class="font-red-haze">{{round($transaction->montant,2)}}{{Auth::user()->devise}}</span>
                @elseif($transaction->type == 'b')
                    <span class="theme-font">{{round($transaction->montant,2)}}{{Auth::user()->devise}}</span>
                @elseif($transaction->type == 'pc')
                    <span class="theme-font">{{round($transaction->montant,2)}}{{Auth::user()->devise}}</span>
                @endif
            </td>
            <td>{{$transaction->description ? $transaction->description : '-'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

