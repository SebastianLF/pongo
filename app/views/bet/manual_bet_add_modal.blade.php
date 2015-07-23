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
                <div class="row">

                    <div class="col-md-6 col-md-offset-3">

                        <div id="date_container" class="form-group">
                            <input name="date"
                                   class="form-control input-sm"
                                   type="date" placeholder="date rencontre">
                            <span id="date_error" class="help-block"></span>
                        </div>

                        <div id="sport_container" class="form-group">
                            <select name="sport" class="form-control sportinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="sport_error" class="help-block"></span>
                        </div>

                        <div id="competition_container" class="form-group">
                            <select name="competition" class="form-control competitioninputdashboard ">
                                <option value=""></option>
                            </select>
                            <span id="competition_error" class="help-block"></span>
                        </div>

                        <div id="market_container" class="form-group">
                            <select name="market" class="form-control marketinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="market_error" class="help-block"></span>
                        </div>

                        <div id="scope_container" class="form-group">
                            <select name="scope" class="form-control scopeinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="scope_error" class="help-block"></span>
                        </div>

                        <div id="pick_container" class="form-group">
                            <select name="pick" class="form-control pickinputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="pick_error" class="help-block"></span>
                        </div>

                        <div id="team1_container" class="form-group">
                            <select name="team1" class="form-control team1inputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="team1_error" class="help-block"></span>
                        </div>

                        <div id="team2_container" class="form-group">
                            <select name="team2" class="form-control team2inputdashboard input-sm">
                                <option value=""></option>
                            </select>
                            <span id="team2_error" class="help-block"></span>
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