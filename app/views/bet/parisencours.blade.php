@if($count_paris_encours == '0')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <span class="glyphicon glyphicon-plus-sign"></span> Ajouter un pari classique à l'aide du formulaire d'ajout
            ci-dessous <span class="glyphicon glyphicon-hand-down"></span>
        </div>
    </div>
@else

        <div class="table-scrollable-borderless table-responsive">
            <table id="parisencourstable" class="table table-condensed"
                   style="border-collapse:collapse;">
                <thead>
                <tr class="uppercase">
                    <th  id="count" class="hidden ">{{$count_paris_encours}}</th>
                    <th></th>
                    <th>N°</th>
                    <th>type</th>
                    <th>Evenement</th>
                    <th>Pari <span class="glyphicon glyphicon-info-sign"></span></th>
                    <th>Tipster</th>
                    <th>Book</th>
                    <th>Cote</th>
                    <th>Mise</th>
                    <th>Resultat</th>
                    <th>Status</th>
                    <th>profits/pertes</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($parisencours as $pari)
                    <div class="wrapperRow">

                    <!-- pour le cas d'un pari simple. -->
                        @if($pari->type_profil == 's')
                            <a href="">
                            <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}" class="mainrow accordion-toggle parisencours-accordeon">
                                <td class="hidden id">{{$pari->id}}</td>
                                <td class="subbetclick"></td>
                                <td><a href="javascript:;" class="primary-link">#{{$pari->numero_pari}}</a></td>
                                
                                <td><span class="label label-sm label-success label-mini type">{{$pari->type_profil == 's' ? 'simple' : 'combiné' }}</span></td>
                                <td width="20%">{{$pari->selections->first()->date_match.' -'}}
                                        {{$pari->selections->first()->sport->name}}{{', '}}{{$pari->selections->first()->competition->name}}
                                    
                                    @if($pari->selections->first()->isMatch)
                                                {{', '}}<strong>{{$pari->selections->first()->game_name}}</strong>
                                              @else
                                        @endif
                                </td>

                                <!--
                                // 1 , 'pick'
                                // 2 , 'pick doubleparam'
                                // 3 , 'pick, parametername1 doubleparam1
                                // 4 , 'pick, doubleparam1-doubleparam2 minutes'
                                // 5 , 'parametername1 doubleparam1' avec '+'
                                // 6 , 'pick Top doubleparam1' -->
                                <td class="blue" width="15%">
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
                                @endif
                                </td>
                                
                                <td class="">{{$pari->tipster->name}}</td>
                                <td class=""><span data-toggle="tooltip"
                      title="{{isset($pari->compte->bookmaker->nom) ? $pari->compte->bookmaker->nom : 'à blanc' }}">
                    @if(isset($pari->compte))
                        <img width="60px"
                             src="{{isset($pari->compte->bookmaker->logo) ? asset('img/logos/bookmakers').'/'.$pari->compte->bookmaker->logo : ''}}"
                             alt=""/>{{isset($pari->compte->bookmaker->logo) ? '' : $pari->compte->bookmaker->nom }}
                    @else
                        <span class="label label-sm label-success label-mini uppercase">à blanc</span>
                    @endif
                </span>
                                </td>
                                <td class="fit tdcote">{{$pari->cote}}</td>
                                <td class="tdmise  bold"><span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{$user->devise}}} {{'('.+$pari->nombre_unites.'u)'}}</td>
                                <td width="120px"><input type="text" name="childrowsinput[]"
                                           class="form-control input-sm"
                                           value="" placeholder="Résultat"/></td>
                                <td width="140px"><select name="resultatSelectionDashboardInput[]"
                                            data-value=""
                                            class="form-control input-sm">
                                        <option value="0"></option>
                                        @foreach($types_resultat as $key => $type)
                                            <option value="{{$key}}"><a href="javascript:;"
                                                                        class="btn btn-xs">{{$type}}</a>
                                            </option>
                                        @endforeach
                                    </select></td>
                                <td class="bold fontsize15" width="100px"><span class="profits"></span><span class="devise hide">{{{' '.$user->devise}}}</span></td>

                                <td width="150px">
                                    {{ Form::open(array('route' => 'historique.store', 'class' => 'validerform form-bouton-paris', 'role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Confirmer')) }}
                                    {{ Form::button('<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'boutonvalider btn btn-sm green', 'disabled' => 'disabled')) }}
                                    {{ Form::close() }}

                                    {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form', 'data-toggle' => 'tooltip', 'data-original-title' => 'Supprimer')) }}
                                    {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red', )) }}
                                    {{ Form::close() }}
                                    @if($pari->followtype == 'n')
                                    {{ Form::button('<i class="fa fa-briefcase"></i>', array('type' => 'submit', 'class' => 'btn btn-sm grey-gallery form-bouton-paris', 'data-toggle' => 'modal', 'data-target' => '#cashoutModal', 'data-hover' => 'tooltip', 'data-id' => $pari->id, 'title' => 'Cash Out')) }}
                                    @endif
                                </td>
                            </tr>
                        </a>



                        <!-- dans le cas d'un pari combiné. -->
                        @else
                            <a href="">
                                <tr data-toggle="collapse" data-target="{{'.row'.$pari->numero_pari}}"
                                    class="mainrow accordion-toggle parisencours-accordeon">

                                    <td class="hidden id">{{$pari->id}}</td>
                                    <td></td>
                                    <!-- <td class="subbetclick"><span data-toggle="collapse"
                                                                  data-target="{{'.row'.$pari->numero_pari}}"
                                                                  class="glyphicon glyphicon-plus-sign"></span></td> -->
                                    <td><a href="javascript:;" class="primary-link">#{{$pari->numero_pari}}</a></td>
                                    <td>
                                        <span class="label label-sm label-success label-mini type">{{$pari->type_profil == 's' ? 'simple' : 'combiné' }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-sm label-success label-mini type">{{'combiné'}}</span>
                                    </td>
                                    <td><span class="label label-sm label-success label-mini type">{{'combiné'}}</span></td>
                                    <td>{{$pari->tipster->name}}</td>
                                    <td><span data-toggle="tooltip"
                      title="{{isset($pari->compte->bookmaker->nom) ? $pari->compte->bookmaker->nom : 'à blanc' }}">
                    @if(isset($pari->compte))
                        <img width="60px"
                             src="{{isset($pari->compte->bookmaker->logo) ? asset('img/logos/bookmakers').'/'.$pari->compte->bookmaker->logo : ''}}"
                             alt=""/>{{isset($pari->compte->bookmaker->logo) ? '' : $pari->compte->bookmaker->nom }}
                    @else
                        <span class="label label-sm label-success label-mini">à blanc</span>
                    @endif
                </span></td>
                                    <td class="fit tdcote">{{$pari->cote}}</td>
                                    <td class="tdmise bold">
                                        <span class="tdsubmise bold ">{{{round($pari->mise_totale, 2)}}}</span>{{{$user->devise.' '}}}{{'('.+$pari->nombre_unites.'u)'}}
                                    </td>
                                    <td>
                                        <span class="label label-sm label-success label-mini type">{{'combiné'}}</span>
                                    </td>
                                    <td><span class="label label-sm label-success label-mini type">{{'combiné'}}</span></td>

                                    <td class="bold fontsize15"><span class="profits"></span><span
                                                class="devise hide">{{{' '.$user->devise}}}</span></td>
                                    <td>
                                        {{ Form::open(array('route' => 'historique.store', 'class' => 'validerform form-bouton-paris' ,'role' => 'form', )) }}
                                        {{ Form::button('<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'boutonvalider btn btn-sm green', 'disabled' => 'disabled')) }}
                                        {{ Form::close() }}

                                        {{ Form::open(array('route' => 'historique.destroy', 'class' => 'supprimerform form-bouton-paris','role' => 'form')) }}
                                        {{ Form::button('<i class="fa fa-times"></i>', array('type' => 'submit', 'class' => 'boutonsupprimer btn btn-sm red', )) }}
                                        {{ Form::close() }}
                                        @if($pari->followtype == 'n')
                                        {{ Form::button('<i class="fa fa-briefcase"></i>', array('type' => 'submit', 'class' => 'btn btn-sm grey-gallery form-bouton-paris', 'data-toggle' => 'modal', 'data-target' => '#cashoutModal', 'data-hover' => 'tooltip', 'data-id' => $pari->id, 'title' => 'Cash Out')) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr class="subrow">
                                    <td colspan="17" class="childtable cancel-padding">
                                        <div class="{{'accordian-body collapse row'.$pari->numero_pari}}">
                                            <table class="table table-striped child-table table-bordered">
                                                <thead>

                                                <tr class="uppercase">
                                                    <th>evenement</th>
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
                                                        <td>{{$pari->selections->first()->date_match.' -'}}
                                                            {{$pari->selections->first()->sport->name}}{{', '}}{{$pari->selections->first()->competition->name}}
                                                        
                                                        @if($pari->selections->first()->isMatch)
                                                                    {{', '}}<strong>{{$pari->selections->first()->game_name}}</strong>
                                                                  @else
                                                            @endif
                                                        </td>
                                                        <td class="blue">{{$pari->selections->first()->market->name.(' : ')}}       
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
                                                            @endif
                                                        </td>
                                                        
                                                        <td>
                                                            <span class="cote-td">{{$selection->cote}}</span>
                                                        </td>
                                                        <td width="120px"><input  type="text" name="childrowsinput[]"
                                                                   class="form-control input-sm"
                                                                   value="{{empty($selection->infos_pari) ? '' : $selection->infos_pari}}"/>
                                                        </td>
                                                        <td width="150px" class="status-td">
                                                            <select name="resultatSelectionDashboardInput[]"
                                                                    data-value="{{$selection->status}}"
                                                                    class="form-control input-sm">
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
                            </a>
                        @endif

                    </div>
                @endforeach
                </tbody>

            </table>
        </div>
        {{$parisencours->appends(Input::except('page'))->links()}}

    @endif