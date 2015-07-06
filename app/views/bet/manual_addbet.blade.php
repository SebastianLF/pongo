<div class="note note-success">
    <p>
        Pour <strong>vos paris perso</strong>, creez vous un tipster se nommant 'moi' ou 'Michel' par exemple.
    </p>
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
    <div id="wrapmanubetscontainer" class="table-scrollable ">
        <table id="tablemanubetlines" class="table table-condensed">
            <tr>
                <th width="">DATE RENCONTRE</th>
                <th width="">SPORT</th>
                <th width="">LEAGUE</th>
                <th colspan="2" width="100px">RENCONTRE</th>
                <th>PARI</th>
                <th width="">COTE <span class="glyphicon glyphicon-asterisk"></span></th>
                <th>OPTIONS</th>
                <th></th>
            </tr>
            <tr class="betline">
                <td>
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
                    <select name="competitioninputdashboard[]" class="form-control competitioninputdashboard">
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
                <td>
                    <select name="picknameinputdashboard[]" class="form-control picknameinputdashboard"
                            placeholder="ex: OVER 2.5">
                        <option value=""></option>
                    </select>
                </td>
                <td>
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
                    <button id="addlinebet" type="button" class="btn btn-default"><span
                                class="glyphicon glyphicon-plus"></span>ajouter une ligne
                    </button>
                </td>
            </tr>
        </table>
        <button type="submit" class="form-control btn btn-success" value="">Valider</button>
        <p class="text-danger center-block " id="changementtype"><strong></strong></p>
    </div>
    {{ Form::close() }}
</div>
