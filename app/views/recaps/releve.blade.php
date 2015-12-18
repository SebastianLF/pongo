<div id="table-releve-recap" class=" table-scrollable table-scrollable-borderless">
    @if($releves_pour_chaque_jour->count() == 0)
        <div class="text-center">Aucun relevé</div>
    @else
        <table class="table table-hover table-light">
            <thead>
            <tr class="uppercase">
                <th></th>
                <th>
                    date
                </th>
                <th>qté</th>
                <th>
                    profits
                </th>

            </tr>
            </thead>
            <tbody>

            @foreach($releves_pour_chaque_jour as $key => $releve_jour)
                <?php
                $date_cloturation = Carbon::createFromFormat('Y-m-d', $releve_jour->closed_bis_at, 'Europe/Paris');
                $date_cloturation->setTimezone(Auth::user()->timezone);
                $date_cloturation->format('d/m/Y')  ?>
                <tr>
                    <td><span class="button-releve-details glyphicon glyphicon-triangle-bottom" data-date="{{$date_cloturation}}"></span></td>
                    <td>{{$date_cloturation->format('d/m/Y')}}</td>
                    <td>{{$releve_jour->quantite}}</td>
                    <td><?php
                        $profit_par_jour = floatval(round($releve_jour->profit_par_jour, 2));
                        if ($profit_par_jour > 0) {
                            $profit_par_jour = '<span class="bold font-green-sharp">' . ' +' . $profit_par_jour . ' ' . Auth::user()->devise . '</span>';
                        } elseif ($profit_par_jour < 0) {
                            $profit_par_jour = '<span class="bold red-lose">' . $profit_par_jour . ' ' . Auth::user()->devise . '</span>';
                        } elseif ($profit_par_jour == 0) {
                            $profit_par_jour = '<span class="bold">' . $profit_par_jour . ' ' . Auth::user()->devise . '</span>';
                        }?>
                        {{$profit_par_jour}}
                    </td>
                </tr>

                <tr class="collapse" id="{{$releve_jour->closed_bis_at.'_'.$key}}">
                    <td>zqdq</td>
                    <td>zqdq</td>
                    <td>zqdq</td>
                    <td>zqdq</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
