@if($count_paris_termine == '0')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <span class="glyphicon glyphicon-hand-down"></span> Ajouter un pari classique à l'aide du formulaire d'ajout
            dans le panneau ci-dessous
        </div>
    </div>
@else
    <table id="paristerminetable" class="table table-light table-condensed table-hover table-paris">
        <thead>
        <tr class="uppercase">
            <th>cloturé le</th>
            <th class="hidden-sm">Sport</th>
            <th class="hidden-sm">Competition</th>
            <th>Pari</th>
            <th>Tipster</th>
            <th>Mise</th>
            <th>Book</th>
            <th>Cote</th>
            <th>Status</th>
            <th>Mt. retour</th>
            <th>profits</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($paristermine as $pari)
            <?php $pari_affichage = App::make('pari_affichage');
            $selections_final = $pari->selections;
            foreach ($selections_final as $selections) {
                $pariAffichage = $pari_affichage->display($selections->market_id, $selections->scope_id, $selections->pick, $selections->odd_doubleParam, $selections->odd_doubleParam2, $selections->odd_doubleParam3, $selections->odd_participantParameterName, $selections->odd_participantParameterName2, $selections->odd_participantParameterName3, $selections->equipe1['name'], $selections->equipe2['name']);
                $selections['pariAffichage'] = $pariAffichage;
            } ?>
            <tr data-selections='{{{$selections_final}}}' data-nb-selections='{{{$pari->selections->count()}}}'
                data-pick="{{$selections->pick}}" data-name1='{{$selections->equipe1['name']}}'
                data-pari-id='{{{$pari->id}}}'
                data-selection-id='{{{$pari->type_profil == "s" ? $selections->id : ""}}}'
                data-pari-type='{{{$pari->type_profil}}}'>
                <td>

                    <?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $pari->closed_at, 'Europe/Paris');
                    $date->setTimezone(Auth::user()->timezone);?>
                    {{{' '.$date->format('d/m/Y H:i')}}}


                </td>
                <td class="hidden-sm">
                    @if($pari->type_profil == 's')
                        {{{$pari->selections->first()->sport->name}}}
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif
                </td>
                <td class="hidden-sm">@if($pari->type_profil == 's')
                        {{{$pari->selections->first()->competition->name}}}
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif</td>
                <td>
                    @if($pari->type_profil == 's')
                        @if($pari->selections->first()->isMatch)
                            {{{$pari->selections->first()->game_name.' »'}}}
                        @endif
                    @endif
                    <span class="blue">
                        @if($pari->type_profil == 's')
                            {{$pariAffichage}}
                            @if($pari->selections->first()->isLive)
                                <span class="label label-sm label-danger label-mini">{{$pari->selections->first()->score.' LIVE!'}}</span>
                            @endif
                        @else
                            <span class="label label-sm label-success label-mini">combiné</span>
                        @endif
                    </span>
                </td>
                <td>{{$pari->tipster->name}}</td>
                <td class="tdmise  bold">

                    <span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{Auth::user()->devise}}}
                </td>
                <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-combine label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}
                </td>
                <td width="10px" class="fit tdcote td-bet">{{floatval($pari->cote)}}</td>
                <td width="" class="uppercase">
                    <?php
                    switch ($pari->status) {
                        case 1:
                            echo '<span class="bold fontsize15 font-green-sharp">gagné</span>';
                            break;
                        case 2:
                            echo '<span class="bold fontsize15 font-red-haze">perdu</span>';
                            break;
                        case 3:
                            echo '<span class="bold fontsize15 font-green-sharp">1/2 gagné</span>';
                            break;
                        case 4:
                            echo '<span class="bold fontsize15 font-red-haze">1/2 perdu</span>';
                            break;
                        case 5:
                            echo '<span class="bold fontsize15">Remboursé</span>';
                            break;
                        case 6:
                            echo '<span class="bold fontsize15 font-blue">cash out</span>';
                            break;
                        case 7:
                            echo '<span class="bold fontsize15 font-green-sharp">GAGNE PARTIEL</span>';
                            break;
                        case 8:
                            echo '<span class="bold fontsize15 font-red-haze">PERDU PARTIEL</span>';
                            break;
                        case 9:
                            echo '<span class="bold fontsize15">ANNULE</span>';
                            break;
                    }?>

                </td>

                <td><span class="bold">
                        <span class="">{{floatval($pari->montant_retour).''.Auth::user()->devise}}</span>
                    </span>
                </td>
                <td>
                    @if($pari->montant_profit > 0)<span class="bold font-green-sharp">
                                <span class="profits">{{' +'.floatval($pari->montant_profit)}}</span><span
                                class="devise">{{{Auth::user()->devise}}}</span>
                        @elseif($pari->montant_profit < 0)<span class="bold font-red-haze"><span
                                    class="profits">{{floatval($pari->montant_profit)}}</span> <span class="devise">{{Auth::user()->devise}}
                                }</span>
                            @else($pari->montant_profit == 0)<span class="bold"><span
                                        class="profits">{{floatval($pari->montant_profit)}}</span><span class="devise">{{Auth::user()->devise}}
                                    }</span>
                    @endif
                </td>

                <td width="" class="textaligncenter">
                    {{ Form::button('<i class="fa fa-trash ladda-label"></i>', array('type' => 'submit', 'class' => 'bouton-supprimer-historique-pari btn btn-xs red ladda-button', 'data-numero-pari' => $pari->numero_pari, 'data-pari-id' => $pari->id, 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer', 'data-style' => "zoom-in", 'data-size'=> "l")) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif