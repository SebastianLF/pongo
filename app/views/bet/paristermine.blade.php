@if($count_paris_termine == '0')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            Aucun historique pour l'instant
        </div>
    </div>
@else

    <table id="paristerminetable" class="table table-bordered table-condensed">
        <thead>
        <tr class="uppercase">
            <th class="">date</th>
            <th>type</th>
            <th>Evenement</th>
            <th>Rencontre</th>
            <th>Pari</th>
            <th>Tipster</th>
            <th>Book</th>
            <th>Cote</th>
            <th>Mise</th>
            <th>Status</th>
            <th>Retour</th>
            <th>PROFITS</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($paristermine as $pari)
            <div class="wrapperRow">

                <!-- pour le cas d'un pari simple. -->

                <?php $app = App::make('pari_affichage');
                $selections_final = $pari->selections;
                foreach ($selections_final as $selections) {
                    $pariAffichage = $app->display($selections->market_id, $selections->pick, $selections->odd_doubleParam1, $selections->odd_doubleParam2, $selections->odd_doubleParam3, $selections->odd_participantParameterName, $selections->odd_participantParameterName2, $selections->odd_participantParameterName3, $selections->equipe1['name'], $selections->equipe2['name']);
                    $selections['pariAffichage'] = $pariAffichage;
                } ?>
                <!-- les parentheses doivent etre des simples quotes pour data-selections car c un objet javascript -->
                <tr data-selections='{{{$selections_final}}}' data-nb-selections='{{{$pari->selections->count()}}}' data-pari-id='{{{$pari->id}}}' data-pari-type='{{{$pari->type_profil}}}'>

                    <td class=""><?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $pari->selections->first()->date_match, 'Europe/Paris');
                        $date->setTimezone(Auth::user()->timezone);?>
                        {{{$date->format('d/m/Y')}}}</td>
                    <td>
                        @if($pari->type_profil == 's')
                            <span class="label label-sm label-success label-mini type" data-toggle="tooltip"
                                  data-title="{{'simple'}}">{{strtoupper($pari->type_profil)}}</span>
                        @endif
                        @if($pari->type_profil == 'c')
                            <span class="label label-sm label-success label-mini type" data-toggle="tooltip"
                                  data-title="{{'combiné'}}">{{strtoupper($pari->type_profil)}}</span>
                        @endif
                        @if($pari->pari_abcd)
                            <span class="label label-sm label-warning label-mini" data-toggle="tooltip"
                                  data-title="{{$pari->nom_abcd.' - '.$pari->lettre_abcd}}">{{'M'}}</span>
                        @endif
                        @if($pari->pari_live)
                            <span class="label label-sm label-danger label-mini" data-toggle="tooltip"
                                  data-title="{{'live'}}">{{'L'}}</span>
                        @endif
                    </td>
                    <td>
                        @if($pari->type_profil == 's')
                            {{{$pari->selections->first()->sport->name.', '.$pari->selections->first()->competition->name}}}
                        @else
                            <span class="label label-sm label-success label-mini">combiné</span>
                        @endif
                    </td>
                    <td class="blue">
                        @if($pari->type_profil == 's')
                            @if($pari->selections->first()->isMatch)
                                <?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $pari->selections->first()->date_match, 'Europe/Paris');
                                $date->setTimezone(Auth::user()->timezone);?>
                                {{{' ('.$date->format('d/m H:i').') '.$pari->selections->first()->game_name}}}
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

                    <td class="">{{$pari->tipster->name}}</td>
                    <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-success label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}</td>

                    <td class="fit tdcote">{{$pari->cote}}</td>
                    <td class="tdmise  bold"><span
                                class="tdsubmise bold ">{{{floatval(round($pari->mise_totale, 2))}}}</span>{{{Auth::user()->devise}}} {{'('.+floatval(round($pari->nombre_unites, 2)).'u)'}}
                    </td>


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
                        }?>

                    </td>

                    <td><span class="{{'bold'}} {{$pari->mise_totale > $pari->montant_retour ? ' font-red-haze' : '' }} {{$pari->mise_totale < $pari->montant_retour ? ' font-green-sharp' : '' }}">
                                        <span class="">{{floatval($pari->montant_retour).''.Auth::user()->devise}}
                                            <span>{{' ('.floatval($pari->unites_retour).'u)'}}</span></span>
                                </span>
                    </td>
                    <td>
                        @if($pari->montant_profit > 0)<span class="bold font-green-sharp"><span
                                    class="profits">{{' +'.floatval($pari->montant_profit)}}</span><span
                                    class="devise">{{{Auth::user()->devise}}}</span><span>{{' (+'.floatval($pari->unites_profit).'u)'}}</span></span>
                        @elseif($pari->montant_profit < 0)<span class="bold font-red-haze"><span
                                    class="profits">{{floatval($pari->montant_profit)}}</span><span
                                    class="devise">{{{Auth::user()->devise}}}</span><span>{{' ('.floatval($pari->unites_profit).'u)'}}</span></span>
                        @else($pari->montant_profit == 0)<span class="bold"><span
                                    class="profits">{{floatval($pari->montant_profit)}}</span><span
                                    class="devise">{{{Auth::user()->devise}}}</span><span>{{' ('.floatval($pari->unites_profit).'u)'}}</span></span>
                        @endif
                    </td>

                    <td width="" class="textaligncenter">
                        {{ Form::button('<i class="fa fa-trash ladda-label"></i>', array('type' => 'submit', 'class' => 'bouton-supprimer-historique-pari btn btn-xs red ladda-button', 'data-id' => $pari->id, 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer', 'data-style' => "zoom-in", 'data-size'=> "l")) }}
                    </td>
                </tr>

            </div>
        @endforeach
        </tbody>
    </table>

@endif
