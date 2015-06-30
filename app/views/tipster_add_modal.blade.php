<div id="tipsterAddModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nouveau Tipster</h4>
            </div>
            {{ Form::open(array('route' => 'tipster.store', 'method' => 'post', 'id' => 'tipsterform-add', 'role' =>
                'form')) }}

            <div class="modal-body">
                <div class="note note-success">
                    <dl class="dl-horizontal">
                        <dt>Suivi:</dt>
                        <dd>Si vous choisissez le type de suivi <strong>à blanc</strong> pour un tipster, les gains
                            et pertes ne seront pas comptabilisés dans vos bankrolls. Ce type de suivi convient
                            lorsqu'on veut tester l'efficacité d'un nouveau tipster.<br> Vous avez la possibilité de
                            changer le type de suivi a n'importequel moment.
                        </dd>
                        <dt>Indice:</dt>
                        <dd>Correspond a l'indice de confiance maximum donné par le tipster, généralement 10.
                            Example: 10 pour 2/10, 5 pour 2/5.
                        </dd>
                        <dt>Montant par unité:</dt>
                        <dd>Correspond au montant alloué pour 1 unité. Example: Pour un tipster avec un indice
                            maximum de 10, si le montant par unité est 40€ alors 1/10 = 40€, 2/10 = 80€.<br>
                            Vous avez la possibilité de changer le montant par indice a n'importequel moment.
                        </dd>

                    </dl>
                </div>
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">


                            <div id="name_tipster_container" class="form-group has-feedback">
                                <label class="" for="name_tipster">Nom </label>
                                <input id="name_tipster" name="name_tipster" type="text"
                                       class="form-control">
                            </div>

                            <div id="suivi_tipster_container" class="form-group has-feedback">
                                <label for="suivi_tipster">Type de suivi </label>
                                <select id="suivi_tipster" name="suivi_tipster" class="form-control">
                                    <option value="n" selected="selected">normal</option>
                                    <option value="b">à blanc</option>
                                </select>
                            </div>

                            <div id="indice_tipster_container" class="form-group has-feedback">
                                <label class="" for="indice_tipster">Indice maximum </label>
                                <select id="indice_tipster" name="indice_tipster" class="form-control">
                                    <option value="" selected="selected"></option>
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                            <div id="amount_tipster_container" class="form-group has-feedback">
                                <label class="" for="amount_tipster">Montant par indice </label>
                                <input id="amount_tipster" name="amount_tipster" type="text"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn green">Ajouter</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>