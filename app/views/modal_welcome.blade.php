<div class="modal fade" id="WelcomeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Bienvenue sur Pongo</h1>
            </div>
            {{ Form::open(array('url' => 'devise', 'method' => 'post', 'id' => 'form-devise', 'class' => '', 'role' => 'form')) }}
                <div class="modal-body">
                    <div class="note note-danger note-automatic-bet">
                        <p>
                            <strong>Attention!</strong> Il n'est pas possible de changer de devise plus tard (pour l'instant).
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="devise">Devise:</label>
                        <small class="text-danger">{{ $errors->first('devise') }}</small>
                        <select name="devise" id="devise" class="form-control">
                            @foreach($devisearray as $devise)
                                <option value="{{$devise->id}}">{{$devise->text}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <br/>
            <br/>
            <br/>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->