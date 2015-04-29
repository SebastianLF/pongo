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
                    <label class="bold">Tipster</label>
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
                       type="text"
                       readonly/>
            </div>
            <div class="col-md-2">
                <div class="">
                    <label class="bold">Montant par unité</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">€</div>
                    <input id="amountperunit" name="amountperunit" class="form-control input-sm" type="text"
                           readonly/></input>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <div class="">
                    <label class="bold" id="stakelabeldashboard">Mise</label>
                </div>
                <div class="">
                    <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                            class="form-control input-sm">
                        <option value="u">en unités</option>
                        <option value="f">manuel</option>
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
                    <label class="bold" id="">Conversion en {{$user->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{$user->devise}}</div>
                    <input id="amountconversion" name="amountconversion" class="form-control"
                           type="text"
                           value="0" readonly/></input>
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
                    <label class="bold" id="">Conversion en unités</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">u</div>
                    <input id="flattounitconversion" name="flattounitconversion"
                           class="form-control"
                           type="text"
                           value="0" readonly/></input>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 bookmaker-line">
                <div class="">
                    <label class="bold">Bookmaker</label>
                </div>
                <select id="bookinputdashboard" name="bookinputdashboard" class="form-control">
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
            <div class="">
                <label id="">Options</label>
            </div>
            <label class="radio-inline">
                <input type="radio" name="RadioOptions" id="aucun" value="aucun" checked="checked">aucun
            </label>
            <label class="radio-inline">
                <input type="radio" name="RadioOptions" id="parislongterme" value="parislongterme">pari long
                terme
            </label>
            <label class="radio-inline">
                <input type="radio" name="RadioOptions" id="systemeABCD" value="systemeABCD">systeme abcd
            </label>
        </div>
        <div id="methodeabcdcontainer" class="form-group">
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
    </div>
    <form>
        <div class="form-body">

        </div>
        <div class="row ">

        </div>


        <div id="wrapmanubetscontainer">
            <table id="tablemanubetlines" class="table table-condensed table-bordered">
                <tr>
                    <th width="80px">DATE RENCONTRE</th>
                    <th width="">SPORT</th>
                    <th width="">LEAGUE</th>
                    <th colspan="2" width="100px">RENCONTRE</th>
                    <th>PARI</th>
                    <th width="50px">COTE <span class="glyphicon glyphicon-asterisk"></span></th>
                </tr>
                <tr class="betline">
                    <td><div class="">
                        <input name="datematchinputdashboard[]" class="form-control datematchinputdashboard input-sm"
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
                    <!--<td>
                        <input id="matchnameinputdashboard" name="matchnameinputdashboard[]" class="form-control" placeholder="ex: Madrid vs Barcelona">
                    </td> -->
                    <!--
                    <input type="text" id="equipe1input[]" class="form-control" />
                    -->
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