<div class="note note-success note-automatic-bet">
    <p>
        Pour <strong>vos paris perso</strong>, creez vous un tipster se nommant 'moi' ou 'Michel' par exemple.
    </p>
</div>
{{ Form::open(array('method' => 'post', 'id' => 'automaticform-add', 'class' => 'form-horizontal', 'role' => 'form')
            ) }}
<div class="row">
    <div class="col-md-7">
        <div class="portlet box green-meadow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Les selections choisies pour ce ticket
                </div>
                <div class="actions">

                    <a id="selection-refresh" class="bold uppercase" href=""><span class="glyphicon glyphicon-refresh"></span>Rafraichir</a> | <span
                            class="pull-right glyphicon glyphicon-refresh glyphicon-spin"></span>
                </div>
            </div>
            <div class="portlet-body form form-automatic">
                <div id="automatic-selections">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box green-meadow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Informations générales du ticket
                </div>


            </div>

            <div class="portlet-body form form-automatic">
                <div class="form-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-3">Tipster</label>

                                <div class="col-md-9">
                                    <select id="tipstersinputdashboard" name="tipstersinputdashboard"
                                            class="form-control input-sm">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-3">Suivi</label>

                                <div class="col-md-9">
                                    <input type="text" id="followtypeinputdashboard" name="followtypeinputdashboard"
                                           class="form-control input-sm" placeholder="Selectionnez un tipster !"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-5">Montant par unité</label>

                                <div class="col-md-6 input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" id="amountperunit" name="amountperunit"
                                           class="form-control input-sm"
                                           placeholder="Selectionnez un tipster !" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mise</label>

                                <div class="col-md-9">
                                    <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                                            class="form-control input-sm">
                                        <option value="u">en unités</option>
                                        <option value="f">manuel</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4 typestakeunites">
                            <div class="form-group">
                                <label class="control-label col-md-5">Mise en unités</label>

                                <div class="col-md-7 input-group">
                                    <div class="input-group-addon">u</div>

                                    <input type="text" id="stakeunitinputdashboard" name="stakeunitinputdashboard"
                                           class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 typestakeunites">
                            <div class="form-group">
                                <label class="control-label col-md-5">Conversion en {{$user->devise}}</label>

                                <div class="col-md-6 input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" id="amountconversion" name="amountconversion"
                                           class="form-control input-sm" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 typestakeflat">
                            <div class="form-group">
                                <label class="control-label col-md-5">Mise en {{$user->devise}}</label>

                                <div class="col-md-7 input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" id="amountinputdashboard" name="amountinputdashboard"
                                           class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 typestakeflat">
                            <div class="form-group">
                                <label class="control-label col-md-5">Conversion en unités</label>

                                <div class="col-md-6 input-group">
                                    <div class="input-group-addon">u</div>
                                    <input type="text" id="flattounitconversion" name="flattounitconversion"
                                           class="form-control input-sm" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row bookmakerrow ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-3">Bookmaker</label>

                                <div class="col-md-9">
                                    <select id="bookinputdashboard" name="bookinputdashboard"
                                            class="form-control input-sm">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-6">Compte de bookmaker</label>

                                <div class="col-md-6">
                                    <select id="accountsinputdashboard" name="accountsinputdashboard"
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
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="ticketABCD" value="ticketABCD">Pari ABCD
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="ticketGratuit" value="ticketGratuit">Pari gratuit
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="methodeabcdcontainer">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-md-5">n° série ou nom</label>

                                    <div class="col-md-7">
                                        <select name="serieinputdashboard" id="serieinputdashboard"
                                                class="form-control input-sm">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-md-3">lettre</label>

                                    <div class="col-md-8">
                                        <select id="letterinputdashboard" name="letterinputdashboard"
                                                class="form-control input-sm">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-actions form-actions-automatic-bet">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-9">
                                <button type="submit" class="btn green-meadow"><i class="fa fa-plus"></i> VALIDER LE
                                    TICKET
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!-- END Portlet PORTLET-->
    </div>

</div>

<div class="portlet-body form form-automatic">

</div>
{{ Form::close() }}