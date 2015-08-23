<?php

	use Carbon\Carbon;
	use Maatwebsite\Excel\Facades\Excel;


	class DashboardController extends BaseController
	{

		protected $types_resultat = [1 => 'Gagné', 2 => 'Perdu', 3 => '1/2 Gagné', 4 => '1/2 Perdu', 5 => 'Remboursé'];


		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$this->beforeFilter('devise_missing', array('only' => array('showDashboard')));
			$this->beforeFilter('welcome_verification', array('only' => array('welcome')));
			$this->beforeFilter('csrf', ['on' => array('postDevise')]);
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
			return View::make('pages.dashboard');
		}

		public function getDevise(){
			/*$devises = Devise::orderBy('initiales')->get(array('id','initiales as text'));
			return $devises;*/
		}

		public function postDevise(){
			$rules = array(
				'devise' => 'required|exists:devises,id'
			);

			$validator = Validator::make(Input::all(), $rules);

			if($validator->passes()){
				$sigle = Devise::find(Input::get('devise'))->sigle;
				Auth::user()->devise = $sigle;
				Auth::user()->save();
				return Redirect::to('dashboard');
			}else{

				return Redirect::back()->withErrors($validator);
			}
		}

		public function getTipsters()
		{
			$tipsters = Auth::user()->tipsters;
			return $tipsters;
		}

		public function showTipsters()
		{
			if (Request::ajax()) {
				;
			}
		}

		public function showParisEnCours()
		{
			$parisencours = Auth::user()->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'selections.market', 'tipster', 'compte.bookmaker')->where('pari_abcd', '0')->orderBy('numero_pari', 'desc')->paginate(8);
			return $parisencours;
		}

		public function showParisLongTerme()
		{
			$parislongterme = Auth::user()->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'tipster', 'compte.bookmaker')->where('pari_long_terme', '1')->orderBy('numero_pari', 'desc')->paginate(8);
			return $parislongterme;
		}

		public function showParisABCD()
		{
			$parislongterme = Auth::user()->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'tipster', 'compte.bookmaker')->where('pari_abcd', '1')->orderBy('numero_pari', 'desc')->paginate(8);
			return $parislongterme;
		}

		public function showRecaps()
		{
			// pour calculer total par mois pour chaque tipster.
			$recaps = Auth::user()->termineParis()->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, tipster_id, followtype, SUM(montant_profit) AS total_devise_par_mois_tipster, SUM(unites_profit) AS total_unites_par_mois_tipster, AVG(mt_par_unite) AS moyenne_unite_par_mois_tipster'))->with('tipster')->groupBy('year', 'month', 'tipster_id', 'followtype')->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('followtype', 'desc')->get();

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
					return Response::json(array(
						'vue' => $view->render(),
						'count_paris_encours' => $countParisEnCours,
					));
					break;
				case 'parislongterme':
					$parisLongTerme = $this->showParisLongTerme();
					$countParisLongTerme = $parisLongTerme->getTotal();
					$view = View::make('bet.parislongterme', array('parislongterme' => $parisLongTerme, 'types_resultat' => $this->types_resultat, 'count_paris_longterme' => $countParisLongTerme));
					return $view;

					break;
				case 'parisabcd':
					$parisABCD = $this->showParisABCD();
					Clockwork::info($parisABCD);
					$countParisABCD = $parisABCD->getTotal();
					$view = View::make('bet.parisabcd', array('parisabcd' => $parisABCD, 'types_resultat' => $this->types_resultat, 'count_paris_abcd' => $countParisABCD));
					return $view;

					break;
				case 'paristermine':
					$parisTermine = Auth::user()->termineParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'compte.bookmaker', 'tipster')->orderBy('created_at','DESC')->get();
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