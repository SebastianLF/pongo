<div id="manualBetAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ajout une sélection</h4>
            </div>
            {{ Form::open(array('route' => 'tipster.store', 'method' => 'post', 'id' => 'tipsterform-add', 'role' =>
                'form')) }}
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 col-md-offset-3">

                        <div id="date_container" class="form-group">
                            <input name="date"
                                   class="form-control input-sm"
                                   type="date" placeholder="date rencontre ou evenement">
                            <span id="date_error" class="help-block"></span>
                        </div>

                        <div id="sport_container" class="form-group">
                            <select name="sport" class="form-control sportinputdashboard">
                                <option value="">azeaze</option>
                            </select>
                            <span id="sport_error" class="help-block"></span>
                        </div>

                        <div id="competition_container" class="form-group">
                            <select name="competition" class="form-control competitioninputdashboard">
                                <option value=""></option>
                            </select>
                            <span id="competition_error" class="help-block"></span>
                        </div>

                        <div id="market_container" class="form-group">
                            <select name="market" class="form-control marketinputdashboard">
                                <option value=""></option>
                            </select>
                            <span id="market_error" class="help-block"></span>
                        </div>

                        <div id="scope_container" class="form-group">
                            <select name="scope" class="form-control scopeinputdashboard">
                                <option value=""></option>
                            </select>
                            <span id="scope_error" class="help-block"></span>
                        </div>

                        <div id="scope_container" class="form-group">
                            <select name="scope" class="form-control scopeinputdashboard">
                                <option value=""></option>
                            </select>
                            <span id="scope_error" class="help-block"></span>
                        </div>

                        <div id="amount_container" class="form-group">
                            <label class="control-label" for="amount_tipster">Montant par unité (en {{$user->devise}})</label>
                            <input id="amount_tipster" name="amount_tipster" type="text"
                                   class="form-control">
                            <span id="amount_error" class="help-block"></span>
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