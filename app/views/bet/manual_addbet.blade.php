
@include('bet/manual_bet_add_modal')
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
                    <i class="fa fa-gift"></i>Panier des sélections
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form form-automatic">
                <div id="automatic-selections">
                    <div class="list-group">

                    </div>


                </div>

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#manualBetAddModal"><span
                            class="glyphicon glyphicon-plus"></span>ajouter une sélection
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
            <div class="portlet-body">
                {{ Form::open(array('method' => 'post', 'id' => 'manubetform-add', 'class' => 'form-horizontal form-row-seperated', 'role' => 'form')
            ) }}


                <div class="form-body">
                    <div class="form-group form-group-manual-bet">
                        <div class="col-md-4">
                            <div class="">
                                <label for="tipstersinputdashboard" class="bold">Tipster</label>
                            </div>
                            <select id="tipstersinputdashboard" name="tipstersinputdashboard" class="form-control input-sm">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <label class="bold">Suivi</label>
                            </div>
                            <input id="followtypeinputdashboard" name="followtypeinputdashboard"
                                   class="form-control input-sm"
                                   type="text" placeholder="Selectionnez un tipster !"
                                   readonly/>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="">
                                <label class="bold" for="typestakeinputdashboard" id="stakelabeldashboard">Mise</label>
                            </div>
                            <div class="">
                                <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                                        class="form-control input-sm">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 typestakeunites">
                            <div class="">
                                <label class="bold" id="">Mise en unités</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">u</div>
                                <input id="stakeunitinputdashboard" name="stakeunitinputdashboard"
                                       class="form-control input-sm"
                                       placeholder="5">
                            </div>
                        </div>
                        <div class="col-md-4 typestakeunites">
                            <div class="">
                                <label class="bold" for="amountconversion" id="">Conversion en {{$user->devise}}</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">{{$user->devise}}</div>
                                <input id="amountconversion" name="amountconversion" class="form-control input-sm"
                                       type="text"
                                       value="0" readonly/>
                            </div>
                        </div>
                        <div class="col-md-4 typestakeflat">
                            <div class="">
                                <label class="bold" id="">Mise en {{$user->devise}}</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">{{$user->devise}}</div>
                                <input id="amountinputdashboard" name="amountinputdashboard"
                                       class="form-control input-sm"
                                       placeholder="10">
                            </div>
                        </div>

                        <div class="col-md-4 typestakeflat">
                            <div class="">
                                <label class="bold" for="flattounitconversion" id="">Conversion en unités</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">u</div>
                                <input id="flattounitconversion" name="flattounitconversion"
                                       class="form-control input-sm"
                                       type="text"
                                       value="0" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 bookmaker-line">
                            <div class="">
                                <label class="bold">Bookmaker</label>
                            </div>
                            <select name="bookinputdashboard" class="bookinputdashboard form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-md-4 bookmaker-line">
                            <div class="">
                                <label class="bold">Compte</label>
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
                    <div class="col-md-4">
                        <div class="">
                            <label>n° série ou nom</label>
                        </div>
                        <select name="serieinputdashboard" id="serieinputdashboard" class="form-control input-sm">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="">
                            <label>lettre:</label>
                        </div>
                        <select id="letterinputdashboard" name="letterinputdashboard" class="form-control input-sm">
                        </select>
                    </div>
                </div>


                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div class="portlet-body form">
    <!-- BEGIN FORM-->

</div>
