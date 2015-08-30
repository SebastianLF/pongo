@if($count_paris_termine == '0')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            Aucun historique pour l'instant
        </div>
    </div>
@else
    <div class="slimScrollTermine">
        <div class="table-scrollable-borderless table-responsive">
            <table id="paristerminetable" class="table table-condensed table-advance table-striped"
                   style="border-collapse:collapse;">
                <thead>
                <tr class="uppercase">
                    <th id="count" class="hidden ">{{$count_paris_termine}}</th>
                    <th></th>
                    <th>N°</th>
                    <th>type</th>
                    <th>Evenement</th>
                    <th>Rencontre</th>
                    <th>Pari <span class="glyphicon glyphicon-info-sign"></span></th>
                    <th>Tipster</th>
                    <th>Book</th>
                    <th>Cote</th>
                    <th>Mise</th>
                    <th>Resultat</th>
                    <th>Status</th>
                    <th>Retour</th>
                    <th>bén./per.</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($paristermine as $pari)
                    <div class="wrapperRow">

                    <!-- pour le cas d'un pari simple. -->
                        @if($pari->type_profil == 's')
                            <a href="">
                            <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}" class="mainrow accordion-toggle parisencours-accordeon">
                                <td class="hidden id">{{$pari->id}}</td>
                                <td class="subbetclick"></td>
                                <td><a href="javascript:;" class="primary-link">#{{$pari->numero_pari}}</a></td>

                                <td><span class="label label-sm label-success label-mini type">{{$pari->type_profil == 's' ? 'simple' : 'combiné' }}</span>{{' '}}<span class="label label-sm label-danger label-mini">{{$pari->pari_live ? 'live' : '' }}</span>{{' '}}<span class="label label-sm label-danger label-mini">{{$pari->pari_gratuit ? 'gratuit' : '' }}</span></td>
                                <td width="">
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
                                <td class="blue" width="">
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
                                <td class="tdmise  bold"><span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{$user->devise}}} {{'('.+$pari->nombre_unites.'u)'}}</td>
                                <td width="90px">
                                    {{'N/A'}}
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
                                        <span class="">{{$pari->montant_retour.''.$user->devise}}<span>{{' ('.$pari->unites_retour.'u)'}}</span></span>
                                </span>
                                </td>
                                <td>
                                    @if($pari->montant_profit > 0)<span class="bold fontsize15 font-green-sharp" ><span class="profits">{{' +'.$pari->montant_profit}}</span><span class="devise">{{{$user->devise}}}</span><span>{{' (+'.$pari->unites_profit.'u)'}}</span></span>
                                    @elseif($pari->montant_profit < 0)<span class="bold fontsize15 font-red-haze"><span class="profits">{{$pari->montant_profit}}</span><span class="devise">{{{$user->devise}}}</span><span>{{' ('.$pari->unites_profit.'u)'}}</span></span>
                                    @else($pari->montant_profit == 0)<span class="bold fontsize15"><span class="profits">{{$pari->montant_profit}}</span><span class="devise">{{{$user->devise}}}</span><span>{{' ('.$pari->unites_profit.'u)'}}</span></span>
                                    @endif
                                </td>

                                <td width="150px" class="textaligncenter">
                                    {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer')) }}
                                    {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red', )) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        </a>



                        <!-- dans le cas d'un pari combiné. -->
                        @else

                                <tr
                                    class="mainrow accordion-toggle parisencours-accordeon">

                                    <td class="hidden id " >{{$pari->id}}</td>
                                    <td class="subbetclick "><span data-toggle="collapse"
                                              data-target="{{'.row'.$pari->numero_pari}}"
                                              class="glyphicon glyphicon-chevron-right"></span></td>
                                    <td class="blue">{{'#'.$pari->numero_pari}}</td>
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
                                        <span class="tdsubmise bold ">{{{$pari->mise_totale}}}</span>{{{$user->devise.' '}}}{{'('.+$pari->nombre_unites.'u)'}}
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
                                        <span class="">{{$pari->montant_retour.''.$user->devise}}<span>{{' ('.$pari->unites_retour.'u)'}}</span></span></span>
                                    </td>
                                    <td>
                                        @if($pari->montant_profit > 0)<span class="bold fontsize15 font-green-sharp" ><span class="profits">{{' +'.$pari->montant_profit}}</span><span class="devise">{{{$user->devise}}}</span><span>{{' (+'.$pari->unites_profit.'u)'}}</span></span>
                                        @elseif($pari->montant_profit < 0)<span class="bold fontsize15 font-red"><span class="profits">{{$pari->montant_profit}}</span><span class="devise">{{{$user->devise}}}</span><span>{{' ('.$pari->unites_profit.'u)'}}</span></span>
                                        @else($pari->montant_profit == 0)<span class="bold fontsize15"><span class="profits">{{$pari->montant_profit}}</span><span class="devise">{{{$user->devise}}}</span><span>{{' ('.$pari->unites_profit.'u)'}}</span></span>
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
                                            <table class="table table-striped child-table table-bordered">
                                                <thead>

                                                <tr class="uppercase">
                                                    <th>evenement</th>
                                                    <th>rencontre</th>
                                                    <th>pari</th>
                                                    <th>cote</th>
                                                    <th>resultat</th>
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
                                                        <td class="blue">{{$selection->market->name.(' : ')}}
                                                            @if($selection->affichage == 1)
                                                                    {{$selection->pick}}
                                                                 @elseif($selection->affichage == 2)
                                                                    {{$selection->pick}}{{' '}}{{$selection->odd_doubleParam}}
                                                                 @elseif($selection->affichage == 3)
                                                                    {{$selection->pick}}{{', '}}{{$selection->odd_participantParameterName}}{{' '}}{{$selection->odd_doubleParam}}
                                                                 @elseif($selection->affichage == 4)
                                                                    {{$selection->pick}}{{', '}}{{$selection->odd_doubleParam}}{{'-'}}{{$selection->odd_doubleParam2}}{{' minutes'}}
                                                                 @elseif($selection->affichage == 5)
                                                                     @if($selection->odd_doubleParam > 0)
                                                                    {{', '}}{{$selection->odd_participantParameterName}}{{' +'}}{{$selection->odd_doubleParam}}
                                                                     @else
                                                                        {{', '}}{{$selection->odd_participantParameterName}}{{' '}}{{$selection->odd_doubleParam}}
                                                                     @endif
                                                                 @elseif($selection->affichage == 6)
                                                                    {{$selection->pick}}{{', '}}{{' Top '}}{{$selection->odd_doubleParam1}}
                                                            @endif
                                                            @if(!is_null($selection->score)){{'('.$selection->score.')'}} @endif
                                                        </td>

                                                        <td>
                                                            <span class="cote-td">{{$selection->cote}}</span>
                                                        </td>
                                                        <td width="150px" class="status-td">
                                                            @if($selection->resultat == '')
                                                                {{'N/A'}}
                                                            @else
                                                                {{$selection->resultat}}
                                                            @endif
                                                        </td>
                                                        <td width="110px" class="uppercase">
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