<?php
	/* controller corresponding to dashboard page */

	use Carbon\Carbon;

	class DashboardController extends BaseController
	{

		protected $types_resultat = [1 => 'Gagné', 2 => 'Perdu', 3 => '1/2 Gagné', 4 => '1/2 Perdu', 5 => 'Remboursé'];

		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth', ['except' => 'getBetInformations']);

		}

		public function showDashboard()
		{
			$devisearray = '';
			// premiere connexion au compte
			if ($this->currentUser->devise == 'Non') {
				$devisearray = $this->getDevise();
			}
			// donnees lors du chargement de la page dashboard
			return View::make('pages/dashboard', array(
					//$devisearray ne sert que pour la boite modal affichée pour la premiere connexion
					'devisearray' => $devisearray ,
				)
			);
		}

		public function getDevise(){
			$devises = Devise::orderBy('initiales')->get(array('id','initiales as text'));
			return $devises;
		}


		public function postDevise(){

			$rules = array(
				'devise' => 'required|exists:devises,id'
			);

			$validator = Validator::make(Input::all(), $rules);

			if($validator->passes()){
				$devise_id = Input::get('devise');
				$sigle = Devise::find($devise_id)->sigle;
				$this->currentUser->devise = $sigle;
				$this->currentUser->save();
				return Redirect::to('dashboard');

			}else{
				return Redirect::back()->withErrors($validator);
			}


		}


		public function getTipsters()
		{
			$tipsters = $this->currentUser->tipsters;
			return $tipsters;
		}

		public function showTipsters()
		{
			if (Request::ajax()) {
				;
			}
		}

		public function showCurrentBets()
		{
			$currentbets = $this->currentUser->currentBets()->orderBy('combonum', 'desc')->get();
			return $currentbets;
		}

		public function showParisEnCours()
		{
			$parisencours = $this->currentUser->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'selections.typePari', 'tipster', 'compte.bookmaker')->where('pari_long_terme', '0')->where('pari_abcd', '0')->orderBy('numero_pari', 'desc')->paginate(5);
			return $parisencours;
		}

		public function showParisLongTerme()
		{
			$parislongterme = $this->currentUser->enCoursParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'selections.typePari', 'tipster', 'compte.bookmaker')->where('pari_long_terme', '1')->paginate(5);
			return $parislongterme;
		}

		public function showRecaps()
		{
			$recaps = $this->currentUser->termineParis()->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, tipster_id, followtype'))->with('tipster')->groupBy('year')->groupBy('month')->groupBy('tipster_id')->groupBy('followtype')->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('followtype', 'desc')->get();
			$count = $recaps->count();
			$view = View::make('recaps.recaps', array('recaps' => $recaps->toArray(), 'count' => $count ));
			return $view;
		}

		public function itemTypeCheck($type)
		{

			switch ($type) {
				case 'parisencours':
					$parisEnCours = $this->showParisEnCours();
					$countParisEnCours = $parisEnCours->getTotal();
					$view = View::make('bet.parisencours', array('parisencours' => $parisEnCours, 'types_resultat' => $this->types_resultat, 'count_paris_encours' => $countParisEnCours));
					return $view;

					break;
				case 'parislongterme':
					$parisLongTerme = $this->showParisLongTerme();
					$countParisLongTerme = $parisLongTerme->getTotal();
					$view = View::make('bet.parislongterme', array('parislongterme' => $parisLongTerme, 'types_resultat' => $this->types_resultat, 'count_paris_longterme' => $countParisLongTerme));
					return $view;

					break;
				case 'paristermine':
					$parisTermine = $this->currentUser->termineParis()->with('selections.equipe1', 'selections.equipe2', 'selections.competition', 'selections.sport', 'selections.typePari', 'tipster', 'compte.bookmaker')->orderBy('created_at','DESC')->get();
					$countParisTermine = $parisTermine->count();
					$view = View::make('bet.paristermine', array('paristermine' => $parisTermine, 'types_resultat' => $this->types_resultat, 'count_paris_termine' => $countParisTermine));
					return $view;

					break;
				default:
					throw new Exception('Invalid type(parisencours|parislongterme) passed');
			}
		}

		function getBetInformations()
		{
			Clockwork::info(Input::all());
		}
	}