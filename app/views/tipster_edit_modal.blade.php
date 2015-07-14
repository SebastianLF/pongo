<div id="tipsterEditModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modification du Tipster</h4>
            </div>
            {{ Form::open(array('route' => 'tipster.update', 'method' => 'post', 'id' => 'tipsterform-edit', 'role' =>
                'form')) }}
            <div class="modal-body">
                <input type="hidden" name="id">

                <div id="name_container" class="form-group">
                    <label class="control-label" for="name_tipster">Nom</label>

                    <input name="name_tipster" type="text" class="form-control">
                    <span id="name_error" class="help-block"></span>
                </div>

                <div id="suivi_container" class="form-group">
                    <label class="control-label" for="suivi_tipster">Type de suivi </label>

                    <select id="suivi_tipster" name="suivi_tipster" class="form-control">
                        <option value="n" selected="selected">normal</option>
                        <option value="b">à blanc</option>
                    </select>
                    <span id="suivi_error" class="help-block"></span>
                </div>

                <div id="amount_container" class="form-group">
                    <label class="control-label" for="amount_tipster">Montant par unité (en {{$user->devise}})</label>
                    <input id="amount_tipster" name="amount_tipster" type="text"
                           class="form-control">
                    <span id="amount_error" class="help-block"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#tipsterEditModal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Modifier</button>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>