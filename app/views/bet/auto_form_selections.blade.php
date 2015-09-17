@if($count == 0)

@else
    <div class="table-responsive">
        <table class="table table-condensed">
            <thead>
            <tr class="uppercase">
                <th>Date</th>
                <th>Evenement</th>
                <th>rencontre</th>
                <th>bookmaker</th>
                <th>pari</th>
                <th width="80px">cote</th>
                <th class="hide">action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($selections as $selection)
                <tr class="betline">
                    <td class="selection_id hidden">{{$selection->id}}</td>

                    <td>{{{' '.$selection->game_time}}}<br/>
                        <br/>

                    </td>
                    <td>{{' '.$selection->sport_name.' - '}}{{$selection->league_name}}</td>
                    <td> @if($selection->isMatch)
                            {{' '.$selection->game_name}}
                        @else
                            {{'N/A'}}
                        @endif</td>
                    <td>{{' '.$selection->bookmaker}}<br/></td>
                    <td class="blue">
                        <?php $app = App::make('pari_affichage') ?>
                        {{$app->display($selection->market_id, $selection->pick, $selection->odd_doubleParam1, $selection->odd_doubleParam2, $selection->odd_doubleParam3,  $selection->odd_participantParameterName, $selection->odd_participantParameterName2, $selection->odd_participantParameterName3)}}
                        {{' ('.$selection->scope.') '}}
                        @if(!is_null($selection->score))
                            {{' ('.$selection->score.' LIVE!) '}}
                        @endif
                    </td>
                    <td ><input class=" form-control input-coupon-odd" name="automatic-selection-cote[]" type="text"
                               value="{{$selection->odd_value}}"/></td>
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

