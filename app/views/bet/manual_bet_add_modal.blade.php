<div id="manualBetAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ajout une sélection</h4>
            </div>
            {{ Form::open(array('url' => 'coupon', 'method' => 'post', 'id' => 'manualselectionform-add', 'role' =>
                'form')) }}
            <div class="modal-body">
                <div class="note note-success ">
                    <p>Les informations a remplir dépendent du sport, renseignez le champ sport avant le reste.</p>
                </div>
                <div class="row">

                    <div class="col-md-6 col-md-offset-3">

                        <div id="date_container" class="form-group">
                            <label for="date">Date</label>
                            <input name="date"
                                   class="form-control input-sm"
                                   type="date" placeholder="date rencontre">
                            <span id="date_error" class="help-block"></span>
                        </div>

                        <div id="sport_container" class="form-group">
                            <label for="sport">Sport</label>
                            <select name="sport" class="form-control sportinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="sport_error" class="help-block"></span>
                        </div>

                        <div id="competition_container" class="form-group">
                            <label for="competition">Competition</label>
                            <select name="competition" class="form-control competitioninputdashboard ">
                                <option value=""></option>
                            </select>
                            <span id="competition_error" class="help-block"></span>
                        </div>

                        <div id="market_container" class="form-group">
                            <label for="market">Type pari</label>
                            <select name="market" class="form-control marketinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="market_error" class="help-block"></span>
                        </div>

                        <div id="scope_container" class="form-group">
                            <label for="scope">Portée</label>
                            <select name="scope" class="form-control scopeinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="scope_error" class="help-block"></span>
                        </div>

                        <div id="team1_container" class="form-group col-md-6">
                            <label for="team1">Domicile</label>
                            <select name="team1" class="form-control team1inputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="team1_error" class="help-block"></span>
                        </div>

                        <div id="team2_container" class="form-group col-md-6">
                            <label for="team2">Extérieur</label>
                            <select name="team2" class="form-control team2inputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="team2_error" class="help-block"></span>
                        </div>

                        <div id="pick_container" class="form-group">
                            <label for="pick">Choix pari</label>
                            <select name="pick" class="form-control pickinputdashboard input-sm">
                            </select>
                            <span id="pick_error" class="help-block"></span>
                        </div>

                        <div id="odd_doubleParam_container" class="form-group">
                            <label for="odd_doubleParam"></label>
                            <select name="odd_doubleParam" class="form-control input-sm"></select>
                            <span id="odd_doubleParam_error" class="help-block"></span>
                        </div>

                        <div id="odd_doubleParam2_container" class="form-group">
                            <label for="odd_doubleParam2"></label>
                            <select name="odd_doubleParam2" class="form-control input-sm"></select>
                            <span id="odd_doubleParam2_error" class="help-block"></span>
                        </div>

                        <div id="odd_doubleParam3_container" class="form-group">
                            <label for="odd_doubleParam3"></label>
                            <select name="odd_doubleParam3" class="form-control input-sm"></select>
                            <span id="odd_doubleParam3_error" class="help-block"></span>
                        </div>

                        <div id="bookmaker_container" class="form-group">
                            <label for="bookmaker">Bookmaker</label>
                            <select name="bookmaker" class="form-control input-sm"></select>
                            <span id="bookmaker_error" class="help-block"></span>
                        </div>

                        <div id="odd_container" class="form-group">
                            <label for="odd_value">Cote</label>
                            <input name="odd_value" class="form-control oddinputdashboard input-sm" placeholder="Cote">
                            <span id="odd_error" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <div class="checker" id="uniform-ticketABCD"><span><input type="checkbox" id="ticketABCD" value="ticketABCD"></span></div>Pari ABCD
                                </label>
                                <label class="checkbox-inline">
                                    <div class="checker" id="uniform-ticketGratuit"><span><input type="checkbox" id="ticketGratuit" value="ticketGratuit"></span></div>Pari gratuit
                                </label>
                                <label class="checkbox-inline">
                                    <div class="checker" id="uniform-ticketLongTerme"><span><input type="checkbox" id="ticketLongTerme" value="ticketLongTerme"></span></div>Pari long terme
                                </label>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Ajouter</button>
            </div>
            {{ Form::close()}}
        </div>
    </div>
</div>