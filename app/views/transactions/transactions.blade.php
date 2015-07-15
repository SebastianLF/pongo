@include('transaction_add_modal')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="fa fa-cogs font-yellow-crusta"></i>
                        <span class="caption-subject  font-yellow-crusta bold uppercase">Transactions</span>
                        <span class="caption-helper">Configuration</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="note note-warning">
                        <p>
                            Vous pouvez utilisez les transactions pour reporter les gains ou pertes d'un pari que
                            vous n'avez pas la possibilité d'ajouter sur dopedrop.
                        </p>
                    </div>
                    <button id="transactionAddButton" type="button" class="btn yellow-crusta" data-toggle="modal"
                            data-target="#transactionAddModal">Ajouter une transaction <span class="glyphicon glyphicon-transfer"></span>
                    </button>
                    <div class="row">
                        <div id="transactions-pagination" class="col-md-8 col-md-offset-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
