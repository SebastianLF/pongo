<?php

	use Carbon\Carbon;

	class DashboardController extends BaseController
	{

		protected $types_resultat = [1 => 'Gagné', 2 => 'Perdu', 3 => '1/2 Gagné', 4 => '1/2 Perdu', 5 => 'Remboursé'];

		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$this->beforeFilter('csrf', ['on' => array('postDevise')]);
		}

		public function welcome(){
			return View::make('pages.welcome');
		}

		public function showDashboard()
		{
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
				Clockwork::info(Input::get('devise'));
				$devise_id = Input::get('devise');
				$sigle = Devise::find($devise_id)->sigle;
				Auth::user()->devise = $sigle;
				Auth::user()->save();
				return View::make('pages/dashboard');
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
			$recaps = Auth::user()->termineParis()->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, tipster_id, followtype'))->with('tipster')->groupBy('year')->groupBy('month')->groupBy('tipster_id')->groupBy('followtype')->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('followtype', 'desc')->get();
			$count = $recaps->count();
			$view = View::make('recaps.recaps', array('recaps' => $recaps->toArray(), 'count' => $count ));
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
					$parisTermine = Auth::user()->termineParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport','compte.bookmaker')->with(array('tipster' => function ($query){ $query->withThrashed(); }))->orderBy('created_at','DESC')->get();
					$countParisTermine = $parisTermine->count();
					$view = View::make('bet.paristermine', array('paristermine' => $parisTermine, 'types_resultat' => $this->types_resultat, 'count_paris_termine' => $countParisTermine));
					return $view;

					break;
				default:
					throw new Exception('Invalid type(parisencours|parislongterme|parisabcd|paristermine) passed');
			}
		}
	}