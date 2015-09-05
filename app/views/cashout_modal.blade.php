<div id="cashoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title uppercase">cash out</h4>
            </div>
            {{ Form::open(array('url' => 'cashout', 'method' => 'post', 'id' => 'cashout-update', 'role' => 'form')) }}
            <div class="modal-body">
                <input name="ticket-id" type="text" readonly class="hide" />
                <div class="row">
                    <div class="col-md-12">
                    <div class="note note-success note-automatic-bet">
                        <p>Lien pour avoir plus d'infos sur le cash out: <a href="http://www.bet365.com.au/extra/en/site-features/cash-out/">http://www.bet365.com.au/extra/en/site-features/cash-out/</a><br><br/>
                            En résumé, il y a deux types de Cash Out: <br/>
                            1 - Cash Out (classique): Le ticket est cloturé avec comme montant retourné la valeur du montant du cash out.<br/>
                            2 - Partial Cash Out : Réajustement de la mise de départ, le ticket reste actif. Le montant retiré sera soustrait à la mise de départ et une transaction (de type partial cash out) sera crée avec comme montant de dépot le montant retiré. Bet365 limite à 10 le nombre de partial cash out pour un seul ticket, la 10eme fois le ticket est cloturé comme un cash out classique. Choisissez donc cash out classique à la 10eme fois.
                        </p>
                    </div>
                    </div>
                <div class="form-group col-md-5 col-md-offset-3">
                    <label for="classic-cash-out">Type de cash out:</label>
                    <small class="text-danger" id=""></small>
                    <select id="cashout-select" name="cashout-select" class="form-control"></select>
                </div>
                <div class="form-group classic-amount-group col-md-5 col-md-offset-3">
                    <label for="classic-cash-out">Montant retiré:</label>
                    <small class="text-danger" id=""></small>
                    <input type="text" class="form-control" id="amount-cash-out" name="amount-cash-out" placeholder="Exemple: 25.50">
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