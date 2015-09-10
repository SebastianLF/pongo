@if($count_paris_termine == '0')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            Aucun historique pour l'instant
        </div>
    </div>
@else
    <div class="row">
        <div class="has-success has-feedback col-md-2" style="float:left;margin-bottom:20px;"><input id="paris-termine-search-input" class="form-control" type="text" placeholder="Recherche..."></div>
    </div>

    <div class="slimScrollTermine">
        <div class="table-scrollable-borderless table-responsive table-responsive-scrollbar-top">
            <table id="paristerminetable" class="table table-condensed table-light table-hover  table-termine"
                   style="border-collapse:collapse;">
                <thead>
                <tr class="uppercase">
                    <th id="count" class="hidden ">{{$count_paris_termine}}</th>
                    <th></th>
                    <th>N°</th>
                    <th>type</th>
                    <th>Evenement</th>
                    <th>Rencontre</th>
                    <th>Pari</th>
                    <th>Tipster</th>
                    <th>Book</th>
                    <th>Cote</th>
                    <th>Mise</th>
                    <th>Resultat</th>
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
                        @if($pari->type_profil == 's')

                            <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}" class="mainrow accordion-toggle parisencours-accordeon">
                                <td class="hidden id">{{$pari->id}}</td>
                                <td width="20px" ></td>
                                <td class="primary-link">{{'#'.$pari->numero_pari}}</td>

                                <td><span class="label label-sm label-success label-mini type">{{$pari->type_profil == 's' ? 'simple' : 'combiné' }}</span>{{' '}}<span class="label label-sm label-danger label-mini">{{$pari->pari_live ? 'live' : '' }}</span>{{' '}}<span class="label label-sm label-danger label-mini">{{$pari->pari_gratuit ? 'gratuit' : '' }}</span></td>
                                <td>
                                        {{$pari->selections->first()->sport->name}}{{', '}}{{$pari->selections->first()->competition->name}}
                                </td>
                                <td>
                                        @if($pari->selections->first()->isMatch)
                                            {{' ('.$pari->selections->first()->date_match.') -'}}
                                            {{$pari->selections->first()->game_name}}
                                        @else
                                            {{'N/A'}}
                                        @endif
                                </td>

                                <!--
                                // 1 , 'pick'
                                // 2 , 'pick doubleparam'
                                // 3 , 'pick, parametername1 doubleparam1
                                // 4 , 'pick, doubleparam1-doubleparam2 minutes'
                                // 5 , 'parametername1 doubleparam1' avec '+'
                                // 6 , 'pick Top doubleparam1'
                                // 7 , 'pick (optional + )doubleparam'
                                // 8 , 'parametername1 pick doubleparam1'-->
                                <td class="blue">
                                     {{$pari->selections->first()->market->name.(' : ')}}
                                 @if($pari->selections->first()->affichage == 1)
                                        {{$pari->selections->first()->pick}}
                                     @elseif($pari->selections->first()->affichage == 2)
                                        {{$pari->selections->first()->pick}}{{' '}}{{$pari->selections->first()->odd_doubleParam}}
                                     @elseif($pari->selections->first()->affichage == 3)
                                        {{$pari->selections->first()->pick}}{{', '}}{{$pari->selections->first()->odd_participantParameterName}}{{' '}}{{$pari->selections->first()->odd_doubleParam}}
                                     @elseif($pari->selections->first()->affichage == 4)
                                        {{$pari->selections->first()->pick}}{{', '}}{{$pari->selections->first()->odd_doubleParam}}{{'-'}}{{$pari->selections->first()->odd_doubleParam2}}{{' minutes'}}
                                     @elseif($pari->selections->first()->affichage == 5)
                                         @if($pari->selections->first()->odd_doubleParam > 0)
                                        {{', '}}{{$pari->selections->first()->odd_participantParameterName}}{{' +'}}{{$pari->selections->first()->odd_doubleParam}}
                                         @else
                                            {{', '}}{{$pari->selections->first()->odd_participantParameterName}}{{' '}}{{$pari->selections->first()->odd_doubleParam}}
                                         @endif
                                     @elseif($pari->selections->first()->affichage == 6)
                                        {{$pari->selections->first()->pick}}{{', '}}{{' Top '}}{{$pari->selections->first()->odd_doubleParam1}}
                                     @elseif($pari->selections->first()->affichage == 7)
                                        {{' '.$pari->selections->first()->pick}}
                                        @if($pari->selections->first()->odd_doubleParam > 0)
                                            {{{' +'.$pari->selections->first()->odd_doubleParam}}}
                                        @else
                                            {{{' '.$pari->selections->first()->odd_doubleParam}}}
                                        @endif
                                     @elseif($pari->selections->first()->affichage == 3)
                                            {{$pari->selections->first()->odd_participantParameterName}}{{' '}}{{$pari->selections->first()->pick}}{{' '}}{{$pari->selections->first()->odd_doubleParam}}
                                @endif
                                </td>

                                <td class="">{{$pari->tipster->name}}</td>
                                <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-success label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}</td>

                                <td class="fit tdcote">{{$pari->cote}}</td>
                                <td class="tdmise  bold"><span class="tdsubmise bold ">{{{floatval(round($pari->mise_totale, 2))}}}</span>{{{Auth::user()->devise}}} {{'('.+floatval(round($pari->nombre_unites, 2)).'u)'}}</td>
                                <td>
                                    @if(is_null($pari->selections->first()->resultat))
                                        {{'N/A'}}
                                    @else
                                        {{$pari->selections->first()->resultat}}
                                    @endif
                                </td>

                                <td width="110px" class="uppercase">
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
                                <td><span class="{{'bold fontsize15'}} {{$pari->mise_totale > $pari->montant_retour ? ' font-red-haze' : '' }} {{$pari->mise_totale < $pari->montant_retour ? ' font-green-sharp' : '' }}">
                                        <span class="">{{floatval($pari->montant_retour).''.Auth::user()->devise}}<span>{{' ('.floatval($pari->unites_retour).'u)'}}</span></span>
                                </span>
                                </td>
                                <td>
                                    @if($pari->montant_profit > 0)<span class="bold fontsize15 font-green-sharp" ><span class="profits">{{' +'.floatval($pari->montant_profit)}}</span><span class="devise">{{{Auth::user()->devise}}}</span><span>{{' (+'.floatval($pari->unites_profit).'u)'}}</span></span>
                                    @elseif($pari->montant_profit < 0)<span class="bold fontsize15 font-red-haze"><span class="profits">{{floatval($pari->montant_profit)}}</span><span class="devise">{{{Auth::user()->devise}}}</span><span>{{' ('.floatval($pari->unites_profit).'u)'}}</span></span>
                                    @else($pari->montant_profit == 0)<span class="bold fontsize15"><span class="profits">{{floatval($pari->montant_profit)}}</span><span class="devise">{{{Auth::user()->devise}}}</span><span>{{' ('.floatval($pari->unites_profit).'u)'}}</span></span>
                                    @endif
                                </td>

                                <td width="150px" class="textaligncenter">
                                    {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer')) }}
                                    {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red', )) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>




                        <!-- dans le cas d'un pari combiné. -->
                        @else

                                <tr
                                    class="mainrow accordion-toggle parisencours-accordeon">

                                    <td class="hidden id" >{{$pari->id}}</td>
                                    <td width="20px" class="subbetclick"><a data-toggle="collapse"
                                              data-target="{{'.row'.$pari->numero_pari}}"
                                              class=""><i class="glyphicon glyphicon-chevron-right"></i></a></td>
                                    <td class="primary-link">{{'#'.$pari->numero_pari}}</td>
                                    <td>
                                        <span class="label label-sm label-success label-mini type">{{$pari->type_profil == 's' ? 'simple' : 'combiné' }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-sm label-combine label-mini type">{{'combiné'}}</span>
                                    </td>
                                    <td><span class="label label-sm label-combine label-mini type">{{'combiné'}}</span></td>
                                    <td><span class="label label-sm label-combine label-mini type">{{'combiné'}}</span></td>
                                    <td>{{$pari->tipster->name}}</td>
                                    <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-combine label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}</td>
                                    <td class="fit tdcote">{{$pari->cote}}</td>
                                    <td class="tdmise bold">
                                        <span class="tdsubmise bold ">{{{floatval(round($pari->mise_totale, 2))}}}</span>{{{Auth::user()->devise.' '}}}{{'('.+floatval(round($pari->nombre_unites, 2)).'u)'}}
                                    </td>
                                    <td width="90px">
                                        <span class="label label-sm label-combine label-mini type">{{'combiné'}}</span>
                                    </td>

                                    <td width="110px" class="uppercase">
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
                                    <td>
                                        <span class="{{'bold fontsize15'}} {{$pari->mise_totale > $pari->montant_retour ? ' font-red' : '' }} {{$pari->mise_totale < $pari->montant_retour ? ' font-green-sharp' : '' }}">
                                        <span class="">{{floatval($pari->montant_retour).''.Auth::user()->devise}}<span>{{' ('.floatval($pari->unites_retour).'u)'}}</span></span></span>
                                    </td>
                                    <td>
                                        @if($pari->montant_profit > 0)<span class="bold fontsize15 font-green-sharp" ><span class="profits">{{' +'.floatval($pari->montant_profit)}}</span><span class="devise">{{{Auth::user()->devise}}}</span><span>{{' (+'.floatval($pari->unites_profit).'u)'}}</span></span>
                                        @elseif($pari->montant_profit < 0)<span class="bold fontsize15 font-red-haze"><span class="profits">{{floatval($pari->montant_profit)}}</span><span class="devise">{{{Auth::user()->devise}}}</span><span>{{' ('.floatval($pari->unites_profit).'u)'}}</span></span>
                                        @else($pari->montant_profit == 0)<span class="bold fontsize15"><span class="profits">{{floatval($pari->montant_profit)}}</span><span class="devise">{{{Auth::user()->devise}}}</span><span>{{' ('.floatval($pari->unites_profit).'u)'}}</span></span>
                                        @endif
                                    </td>

                                    <td width="150px" class="textaligncenter">
                                        {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer')) }}
                                        {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red', )) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>

                                <tr class="subrow">
                                    <td colspan="17" class="childtable cancel-padding">
                                        <div class="{{'accordian-body collapse row'.$pari->numero_pari}}">
                                            <table class="table child-table table-bordered table-condensed table-subrow-combine table-responsive ">
                                                <thead>

                                                <tr class="uppercase">
                                                    <th>evenement</th>
                                                    <th>rencontre</th>
                                                    <th>pari</th>
                                                    <th>cote</th>
                                                    <th>score/autre</th>
                                                    <th>status</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($pari->selections as $selection)
                                                    <tr class="child-table-tr">
                                                        <td class="hidden child-id">{{$selection->id}}</td>
                                                        <td>
                                                            {{$selection->sport->name}}{{', '}}{{$selection->competition->name}}
                                                        </td>
                                                        <td>
                                                            @if($selection->isMatch) {{'('.$selection->date_match.') '.$selection->game_name}} @else {{"N/A"}}@endif
                                                        </td>
                                                        <td class="blue">
                                                            <?php $app = App::make('pari_affichage') ?>
                                                            {{$app->display($selection->market_id, $selection->pick, $selection->odd_doubleParam1, $selection->odd_doubleParam2, $selection->odd_doubleParam3,  $selection->odd_participantParameterName, $selection->odd_participantParameterName2, $selection->odd_participantParameterName3)}}
                                                            {{' ('.$selection->scope->name.') '}}
                                                            @if($selection->score)
                                                                {{' ('.$selection->score.' LIVE!) '}}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <span class="cote-td">{{$selection->cote}}</span>
                                                        </td>
                                                        <td width="" class="status-td">
                                                            @if($selection->resultat == '')
                                                                {{'N/A'}}
                                                            @else
                                                                {{$selection->resultat}}
                                                            @endif
                                                        </td>
                                                        <td class="uppercase">
                                                            <?php
                                                            switch ($selection->status) {
                                                                case 0:
                                                                    echo '<span class="bold fontsize15">N/A</span>';
                                                                    break;
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

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>

                        @endif
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif