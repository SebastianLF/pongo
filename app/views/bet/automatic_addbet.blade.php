<div class="form-body " style="padding:5px;">
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <div class="form-group">
                <div class="">
                    <label class="">Suivi <span
                                class="glyphicon glyphicon-question-sign"
                                data-toggle="tooltip" data-placement="bottom"
                                title="Quand le type de suivi est à blanc, la mise et les gains/pertes ne seront pas déduits des bookmakers. C'est un type de suivi pour tester l'éfficacité d'un tipster avant de l'adopter."></span></label>
                </div>
                <select type="text" id="followtypeinputdashboard"
                        name="followtypeinputdashboard"
                        class="form-control input-sm"
                        readonly></select>
            </div>
        </div>
        <div class="col-md-4 hidden">
            <div class="form-group">
                <div class="">
                    <label class="">Montant par u. <span
                                class="glyphicon glyphicon-question-sign"
                                data-toggle="tooltip" data-placement="bottom"
                                title="Montant par unité spécifique au tipster selectionné. Pour le changer, veuillez vous rendre sur la page configuration"></span></label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">€</div>
                    <input type="text" id="amountperunit" name="amountperunit"
                           class="form-control input-sm"
                           readonly>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!--/row-->
    <div id="typestakecontainer" class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="">
                    <label class="">Mise <span class="glyphicon glyphicon-question-sign"
                                               data-toggle="tooltip"
                                               data-placement="bottom"
                                               title="En unités: miser en unités par rapport au montant par unité attribué pour ce tipter, type de mise à privilégier pour un gain de temps. En montant(devise): miser en montant devise lorsque vous ne souhaitez pas respecter le principe de mise en unité, cela vous donne plus de liberté."></span></label>
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
        <div class="col-md-6 typestakeunites">
            <div class="form-group">
                <div class="">
                    <label class="">Mise en U</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">U</div>

                    <input type="text" id="stakeunitinputdashboard"
                           name="stakeunitinputdashboard"
                           class="form-control input-sm">
                </div>
            </div>
        </div>
        <div class="col-md-5 typestakeunites hidden">
            <div class="form-group">
                <div class="">
                    <label class="">Conversion en {{Auth::user()->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{Auth::user()->devise}}</div>
                    <input type="text" id="amountconversion"
                           name="amountconversion"
                           class="form-control input-sm" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6 typestakeflat">
            <div class="form-group">
                <div class="">
                    <label class="">Mise en {{Auth::user()->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{Auth::user()->devise}}</div>
                    <input type="text" id="amountinputdashboard"
                           name="amountinputdashboard"
                           class="form-control input-sm">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="bookmakercontainer" class="row">

        <!--/span-->
        <div class="col-md-4 ">
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
    <hr>

    <!--/span-->
    <div id="optionscontainer" class="row">
        <div class="col-md-12">
            <div class="form-group">

                <label class="checkbox-inline">
                    <input type="checkbox" id="ticketABCD"
                           value="ticketABCD">Martingale ABCD
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="ticketLongTerme"
                           value="ticketLongTerme">Long terme
                </label>

            </div>
        </div>
        <div id="methodeabcdcontainer">
            <div class="col-md-4  col-md-offset-1">
                <div class="form-group">
                    <div class="">
                        <label class="">N° ou nom</label>
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
    <hr>
    <div id="submitboutoncontainer" class="row">
        <div class="text-center col-md-12">
            <button type="submit" class="btn btn-danger ladda-button" data-style="slide-down" data-size="l"><span
                        class="ladda-label">AJOUTER LE PARI</span></button>
        </div>
    </div>
</div>



