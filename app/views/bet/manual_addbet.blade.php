<div class="note note-success">
    <p>
        Pour <strong>vos paris perso</strong>, creez vous un tipster se nommant 'moi' ou 'Michel' par exemple.
    </p>
</div>
<div class="row " style="padding:10px;">
    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light bordered ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Panier
                </div>
                <div class="actions">

                    <a id="selection-refresh" class="bold uppercase" href=""><span
                                class="glyphicon glyphicon-refresh"></span>Rafraichir</a>
                    | <span class="pull-right glyphicon glyphicon-refresh glyphicon-spin"></span>
                </div>
            </div>
            <div class="portlet-body form form-automatic">
                <div id="automatic-selections">
                    <div class="list-group">
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">1) Ajouter une selection (pari) à l'aide du panneau
                                ci-dessous.</h4>

                            <p class="list-group-item-text">
                                Vous avez 3 façons d'ajouter une selection, soit par le champ de recherche tout en haut
                                du panneau, soit par le menu deroulant juste en dessous du champ de recherche, soit par
                                le menu 'liste des evenements'sur la gauche. Si vous ne trouvez pas le bouton 'ajouter
                                au panier', c'est que vous n'avez pas cliqué sur le match en question.
                            </p>
                        </div>
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">2) Ajouter les informations générales</h4>

                            <p class="list-group-item-text">
                                Une fois la ou les selections ajoutées, remplissez les informations générales. Pour
                                finir, cliquez sur le bouton 'valider le ticket'. Répétez la procédure pour chaque
                                ticket que vous voulez ajouter :)
                            </p>
                        </div>
                    </div>


                </div>

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#manualBetAddModal"><span
                            class="glyphicon glyphicon-plus"></span>ajouter une ligne
                </button>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Informations générales du ticket
                </div>
            </div>

            <div class="portlet-body form form-automatic">
                <div class="form-body" style="padding:5px;">
                    <div class="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Tipster</label>
                                </div>
                                <select id="tipstersinputdashboard" name="tipstersinputdashboard"
                                        class="form-control input-sm" tabindex="-1" style="display: none;">
                                    <option></option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                               style="width: 100px;"><span class="selection"><span
                                                class="select2-selection select2-selection--single" role="combobox"
                                                aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-labelledby="select2-tipstersinputdashboard-container"><span
                                                    class="select2-selection__rendered"
                                                    id="select2-tipstersinputdashboard-container"><span
                                                        class="select2-selection__placeholder">Choisir un tipster</span></span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Suivi</label>
                                </div>
                                <input type="text" id="followtypeinputdashboard" name="followtypeinputdashboard"
                                       class="form-control input-sm" placeholder="Selectionnez un tipster !"
                                       readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Montant par unité</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" id="amountperunit" name="amountperunit"
                                           class="form-control input-sm" placeholder="Selectionnez un tipster !"
                                           readonly="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Mise</label>
                                </div>
                                <div class="">
                                    <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                                            class="form-control input-sm" tabindex="-1" style="display: none;">

                                        <option value="u">en unités</option>
                                        <option value="f">en devise</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                                   dir="ltr" style="width: 100px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0"
                                                    aria-labelledby="select2-typestakeinputdashboard-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-typestakeinputdashboard-container"
                                                        title="en unités">en unités</span><span
                                                        class="select2-selection__arrow" role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-3 col-md-offset-1 typestakeunites">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Mise en unités</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">u</div>

                                    <input type="text" id="stakeunitinputdashboard" name="stakeunitinputdashboard"
                                           class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1 typestakeunites">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Conversion en €</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" id="amountconversion" name="amountconversion"
                                           class="form-control input-sm" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-offset-1 typestakeflat" style="display: none;">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Mise en €</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" id="amountinputdashboard" name="amountinputdashboard"
                                           class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1 typestakeflat" style="display: none;">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Conversion en unités</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">u</div>
                                    <input type="text" id="flattounitconversion" name="flattounitconversion"
                                           class="form-control input-sm" readonly="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bookmakerrow ">
                        <div class="col-md-4 bookmakercontainer">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Bookmaker</label>
                                </div>
                                <div class="">
                                    <select name="bookinputdashboard" class="form-control bookinputdashboard input-sm"
                                            tabindex="-1" style="display: none;">
                                        <option></option>
                                        <option value="1">bet365</option>
                                        <option value="2">pinnacle</option>
                                        <option value="3">sbobet</option>
                                        <option value="4">parionsweb</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                                   dir="ltr" style="width: 100px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0"
                                                    aria-labelledby="select2-bookinputdashboard-1m-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-bookinputdashboard-1m-container"
                                                        title=""></span><span class="select2-selection__arrow"
                                                                              role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Compte de bookmaker</label>
                                </div>
                                <div class="">
                                    <select id="accountsinputdashboard" name="accountsinputdashboard"
                                            class="form-control input-sm" tabindex="-1" style="display: none;">
                                        <option></option>
                                    </select><span class="select2 select2-container select2-container--default"
                                                   dir="ltr" style="width: 100px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0"
                                                    aria-labelledby="select2-accountsinputdashboard-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-accountsinputdashboard-container"><span
                                                            class="select2-selection__placeholder">Choisir un compte</span></span><span
                                                        class="select2-selection__arrow" role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <!--/span-->
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="checkbox-inline">
                                        <div class="checker" id="uniform-ticketABCD"><span><input type="checkbox"
                                                                                                  id="ticketABCD"
                                                                                                  value="ticketABCD"></span>
                                        </div>
                                        Pari ABCD
                                    </label>
                                    <label class="checkbox-inline">
                                        <div class="checker" id="uniform-ticketGratuit"><span><input type="checkbox"
                                                                                                     id="ticketGratuit"
                                                                                                     value="ticketGratuit"></span>
                                        </div>
                                        Pari gratuit
                                    </label>
                                    <label class="checkbox-inline">
                                        <div class="checker" id="uniform-ticketLongTerme"><span><input type="checkbox"
                                                                                                       id="ticketLongTerme"
                                                                                                       value="ticketLongTerme"></span>
                                        </div>
                                        Pari long terme
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <div class="methodeabcdcontainer  hide">
                        <div class="col-md-5  col-md-offset-1">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">N° série ou nom</label>
                                </div>
                                <div class="">
                                    <select name="serieinputdashboard" id="serieinputdashboard"
                                            class="form-control input-sm" tabindex="-1" disabled=""
                                            style="display: none;">
                                        <option></option>
                                    </select><span
                                            class="select2 select2-container select2-container--default select2-container--disabled"
                                            dir="ltr" style="width: 100px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="-1"
                                                    aria-labelledby="select2-serieinputdashboard-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-serieinputdashboard-container"><span
                                                            class="select2-selection__placeholder">Choisir une serie</span></span><span
                                                        class="select2-selection__arrow" role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <div class="form-group">
                                <div class="">
                                    <label class="bold">Lettre</label>
                                </div>
                                <div class="">
                                    <select id="letterinputdashboard" name="letterinputdashboard"
                                            class="form-control input-sm" tabindex="-1" disabled=""
                                            style="display: none;">
                                        <option></option>
                                    </select><span
                                            class="select2 select2-container select2-container--default select2-container--disabled"
                                            dir="ltr" style="width: 100px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="-1"
                                                    aria-labelledby="select2-letterinputdashboard-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-letterinputdashboard-container"><span
                                                            class="select2-selection__placeholder">Choisir une lettre</span></span><span
                                                        class="select2-selection__arrow" role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<div class="portlet-body form">
    <!-- BEGIN FORM-->
    {{ Form::open(array('method' => 'post', 'id' => 'manubetform-add', 'class' => 'form-horizontal form-row-seperated', 'role' => 'form')
            ) }}


    <div class="form-body">
        <div class="form-group form-group-manual-bet">
            <div class="col-md-2">
                <div class="">
                    <label for="tipstersinputdashboard" class="bold">Tipster</label>
                </div>
                <select id="tipstersinputdashboard" name="tipstersinputdashboard" class="form-control input-sm">
                    <option></option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="">
                    <label class="bold">Suivi</label>
                </div>
                <input id="followtypeinputdashboard" name="followtypeinputdashboard"
                       class="form-control input-sm"
                       type="text" placeholder="Selectionnez un tipster !"
                       readonly/>
            </div>
            <div class="col-md-2">
                <div class="">
                    <label class="bold">Montant par unité</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">€</div>
                    <input id="amountperunit" name="amountperunit" class="form-control input-sm" type="text"
                           placeholder="Selectionnez un tipster !"
                           readonly/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <div class="">
                    <label class="bold" for="typestakeinputdashboard" id="stakelabeldashboard">Mise</label>
                </div>
                <div class="">
                    <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                            class="form-control input-sm">
                    </select>
                </div>
            </div>
            <div class="col-md-2 typestakeunites">
                <div class="">
                    <label class="bold" id="">Mise en unités</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">u</div>
                    <input id="stakeunitinputdashboard" name="stakeunitinputdashboard"
                           class="form-control"
                           placeholder="5">
                </div>
            </div>
            <div class="col-md-2 typestakeunites">
                <div class="">
                    <label class="bold" for="amountconversion" id="">Conversion en {{$user->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{$user->devise}}</div>
                    <input id="amountconversion" name="amountconversion" class="form-control"
                           type="text"
                           value="0" readonly/>
                </div>
            </div>
            <div class="col-md-2 typestakeflat">
                <div class="">
                    <label class="bold" id="">Mise en {{$user->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{$user->devise}}</div>
                    <input id="amountinputdashboard" name="amountinputdashboard"
                           class="form-control"
                           placeholder="10">
                </div>
            </div>

            <div class="col-md-2 typestakeflat">
                <div class="">
                    <label class="bold" for="flattounitconversion" id="">Conversion en unités</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">u</div>
                    <input id="flattounitconversion" name="flattounitconversion"
                           class="form-control"
                           type="text"
                           value="0" readonly/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 bookmaker-line">
                <div class="">
                    <label class="bold">Bookmaker</label>
                </div>
                <select name="bookinputdashboard" class="bookinputdashboard form-control">
                    <option></option>
                </select>
            </div>
            <div class="col-md-2 bookmaker-line">
                <div class="">
                    <label class="bold">Comptes associés</label>
                </div>
                <select id="accountsinputdashboard" name="accountsinputdashboard" class="form-control ">
                    <option></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="">
                    <label class="bold" id="">Options</label>
                </div>
                <div class="col-md-12">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="ticketABCD"
                               value="ticketABCD">Pari ABCD
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="ticketGratuit"
                               value="ticketGratuit">Pari gratuit
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="methodeabcdcontainer" class="form-group hide">
        <div class="col-md-2">
            <div class="">
                <label>n° série ou nom</label>
            </div>
            <select name="serieinputdashboard" id="serieinputdashboard" class="form-control input-sm">
            </select>
        </div>
        <div class="col-md-2">
            <div class="">
                <label>lettre:</label>
            </div>
            <select id="letterinputdashboard" name="letterinputdashboard" class="form-control input-sm">
            </select>
        </div>
    </div>
    @include('bet/manual_bet_add_modal')
    <div id="wrapmanubetscontainer" class="table-scrollable ">

        <table id="tablemanubetlines" class="table table-condensed">
            <tr>
                <th width="70px">DATE RENCONTRE</th>
                <th width="">SPORT</th>
                <th width="">LEAGUE</th>
                <th>TYPE PARI</th>
                <th>SOUS TYPE</th>
                <th>CHOIX N°1</th>
                <th class="hide">CHOIX N°2</th>
                <th class="hide">CHOIX N°2</th>
                <th class="hide">CHOIX N°2</th>
                <th class="hide">CHOIX N°2</th>
                <th class="hide">CHOIX N°2</th>
                <th class="hide">CHOIX N°2</th>
                <th colspan="2" width="100px">RENCONTRE</th>
                <th width="">COTE <span class="glyphicon glyphicon-asterisk"></span></th>
                <th>OPTIONS</th>
                <th></th>
            </tr>
            <tr class="betline">
                <td width="70px">
                    <div class="">
                        <input name="datematchinputdashboard[]"
                               class="form-control datematchinputdashboard input-sm"
                               type="date">
                    </div>
                </td>
                <td>
                    <select name="sportinputdashboard[]" class="form-control sportinputdashboard">
                        <option value=""></option>
                    </select>
                </td>

                <td>
                    <div class="">
                        <select name="competitioninputdashboard[]" class="form-control competitioninputdashboard">
                            <option value=""></option>
                        </select>
                    </div>
                </td>
                <td>
                    <select name="marketinputdashboard[]" class="form-control marketinputdashboard">
                        <option value=""></option>
                    </select>
                </td>
                <td>
                    <select name="scopeinputdashboard[]" class="form-control scopeinputdashboard">
                        <option value=""></option>
                    </select>
                </td>
                <td>
                    <select name="pick[]" class="form-control pick">
                        <option value=""></option>
                    </select>
                </td>
                <td class="hide">
                    <select name="oddParam1[]" class="form-control oddParam1 ">
                        <option value=""></option>
                    </select>
                </td>
                <td class="hide">
                    <select name="oddParam2[]" class="form-control oddParam2 hide">
                        <option value=""></option>
                    </select>
                </td>
                <td class="hide">
                    <select name="oddParam3[]" class="form-control oddParam3 hide">
                        <option value=""></option>
                    </select>
                <td class="hide">
                    <select name="parametreName1[]" class="form-control parametreName1 hide">
                        <option value=""></option>
                    </select>
                </td>
                <td class="hide">
                    <select name="parametreName2[]" class="form-control parametreName2 hide">
                        <option value=""></option>
                    </select>
                </td>
                <td class="hide">
                    <select name="parametreName3[]" class="form-control parametreName3 hide">
                        <option value=""></option>
                    </select>
                </td>
                <td width="120">
                    <select name="team1inputdashboard[]" class="form-control team1inputdashboard">
                        <option value=""></option>
                    </select>
                </td>
                <td width="120">
                    <select name="team2inputdashboard[]" class="form-control team2inputdashboard">
                        <option value=""></option>
                    </select>
                </td>
                <td width="60px">
                    <input name="oddinputdashboard[]" class="form-control input-sm" placeholder="ex: 1.83">
                </td>
                <td width="230px">
                    <label class="checkbox-inline uppercase">
                        <input type="checkbox" name="selectionsLive[]"
                               value="live">live
                    </label>
                    <label class="checkbox-inline uppercase">
                        <input type="checkbox" name="selectionsLongterme[]"
                               value="ticketLongTerme">long terme
                    </label>
                </td>
                <td>
                    <button type="button" class="btn btn-danger supprlinebet"><span
                                class="glyphicon glyphicon-trash"></span></button>
                </td>
            </tr>

            <tr id="addbetbuttontr">
                <td>

                </td>
            </tr>
        </table>
        <button type="submit" class="form-control btn btn-success" value="">Valider</button>
        <p class="text-danger center-block " id="changementtype"><strong></strong></p>
    </div>
    {{ Form::close() }}
</div>
