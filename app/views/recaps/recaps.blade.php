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
                <p class="font-yellow-crusta"><span class="icon-calendar"></span>{{{' '.$recaps[$i]['year']}}}</p>
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
                                                {{'Janvier '}}

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
                                                <span class="uppercase ">{{'Juillet'}}</span>
                                                    @if($recaps2[$i]['month'] == 7 && $annee == $recaps2[$i]['year'])
                                                        @if($recaps2[$i]['total_mois'] > 0)
                                                            <span class="font-green-sharp pull-right bold">{{' +'.round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                        @elseif($recaps2[$i]['total_mois'] < 0)
                                                            <span class="font-red-haze pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                        @elseif($recaps2[$i]['total_mois'] == 0)
                                                            <span class="pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                        @endif
                                                    @endif
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
                                <table class="table table-light table-hover">
                                    <tbody>

                                    @while($annee == $recaps[$i]['year'] && $mois == $recaps[$i]['month'])
                                    <tr>
                                        <td class="uppercase "> {{$recaps[$i]['followtype'] == 'b' ? $recaps[$i]['tipster']['name'].'  <span class="label label-sm label-warning label-mini">à blanc</span>' : $recaps[$i]['tipster']['name']}}
                                        @if($recaps[$i]['total_devise_par_mois_tipster'] > 0)
                                            <span class="font-green-sharp pull-right">{{' +'.round($recaps[$i]['total_devise_par_mois_tipster'],2)}} {{$user->devise}}</span>
                                        @elseif($recaps[$i]['total_devise_par_mois_tipster'] < 0)
                                            <span class="font-red-haze pull-right">{{round($recaps[$i]['total_devise_par_mois_tipster'],2)}} {{$user->devise}}</span>
                                        @elseif($recaps[$i]['total_devise_par_mois_tipster'] == 0)
                                            <span class="pull-right">{{round($recaps[$i]['total_devise_par_mois_tipster'],2)}} {{$user->devise}}</span>
                                        @endif

                                        </td>
                                            <?php $i++; ?>
                                        @if($i == $count)
                                            <?php break; ?>
                                        @endif
                                        </tr>
                                    @endwhile

                                    </tbody>
                                </table>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                        </div>

        @endwhile
        </div>
    </div>
</div>