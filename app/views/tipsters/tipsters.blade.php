@include('tipster_edit_modal')
@include('tipster_add_modal')

        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject theme-font bold uppercase">Tipsters</span>
                    <span class="caption-helper">Configuration</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="note note-success">
                    <dl class="dl-horizontal">
                        <dt>Suivi:</dt>
                        <dd>Si vous choisissez le type de suivi <strong>à blanc</strong> pour un tipster, les gains
                            et pertes ne seront pas comptabilisés dans vos bankrolls des bookmakers. Ce type de suivi convient
                            lorsqu'on veut tester l'efficacité d'un nouveau tipster.<br> Vous avez la possibilité de
                            changer le type de suivi a n'importequel moment. Si vous changez de type de suivi dans le meme mois, le tipster aura deux profils avec ses pertes et/ou profits respectifs.
                        </dd>
                        <dt>Montant par unité:</dt>
                        <dd>Correspond au montant alloué pour 1 unité. Example: Si le montant par unité est 40€ alors 1 unité = 40€, 2 unités = 80€.<br>
                            Vous avez la possibilité de modifier le montant par unité à n'importequel moment.
                        </dd>
                    </dl>
                </div>
                <button class="btn bg-green-meadow" data-toggle="modal" data-target="#tipsterAddModal">Ajouter un tipster <span class="glyphicon glyphicon-user"></span></button>
                <div id="tipsters-pagination" class="">
                </div>
            </div>
        </div>
    </div>
</div>