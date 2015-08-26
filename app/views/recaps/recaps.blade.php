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
                                <div class="panel-body panel-body-recaps">
                                <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-light table-recap">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    @while($annee == $recaps[$i]['year'] && $mois == $recaps[$i]['month'])
                                        <?php
                                            $nom_mois = '';
                                            $total_unites_par_mois_tipster = '';
                                            $nombre_paris_gagnes = $recaps[$i]['nombre_paris_gagnes_par_mois_tipster'] + $recaps[$i]['nombre_paris_demigagnes_par_mois_tipster'];
                                            $nombre_paris_total = $recaps[$i]['nombre_paris_total'];
                                            $pourcentage_paris_gagnes = floatval(round($nombre_paris_gagnes / $nombre_paris_total * 100));
                                            $nombre_paris_gagnes = '<span class="bold theme-font">'.$nombre_paris_gagnes.'</span>';
                                            $nombre_paris_perdu = $recaps[$i]['nombre_paris_perdu_par_mois_tipster'] + $recaps[$i]['nombre_paris_demiperdu_par_mois_tipster'];
                                            $nombre_paris_perdu = '<span class="bold red-lose">'.$nombre_paris_perdu.'</span>';
                                            $nombre_paris_rembourse = '<span class="bold blue-rembourse">'. $recaps[$i]['nombre_paris_rembourse_par_mois_tipster'].'</span>';
                                            $total_devise_retour_par_mois_tipster = $recaps[$i]['total_devise_retour_par_mois_tipster'];
                                            $total_investissement_par_mois_tipster = $recaps[$i]['total_investissement_par_mois_tipster'];
                                            $roi = floatval(round(($total_devise_retour_par_mois_tipster - $total_investissement_par_mois_tipster)/$total_investissement_par_mois_tipster*100));
                                            if($roi > 0){$roi = '<span class="bold theme-font">'.$roi.'%'.'</span>';}else if($roi < 0){$roi = '<span class="bold red-lose">'.$roi.'%'.'</span>';}else if($roi == 0){$roi = '<span class="bold">'.$roi.'%'.'</span>';}
                                            $cote = floatval(round($recaps[$i]['moyenne_cote_par_mois_tipster'], 2));
                                            $moyenne_mise_unites = floatval(round($recaps[$i]['moyenne_mise_unites'], 2));

                                        if($recaps[$i]['month'] == 1)
                                        {$nom_mois = 'Janvier';}
                                        elseif($recaps[$i]['month'] == 2)
                                        { $nom_mois = 'Février';}
                                        elseif($recaps[$i]['month'] == 3)
                                        { $nom_mois = 'Mars';}
                                        elseif($recaps[$i]['month'] == 4)
                                        { $nom_mois = 'Avril';}
                                        elseif($recaps[$i]['month'] == 5)
                                        { $nom_mois = 'Mai';}
                                        elseif($recaps[$i]['month'] == 6)
                                        { $nom_mois = 'Juin';}
                                        elseif($recaps[$i]['month'] == 7)
                                        { $nom_mois = 'Juillet';}
                                        elseif($recaps[$i]['month'] == 8)
                                        { $nom_mois = 'Août';}
                                        elseif($recaps[$i]['month'] == 9)
                                        { $nom_mois = 'Septembre';}
                                        elseif($recaps[$i]['month'] == 10)
                                        { $nom_mois = 'Octobre';}
                                        elseif($recaps[$i]['month'] == 11)
                                        { $nom_mois = 'Novembre';}
                                        elseif($recaps[$i]['month'] == 12)
                                        { $nom_mois = 'Décembre';}
                                        ?>
                                    <tr>
                                        <td class="blue"> {{$recaps[$i]['followtype'] == 'b' ? '<span class="label label-sm label-warning label-mini">B</span>'.$recaps[$i]['tipster']['name'] : $recaps[$i]['tipster']['name']}}</td>
                                        <!--<td>{{{'1u='.floatval($recaps[$i]['moyenne_mt_par_unite_par_mois_tipster']).Auth::user()->devise}}}</td>-->

                                        @if($recaps[$i]['total_unites_par_mois_tipster'] > 0)
                                            <td><span class="font-green-sharp">{{' +'.floatval(round($recaps[$i]['total_unites_par_mois_tipster'], 2)).'u '}}</span></td>
                                             <!--<td><span class="font-green-sharp">{{' +'.floatval(round($recaps[$i]['total_devise_retour_par_mois_tipster'],2)).Auth::user()->devise}}</span></td> -->
                                        @elseif($recaps[$i]['total_unites_par_mois_tipster'] < 0)
                                            <td><span class="red-lose">{{floatval(round($recaps[$i]['total_unites_par_mois_tipster'], 2)).'u '}}</span></td>
                                           <!-- <td><span class="font-red-haze">{{floatval(round($recaps[$i]['total_devise_retour_par_mois_tipster'], 2)).Auth::user()->devise}}</span></td> -->
                                        @elseif($recaps[$i]['total_unites_par_mois_tipster'] == 0)
                                            <td><span class="">{{floatval(round($recaps[$i]['total_unites_par_mois_tipster'], 2)).'u '}}</span></td>
                                             <!--<td><span class="">{{floatval(round($recaps[$i]['total_devise_retour_par_mois_tipster'], 2)).Auth::user()->devise}}</span></td>-->
                                        @endif
                                            <?php $i++;

                                            ?>
                                        <td><button type="button" class="btn btn-default btn-xs recap-profil" data-placement="left" data-trigger="focus" data-toggle="popover" data-html="true" data-content="{{{'<table><thead><tr><th>'.$nom_mois.' '.$annee.'</th><th></th></tr></thead><tbody><tr><td>ROI = '.$roi.'</td></tr><tr><td>G/P/R = '.$nombre_paris_gagnes.'('.$pourcentage_paris_gagnes.'%)/'.$nombre_paris_perdu.'/'.$nombre_paris_rembourse.' (Total = '.$nombre_paris_total.' )</td></tr><tr><td>moy. cote = '.$cote.'</td></tr><tr><td>moy. mise = '.$moyenne_mise_unites.'u</td></tr></tbody></table>'}}}"><i class="fa fa-user"></i> Profil</button></td>
                                        @if($i == $count)
                                                <?php break; ?>
                                            @endif
                                    </tr>
                                    @endwhile
                                    </tbody>
                                </table>

                                </div>
                                </div>

                                </div>
                            </div>
                        </div>
        @endwhile
        </div>
    </div>
</div>