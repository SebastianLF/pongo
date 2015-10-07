@if($count_paris_encours == '0')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <span class="glyphicon glyphicon-plus-sign"></span> Ajouter un pari classique à l'aide du formulaire d'ajout
            dans le panneau ci-dessous <span class="glyphicon glyphicon-hand-down"></span>
        </div>
    </div>
@else
    <table id="parisencourstable" class="table table-condensed table-bordered">
        <thead>
        <tr class="uppercase">
            <th></th>
            <th>date r.</th>
            <th>Sport</th>
            <th>Competition</th>
            <th>Rencontre</th>
            <th>Pari</th>
            <th>Tipster</th>
            <th>Book</th>
            <th>Cote</th>
            <th>Mise</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($parisencours as $pari)
            <?php $app = App::make('pari_affichage');
            $selections_final = $pari->selections;
            foreach ($selections_final as $selections) {
                $pariAffichage = $app->display($selections->market_id, $selections->pick, $selections->odd_doubleParam1, $selections->odd_doubleParam2, $selections->odd_doubleParam3, $selections->odd_participantParameterName, $selections->odd_participantParameterName2, $selections->odd_participantParameterName3, $selections->home_team, $selections->away_team);
                $selections['pariAffichage'] = $pariAffichage;
            } ?>
            <tr data-selections='{{{$selections_final}}}' data-pari-id='{{{$pari->id}}}' data-pari-type='{{{$pari->type_profil}}}'>
                <td>{{{'#'.$pari->numero_pari}}}</td>
                <td>
                    @if($pari->type_profil == 's')
                        <?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $pari->selections->first()->date_match, 'Europe/Paris');
                        $date->setTimezone(Auth::user()->timezone);?>
                        {{{' '.$date->format('d/m/Y H:i')}}}
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif

                </td>
                <td>
                    @if($pari->type_profil == 's')
                        {{{$pari->selections->first()->sport->name}}}
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif
                </td>
                <td>@if($pari->type_profil == 's')
                        {{{$pari->selections->first()->competition->name}}}
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif</td>
                <td>
                    @if($pari->type_profil == 's')
                        @if($pari->selections->first()->isMatch)
                            {{{$pari->selections->first()->game_name}}}
                        @else
                            {{{'N/A'}}}
                        @endif
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif
                </td>

                <td class="blue">
                    @if($pari->type_profil == 's')
                        {{$pariAffichage}}
                        {{' ('.$pari->selections->first()->scope->representation.') '}}
                        @if($pari->selections->first()->score)
                            {{' ('.$pari->selections->first()->score.' LIVE!) '}}
                        @endif
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif
                </td>
                <td>{{$pari->tipster->name}}</td>
                <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-combine label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}
                </td>
                <td class="fit tdcote">{{$pari->cote}}</td>
                <td class="tdmise  bold">

                    <span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{Auth::user()->devise}}} {{'('.+$pari->nombre_unites.'u)'}}
                </td>

                <td width="90px">
                    @if($pari->type_profil == 's')
                        <select name="status[]"
                                data-value=""
                                class="form-control inputs-ticket">
                            <option value="0">-Choisir-</option>
                            @foreach($types_resultat as $key => $type)
                                <option value="{{$key}}"><a href="javascript:;"
                                                            class="btn btn-xs">{{$type}}</a>
                                </option>
                            @endforeach
                        </select>
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif

                </td>


                <td width="120px">
                    {{ Form::button('<i class="fa fa-check"></i>', array('data-pari-type' => $pari->type_profil, 'data-pari-id' => $pari->id, 'data-style' => "zoom-in", 'class' => 'boutonvalider btn btn-sm ladda-button green-jungle buttons-actions-ticket')) }}
                    {{ Form::button('<i class="fa fa-trash"></i>', array('data-pari-type' => $pari->type_profil, 'data-pari-id' => $pari->id, 'data-style' => "zoom-in", 'class' => 'boutonsupprimer btn btn-sm ladda-button red buttons-actions-ticket')) }}
                    @if($pari->followtype == 'n')
                        {{ Form::button('<i class="fa fa-briefcase"></i>', array('type' => 'submit', 'class' => 'btn btn-sm grey-gallery form-bouton-paris buttons-actions-ticket', 'data-toggle' => 'modal', 'data-target' => '#cashoutModal', 'data-hover' => 'tooltip', 'data-id' => $pari->id, 'title' => 'Cash Out')) }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif