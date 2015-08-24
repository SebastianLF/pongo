<div id="cashoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title uppercase">cash out</h4>
            </div>
            {{ Form::open(array('url' => 'cashout', 'method' => 'post', 'id' => 'cashout-update', 'role' => 'form')) }}
            <div class="modal-body">
                <input name="pari-id" type="text" readonly class="hide" />
                <div class="row">
                    <div class="note note-success note-automatic-bet">
                        <p>
                            <strong>cash out classique:</strong> retrait du montant misé (très souvent inférieur a la mise de départ donc déficit), le ticket est alors cloturé dans l'historique avec le status 'cash out'. Entrez le montant retiré.<br/>
                            <strong>cash out partiel:</strong> réajustement de la mise de départ, le ticket reste actif. Entrez la nouvelle mise.
                        </p>
                    </div>
                <div class="form-group col-md-5 col-md-offset-3">
                    <label for="classic-cash-out">Type de cash out:</label>
                    <small class="text-danger" id=""></small>
                    <select id="cashout-select" name="cashout-select" class="form-control"></select>
                </div>
                <div class="form-group classic-cash-out-group col-md-5 col-md-offset-3">
                    <label for="classic-cash-out">Montant:</label>
                    <small class="text-danger" id=""></small>
                    <input type="text" class="form-control" id="classic-cash-out" name="classic-cash-out" placeholder="Exemple: 25.50">
                </div>
                <div class="form-group hide partial-cash-out-group col-md-5 col-md-offset-3">
                    <label for="partial-cash-out">Nouvelle mise:</label>
                    <small class="text-danger" id=""></small>
                    <input type="text" class="form-control" id="partial-cash-out" name="partial-cash-out" placeholder="Exemple: 25.50">
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#cashoutModal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Enregistrer</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>