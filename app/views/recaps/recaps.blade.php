<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs font-yellow-crusta"></i>
            <span class="caption-subject font-yellow-crusta bold uppercase">Tipsters</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
            <a href="#portlet-config" data-toggle="modal" class="config">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <?php $annee = 3000 ?>
        <?php $mois = 30 ?>
        <div class="panel-group accordion" id="accordion3">
        @foreach($recaps as $recap)
            @if($annee == $recap->annee)
                @if($mois != $recap->mois)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"
                                   data-parent="#accordion3" href="#collapse_4_1">
                                    {{$recap->mois}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_4_1" class="panel-collapse in">
                            <div class="panel-body">
                            <ul>
                                <li>{{$recap->tipster_id}}</li>

                            </ul>

                            </div>
                        </div>
                    </div>
                @endif
            @else
                {{$recap->annee}}
                <?php $annee = $recap->annee ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"
                                   data-parent="#accordion3" href="#collapse_4_1">
                                    {{$recap->mois}}
                                </a>
                            </h4>
                        </div>
                        <?php $mois = $recap->mois ?>
                        <div id="collapse_4_1" class="panel-collapse in">
                            <div class="panel-body">
                                <ul>
                                    <li>{{$recap->tipster_id}} {{$recap->montant_profit}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

            @endif

        @endforeach
        </div>
    </div>
</div>