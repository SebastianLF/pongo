@include('bet/manual_bet_add_modal')
{{ Form::open(array('method' => 'post', 'id' => 'automaticform-add', 'class' => 'form-horizontal', 'role' => 'form')
            ) }}


    <div class="portlet green-haze">

        <div class="portlet-body form ">
            <form action="javascript:;" class="form-horizontal">
                <div class="form-body">
                    <div class="row " style="padding:10px;">
                        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet light">

                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Panier des sélections | <span class="glyphicon glyphicon-refresh glyphicon-spin"></span><a id="selection-refresh" class="" href="">Rafraichir</a>

                                    </div>
                                    <div class="actions">
                                    </div>
                                </div>

                                <div class="portlet-body form form-automatic">

                                    <div id="automatic-selections">

                                    </div>
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#manualBetAddModal"><span
                                                class="glyphicon glyphicon-plus"></span> ajouter une sélection manuellement
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet light ">
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
                                                        <label class="">Tipster</label>
                                                    </div>
                                                    <select id="tipstersinputdashboard"
                                                            name="tipstersinputdashboard"
                                                            class="form-control input-sm">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-md-offset-1">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Suivi</label>
                                                    </div>
                                                    <input type="text" id="followtypeinputdashboard"
                                                           name="followtypeinputdashboard"
                                                           class="form-control input-sm"
                                                           placeholder="Selectionnez un tipster !"
                                                           readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-md-offset-1">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Montant par unité</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">€</div>
                                                        <input type="text" id="amountperunit" name="amountperunit"
                                                               class="form-control input-sm"
                                                               placeholder="Selectionnez un tipster !" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Mise</label>
                                                    </div>
                                                    <div class="">
                                                        <select name="typestakeinputdashboard"
                                                                id="typestakeinputdashboard"
                                                                class="form-control input-sm">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3 col-md-offset-1 typestakeunites">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Mise en unités</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">u</div>

                                                        <input type="text" id="stakeunitinputdashboard"
                                                               name="stakeunitinputdashboard"
                                                               class="form-control input-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-md-offset-1 typestakeunites">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Conversion en {{$user->devise}}</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">€</div>
                                                        <input type="text" id="amountconversion"
                                                               name="amountconversion"
                                                               class="form-control input-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-md-offset-1 typestakeflat">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Mise en {{$user->devise}}</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">€</div>
                                                        <input type="text" id="amountinputdashboard"
                                                               name="amountinputdashboard"
                                                               class="form-control input-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-md-offset-1 typestakeflat">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Conversion en unités</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">u</div>
                                                        <input type="text" id="flattounitconversion"
                                                               name="flattounitconversion"
                                                               class="form-control input-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bookmakerrow ">
                                            <div class="col-md-4 bookmakercontainer hide">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Bookmaker</label>
                                                    </div>
                                                    <div class="">
                                                        <select name="bookinputdashboard"
                                                                class="form-control bookinputdashboard input-sm">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="">
                                                        <label class="">Compte</label>
                                                    </div>
                                                    <div class="">
                                                        <select id="accountsinputdashboard"
                                                                name="accountsinputdashboard"
                                                                class="form-control input-sm">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" id="ticketABCD"
                                                                   value="ticketABCD">Pari ABCD
                                                        </label>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" id="ticketGratuit"
                                                                   value="ticketGratuit">Pari gratuit
                                                        </label>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" id="ticketLongTerme"
                                                                   value="ticketLongTerme">Pari long terme
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="methodeabcdcontainer ">
                                                <div class="col-md-4  col-md-offset-1">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="">N° série ou nom</label>
                                                        </div>
                                                        <div class="">
                                                            <select name="serieinputdashboard"
                                                                    id="serieinputdashboard"
                                                                    class="form-control input-sm">
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-md-offset-1">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="">Lettre</label>
                                                        </div>
                                                        <div class="">
                                                            <select id="letterinputdashboard"
                                                                    name="letterinputdashboard"
                                                                    class="form-control input-sm">
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions form-actions-automatic-bet">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-offset-5 ">
                                <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> VALIDER LE
                                    TICKET
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



<div class="portlet-body form form-automatic">

</div>
{{ Form::close() }}