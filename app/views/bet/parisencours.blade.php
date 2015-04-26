
<table id="parisencourstable" class="table table-condensed " style="border-collapse:collapse;">
    <thead>
    <tr>
        <th id="count" class="hidden ">{{$count_paris_encours}}</th>
        <th></th>
        <th>N°</th>
        <th>date ajout</th>
        <th>type</th>
        <th>Sport</th>
        <th>Compet.</th>
        <th>Rencontre</th>
        <th>Pari <span class="glyphicon glyphicon-info-sign"></span></th>
        <th>Cote</th>
        <th>Tipster</th>
        <th>Bookmaker</th>
        <th>Mise</th>
        <th>Status <span class="glyphicon glyphicon-info-sign"></span></th>
        <th>Retour <span class="glyphicon glyphicon-info-sign"></span></th>
        <th>Actionqsdqsd <span class="glyphicon glyphicon-info-sign"></span></th>
    </tr>
    </thead>
    <tbody>
    @foreach($parisencours as $pari)
        <div class="wrapperRow">
            <a href="">
                <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}"
                    class="mainrow accordion-toggle parisencours-accordeon">

                    <td class="hidden id">{{$pari->id}}</td>

                    <td class="subbetclick"><span data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}"
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
                        @if(isset($pari->selections[0]->typePari))
                            {{$pari->selections[0]->typePari->name}} - {{$pari->selections[0]->choix_pari}}</td>
                    @else
                        {{'non spéc.'}}
                    @endif
                    <td class="fit tdcote">{{$pari->cote}}</td>
                    <td>{{$pari->tipster->name}}</td>
                    <td>
                <span data-toggle="tooltip"
                      title="{{isset($pari->compte->bookmaker->nom) ? $pari->compte->bookmaker->nom : 'à blanc' }}">
                    @if(isset($pari->compte))
                        <img width="60px"
                             src="{{isset($pari->compte->bookmaker->logo) ? asset('img/logos/bookmakers').'/'.$pari->compte->bookmaker->logo : ''}}"
                             alt=""/>{{isset($pari->compte->bookmaker->logo) ? '' : $pari->compte->bookmaker->nom }}
                    @else
                        <span class="label label-sm label-success label-mini">à blanc</span>
                    @endif
                </span>
                    </td>
                    <td class="tdmise bold theme-font">
                        <span class="tdsubmise bold theme-font">{{{$pari->mise_totale}}}</span>{{{$user->devise}}}
                    </td>

                    <td>
                        <select name="resultatDashboardInput" class="form-control input-sm">
                            <option value="0">--Selectionnez--</option>
                            @foreach($types_resultat as $key => $type)
                                <option value="{{$key}}"><a href="javascript:;" class="btn btn-xs">{{$type}}</a>
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="tdretour bold"><span class="subretour"></span>{{{$user->devise}}}</td>
                    <td>
                        {{ Form::open(array('route' => 'historique.store', 'class' => 'validerform form-bouton-paris' ,'role' => 'form', )) }}
                        {{ Form::button('<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'boutonvalider btn btn-sm green')) }}
                        {{ Form::close() }}

                        {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form')) }}
                        {{ Form::button('<i class="fa fa-times"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red')) }}
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
                                    <th>pari</th>
                                    <th>cote</th>
                                    <th>score/autre</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($pari->selections as $selection)
                                    <tr class="child-table-tr">
                                        <td>{{isset($selection->date_match) ? $selection->date_match : 'non spéc.'}}</td>
                                        <td>{{isset($selection->sport) ? $selection->sport->name : 'non spéc.'}}</td>
                                        <td>{{isset($selection->competition) ? $selection->competition->name : 'non spéc.'}}</td>
                                        <td>{{isset($selection->equipe1) ? $selection->equipe1->name : 'non spéc.'}}</td>
                                        <td>{{isset($selection->equipe2) ? $selection->equipe2->name : 'non spéc.'}}</td>
                                        <td>{{isset($selection->typePari) ? $selection->typePari->name : 'non spéc.'}}
                                            - {{isset($selection->choix_pari) ? $selection->choix_pari : 'aucun'}}</td>
                                        <td>{{$selection->cote}}</td>
                                        <td><input type="text" name="childrowsinput[]"
                                                   class="form-control input-sm"/></td>
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

{{$parisencours->appends(Input::except('page'))->links()}}

