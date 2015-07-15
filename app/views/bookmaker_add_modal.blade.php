<div id="bookmakerAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nouveau compte de bookmaker</h4>
            </div>
            {{ Form::open(array('route' => 'bookmaker.store', 'method' => 'post', 'id' =>
                'bookmakerform-add', 'class' => '', 'role' => 'form')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div id="bookmaker_container" class="form-group">
                            <label class="control-label" for="name_bookmaker">Bookmaker</label>

                            <select name="name_bookmaker" class="form-control">
                                <option value=""></option>
                                @foreach($allbookmakers as $one)
                                    <option value="{{$one->id}}">{{$one->nom}}</option>
                                @endforeach
                            </select>
                            <span id="bookmaker_error" class="help-block"></span>
                        </div>

                        <div id="account_container" class="form-group">
                            <label class="control-label" for="name_account">N° ou nom de compte</label>
                            <input name="name_account" type="text"
                                   class="form-control">
                            <span id="account_error" class="help-block"></span>
                        </div>

                        <div id="amount_container" class="form-group">
                            <label class="control-label" for="amount_bookmaker">Montant actuel (en {{$user->devise}})</label>
                            <input name="amount_bookmaker" type="text"
                                   class="form-control">
                            <span id="amount_error" class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#bookmakerAddModal" class="btn btn-default">
                    Annuler
                </button>
                <button type="submit" class="btn green">Ajouter</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>