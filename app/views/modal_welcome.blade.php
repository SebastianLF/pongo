<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Bienvenue sur Cockpit</h1>
            </div>
            {{ Form::open(array('url' => 'devise', 'method' => 'post', 'id' => 'form-devise', 'class' => '', 'role' => 'form')) }}
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert"><strong>Attention!</strong> Il est obligatoire de sélectionner la devise que vous allez utiliser.</div>
                    <small class="text-danger">{{ $errors->first('devise') }}</small>
                    <div class="form-group">
                        <label for="devise_select_input">Devise:</label>
                        <select name="devise_select_input" id="devise_select_input" class="form-control">
                            @foreach($devisearray as $devise)
                                <option value="{{$devise->id}}">{{$devise->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->