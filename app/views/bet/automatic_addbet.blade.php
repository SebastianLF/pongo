<div class="note note-success note-automatic-bet">
    <p>
        Pour <strong>vos paris perso</strong>, creez vous un tipster se nommant 'moi' ou 'Michel' par exemple.
    </p>
</div>
{{ Form::open(array('method' => 'post', 'id' => 'automaticform-add', 'class' => 'form-horizontal', 'role' => 'form')
            ) }}

<div class="row">
    <div class="col-md-12">
        <div class="portlet box green-meadow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Ticket
                </div>
            </div>
            <div class="portlet-body form">
                <form action="javascript:;" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-5">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Les selections choisies pour ce ticket
                                        </div>
                                        <div class="actions">

                                            <a id="selection-refresh" class="bold uppercase" href=""><span
                                                        class="glyphicon glyphicon-refresh"></span>Rafraichir</a>
                                            | <span
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
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Informations générales du ticket
                                        </div>
                                    </div>

                                    <div class="portlet-body form form-automatic">
                                        <div class="form-body">
                                            <div class="">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="bold">Tipster</label>
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
                                                            <label class="bold">Suivi</label>
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
                                                            <label class="bold">Montant par unité</label>
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
                                                            <label class="bold">Mise</label>
                                                        </div>
                                                        <div class="">
                                                            <select name="typestakeinputdashboard"
                                                                    id="typestakeinputdashboard"
                                                                    class="form-control input-sm">
                                                                <option value="u">en unités</option>
                                                                <option value="f">manuel</option>
                                                            </select>
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

                                                            <input type="text" id="stakeunitinputdashboard"
                                                                   name="stakeunitinputdashboard"
                                                                   class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-md-offset-1 typestakeunites">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="bold">Conversion en {{$user->devise}}</label>
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
                                                            <label class="bold">Mise en {{$user->devise}}</label>
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
                                                            <label class="bold">Conversion en unités</label>
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="bold">Bookmaker</label>
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
                                                            <label class="bold">Compte de bookmaker</label>
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
                                                <div class="col-md-8">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <div class="">
                                                <div class="methodeabcdcontainer ">
                                                    <div class="col-md-5  col-md-offset-1">
                                                        <div class="form-group">
                                                            <div class="">
                                                                <label class="bold">N° série ou nom</label>
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
                                                                <label class="bold">Lettre</label>
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
                                    <button type="submit" class="btn green-meadow"><i class="fa fa-plus"></i> VALIDER LE
                                        TICKET
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<div class="portlet-body form form-automatic">

</div>
{{ Form::close() }}