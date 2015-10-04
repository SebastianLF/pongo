<?php

	use Carbon\Carbon;
	use Laracasts\Utilities\JavaScript\Facades\JavaScript;
	use yajra\Datatables\Datatables;


	class DashboardController extends BaseController
	{
		protected $types_resultat = [1 => 'Gagné', 2 => 'Perdu', 3 => '1/2 Gagné', 4 => '1/2 Perdu', 5 => 'Remboursé'];


		public function __construct()
		{
			parent::__construct();
		}

		public function welcome(){
			return View::make('pages.welcome');
		}

		public function showDashboard()
		{
			/*Excel::selectSheetsByIndex(0)->load('xls/BettingTypes.xls', function ($reader) {
				// Getting all results
				$results = $reader->get();
				Clockwork::info($results);
				foreach($results as $result){
					Market::create(array('id' => $result->id, 'name' => $result->name, 'description' => $result->description));
				}
			});

			Excel::selectSheetsByIndex(2)->load('xls/BettingTypes.xls', function ($reader) {
				// Getting all results
				$results = $reader->get();
				Clockwork::info($results);
				foreach($results as $result){
					Sport::create(array('id' => $result->id, 'name' => $result->name, 'description' => $result->description));
				}
			});

			Excel::selectSheetsByIndex(0)->load('xls/bookmakers.xls', function ($reader) {
				// Getting all results
				$results = $reader->get();
				foreach ($results as $result) {
					$name = trim($result->name);
					Bookmaker::create(array('nom' => $name));
				}
			});*/

			JavaScript::put([
				'timezone' => Auth::user()->timezone,
			]);

			return View::make('pages.dashboard');
		}

		public function getTipsters()
		{
			$tipsters = Auth::user()->tipsters;
			return $tipsters;
		}

		public function showTipsters()
		{
			if (Request::ajax()) {

			}
		}

		public function showParisEnCours()
		{
			$parisencours = Auth::user()->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'selections.market', 'tipster', 'compte.bookmaker')->where('pari_long_terme', '0')->orderBy('numero_pari', 'desc')->paginate(5);
			return $parisencours;
		}



		public function showGeneralRecap(){

			// tipsters
			$dates = explode("-", Input::get('range'));
			$startDate = explode("/", trim($dates[0]));
			$startDate = Carbon::create($startDate[2], $startDate[1], $startDate[0], 0, 0, 0, Auth::user()->timezone);
			$endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]), Auth::user()->timezone);
			$recap_tipsters = Auth::user()->termineParis()->select(DB::raw('tipster_id, followtype, SUM(montant_profit) AS total_devise_profit_par_mois_tipster, SUM(montant_retour) AS total_devise_retour_par_mois_tipster, SUM(unites_profit) AS total_unites_benefs_par_mois_tipster, AVG(mt_par_unite) AS moyenne_mt_par_unite_par_mois_tipster, AVG(nombre_unites) AS moyenne_mise_unites, AVG(mise_totale) AS moyenne_mise_devise, SUM(mise_totale) AS total_investissement_par_mois_tipster, COUNT(case when status = 1 then 1 else null end) AS nombre_paris_gagnes_par_mois_tipster, COUNT(case when status = 2 then 1 else null end) AS nombre_paris_perdu_par_mois_tipster, COUNT(case when status = 5 then 1 else null end) AS nombre_paris_rembourse_par_mois_tipster, COUNT(case when status = 3 then 1 else null end) AS nombre_paris_demigagnes_par_mois_tipster, COUNT(case when status = 4 then 1 else null end) AS nombre_paris_demiperdu_par_mois_tipster, COUNT(*) AS nombre_paris_total, AVG(cote) AS moyenne_cote_par_mois_tipster'))->with('tipster')->whereBetween('created_at', array($startDate, $endDate))->groupBy('tipster_id', 'followtype')->orderBy('total_unites_benefs_par_mois_tipster', 'desc')->get();
			Clockwork::info($recap_tipsters);
				//total line
			$cote_moyenne_general = round(Auth::user()->termineParis()->whereBetween('created_at', array($startDate, $endDate))->where('followtype', '!=', 'b')->avg('cote'), 3);
			$mise_unites_moyenne_general = round(Auth::user()->termineParis()->whereBetween('created_at', array($startDate, $endDate))->where('followtype', '!=', 'b')->avg('nombre_unites'), 2);
			$mt_par_unite_moyenne_general = round(Auth::user()->termineParis()->whereBetween('created_at', array($startDate, $endDate))->where('followtype', '!=', 'b')->avg('mt_par_unite'), 2);

			// view send with parameters
			$recap_tipsters_view = View::make('recaps.tipstersrecap', array('recap_tipsters' => $recap_tipsters, 'cote_moyenne_general' => $cote_moyenne_general, 'mise_unites_moyenne_general' => $mise_unites_moyenne_general, 'mt_par_unite_moyenne_general' => $mt_par_unite_moyenne_general.Auth::user()->devise));

			// general
			$recap_general = Auth::user()->termineParis()->whereBetween('created_at', array($startDate, $endDate))->where('followtype', '!=', 'b')->get();
			$total_profit_devise = $this->setCouleur(floatval(round($recap_general->sum('montant_profit'), 2)), Auth::user()->devise);
			//$total_profit_unites = $this->setCouleur(floatval(round($recap_general->sum('unites_profit'), 2)), 'U');

			return array('tipsters_view' => $recap_tipsters_view->render(), 'total_profit_devise' => $total_profit_devise);
		}

		function setCouleur($nombre, $monnaie){
			if($nombre > 0){
				return '<span class="bold theme-font">+'.$nombre.' '.$monnaie.'</span>';
			}elseif($nombre < 0){
				return '<span class="bold red-lose">'.$nombre.' '.$monnaie.'</span>';
			}elseif($nombre == 0){
				return '<span class="bold">'.$nombre.' '.$monnaie.'</span>';
			}
			return '';
		}

		public function showRecaps()
		{
			// pour calculer total par mois pour chaque tipster.
			$recaps = Auth::user()->termineParis()->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, tipster_id, followtype, SUM(montant_profit) AS total_devise_profit_par_mois_tipster, SUM(montant_retour) AS total_devise_retour_par_mois_tipster, SUM(unites_profit) AS total_unites_benefs_par_mois_tipster, AVG(mt_par_unite) AS moyenne_mt_par_unite_par_mois_tipster, AVG(nombre_unites) AS moyenne_mise_unites, SUM(mise_totale) AS total_investissement_par_mois_tipster, COUNT(case when status = 1 then 1 else null end) AS nombre_paris_gagnes_par_mois_tipster, COUNT(case when status = 2 then 1 else null end) AS nombre_paris_perdu_par_mois_tipster, COUNT(case when status = 5 then 1 else null end) AS nombre_paris_rembourse_par_mois_tipster, COUNT(case when status = 3 then 1 else null end) AS nombre_paris_demigagnes_par_mois_tipster, COUNT(case when status = 4 then 1 else null end) AS nombre_paris_demiperdu_par_mois_tipster, COUNT(*) AS nombre_paris_total, AVG(cote) AS moyenne_cote_par_mois_tipster'))->with('tipster')->groupBy('year', 'month', 'tipster_id', 'followtype')->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('followtype', 'desc')->get();

			// pour calculer le total par mois tout court.
			$recaps2 = Auth::user()->termineParis()->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, SUM(unites_profit) AS total_unites_par_mois'))->groupBy('year', 'month', 'followtype')->having('followtype', '=', 'n')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

			Clockwork::info($recaps);
			Clockwork::info($recaps2);
			$count = $recaps->count();
			$view = View::make('recaps.recaps', array('recaps' => $recaps->toArray(), 'recaps2' => $recaps2->toArray(), 'count' => $count ));
			return $view;
		}

		public function getTotalProfit(){

			// tous les paris terminés sauf les a blanc.
			$paristermines = Auth::user()->termineParis()->where('followtype', 'n')->get();

			$benefices = $paristermines->sum('montant_profit');
			$capital = $paristermines->sum('mise_totale');

			// calcul du ROI. Si nombres = 0 , division impossible
			if($benefices != 0 || $capital != 0){
				$roi = ($benefices / $capital) * 100;
			}else{
				$roi = 'N/A';
			}

			// calcul des profits.
			$montant_total_profit = 0;
			$montant_total_profit += $paristermines->sum('montant_profit');

			return Response::json(array('montantprofit' => $montant_total_profit, 'roi' => round($roi,2)));
		}

		public function itemTypeCheck($type)
		{

			switch ($type) {
				case 'parisencours':
					$parisEnCours = $this->showParisEnCours();
     					$countParisEnCours = $parisEnCours->getTotal();
					$view = View::make('bet.parisencours', array('parisencours' => $parisEnCours, 'types_resultat' => $this->types_resultat, 'count_paris_encours' => $countParisEnCours));
					Clockwork::info($parisEnCours);
					return Response::json(array(
						'vue' => $view->render(),
						'count_paris_encours' => $countParisEnCours,
					));
					break;
				case 'parislongterme':
					$parislongterme = Auth::user()->enCoursParis()->with('selections.equipe1', 'selections.equipe1.country', 'selections.equipe2', 'selections.equipe2.country', 'selections.competition', 'selections.sport', 'selections.scope', 'compte.bookmaker', 'tipster')->where('pari_long_terme', '1')->orderBy('numero_pari', 'desc')->get();
					$countParisLongTerme = $parislongterme->count();
					$view = View::make('bet.parislongterme', array('parislongterme' => $parislongterme, 'types_resultat' => $this->types_resultat, 'count_paris_longterme' => $countParisLongTerme));
					return array(
						'vue' => $view->render(),
						'count_paris_longterme' => $countParisLongTerme,
					);

					break;
				case 'parisabcd':
					$parisABCD = Auth::user()->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'selections.market', 'tipster', 'compte.bookmaker')->where('pari_abcd', 1)->where('pari_long_terme', 0)->orderBy('numero_pari', 'desc')->get();
					Clockwork::info($parisABCD);
					$countParisABCD = $parisABCD->count();
					$view = View::make('bet.parisabcd', array('parisabcd' => $parisABCD, 'types_resultat' => $this->types_resultat, 'count_paris_abcd' => $countParisABCD));
					return $view;

					break;
				case 'paristermine':
					$parisTermine = Auth::user()->termineParis()->with('selections.equipe1', 'selections.equipe1.country', 'selections.equipe2', 'selections.equipe2.country', 'selections.competition', 'selections.sport', 'selections.scope', 'compte.bookmaker', 'tipster')->orderBy('created_at','DESC')->get();
					Clockwork::info($parisTermine);
					$countParisTermine = $parisTermine->count();
					$view = View::make('bet.paristermine', array('paristermine' => $parisTermine, 'types_resultat' => $this->types_resultat, 'count_paris_termine' => $countParisTermine));

					return $view;

					break;
				default:
					throw new Exception('Invalid type(parisencours|parislongterme|parisabcd|paristermine) passed');
			}
		}
	}