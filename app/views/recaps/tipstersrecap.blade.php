<div class="table-scrollable table-scrollable-borderless">
    <table class="table table-hover table-light">
        <thead>
        <tr class="uppercase">
            <th colspan="">
                NOM
            </th>
            <th>
                COTE M.
            </th>
            <th>
                MISE MOY.
            </th>
            <th>
                EFFICACITE
            </th>
            <th>
                PROFITS
            </th>
            <th>
                ROI
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>TOTAL</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($recap_tipsters as $recap_tipster)
            <?php $roi = floatval(round(($recap_tipster->total_devise_retour_par_mois_tipster - $recap_tipster->total_investissement_par_mois_tipster)/$recap_tipster->total_investissement_par_mois_tipster*100));
            if($roi > 0){$roi = '<span class="bold theme-font">'.$roi.'%'.'</span>';}else if($roi < 0){$roi = '<span class="bold red-lose">'.$roi.'%'.'</span>';}else if($roi == 0){$roi = '<span class="bold">'.$roi.'%'.'</span>';}
            $nombre_paris_gagnes = $recap_tipster->nombre_paris_gagnes_par_mois_tipster + $recap_tipster->nombre_paris_demigagnes_par_mois_tipster;
            $nombre_paris_gagnes = '<span class="theme-font">'.$nombre_paris_gagnes.'</span>';
            $nombre_paris_perdu = $recap_tipster->nombre_paris_perdu_par_mois_tipster + $recap_tipster->nombre_paris_demiperdu_par_mois_tipster;
            $nombre_paris_perdu = '<span class="red-lose">'.$nombre_paris_perdu.'</span>';
            $nombre_paris_rembourse = '<span class="blue-rembourse">'.$recap_tipster->nombre_paris_rembourse_par_mois_tipster.'</span>';
            $total_unites_benefs_par_mois_tipster = floatval(round($recap_tipster->total_unites_benefs_par_mois_tipster, 2));
            if($recap_tipster->total_unites_benefs_par_mois_tipster > 0){$total_unites_benefs_par_mois_tipster = '<span class="bold font-green-sharp">'.' +'.$total_unites_benefs_par_mois_tipster.' U'.'</span>';}elseif($recap_tipster->total_unites_benefs_par_mois_tipster < 0){$total_unites_benefs_par_mois_tipster = '<span class="bold red-lose">'.$total_unites_benefs_par_mois_tipster.' U'.'</span>';}elseif($recap_tipster->total_unites_benefs_par_mois_tipster == 0){$total_unites_benefs_par_mois_tipster = '<span class="bold">'.$total_unites_benefs_par_mois_tipster.' U'.'</span>';}
            ?>
        <tr>
            <td>
                <span class="primary-link">{{$recap_tipster->followtype == 'b' ? $recap_tipster->tipster->name.' <span class="label label-sm label-warning label-mini">B</span>' : $recap_tipster->tipster->name}}</span>
            </td>
            <td>
                {{floatval(round($recap_tipster->moyenne_cote_par_mois_tipster, 2))}}
            </td>

            <td>
                {{floatval(round($recap_tipster->moyenne_mise_unites, 2)).' U (1U='.floatval(round($recap_tipster->moyenne_mt_par_unite_par_mois_tipster)).Auth::user()->devise.')'}}
            </td>
            <td>
                {{floatval(round($recap_tipster->nombre_paris_gagnes_par_mois_tipster / $recap_tipster->nombre_paris_total * 100)).'% ('.$nombre_paris_gagnes.'/'.$nombre_paris_perdu.'/'.$nombre_paris_rembourse.')'}}
            </td>
            <td>
                {{$total_unites_benefs_par_mois_tipster}}
            </td>
            <td>
                <span class="bold theme-font">{{$roi}}</span>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
