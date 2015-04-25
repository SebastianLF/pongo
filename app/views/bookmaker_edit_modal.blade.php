<div id="bookmakerEditModal" class="modal fade" tabindex="-1" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modification Compte Bookmaker</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => 'bookmaker.update', 'method' => 'put', 'id' => 'bookmakerform-edit', 'role' =>
                'form')) }}

                <input type="hidden" id="idBookmakerEditInput" name="idBookmakerEditInput"/>
                <input type="hidden" id="idAccountEditInput" name="idAccountEditInput">
                <div id="nameAccountEditContainer" class="form-group has-feedback">
                    <label for="nameAccountEditInput">n° ou nom compte</label>
                    <input type="text" class="form-control" id="nameAccountEditInput" name="nameAccountEditInput" placeholder="n° ou nom compte">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="modal" data-target="#bookmakerEditModal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Mettre à jour</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>