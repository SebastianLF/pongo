@if($count == 0)
    <div class="list-group">
        <div class="list-group-item">
            <h4 class="list-group-item-heading">1) Ajouter une selection (pari) à l'aide du panneau ci-dessous.</h4>

            <p class="list-group-item-text">
                Vous avez 3 façons d'ajouter une selection, soit par le champ de recherche tout en haut du panneau, soit
                par le menu deroulant juste en dessous du champ de recherche, soit par le menu 'liste des evenements'sur
                la gauche. Si vous ne trouvez pas le bouton 'ajouter au panier', c'est que vous n'avez pas cliqué sur le
                match en question.
            </p>
        </div>
        <div class="list-group-item">
            <h4 class="list-group-item-heading">2) Ajouter les informations générales</h4>

            <p class="list-group-item-text">
                Une fois la ou les selections ajoutées, remplissez les informations générales. Pour finir, cliquez sur
                le bouton 'valider le ticket'. Répétez la procédure pour chaque ticket que vous voulez ajouter :)
            </p>
        </div>
    </div>

@else
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Evenement</th>
                <th>rencontre</th>
                <th>bookmaker</th>
                <th>pari</th>
                <th>choix</th>
                <th>cote</th>
                <th>action</th>
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
                    <td>
                        {{' '.$selection->market.' '}}{{$selection->score =! 'null' ? '('.$selection->score.')' : ''}}{{' ('.$selection->scope.') '}}
                        <br/>
                    <td>
                        <?php $app = App::make('pari_affichage') ?>
                        {{$app->display($selection->market_id, $selection->pick, $selection->odd_doubleParam1, $selection->odd_doubleParam2, $selection->odd_doubleParam3,  $selection->odd_participantParameterName, $selection->odd_participantParameterName2, $selection->odd_participantParameterName3)}}

                    </td>
                    <td><input name="automatic-selection-cote[]" type="text"
                               value="{{$selection->odd_value}}"/></td>
                    <td>
                        <button class="boutonsupprimer btn btn-xs red"><i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

