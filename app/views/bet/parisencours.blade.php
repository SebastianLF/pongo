@if($count_paris_encours == '0')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <span class="glyphicon glyphicon-hand-down"></span> Ajouter un pari classique à l'aide du formulaire d'ajout
            dans le panneau ci-dessous
        </div>
    </div>
@else
    <table id="parisencourstable" class="table table-light table-condensed table-hover table-paris">
        <thead>
        <tr class="uppercase">
            <th >N°</th>
            <th>date r.</th>
            <th class="hidden-sm">Sport</th>
            <th class="hidden-sm">Competition</th>
            <th>Pari</th>
            <th>Tipster</th>
            <th>Mise</th>
            <th>Book</th>
            <th>Cote</th>
            <th>Status</th>
            <th>Mt. retour <span class="glyphicon glyphicon-info-sign font-red-sunglo" data-toggle="tooltip" data-html="true" title="Exemple: cote à 2 et mise de 50 {{Auth::user()->devise}}, le montant retour sera 100 {{Auth::user()->devise}} . <br/><span class='font-red-sunglo'>Verifiez bien le montant, il peut etre différent de celui calculé chez le bookmaker. Si c'est le cas, remplacez le.</span>"></span></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($parisencours as $pari)
            <?php $pari_affichage = App::make('pari_affichage');
            $selections_final = $pari->selections;
            foreach ($selections_final as $selections) {
                $pariAffichage = $pari_affichage->display($selections->market_id, $selections->scope_id, $selections->pick, $selections->odd_doubleParam, $selections->odd_doubleParam2, $selections->odd_doubleParam3, $selections->odd_participantParameterName, $selections->odd_participantParameterName2, $selections->odd_participantParameterName3, $selections->equipe1['name'], $selections->equipe2['name']);
                $selections['pariAffichage'] = $pariAffichage;
            } ?>
            <tr data-selections='{{{$selections_final}}}' data-nb-selections='{{{$pari->selections->count()}}}' data-pick="{{$selections->pick}}" data-name1='{{$selections->equipe1['name']}}' data-pari-id='{{{$pari->id}}}' data-selection-id='{{{$pari->type_profil == "s" ? $selections->id : ""}}}' data-pari-type='{{{$pari->type_profil}}}'>
                <td >{{{'#'.$pari->numero_pari}}}</td>
                <td>
                    @if($pari->type_profil == 's')
                        <?php $date = Carbon::createFromFormat('Y-m-d H:i:s', $pari->selections->first()->date_match, 'Europe/Paris');
                        $date->setTimezone(Auth::user()->timezone);?>
                        {{{' '.$date->format('d/m/Y H:i')}}}
                    @else
                        <span class="label label-sm label-success label-mini">combiné</span>
                    @endif

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
                <td>{{$pari->tipster->name == 'default' ? '-' : $pari->tipster->name}}</td>
                <td class="tdmise  bold">

                    <span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{Auth::user()->devise}}}
                </td>
                <td>{{is_null($pari->bookmaker_user_id) ? '<span class="label label-sm label-combine label-mini">à blanc</span>' : $pari->compte->bookmaker->nom }}
                </td>
                <td width="10px" class="fit tdcote td-bet">{{floatval($pari->cote)}} @if($pari->tipster->name != 'default') {{' ('.floatval($pari->cote_tipster).') '}} @endif</td>
                <td width="">
                    @if($pari->type_profil == 's')
                        <select name="status[]"
                                data-value=""
                                data-defaut-value="{{$pari->selections->first()->status}}"
                                class="form-control pari-status ">
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
                <td width="10px" class="td-bet"><div class="input-group "><input value="{{$pari->montant_retour + 0}}" type="text" width="50px" name="amount-returned" class="form-control inputs-ticket"><div class="input-group-addon input-group-addon-amount-returned">{{Auth::user()->devise}}</div></div></td>
                <td width="130px" class="td-bet-options center-text">
                    {{ Form::button('<i class="fa fa-check"></i>', array('data-id' => $pari->id, 'data-pari-type' => $pari->type_profil, 'data-numero-pari' => $pari->numero_pari, 'data-toggle' => "tooltip", 'title' => "Basculer définitivement dans l'historique", 'data-style' => "zoom-in", 'class' => 'boutonvalider btn btn-sm ladda-button green-jungle buttons-actions-ticket')) }}
                    {{ Form::button('<i class="fa fa-trash"></i>', array('data-id' => $pari->id, 'data-pari-type' => $pari->type_profil, 'data-numero-pari' => $pari->numero_pari, 'data-toggle' => "tooltip", 'title' => "Supprimer", 'data-style' => "zoom-in", 'class' => 'boutonsupprimer btn btn-sm ladda-button red buttons-actions-ticket')) }}
                    @if($pari->followtype == 'n')
                        <!-- {{ Form::button('<i class="fa fa-briefcase"></i>', array('type' => 'submit', 'class' => 'btn btn-sm grey-gallery form-bouton-paris buttons-actions-ticket', 'data-id' => $pari->id, 'data-toggle' => 'modal', 'data-target' => '#cashoutModal', 'data-hover' => 'tooltip', 'title' => 'Cash Out',  )) }} -->
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif