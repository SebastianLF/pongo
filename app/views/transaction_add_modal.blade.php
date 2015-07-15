<div id="transactionAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            {{ Form::open(array('route' => 'transaction.store', 'method' => 'post', 'id' => 'transactionform-add', 'class' => '', 'role' => 'form')) }}
            <div class="modal-header">
                <h4 class="modal-title">Creation Transaction</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div id="type_container" class="form-group">
                            <label class="control-label" for="type_name">Type</label>
                            <select name="type_name" class="form-control">
                                <option value="" selected="selected"></option>
                                <option value="d">depot</option>
                                <option value="r">retrait</option>
                                <option value="b">bonus</option>
                                <option value="tp">ticket perdu</option>
                                <option value="tg">ticket gagné</option>
                            </select>
                            <span id="type_error" class="help-block"></span>
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
                </div>


                <div id="typeTransContainer" class="hidden form-group has-feedback">
                    <label for="typetransinput">type:</label>
                    <input id="typetransinput" name="typetransinput" class="form-control">
                </div>

                <div id="booknameTransContainer" class=" form-group has-feedback">
                    <label for="booknametransselect">bookmaker:</label>
                    <select id="booknametransselect" name="booknametransselect" class="form-control">
                        <option value="" selected="selected"></option>
                    </select>
                </div>

                <div id="accountnameTransContainer" class=" form-group has-feedback">
                    <label for="accountnametransselect">account:</label>
                    <select id="accountnametransselect" name="accountnametransselect" class="form-control">
                    </select>
                </div>

                <div id="amountTransactionContainer" class=" form-group has-feedback">
                    <label for="amounttransinput" class="">montant</label>
                    <input type="text" id="amounttransinput" name="amounttransinput" class="form-control"
                           placeholder="0.00">
                </div>

                <div id="describeTransContainer" class=" form-group has-feedback">
                    <label for="describetranstext">description:</label>

                    {{ Form::text('describetranstext', Input::old('describetranstext') , array('id' =>
                    'describetranstext', 'class' => 'form-control')) }}

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#transactionAddModal" class="btn btn-primary">Annuler</button>
                <input id="transactionformsubmit" value="Ajouter" type="submit" class="btn btn-success">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>