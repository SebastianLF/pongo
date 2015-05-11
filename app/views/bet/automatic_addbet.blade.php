<div class="note note-success note-automatic-bet">
    <p>
        Pour <strong>vos paris perso</strong>, creez vous un tipster se nommant 'moi' ou 'Michel' par exemple.
    </p>
</div>
<div class="portlet-body form form-automatic">
    {{ Form::open(array('method' => 'post', 'id' => 'automaticform-add', 'class' => 'form-horizontal', 'role' => 'form')
            ) }}
        <div class="form-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-md-3">Tipster</label>

                        <div class="col-md-9">
                            <select id="tipstersinputdashboard" name="tipstersinputdashboard"
                                    class="form-control input-sm" tabindex="-1" style="display: none;">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-md-3">Suivi</label>

                        <div class="col-md-9">
                            <input type="text" id="followtypeinputdashboard" name="followtypeinputdashboard"
                                   class="form-control input-sm" placeholder="affichage du suivi" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-md-5">Montant par unité</label>

                        <div class="col-md-6">
                            <input type="text" id="amountperunit" name="amountperunit" class="form-control input-sm"
                                   placeholder="affichage du montant par unité" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-md-3">Mise</label>

                        <div class="col-md-9">
                            <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                                    class="form-control input-sm">
                                <option value="u">en unités</option>
                                <option value="f">manuel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-4 typestakeunites">
                    <div class="form-group">
                        <label class="control-label col-md-5">Mise en unités</label>

                        <div class="col-md-7">
                            <input type="text" id="stakeunitinputdashboard" name="stakeunitinputdashboard"
                                   class="form-control input-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 typestakeunites">
                    <div class="form-group">
                        <label class="control-label col-md-5">Conversion en {{$user->devise}}</label>

                        <div class="col-md-6">
                            <input type="text" id="amountconversion" name="amountconversion"
                                   class="form-control input-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 typestakeflat">
                    <div class="form-group">
                        <label class="control-label col-md-5">Mise en {{$user->devise}}</label>

                        <div class="col-md-7">
                            <input type="text" id="amountinputdashboard" name="amountinputdashboard"
                                   class="form-control input-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 typestakeflat">
                    <div class="form-group">
                        <label class="control-label col-md-5">Conversion en unités</label>

                        <div class="col-md-6">
                            <input type="text" id="flattounitconversion" name="flattounitconversion"
                                   class="form-control input-sm" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-md-3">Bookmaker</label>

                        <div class="col-md-9">
                            <select id="bookinputdashboard" name="bookinputdashboard"
                                    class="form-control input-sm">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label col-md-6">Compte de bookmaker</label>

                        <div class="col-md-6">
                            <select id="accountsinputdashboard" name="accountsinputdashboard"
                                    class="form-control input-sm">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->
            <div class="row">
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Options</label>

                        <div class="col-md-9">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <div class="radio"><span><input type="radio" name="RadioOptions" id="aucun"
                                                                    value="aucun" checked="checked"></span>
                                    </div>
                                    Aucun </label>
                                <label class="radio-inline">
                                    <div class="radio"><span class="checked"><input type="radio" name="RadioOptions"
                                                                                    id="parislongterme"
                                                                                    value="parislongterme"></span>
                                    </div>
                                    Pari long terme </label>
                                <label class="radio-inline">
                                    <div class="radio"><span class="checked"><input type="radio" name="RadioOptions"
                                                                                    id="systemeABCD"
                                                                                    value="systemeABCD"></span>
                                    </div>
                                    pari en système ABCD </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="methodeabcdcontainer">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label col-md-5">n° série ou nom</label>

                            <div class="col-md-7">
                                <select name="serieinputdashboard" id="serieinputdashboard"
                                        class="form-control input-sm">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label col-md-3">lettre</label>

                            <div class="col-md-8">
                                <select id="letterinputdashboard" name="letterinputdashboard"
                                        class="form-control input-sm">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/span-->
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    game_time
                </th>
                <th>
                    sport_id
                </th>
                <th>
                    league_id
                </th>
                <th>
                    home_team
                </th>
                <th>
                    away_team
                </th>
                <th>
                    market
                </th>
                <th>
                    odd
                </th>
                <th>

                </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td><input type="text" readonly/></td>
                    <td><button class="boutonsupprimer btn btn-sm red"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>

            </tbody>
        </table>
        <div class="form-actions form-actions-automatic-bet">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-offset-5 col-md-9">
                            <button type="submit" class="btn green">Valider</button>
                            <button type="button" class="btn default">Annuler</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
        {{ Form::close() }}
</div>