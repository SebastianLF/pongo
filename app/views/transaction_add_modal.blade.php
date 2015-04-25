<div id="transactionAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            {{ Form::open(array('route' => 'transaction.store', 'method' => 'post', 'id' => 'transactionform-add', 'class' => '', 'role' => 'form')) }}
            <div class="modal-header">
                <h4 class="modal-title">Creation Transaction</h4>
            </div>
            <div class="modal-body">
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