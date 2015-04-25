<table id="parislongtermetable" class=" table table-condensed" style="border-collapse:collapse;">
    <thead>
    <tr>
        <th id="count" class="hidden ">{{$count_paris_longterme}}</th>
        <th></th>
        <th>N°</th>
        <th>date ajout</th>
        <th>type</th>
        <th>suivi</th>
        <th>Sport</th>
        <th>Compet.</th>
        <th>Rencontre</th>
        <th>Pari</th>
        <th>Cote</th>
        <th>Tipster</th>
        <th>Bookmaker</th>
        <th>Mise</th>
        <th>Status</th>
        <th>Retour</th>
        <th>Actionqsdqsd</th>
    </tr>
    </thead>
    <tbody>
    @foreach($parislongterme as $pari)
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
                <span class="label label-sm label-success label-mini">{{$pari->followtype == 'n' ? 'normal' : 'à blanc'}}</span>
            </td>
            <td>
                <span data-toggle="tooltip" title="{{$pari->selections[0]->sport->name}}"><img width="25px"
                                                                                               src="{{$pari->selections[0]->sport->logo ? asset('img/logos/sports').'/'.$pari->selections[0]->sport->logo : ''}}"
                                                                                               alt=""/>{{$pari->selections[0]->sport->logo ? '' : $pari->selections[0]->sport->name}}</span>
            </td>
            <td>
                <span data-toggle="tooltip" title="{{$pari->selections[0]->competition->name}}"><img width="30px"
                                                                                                     src="{{$pari->selections[0]->competition->logo ? asset('img/logos/sports').'/'.$pari->selections[0]->competition->logo : ''}}"
                                                                                                     alt=""/>{{{$pari->selections[0]->competition->logo ? '' : $pari->selections[0]->competition->name}}}</span>
            </td>
            <td>
                <span data-toggle="tooltip" title="{{$pari->selections[0]->equipe1->name}}"><img width="25px"
                                                                                                 src="{{$pari->selections[0]->equipe1->logo ? asset('img/logos/sports').'/'.$pari->selections[0]->equipe1->logo : ''}}"
                                                                                                 alt=""/>{{$pari->selections[0]->equipe1->logo ? '':$pari->selections[0]->equipe1->name}}</span>
                <span data-toggle="tooltip" title="{{$pari->selections[0]->equipe2->name}}"><img width="25px"
                                                                                                 src="{{$pari->selections[0]->equipe2->logo ? asset('img/logos/sports').'/'.$pari->selections[0]->equipe2->logo : ''}}"
                                                                                                 alt=""/>{{$pari->selections[0]->equipe2->logo ? '':$pari->selections[0]->equipe2->name}}</span>
            </td>
            <td>{{$pari->selections[0]->typePari->name}} - {{$pari->selections[0]->choix_pari}}</td>
            <td class="fit tdcote">{{$pari->cote}}</td>
            <td>{{$pari->tipster->name}}</td>
            <td>
                <span data-toggle="tooltip" title="{{$pari->compte->bookmaker->nom}}"><img width="60px"
                                                                                           src="{{asset('img/logos/bookmakers').'/'.$pari->compte->bookmaker->logo}}"
                                                                                           alt=""/></span>
            </td>
            <td class="tdmise bold theme-font">
                <span class="tdsubmise bold theme-font">{{{$pari->mise_totale}}}</span>{{{$user->devise}}}
            </td>

            <td>
                <select name="resultatDashboardInput" class="form-control input-sm">
                    <option value="">--Selectionnez--</option>
                    @foreach($types_resultat as $type)
                        <option value=""><a href="javascript:;" class="btn btn-xs">{{$type}}</a></option>
                    @endforeach
                </select>
            </td>
            <td class="tdretour bold"><span class="subretour"></span>{{{$user->devise}}}</td>
            <td>
                {{ Form::open(array('route' => 'historique.store', 'class' => 'validerform' ,'role' => 'form', )) }}
                {{ Form::button('<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'boutonvalider btn btn-sm green')) }}
                {{ Form::close() }}

                {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform','role' => 'form')) }}
                {{ Form::button('<i class="fa fa-times"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red')) }}
                {{ Form::close() }}
            </td>
        </tr>

        <div class="{{'accordian-body collapse row'.$pari->numero_pari}}">
            @foreach($pari->selections as $selection)
                <tr class="{{'collapse subrow '.'row'.$pari->numero_pari}}">
                    <td colspan="17">
                        <table class="table table-hover table-light">
                            <td>{{$selection->date_match}}</td>
                            <td>{{$selection->sport->name}}</td>
                            <td>{{$selection->competition->name}}</td>

                            <td>{{$selection->equipe1->name}} - {{$selection->equipe2->name}}</td>
                            <td>{{$selection->typePari->name}} - {{$selection->choix_pari}}</td>
                            <td>{{$selection->cote}}</td>
                        </table>
                    </td>
                </tr>
            @endforeach
        </div>
    @endforeach
    </tbody>
</table>
{{$parislongterme->appends(Input::except('page'))->links()}}

