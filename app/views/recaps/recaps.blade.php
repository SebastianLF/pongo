<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Recap Tipsters</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
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
                <p class="font-green-sharp"><span class="icon-calendar"></span>{{{' '.$recaps[$i]['year']}}}</p>
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
                                                    <span class="uppercase ">{{'Janvier '}}</span>
                                                        @if($recaps2[$i]['month'] == 1 && $annee == $recaps2[$i]['year'])
                                                            @if($recaps2[$i]['total_mois'] > 0)
                                                                <span class="font-green-sharp pull-right bold">{{' +'.round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @elseif($recaps2[$i]['total_mois'] < 0)
                                                                <span class="font-red-haze pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @elseif($recaps2[$i]['total_mois'] == 0)
                                                                <span class="pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @endif
                                                        @endif

                                                @elseif($recaps[$i]['month'] == 2)

                                                    <span class="uppercase ">{{'Fevrier'}}</span>
                                                        @if($recaps2[$i]['month'] == 2 && $annee == $recaps2[$i]['year'])
                                                            @if($recaps2[$i]['total_mois'] > 0)
                                                                <span class="font-green-sharp pull-right bold">{{' +'.round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @elseif($recaps2[$i]['total_mois'] < 0)
                                                                <span class="font-red-haze pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @elseif($recaps2[$i]['total_mois'] == 0)
                                                                <span class="pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @endif
                                                        @endif

                                                @elseif($recaps[$i]['month'] == 3)

                                                    <span class="uppercase ">{{'Mars'}}</span>
                                                        @if($recaps2[$i]['month'] == 3 && $annee == $recaps2[$i]['year'])
                                                            @if($recaps2[$i]['total_mois'] > 0)
                                                                <span class="font-green-sharp pull-right bold">{{' +'.round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @elseif($recaps2[$i]['total_mois'] < 0)
                                                                <span class="font-red-haze pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @elseif($recaps2[$i]['total_mois'] == 0)
                                                                <span class="pull-right">{{round($recaps2[$i]['total_mois'], 2)}} {{$user->devise}}</span>
                                                            @endif
                                                        @endif
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
                                                <span class="theme-font blue-bookmaker">{{'Aout | '}}</span>
                                                @if($recaps2[$i]['month'] == 8 && $annee == $recaps2[$i]['year'])
                                                        @if($recaps2[$i]['total_unites_par_mois'] > 0)
                                                            <span class="font-green-sharp">{{'+'.floatval(round($recaps2[$i]['total_unites_par_mois'], 2)).' unités'}}</span>
                                                        @elseif($recaps2[$i]['total_unites_par_mois'] < 0)
                                                            <span class="font-red-haze">{{floatval(round($recaps2[$i]['total_unites_par_mois'], 2)).' unités'}}</span>
                                                        @elseif($recaps2[$i]['total_unites_par_mois'] == 0)
                                                            <span class="">{{floatval(round($recaps2[$i]['total_unites_par_mois'], 2)).' unités'}}</span>
                                                        @endif
                                                    @endif
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
                                <table class="table table-light">
                                    <thead>
                                    <tr class="uppercase">
                                        <th colspan="">
                                            Tipster
                                        </th>
                                        <th>
                                            1u=
                                        </th>
                                        <th>
                                            cote moy.
                                        </th>
                                        <th>
                                            G/P
                                        </th>
                                        <th>
                                            ROI
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @while($annee == $recaps[$i]['year'] && $mois == $recaps[$i]['month'])
                                    <tr>
                                        <td class="blue bold"> {{$recaps[$i]['followtype'] == 'b' ? '<span class="label label-sm label-warning label-mini">B</span>'.$recaps[$i]['tipster']['name'] : $recaps[$i]['tipster']['name']}}</td>

                                        @if($recaps[$i]['total_devise_par_mois_tipster'] > 0)
                                            <td><span class="font-green-sharp">{{' +'.floatval(round($recaps[$i]['total_unites_par_mois_tipster'], 2)).'u '}}</span><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="{{'1u='.floatval(round($recaps[$i]['moyenne_unite_par_mois_tipster'], 2)).Auth::user()->devise.' en moy.'}}"></span></td>
                                            <td><span class="font-green-sharp">{{' +'.floatval(round($recaps[$i]['total_devise_par_mois_tipster'],2)).Auth::user()->devise}}</span></td>
                                        @elseif($recaps[$i]['total_devise_par_mois_tipster'] < 0)
                                            <td><span class="font-red-haze">{{floatval(round($recaps[$i]['total_unites_par_mois_tipster'], 2)).'u (1u='.floatval(round($recaps[$i]['moyenne_unite_par_mois_tipster'], 2)).Auth::user()->devise.')'}}</span></td>
                                            <td><span class="font-red-haze">{{floatval(round($recaps[$i]['total_devise_par_mois_tipster'], 2)).Auth::user()->devise}}</span></td>
                                        @elseif($recaps[$i]['total_devise_par_mois_tipster'] == 0)
                                            <td><span class="">{{floatval(round($recaps[$i]['total_unites_par_mois_tipster'], 2)).'u (1u='.floatval(round($recaps[$i]['moyenne_unite_par_mois_tipster'], 2)).Auth::user()->devise.')'}}</span></td>
                                            <td><span class="">{{floatval(round($recaps[$i]['total_devise_par_mois_tipster'], 2)).Auth::user()->devise}}</span></td>
                                        @endif
                                            <?php $i++; ?>
                                        @if($i == $count)
                                            <?php break; ?>
                                        @endif
                                    </tr>
                                    @endwhile
                                    <tr>
                                        <td>
                                            <a href="javascript:;" class="primary-link">Brain</a>
                                        </td>
                                        <td>
                                            $345
                                        </td>
                                        <td>
                                            45
                                        </td>
                                        <td>
                                            124
                                        </td>
                                        <td>
                                            <span class="bold theme-font">80%</span>
                                        </td>
                                    </tr>
                                    </tbody></table>

                                    <ul>

                                    </ul>
                                </div>
                            </div>
                        </div>

        @endwhile
        </div>
    </div>
</div>