<div id="transactionAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            {{ Form::open(array('route' => 'transaction.store', 'method' => 'post', 'id' => 'transactionform-add', 'class' => '', 'role' => 'form')) }}
            <div class="modal-header">
                <h4 class="modal-title">Creation d'une transaction</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div id="type_container" class="form-group">
                            <label class="control-label" for="type">Type</label>
                            <select name="type" class="form-control">
                                <option value="" selected="selected"></option>
                                <option value="d">depot</option>
                                <option value="r">retrait</option>
                                <option value="b">bonus</option>
                            </select>
                            <span id="type_error" class="help-block"></span>
                        </div>

                        <div id="book_container" class="form-group">
                            <label class="control-label" for="book">Bookmaker</label>

                            <select name="book" class="form-control">
                                <option value="" selected="selected"></option>
                            </select>

                            <span id="book_error" class="help-block"></span>
                        </div>

                        <div id="account_container" class="form-group">
                            <label class="control-label" for="account">Compte de bookmaker</label>
                            <select name="account" class="form-control">
                                <option value="" selected="selected"></option>
                            </select>
                            <span id="account_error" class="help-block"></span>
                        </div>

                        <div id="amount_container" class="form-group">
                            <label class="control-label" for="amount">Montant (en {{Auth::user()->devise}})</label>
                            <input name="amount" type="text"
                                   class="form-control">
                            <span id="amount_error" class="help-block"></span>
                        </div>

                        <div id="description_container" class="form-group">
                            <label class="control-label" for="description">Description (facultatif)</label>
                            <input name="description" type="text"
                                   class="form-control">
                            <span id="description_error" class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green ladda-button">Ajouter</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>