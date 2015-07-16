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
        <?php $i = 0 ?>
        <?php $iterate = true; ?>

        <div class="panel-group accordion" id="accordion2">
        @while($i < $count)
            <?php $iterate = true; ?>
            @if($annee != $recaps[$i]['year'])
                <p class="theme-font bold">{{{$recaps[$i]['year']}}}</p>
                        <?php $annee = $recaps[$i]['year'] ?>
                        <?php $mois = 30 ?>
            @else
            @endif
                        <div class="panel panel-default">
                        @if($mois != $recaps[$i]['month'])
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"
                                       data-parent="#accordion2" href="{{'#collapse_'.$annee.'_'.$recaps[$i]['month']}}">
                                                @if($recaps[$i]['month'] == 1)
                                                 {{'Janvier'}}
                                                @elseif($recaps[$i]['month'] == 2)
                                                {{'Fevrier'}}
                                                @elseif($recaps[$i]['month'] == 3)
                                                {{'Mars'}}
                                                @elseif($recaps[$i]['month'] == 4)
                                                {{'Avril'}}
                                                @elseif($recaps[$i]['month'] == 5)
                                                {{'Mai'}}
                                                @elseif($recaps[$i]['month'] == 6)
                                                {{'Juin'}}
                                                @elseif($recaps[$i]['month'] == 7)
                                                {{'Juillet'}}
                                                @elseif($recaps[$i]['month'] == 8)
                                                {{'Aout'}}
                                                @elseif($recaps[$i]['month'] == 9)
                                                {{'Septembre'}}
                                                @elseif($recaps[$i]['month'] == 10)
                                                {{'Octobre'}}
                                                @elseif($recaps[$i]['month'] == 11)
                                                {{'Novembre'}}
                                                @elseif($recaps[$i]['month'] == 12)
                                                {{'Decembre'}}
                                                @endif
                                    </a>
                                </h4>
                            </div>
                            <?php $mois = $recaps[$i]['month'] ?>
                        @else
                        @endif
                            <div id="{{'collapse_'.$annee.'_'.$mois}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @while($annee == $recaps[$i]['year'] && $mois == $recaps[$i]['month'])
                                        <li class="">{{$recaps[$i]['tipster']['name']}} <span class="theme-font">{{round($recaps[$i]['total_devise_par_mois_tipster'],2)}} {{$user->devise}}</span></li>
                                            <?php $i++; ?>
                                        @if($i == $count)
                                            <?php break; ?>
                                        @endif
                                        @endwhile
                                    </ul>
                                </div>
                            </div>
                        </div>

        @endwhile
        </div>
    </div>
</div>