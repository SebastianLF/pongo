@if($count == 0)
    <div class="text-center"> - Ici se trouvent les selections ajoutees a partir du mode automatique ou manuel ci-dessous. -</div>
@else
    <div class="table-responsive">
        <table class="table table-condensed">
            <thead>
            <tr class="uppercase">
                <th>pari</th>
                <th>book</th>
                <th width="80px">cote</th>
                <th class="hide"></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($selections as $selection)
                <tr class="betline">
                    <td class="selection_id hidden">{{$selection->id}}</td>

                    <td> @if($selection->isMatch)
                            {{' '.$selection->game_name}}
                        @else
                            {{' '.$selection->league_name}}
                        @endif
                        {{' / '}}
                        <span class="blue">
                        <?php $app = App::make('pari_affichage') ?>
                        {{$app->display($selection->market_id, $selection->pick, $selection->odd_doubleParam, $selection->odd_doubleParam2, $selection->odd_doubleParam3,  $selection->odd_participantParameterName, $selection->odd_participantParameterName2, $selection->odd_participantParameterName3, $selection->home_team, $selection->away_team)}}

                        @if(!is_null($selection->score))
                            {{' ('.$selection->score.' LIVE!) '}}
                        @endif
                        </span>
                    </td>

                    <td>{{' '.$selection->bookmaker}}</td>
                    <td ><input class=" form-control input-coupon-odd" name="automatic-selection-cote[]" type="text"
                               value="{{floatval($selection->odd_value)}}"/></td>
                    <td width="5px">
                        <button class="boutonsupprimer btn btn-xs red"><i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

