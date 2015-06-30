<div id="tipsterEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modification Tipster</h4>
            </div>
            {{ Form::open(array('route' => 'tipster.update', 'method' => 'post', 'id' => 'tipsterform-edit', 'role' =>
                'form')) }}
            <div class="modal-body">
                <input type="hidden" id="idTipsterEditInput" name="idTipsterEditInput">
                <div class="form-group">
                    <label for="nameTipsterEditInput">Nom</label>
                    <small class="text-danger" id="nameTipsterEditSmall"></small>
                    <input type="text" class="form-control" id="nameTipsterEditInput" name="nameTipsterEditInput" placeholder="Nom">
                </div>
                <div class="form-group">
                    <label for="suiviTipsterEditSelect">Type de suivi</label>
                    <small class="text-danger" id="suiviTipsterEditSmall"></small>
                    <select name="suiviTipsterEditSelect" id="suiviTipsterEditSelect" class="form-control">
                        <option value="n">normal</option>
                        <option value="b">à blanc</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="indiceTipsterEditSelect">Indice maximum</label>
                    <small class="text-danger" id="indiceTipsterEditSmall"></small>
                    <select name="indiceTipsterEditSelect" id="indiceTipsterEditSelect" class="form-control">
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mtTipsterEditInput">Montant par indice</label>
                    <small class="text-danger" id="mtTipsterEditSmall"></small>
                    <input type="text" class="form-control" id="mtTipsterEditInput" name="mtTipsterEditInput" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#tipsterEditModal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Mettre à jour</button>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>