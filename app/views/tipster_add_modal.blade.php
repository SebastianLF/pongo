<div id="tipsterAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ajout d'un nouveau tipster</h4>
            </div>
            {{ Form::open(array('route' => 'tipster.store', 'method' => 'post', 'id' => 'tipsterform-add', 'role' =>
                'form')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
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
                            <label class="control-label" for="amount_tipster">Montant par unité (en {{Auth::user()->devise}})</label>
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