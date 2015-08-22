<?php

	class CouponController extends BaseController
	{

		public function __construct()
		{
			parent::__construct();
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			return View::make('coupons.index');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			return View::make('coupons.create');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function show($id)
		{
			return View::make('coupons.show');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function edit($id)
		{
			return View::make('coupons.edit');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function update($id)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function destroy($id)
		{
			$coupon = Coupon::where('session_id', Session::getId())->where('id', $id)->first();
			$coupon->delete();
		}

		public function setAffichage($market_id)
		{
			// affectation du numero d'affichage selon le type de pari.
			// 1 , 'pick'
			// 2 , 'pick doubleparam1'
			// 3 , 'pick, parametername1 doubleparam1
			// 4 , 'pick, doubleparam1-doubleparam2 minutes'
			// 5 , 'parametername1 doubleparam1' avec '+'
			// 6 , 'pick Top doubleparam1'
			$affichage_num = '';
			if ($market_id == '43') {
				return 1;
			} elseif ($market_id == '7') {
				return 1;
			} elseif ($market_id == '8') {
				return 3;
			} elseif ($market_id == '9') {
				return 1;
			} elseif ($market_id == '28') {
				return 6;
			} elseif ($market_id == '48') {
				return 2;
			} elseif ($market_id == '46') {
				return 1;
			} elseif ($market_id == '47') {
				return 7;
			} elseif ($market_id == '158') {
				return 1;
			} elseif ($market_id == '145') {
				return 1;
			} elseif ($market_id == '77') {
				return 8;
			} elseif ($market_id == '79') {
				return 1;
			} elseif ($market_id == '150') {
				return 1;
			} elseif ($market_id == '151') {
				return 1;
			} elseif ($market_id == '118') {
				return 2;
			} elseif ($market_id == '112') {
				return 1;
			} elseif ($market_id == '24') {
				return 1;
			} elseif ($market_id == '12') {
				return 1;
			} elseif ($market_id == '140') {
				return 1;
			} elseif ($market_id == '94') {
				return 4;
			} elseif ($market_id == '39') {
				return 5;
			}  else {
				return 0;
			}
		}

		public function postManualSelections()
		{
			$regles = array(
				'date' => 'required|date_format:d-m-Y H:i',
				'sport' => 'required|exists:sports,id',
				'competition' => 'required|exists:competitions,id',
				'market' => 'required|exists:markets,id',
				'scope' => 'required|exists:scopes,id',
				'team1' => 'sometimes|required|exists:equipes,id',
				'team2' => 'sometimes|required|exists:equipes,id',
				'pick' => 'required|pick_validation:' . Input::get('market'),
				'odd_doubleParam' => 'sometimes|required|oddParam_validation:' . Input::get('market'),
				'odd_doubleParam2' => 'sometimes|required|oddParam2_validation:' . Input::get('market'),
				'odd_doubleParam3' => 'sometimes|required|oddParam3_validation:' . Input::get('market'),
				'odd_participantParameterName' => 'sometimes|required|participantParameter_validation:' . Input::get('market'),
				'bookmaker' => 'required|exists:bookmakers,id',
				'odd_value' => 'required|european_odd',
				'live' => 'required|in:0,1',
				'score' => 'required_if:live,1',
			);

			$messages = array();

			$validator = Validator::make(Input::all(), $regles, $messages);
			Clockwork::info($validator->getData());
			if ($validator->fails()) {
				$array = $validator->getMessageBag()->toArray();
				return Response::json(array(
					'etat' => 0,
					'errors' => $array,
				));
			} else {

				// creation dans la base ou récuperation avant d'instancier un nouveau coupon.
				$date = Carbon::createFromFormat('d-m-Y H:i', Input::get('date'));
				$date->setToStringFormat('Y-m-d H:i');
				$sport = Sport::find(Input::get('sport'));
				$competition = Competition::find(Input::get('competition'));
				$competition_country = Country::find($competition->country_id);
				$market = Market::find(Input::get('market'));
				$scope = Scope::find(Input::get('scope'));
				$pick = Input::get('pick');
				$bookmaker = Bookmaker::find(Input::get('bookmaker'));
				$odd_value = Input::get('odd_value');
				$home_team = Input::exists(array('team1')) ? Equipe::find(Input::get('team1')) : null;
				$away_team = Input::exists(array('team2')) ? Equipe::find(Input::get('team2')) : null;
				$odd_doubleParam = Input::exists(array('odd_doubleParam')) ? Input::get('odd_doubleParam') : null;

				$coupon = new Coupon(array(
					'pick' => $pick,
					'scope' => $scope->name,
					'scope_id' => $scope->id,
					'bookmaker' => $bookmaker->nom,
					'bookmaker_id' => $bookmaker->id,
					'odd_value' => $odd_value,
					'odd_doubleParam' => $odd_doubleParam,
					'odd_doubleParam2' => Input::exists('odd_doubleParam2') ? Input::get('odd_doubleParam2') : null,
					'odd_doubleParam3' => Input::exists('odd_doubleParam3') ? Input::get('odd_doubleParam3') : null,
					'odd_participantParameterName' => Input::exists('odd_participantParameterName') ? Input::get('odd_participantParameterName') : null,
					'odd_participantParameterName2' => Input::exists('odd_participantParameterName2') ? Input::get('odd_participantParameterName2') : null,
					'odd_participantParameterName3' => Input::exists('odd_participantParameterName3') ? Input::get('odd_participantParameterName3') : null,
					'odd_groupParam' => Input::exists('odd_groupParam') ? Input::get('odd_groupParam') : null,
					'market_id' => $market->id,
					'market' => $market->name,
					'game_time' => $date,
					'game_id' => null,
					'game_name' => Input::exists(array('team1', 'team2')) ? $home_team->name . ' - ' . $away_team->name : null,
					'sport_id' => $sport->id,
					'sport_name' => $sport->name,
					'league_id' => $competition->id,
					'league_name' => $competition->name,
					"event_country_name" => $competition_country->name,
					"home_team" => Input::exists(array('team1')) ? Equipe::find(Input::get('team1'))->name : null,
					"home_team_country_name" => Input::exists(array('team1')) ? $home_team->country()->first()->name : null,
					"away_team" => Input::exists(array('team2')) ? Equipe::find(Input::get('team2'))->name : null,
					"away_team_country_name" => Input::exists(array('team2')) ? $away_team->country()->first()->name : null,
					"score" => Input::exists('score') ? Input::get('score') : null,
					"isLive" => Input::exists('live') ? Input::get('live') : null,
					"isMatch" => $market->isMatch,
					"session_id" => Session::getId(),
					"affichage" => $this->setAffichage($market->id)
				));
				Clockwork::info($coupon);
				$coupon->save();
			}
		}

		public function postAutomaticSelections()
		{

			// données a entrer dans la bd dans le but de grossir la bd.
			$bookmaker = Bookmaker::firstOrCreate(array('nom' => Input::get('bookmaker')));
			$sport = Sport::firstOrCreate(array('name' => Input::get('sport_Name')));
			$event_country = Country::firstOrCreate(array('name' => Input::get('event_country_name')));
			$home_country = Input::exists('home_team') ? Country::firstOrCreate(array('name' => Input::get('home_team_country_name'))) : null;
			$away_country = Input::exists('away_team') ? Country::firstOrCreate(array('name' => Input::get('away_team_country_name'))) : null;
			$competition = Competition::firstOrCreate(array('name' => Input::get('league_name'), 'sport_id' => $sport->id, 'country_id' => $event_country->id));
			$home_team = Input::exists('home_team') ? Equipe::firstOrCreate(array('name' => Input::get('home_team'), 'sport_id' => $sport->id, 'country_id' => $home_country->id)) : null;
			$away_team = Input::exists('away_team') ? Equipe::firstOrCreate(array('name' => Input::get('away_team'), 'sport_id' => $sport->id, 'country_id' => $away_country->id)) : null;

			$market = Market::firstOrCreate(array('id' => Input::get('market_id'))); // le nom peut etre change du coté de betbrain donc on recherche uniquement par id.
			$market->name = Input::get('market'); // donc du coup on met a jour le nom du market si il y a eu une nouvelle creation ou mise à jour si betbrain a décidé de changer le nom du market.
			$market->save();

			$scope = Scope::firstOrCreate(array('name' => Input::get('scope'))); // recherche par nom parceque betbrain peut envoyer un scope qui a 0 en id ce qui fait buguer l appli.

			if(Input::exists('home_team')){ $competition->equipes()->save($home_team);}
			if(Input::exists('away_team')){ $competition->equipes()->save($away_team);}

			$sport->markets()->save($market);
			$sport->scopes()->save($scope);


			// verification si l'input islive existe et ensuite suivant si c true ou false.
			$isLive = '';
			if(Input::exists('isLive')){
				if(Input::get('isLive') == 'true'){
					$isLive = 1;
				}else{
					$isLive = 0;
				}
			}else{
				$isLive = 0;
			}

			$coupon = new Coupon(array(
				'pick' => Input::get('pick'),
				'scope' => Input::get('scope'),
				'scope_id' => Input::get('scope_id'),
				'bookmaker' => Input::get('bookmaker'),
				'bookmaker_id' => Input::get('bookmaker_id'),
				'odd_value' => Input::get('odd_value'),
				'odd_doubleParam' => Input::get('odd_doubleParam') == "-999.888" ? null : Input::get('odd_doubleParam'),
				'odd_doubleParam2' => Input::get('odd_doubleParam2') == "-999.888" ? null : Input::get('odd_doubleParam2'),
				'odd_doubleParam3' => Input::get('odd_doubleParam3') == "-999.888" ? null : Input::get('odd_doubleParam3'),
				'odd_participantParameterName' => Input::exists('odd_participantParameterName') == "-9223372036854775808" ? null : Input::get('odd_participantParameterName') ,
				'odd_participantParameterName2' => Input::exists('odd_participantParameterName2') == "-9223372036854775808" ? null : Input::get('odd_participantParameterName2'),
				'odd_participantParameterName3' => Input::exists('odd_participantParameterName3') == "-9223372036854775808" ? null : Input::get('odd_participantParameterName3'),
				'odd_groupParam' => Input::get('odd_groupParam') == "-999.888" ? null : Input::get('odd_groupParam'),
				'market_id' => Input::get('market_id'),
				'market' => Input::get('market'),
				'game_time' => Input::get('game_time'),
				'game_id' => Input::get('game_id'),
				'game_name' => Input::get('game_name'),
				'sport_id' => Input::get('sport_id'),
				'sport_name' => Input::get('sport_Name'),
				'league_id' => Input::get('league_id'),
				'league_name' => Input::get('league_name'),
				"event_country_name" => Input::get('event_country_name'),
				"home_team" => Input::exists('home_team') ?  Input::get('home_team') : null,
				"home_team_country_name" => Input::exists('home_team_country_name') ?  Input::get('home_team_country_name') : null,
				"away_team" => Input::exists('away_team') ?  Input::get('away_team') : null,
				"away_team_country_name" => Input::exists('away_team_country_name') ?  Input::get('away_team_country_name') : null,
				"score" => Input::exists('score') ? Input::get('score') : null,
				"isLive" => $isLive,
				"isMatch" => Input::get('isMatch') == 'true' ? 1 : 0,
				"session_id" => Input::get('userSessionId'),
				"affichage" => $this->setAffichage(Input::get('market_id'))
			));
			$coupon->save();
			file_put_contents('log_index.txt', json_encode(Input::all()) . "\n\n", FILE_APPEND | LOCK_EX);
			file_put_contents('log_index.txt', json_encode($coupon) . "\n\n", FILE_APPEND | LOCK_EX);
			return 1;
		}

		public function getSelections()
		{
			$selections_coupon = Coupon::where('session_id', Session::getId())->get();
			$count = $selections_coupon->count();

			$view = View::make('bet/auto_form_selections', array(
				'selections' => $selections_coupon,
				'count' => $count
			));

			$array_msg = array();
			$bookmaker_select = '';

			// gestion des ereurs.
			if ($count > 0) {
				$bookmaker_temp = $selections_coupon->first()->bookmaker;
				$bookmaker_select = Bookmaker::where('nom', $bookmaker_temp)->first();
				/*$bookmaker_comptes = $comptes_count = $this->currentUser->comptes()->whereHas('bookmaker', function ($query) use($bookmaker_temp){
					$query->where('nom', $bookmaker_temp);
				})->where('deleted_at', NULL)->count();*/

				if (!$bookmaker_select) {

					// creation d'un nouveau bookmaker dans la base de données si aucun bookmaker n'a ete trouvé.
					$new_bookmaker = new Bookmaker(array(
						'nom' => $bookmaker_temp
					));
					$new_bookmaker->save();
					$bookmaker_select = $new_bookmaker;
				}

				/*if(!$bookmaker_comptes){
					array_push($array_msg, 'Aucun compte n\'a été crée pour ce bookmaker, rendez vous dans la page configuration pour le créer');
				}*/

				// inits
				$game_id_temp = -1;
				$bookmaker = '';
				$game_error_count = 0;
				$bookmaker_error_count = 0;

				foreach ($selections_coupon as $selection_coupon) {
					$bookmaker = $selection_coupon->bookmaker;
					$game_id = $selection_coupon->game_id;

					// verification des game id soit differents si il y a plusieurs selections.
					if ($game_id_temp == $game_id) {
						$game_error_count += 1;
					}

					// verification des bookmakers soit le meme si il y a plusieurs selections.
					if ($bookmaker_temp != $bookmaker) {
						$bookmaker_error_count += 1;
					}
					$game_id_temp = $selection_coupon->game_id;
				}
				if ($game_error_count > 0) {
					array_push($array_msg, 'Il n\'est pas possible de selectionner deux fois le meme pari');
				}
				if ($bookmaker_error_count > 0) {
					array_push($array_msg, 'Le bookmaker doit etre le meme pour toutes les selections');
				}
				if ($bookmaker_error_count > 0 || $game_error_count > 0) {
					array_push($array_msg, 'Veuillez supprimer les selections concernées');
				}
			}

			// return
			return Response::json(array(
				'vue' => $view->render(),
				'bookmaker_id' => $bookmaker_select != '' ? $bookmaker_select->id : '',
				'msg' => $array_msg,
				'count' => $count
			));
		}



	}
