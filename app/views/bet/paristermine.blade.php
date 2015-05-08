@if($count_paris_termine == '0')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            Aucun résultat
        </div>
    </div>
@else
    <div class="table-scrollable table-scrollable-borderless">
        <table id="paristerminetable" class="table table-condensed table-hover table-light"
               style="border-collapse:collapse;">
            <thead>
            <tr class="uppercase">
                <th id="count" class="hidden ">{{$count_paris_termine}}</th>
                <th></th>
                <th>N°</th>
                <th>date ajout</th>
                <th>type</th>
                <th colspan="3" align="center">Apercu</th>
                <th>Pari <span class="glyphicon glyphicon-info-sign"></span></th>
                <th>Cote</th>
                <th>Tipster</th>
                <th>Bookmaker</th>
                <th>Mise</th>
                <th>status</th>
                <th>profits</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($paristermine as $pari)
                <div class="wrapperRow">
                    <a href="">
                        <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}"
                            class="mainrow accordion-toggle parisencours-accordeon">

                            <td class="hidden id">{{$pari->id}}</td>

                            <td class="subbetclick"><span data-toggle="collapse"
                                                          data-target="{{'.row'.$pari->numero_pari}}"
                                                          class="glyphicon glyphicon-chevron-right"></span></td>
                            <td><a href="javascript:;" class="primary-link">#{{$pari->numero_pari}}</a></td>
                            <td>{{$pari->created_at}}</td>
                            <td>
                                <span class="label label-sm label-success label-mini">{{$pari->type_profil == 's' ? 'simple' : 'combiné' }}</span>
                            </td>
                            <td>
                <span data-toggle="tooltip"
                      title="{{isset($pari->selections[0]->sport) ? $pari->selections[0]->sport->name : 'aucun'}}">
                    @if(isset($pari->selections[0]->sport))
                        <img width="25px"
                             src="{{isset($pari->selections[0]->sport->logo) ? asset('img/logos/sports').'/'.$pari->selections[0]->sport->logo : ''}}"
                             alt=""/>{{isset($pari->selections[0]->sport->logo) ? '' : $pari->selections[0]->sport->name}}
                    @else
                        {{'non spéc.'}}
                    @endif
                </span>
                            </td>
                            <td>
                <span data-toggle="tooltip"
                      title="{{isset($pari->selections[0]->competition) ? $pari->selections[0]->competition->name : 'aucun'}}">
                    @if(isset($pari->selections[0]->competition))
                        <img width="30px"
                             src="{{isset($pari->selections[0]->competition->logo) ? asset('img/logos/sports').'/'.$pari->selections[0]->competition->logo : ''}}"
                             alt=""/>{{{isset($pari->selections[0]->competition->logo)? '' : $pari->selections[0]->competition->name}}}
                    @else
                        {{'non spéc.'}}
                    @endif
                </span>
                            </td>
                            <td>
                <span data-toggle="tooltip"
                      title="{{isset($pari->selections[0]->equipe1) ? $pari->selections[0]->equipe1->name : 'aucun'}}">
                    @if(isset($pari->selections[0]->equipe1))
                        <img width="30px"
                             src="{{isset($pari->selections[0]->equipe1->logo) ? asset('img/logos/sports').'/'.$pari->selections[0]->equipe1->logo : ''}}"
                             alt=""/>{{isset($pari->selections[0]->equipe1->logo) ? '':$pari->selections[0]->equipe1->name}}
                    @else
                        {{'non spéc.'}}
                    @endif
                </span>
                <span data-toggle="tooltip"
                      title="{{isset($pari->selections[0]->equipe2) ? $pari->selections[0]->equipe2->name  : 'aucun'}}">
                    @if(isset($pari->selections[0]->equipe2))
                        <img width="25px"
                             src="{{isset($pari->selections[0]->equipe2->logo) ? asset('img/logos/sports').'/'.$pari->selections[0]->equipe2->logo : ''}}"
                             alt=""/>{{isset($pari->selections[0]->equipe2->logo) ? '':$pari->selections[0]->equipe2->name}}
                    @endif
                </span>
                            </td>
                            <td>

                            </td>

                            <td class="fit tdcote">{{$pari->cote}}</td>
                            <td>{{$pari->tipster->name}}</td>
                            <td>
                <span data-toggle="tooltip"
                      title="{{isset($pari->compte->bookmaker->nom) ? $pari->compte->bookmaker->nom : 'à blanc' }}">
                    @if(isset($pari->compte))
                        <img width="60px"
                             src="{{isset($pari->compte->bookmaker->logo) ? asset('img/logos/bookmakers').'/'.$pari->compte->bookmaker->logo : ''}}"
                             alt=""/>{{isset($pari->compte->bookmaker->logo) ? '' : $pari->compte->bookmaker->nom }}{{' ('.$pari->compte->nom_compte.')'}}
                    @else
                        <span class="label label-sm label-success label-mini">à blanc</span>
                    @endif
                </span>
                            </td>
                            <td class="tdmise bold">
                                <span class="tdsubmise bold ">{{{$pari->mise_totale}}} </span>{{{$user->devise}}}
                            </td>
                            <td class="bold uppercase">
                                @if($pari->type_profil == 's')
                                @if($pari->status == 1)
                                    <span class="font-green">{{'Gagné'}}</span>
                                @elseif($pari->status == 2)
                                    <span class="font-red">{{'Perdu'}}</span>
                                @elseif($pari->status == 3)
                                    <span class="font-green">{{'1/2 Gagné'}}</span>
                                @elseif($pari->status == 4)
                                    <span class="font-red">{{'1/2 Perdu'}}</span>
                                @elseif($pari->status == 5)
                                    <span class="font-blue">{{'Remboursé'}}</span>
                                @endif
                                    @else
                                @endif
                            </td>
                            <td class="bold">
                            <span class="profits">

                                    @if($pari->status == 1)
                                        <span class="font-green">{{{$pari->montant_profit}}}</span>
                                        <span class="devise font-green"> {{{$user->devise}}}</span>
                                    @elseif($pari->status == 2)
                                        <span class="font-red">{{{$pari->montant_profit}}}</span>
                                        <span class="devise font-red"> {{{$user->devise}}}</span>
                                    @elseif($pari->status == 3)
                                        <span class="font-green">{{{$pari->montant_profit}}}</span>
                                        <span class="devise font-green"> {{{$user->devise}}}</span>
                                    @elseif($pari->status == 4)
                                        <span class="font-red">{{{$pari->montant_profit}}}</span>
                                        <span class="devise font-red"> {{{$user->devise}}}</span>
                                    @elseif($pari->status == 5)
                                        <span class="font-blue">{{{$pari->montant_profit}}}</span>
                                        <span class="devise font-blue"> {{{$user->devise}}}</span>
                                    @endif

                            </span>
                            </td>

                            <td>
                                {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form')) }}
                                {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red', )) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr class="subrow">
                            <td colspan="17" class="childtable cancel-padding">
                                <div class="{{'accordian-body collapse row'.$pari->numero_pari}}">
                                    <table class="table table-striped child-table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>date rencontre</th>
                                            <th>sport</th>
                                            <th>competition</th>
                                            <th>equipe/joueur n°1</th>
                                            <th>equipe/joueur n°2</th>
                                            <th>cote</th>
                                            <th>score/autre</th>
                                            <th>status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($pari->selections as $selection)
                                            <tr class="child-table-tr">
                                                <td class="hidden child-id">{{$selection->id}}</td>
                                                <td>{{isset($selection->date_match) ? $selection->date_match : 'non spéc.'}}</td>
                                                <td>{{isset($selection->sport) ? $selection->sport->name : 'non spéc.'}}</td>
                                                <td>{{isset($selection->competition) ? $selection->competition->name : 'non spéc.'}}</td>
                                                <td>{{isset($selection->equipe1) ? $selection->equipe1->name : 'non spéc.'}}</td>
                                                <td>{{isset($selection->equipe2) ? $selection->equipe2->name : 'non spéc.'}}</td>
                                                <td>
                                                    <span class="cote-td">{{$selection->cote}}</span>{{empty($selection->cote_apres_status) ? '' : ' ('.($selection->cote_apres_status).')'}}
                                                </td>
                                                <td>{{$selection->infos_pari}}</td>
                                                <td class="status-td uppercase bold">
                                                    @if($pari->status == 1)
                                                        <span class="font-green">{{'Gagne'}}</span>
                                                    @elseif($pari->status == 2)
                                                        <span class="font-red">{{'Perdu'}}</span>
                                                    @elseif($pari->status == 3)
                                                        <span class="font-green">{{'1/2 Gagne'}}</span>
                                                    @elseif($pari->status == 4)
                                                        <span class="font-red">{{'1/2 Perdu'}}</span>
                                                    @elseif($pari->status == 5)
                                                        <span class="font-blue">{{'Rembourse'}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </td>


                        </tr>
                    </a>
                </div>
            @endforeach
            </tbody>

        </table>
    </div>
@endif