<div id="table-releve-recap" class=" table-scrollable table-scrollable-borderless">
    @if($releves_pour_chaque_jour->count() == 0)
        <div class="text-center">Aucun relevé</div>
    @else
        <table class="table table-hover table-light">
            <thead>
            <tr class="uppercase">

                <th>
                    date
                </th>
                <th>
                    profits
                </th>
                
            </tr>
            </thead>
            <tbody>

            @foreach($releves_pour_chaque_jour as $releve_jour)
                <tr>
                    <td>
                        <?php
                        $date_cloturation = Carbon::createFromFormat('Y-m-d', $releve_jour->date_cloturation, 'Europe/Paris');
                        $date_cloturation->setTimezone(Auth::user()->timezone); ?>
                        {{$date_cloturation->format('d/m/Y')}}
                    </td>
                    <td><?php
                        $profit_par_jour = floatval(round($releve_jour->profit_par_jour, 2));
                        if ($profit_par_jour > 0) {
                        $profit_par_jour = '<span class="bold font-green-sharp">' . ' +' . $profit_par_jour . ' ' . Auth::user()->devise . '</span>';
                        } elseif ($profit_par_jour < 0) {
                        $profit_par_jour = '<span class="bold red-lose">' . $profit_par_jour . ' ' .Auth::user()->devise . '</span>';
                        } elseif ($profit_par_jour == 0) {
                        $profit_par_jour = '<span class="bold">' . $profit_par_jour . ' ' .Auth::user()->devise . '</span>';
                        }?>
                        {{$profit_par_jour}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
