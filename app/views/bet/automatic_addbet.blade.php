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
                                    <i class="glyphicon glyphicon-lock"></i>Panier des sélections | <span
                                            class="glyphicon glyphicon-refresh glyphicon-spin"></span><a
                                            id="selection-refresh" class="" href="">Rafraichir</a>

                                </div>
                                <div class="actions">
                                </div>
                            </div>

                            <div class="portlet-body form form-automatic">

                                <div id="automatic-selections">

                                </div>
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#manualBetAddModal"><span
                                            class="glyphicon glyphicon-plus"></span> ajouter une sélection manuellement
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="glyphicon glyphicon-cog"></i>Informations générales du ticket
                                </div>
                            </div>

                            <div class="portlet-body form form-automatic">
                                <div class="form-body" style="padding:5px;">
                                    <div class="row">
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
                                        <div class="col-md-4 col-md-offset-1">
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
                                    <!--/row-->
                                    <div id="typestakecontainer" class="row">
                                        <div class="col-md-3">
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
                                                    <label class="">Conversion en {{Auth::user()->devise}}</label>
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
                                                    <label class="">Mise en {{Auth::user()->devise}}</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">€</div>
                                                    <input type="text" id="amountinputdashboard"
                                                           name="amountinputdashboard"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bookmakercontainer" class="row">

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

                                    <!--/span-->
                                    <div id="optionscontainer" class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="ticketABCD"
                                                               value="ticketABCD">Pari ABCD
                                                    </label>
                                                   <!-- <label class="checkbox-inline">
                                                        <input type="checkbox" id="ticketGratuit"
                                                               value="ticketGratuit">Pari gratuit <span
                                                                class="glyphicon glyphicon-question-sign"
                                                                data-toggle="tooltip"
                                                                title="Pari Gratuit: à cocher uniquement lorsque le bookmaker"></span>
                                                    </label> -->
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="ticketLongTerme"
                                                               value="ticketLongTerme">Pari long terme
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="methodeabcdcontainer">
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light">

                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="glyphicon glyphicon-globe"></i>Recherche automatique

                                </div>
                                <div class="actions">
                                </div>
                            </div>

                            <div class="portlet-body form form-automatic">

                                @if(App::environment('local'))
                                    <iframe src={{"http://stage.betbrain.com/?portalId=1312&userSessionId=".Session::getId()}} height="600"
                                            width="100%" frameborder="0">Odds service provided in co-operation with
                                        <a href="http://www.betbrain.com" target="_blank"><b>BetBrain.com</b></a>
                                    </iframe>
                                @else
                                    <iframe src={{"http://betbrain.com/?portalId=1326&userSessionId=".Session::getId()}} height="1090"
                                            width="100%" frameborder="0">Odds service provided in
                                        co-operation with <a href="http://www.betbrain.com" target="_blank"><b>BetBrain.com</b></a>
                                    </iframe>
                                @endif
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