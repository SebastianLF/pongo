<div id="bookmakerAddModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nouveau compte de bookmaker</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => 'bookmaker.store', 'method' => 'post', 'id' =>
                'bookmakerform-add', 'class' => '', 'role' => 'form')) }}


                            <div id="bookmakerListOnBookmakerContainer" class="form-group has-feedback">
                                <label for="booknameselect">bookmaker</label>
                                <small class="text-danger"></small>
                                <select id="booknameselect" name="booknameselect" class="form-control">
                                    @foreach($allbookmakers as $one)
                                    <option value="{{$one->id}}">{{$one->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="accountNameBookmakerContainer" class="form-group has-feedback">
                                <label for="accountnameinput" class="control-label">n° ou nom compte :</label>
                                <input id="accountnameinput" type="text" name="accountnameinput" class="form-control" >
                            </div>
                            <div id="bankrollAmountBookmakerContainer">
                                <label for="bankrollamountinput" class="control-label">solde actuel:</label>
                                <input id="bankrollamountinput" name="bankrollamountinput" class="form-control" placeholder="0.00" >
                            </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#bookmakerAddModal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Mettre à jour</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>