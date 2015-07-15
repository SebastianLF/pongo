<div id="bookmakerEditModal" class="modal fade" tabindex="-1" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modification Compte Bookmaker</h4>
            </div>
            {{ Form::open(array('route' => 'bookmaker.update', 'method' => 'put', 'id' => 'bookmakerform-edit', 'role' =>
               'form')) }}
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="idBookmakerEditInput" name="idBookmakerEditInput"/>
                    <input type="hidden" id="idAccountEditInput" name="idAccountEditInput">
                    <div class="col-md-6 col-md-offset-3">
                        <div id="account_container" class="form-group">
                            <label class="control-label" for="name_account">N° ou nom de compte</label>
                            <input name="name_account" type="text"
                                   class="form-control">
                            <span id="account_error" class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#bookmakerEditModal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Modifier</button>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>