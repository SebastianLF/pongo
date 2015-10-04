@if($count_paris_encours == '0')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <span class="glyphicon glyphicon-hand-down"></span> Ajouter un pari classique à l'aide du formulaire d'ajout
            ci-dessous
        </div>
    </div>
@else
    <div class="table-scrollable-borderless table-responsive">
        <table id="parisencourstable" class="table table-condensed table-hover table-bordered"
               style="border-collapse:collapse;">
            <thead>
            <tr class="uppercase">
                <th class="hidden"></th>
                <th></th>
                <th>N°</th>
                <th width="70px">type</th>
                <th>Evenement</th>
                <th>Rencontre</th>
                <th>Pari</th>
                <th>Tipster</th>
                <th>Book</th>
                <th>Cote</th>
                <th>Mise</th>
                <th>Resultat</th>
                <th>Status</th>
                <th>bén./per.</th>
                <th width="115px"></th>
            </tr>

            </thead>
            <tbody>
            @foreach($parisencours as $pari)
                <div class="wrapperRow">

                    <!-- pour le cas d'un pari simple. -->
                    @if($pari->type_profil == 's')

                        <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}"
                            class="mainrow accordion-toggle parisencours-accordeon">
                            <td class="hidden id">{{$pari->id}}</td>
                            <td width="20px"></td>
                            <td class="primary-link">{{'#'.$pari->numero_pari}}</td>

                            <td>
                                <span class="label label-sm label-success label-mini type" data-toggle="tooltip" data-title="{{'simple'}}">{{strtoupper($pari->type_profil)}}</span>
                                @if($pari->pari_abcd)
                                    <span class="label label-sm label-warning label-mini" data-toggle="tooltip" data-title="{{$pari->nom_abcd.' - '.$pari->lettre_abcd}}">{{'M'}}</span>
                                @endif
                                @if($pari->pari_live)
                                    <span class="label label-sm label-danger label-mini" data-toggle="tooltip" data-title="{{'live'}}">{{'L'}}</span>
                                @endif
                            </td>
                            <td>
                                {{{$pari->selections->first()->sport->name.', '.$pari->selections->first()->competition->name}}}
                            </td>
                            <td>
                                @if($pari->selections->first()->isMatch)
                                    <?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $pari->selections->first()->date_match, 'Europe/Paris');
                                        $date->setTimezone(Auth::user()->timezone);?>
                                        {{{' '.$date->format('d/m H:i').' |'}}}
                                    <span>
                                        <img src="{{asset($pari->selections->first()->equipe1->country->shortname != '' ? 'img/flags/'.$pari->selections->first()->equipe1->country->shortname.'.png' : 'img/flags/unknown2.png')}}" class="img-flag" alt="country"/>{{' '.$pari->selections->first()->equipe1->name.' -'}}
                                    </span>
                                    <span>
                                        <img src="{{asset($pari->selections->first()->equipe2->country->shortname != '' ? 'img/flags/'.$pari->selections->first()->equipe2->country->shortname.'.png' : 'img/flags/unknown2.png')}}" class="img-flag" alt="country"/>{{' '.$pari->selections->first()->equipe2->name}}
                                    </span>

                                @else
                                    {{{'N/A'}}}
                                @endif
                            </td>

                            <td class="blue">
                                <?php $app = App::make('pari_affichage') ?>
                                {{$app->display($pari->selections->first()->market_id, $pari->selections->first()->pick, $pari->selections->first()->odd_doubleParam, $pari->selections->first()->odd_doubleParam2, $pari->selections->first()->odd_doubleParam3,  $pari->selections->first()->odd_participantParameterName, $pari->selections->first()->odd_participantParameterName2, $pari->selections->first()->odd_participantParameterName3, $pari->selections->first()->equipe1->name, $pari->selections->first()->equipe2->name)}}
                                {{' ('.$pari->selections->first()->scope->name.') '}}
                                @if($pari->selections->first()->score)
                                    {{' ('.$pari->selections->first()->score.' LIVE!) '}}
                                @endif
                            </td>
                            <td>{{$pari->tipster->name}}</td>
                            <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-combine label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}
                            </td>
                            <td class="fit tdcote">{{$pari->cote}}</td>
                            <td class="tdmise  bold">

                                <span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{Auth::user()->devise}}} {{'('.+$pari->nombre_unites.'u)'}}
                            </td>
                            <td width="90px"><input type="text" name="childrowsinput[]"
                                                    class="form-control inputs-ticket"
                                                    value="" placeholder="Résultat"/></td>
                            <td width="110px"><select name="resultatSelectionDashboardInput[]"
                                                      data-value=""
                                                      class="form-control inputs-ticket">
                                    <option value="0">-Choisir-</option>
                                    @foreach($types_resultat as $key => $type)
                                        <option value="{{$key}}"><a href="javascript:;"
                                                                    class="btn btn-xs">{{$type}}</a>
                                        </option>
                                    @endforeach
                                </select></td>
                            <td class="bold fontsize15" width=""><span class="profits"></span><span
                                        class="devise hide">{{{' '.Auth::user()->devise}}}</span></td>

                            <td width="100px">
                                {{ Form::open(array('route' => 'historique.store', 'class' => 'validerform form-bouton-paris', 'role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Clôturer')) }}
                                {{ Form::button('<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'boutonvalider btn btn-sm green buttons-actions-ticket', 'disabled' => 'disabled')) }}
                                {{ Form::close() }}

                                {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer')) }}
                                {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red buttons-actions-ticket', )) }}
                                {{ Form::close() }}
                                @if($pari->followtype == 'n')
                                    {{ Form::button('<i class="fa fa-briefcase"></i>', array('type' => 'submit', 'class' => 'btn btn-sm grey-gallery form-bouton-paris buttons-actions-ticket', 'data-toggle' => 'modal', 'data-target' => '#cashoutModal', 'data-hover' => 'tooltip', 'data-id' => $pari->id, 'title' => 'Cash Out')) }}
                                @endif
                            </td>
                        </tr>




                        <!-- dans le cas d'un pari combiné. -->
                    @else
                        <tr class="mainrow accordion-toggle parisencours-accordeon">
                            <td class="hidden id">{{$pari->id}}</td>
                            <td class="subbetclick"><a data-toggle="collapse"
                                                       data-target="{{'.row'.$pari->numero_pari}}"
                                                       class=""><i class="glyphicon glyphicon-chevron-right"></i></a>
                            </td>
                            <td class="primary-link">{{'#'.$pari->numero_pari}}</td>
                            <td>
                                <span class="label label-sm label-success label-mini type" data-toggle="tooltip" data-title="{{'combiné'}}">{{strtoupper($pari->type_profil)}}</span>
                                @if($pari->pari_abcd)
                                    <span class="label label-sm label-warning label-mini" data-toggle="tooltip" data-title="{{$pari->nom_abcd.' - '.$pari->lettre_abcd}}">{{'M'}}</span>
                                @endif
                                @if($pari->pari_live)
                                    <span class="label label-sm label-danger label-mini" data-toggle="tooltip" data-title="{{'live'}}">{{'L'}}</span>
                                @endif
                            </td>
                            <td>
                                <span class="label label-sm label-combine label-combine label-mini type">{{'combiné'}}</span>
                            </td>
                            <td><span
                                        class="label label-sm label-combine label-mini type">{{'combiné'}}</span></td>
                            <td><span
                                        class="label label-sm label-combine label-mini type">{{'combiné'}}</span></td>
                            <td>{{$pari->tipster->name}}</td>
                            <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-combine label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}</td>
                            <td class="fit tdcote">{{$pari->cote}}</td>
                            <td class="tdmise bold">
                                <span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{Auth::user()->devise.' '}}}{{'('.+$pari->nombre_unites.'u)'}}
                            </td>
                            <td>
                                <span class="label label-sm label-combine label-mini type">{{'combiné'}}</span>
                            </td>
                            <td><span class="label label-sm label-combine label-mini type">{{'combiné'}}</span></td>

                            <td class="bold fontsize15"><span class="profits"></span><span
                                        class="devise hide">{{{' '.Auth::user()->devise}}}</span></td>
                            <td width="100px">
                                {{ Form::open(array('route' => 'historique.store', 'class' => 'validerform form-bouton-paris' ,'role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Clôturer')) }}
                                {{ Form::button('<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'boutonvalider btn btn-sm green buttons-actions-ticket', 'disabled' => 'disabled')) }}
                                {{ Form::close() }}

                                {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer')) }}
                                {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red buttons-actions-ticket', )) }}
                                {{ Form::close() }}
                                @if($pari->followtype == 'n')
                                    {{ Form::button('<i class="fa fa-briefcase"></i>', array('type' => 'submit', 'class' => 'btn btn-sm grey-gallery boutoncashout form-bouton-paris buttons-actions-ticket', 'data-toggle' => 'modal', 'data-target' => '#cashoutModal', 'data-hover' => 'tooltip', 'data-id' => $pari->id, 'title' => 'Cash Out')) }}
                                @endif

                            </td>
                        </tr>
                        <tr class="subrow">
                            <td colspan="17" class="childtable cancel-padding">
                                <div class="{{'accordian-body collapse row'.$pari->numero_pari}}">
                                    <table class="table child-table table-bordered table-condensed table-subrow-combine table-responsive">
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
                                                    @if($selection->isMatch)
                                                        <span><img src="img/flags/{{!is_null($selection->equipe1->country_id) ? $selection->equipe1->country->shortname : 'unknown2'}}.png" class="img-flag" />{{' '.$selection->equipe1->name.' -'}}</span>
                                                        <span><img src="img/flags/{{!is_null($selection->equipe2->country_id) ? $selection->equipe2->country->shortname : 'unknown2'}}.png" class="img-flag" />{{' '.$selection->equipe2->name}}</span>
                                                    @else {{"N/A"}}
                                                    @endif
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
                                                <td width="120px"><input type="text" name="childrowsinput[]"
                                                                         class="form-control inputs-ticket childrowsinput"
                                                                         value="{{empty($selection->infos_pari) ? '' : $selection->infos_pari}}"/>
                                                </td>
                                                <td width="150px" class="status-td">
                                                    <select name="resultatSelectionDashboardInput[]"
                                                            data-value="{{$selection->status}}"
                                                            class="form-control inputs-ticket resultatSelectionDashboardInput">
                                                        <option value="0">--Selectionnez--</option>
                                                        @foreach($types_resultat as $key => $type)
                                                            <option value="{{$key}}"><a href="javascript:;"
                                                                                        class="btn btn-xs">{{$type}}</a>
                                                            </option>
                                                        @endforeach
                                                    </select>
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
    {{$parisencours->appends(Input::except('page'))->links()}}
@endif