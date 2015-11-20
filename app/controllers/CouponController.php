<?php

	use Carbon\Carbon;

	class CouponController extends Controller
	{

		public function __construct()
		{
			$this->beforeFilter('auth', array('except' => array('postAutomaticSelections')));
			$this->beforeFilter('csrf', array('only' => array('postManualSelections')));
			$this->beforeFilter('devise_missing', array('except' => array('postAutomaticSelections')));
		}

		public function index()
		{
			return View::make('coupons.index');
		}

		public function create()
		{
			return View::make('coupons.create');
		}

		public function store()
		{
			//
		}

		public function show($id)
		{
			return View::make('coupons.show');
		}

		public function edit($id)
		{
			return View::make('coupons.edit');
		}

		public function update($id)
		{
			//
		}

		public function destroy($id)
		{
			$coupon = Coupon::where('session_id', Session::getId())->where('id', $id)->first();
			$coupon->delete();
		}

		public function setAffichage($market_id)
		{

		}

		public function postManualSelections()
		{
			$regles = array(
				'date' => 'required|date_format:d/m/Y H:i',
				'sport' => 'required|exists:sports,id',
				'competition' => 'required|exists:competitions,id',
				'market' => 'required|exists:markets,id',
				'scope' => 'required|exists:scopes,id',
				'team1' => 'required_if:market,8,9,11,43,46,48|exists:equipes,id',
				'team2' => 'required_if:market,8,9,11,43,46,48|exists:equipes,id',
				'pick' => 'required|pick_validation:' . Input::get('market'),
				'odd_doubleParam' => 'required_if:market,8,48|odd_double_param_validation:' . Input::get('market'),
				'odd_doubleParam2' => 'required_if:market,|odd_double_param2_validation:' . Input::get('market'),
				'odd_doubleParam3' => 'required_if:market,|odd_double_param3_validation:' . Input::get('market'),
				'odd_participantParameterName' => 'required_if:market,8|odd_participant_parametername_validation:' . Input::get('market'),
				'bookmaker' => 'required|exists:bookmakers,id',
				'odd_value' => 'required|european_odd',
				'live' => 'required|in:0,1',
				'score' => 'required_if:live,1',
			);

			$messages = array(
				"market.required" => "type de pari obligatoire.",
				"scope.required" => "Portée du pari obligatoire.",
				"team1.required_if" => "equipe/joueur domicile obligatoire.",
				"team2.required_if" => "equipe/joueur extérieur obligatoire.",
				"pick.required" => "Ce champ est obligatoire pour ce type de pari.",
				"odd_doubleParam.required_if" => "Ce champ est obligatoire pour ce type de pari.",
				"odd_doubleParam2.required_if" => "Ce champ est obligatoire pour ce type de pari.",
				"odd_doubleParam3.required_if" => "Ce champ est obligatoire pour ce type de pari.",
				"odd_participantParameterName.required_if" => "Ce champ est obligatoire pour ce type de pari.",
				"odd_value.required" => "Cote obligatoire.",
				"score.required_if" => "Le champ score est obligatoire lorsque live est coché.",
			);

			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				$array = $validator->getMessageBag()->toArray();
				return Response::json(array(
					'etat' => 0,
					'errors' => $array,
				));
			} else {

				$date = Carbon::createFromFormat('d/m/Y H:i', Input::get('date'), Auth::user()->timezone);
				$date->setTimezone('Europe/Paris');
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
					"isMatch" => Input::exists(array('team1', 'team2')) ? 1 : 0,
					"session_id" => Session::getId(),
				));
				$coupon->save();
			}
		}

		public function postAutomaticSelections()
		{
			$home_team = utf8_encode(Input::get('home_team'));
			$away_team = utf8_encode(Input::get('away_team'));
			$bookmaker = utf8_encode(Input::get('bookmaker'));
			$sport = utf8_encode(Input::get('sport_Name'));
			$event_country = utf8_encode(Input::get('event_country_name'));
			$home_country = utf8_encode(Input::get('home_team_country_name'));
			$away_country = utf8_encode(Input::get('away_team_country_name'));

			// données a entrer dans la bd dans le but de grossir la bd.
			$date = Carbon::createFromFormat('Y-m-d H:i:s', Input::get('game_time'), 'UTC');
			$date->setTimezone('Europe/Paris');
			$bookmaker = Bookmaker::firstOrCreate(array('nom' => utf8_encode(Input::get('bookmaker'))));
			$sport = Sport::firstOrCreate(array('name' => utf8_encode(Input::get('sport_Name'))));
			$event_country = Country::firstOrCreate(array('name' => utf8_encode(Input::get('event_country_name'))));
			$home_country = Input::exists('home_team') ? Country::firstOrCreate(array('name' => utf8_encode(Input::get('home_team_country_name')))) : null;
			$away_country = Input::exists('away_team') ? Country::firstOrCreate(array('name' => utf8_encode(Input::get('away_team_country_name')))) : null;
			$competition = Competition::firstOrCreate(array('name' => utf8_encode(Input::get('league_name')), 'sport_id' => $sport->id, 'country_id' => $event_country->id));
			$home_team = Input::exists('home_team') ? Equipe::firstOrCreate(array('name' => utf8_encode(Input::get('home_team')), 'sport_id' => $sport->id, 'country_id' => $home_country->id)) : null;
			$away_team = Input::exists('away_team') ? Equipe::firstOrCreate(array('name' => utf8_encode(Input::get('away_team')), 'sport_id' => $sport->id, 'country_id' => $away_country->id)) : null;

			$market = Market::find(Input::get('market_id'));
			if (is_null($market)) {
				$market = Market::firstOrCreate(array('id' => Input::get('market_id'), 'name' => utf8_encode(Input::get('market')))); // le nom peut etre change du coté de betbrain donc on recherche uniquement par id.
			}

			$scope = Scope::firstOrCreate(array('name' => utf8_encode(Input::get('scope')))); // recherche par nom parceque betbrain peut envoyer un scope qui a 0 en id ce qui fait buguer.

			if (Input::exists('home_team')) {
				if (!$competition->equipes->contains($home_team->id)) {
					$competition->equipes()->save($home_team);
				}
			}
			if (Input::exists('away_team')) {
				if (!$competition->equipes->contains($away_team->id)) {
					$competition->equipes()->save($away_team);
				}
			}

			if (!$sport->markets->contains($market->id)) {
				$sport->markets()->save($market);
			}
			if (!$sport->scopes->contains($scope->id)) {
				$sport->scopes()->save($scope);
			}


			// verification si l'input islive existe et ensuite suivant si c true ou false.
			$isLive = '';
			if (Input::exists('isLive')) {
				if (Input::get('isLive') == 'true') {
					$isLive = 1;
				} else {
					$isLive = 0;
				}
			} else {
				$isLive = 0;
			}

			$coupon = new Coupon(array(
				'pick' => utf8_encode(Input::get('pick')),
				'scope' => $scope->name,
				'scope_id' => $scope->id,
				'bookmaker' => $bookmaker->nom,
				'bookmaker_id' => $bookmaker->id,
				'odd_value' => Input::get('odd_value'),
				'odd_doubleParam' => Input::get('odd_doubleParam') == "-999.888" ? null : Input::get('odd_doubleParam'),
				'odd_doubleParam2' => Input::get('odd_doubleParam2') == "-999.888" ? null : Input::get('odd_doubleParam2'),
				'odd_doubleParam3' => Input::get('odd_doubleParam3') == "-999.888" ? null : Input::get('odd_doubleParam3'),
				'odd_participantParameterName' => Input::exists('odd_participantParameterName') == "-9223372036854775808" ? null : utf8_encode(Input::get('odd_participantParameterName')),
				'odd_participantParameterName2' => Input::exists('odd_participantParameterName2') == "-9223372036854775808" ? null : utf8_encode(Input::get('odd_participantParameterName2')),
				'odd_participantParameterName3' => Input::exists('odd_participantParameterName3') == "-9223372036854775808" ? null : utf8_encode(Input::get('odd_participantParameterName3')),
				'odd_groupParam' => Input::get('odd_groupParam') == "-999.888" ? null : Input::get('odd_groupParam'),
				'market_id' => $market->id,
				'market' => $market->name,
				'game_time' => $date,
				'game_id' => Input::get('game_id'),
				'game_name' => utf8_encode(Input::get('game_name')),
				'sport_id' => $sport->id,
				'sport_name' => $sport->name,
				'league_id' => $competition->id,
				'league_name' => $competition->name,
				"event_country_name" => $event_country->name,
				"home_team" => Input::exists('home_team') ? $home_team->name : null,
				"home_team_country_name" => Input::exists('home_team_country_name') ? $home_country->name : null,
				"away_team" => Input::exists('away_team') ? $away_team->name : null,
				"away_team_country_name" => Input::exists('away_team_country_name') ? $away_country->name : null,
				"score" => Input::get('score') != 'null' ? Input::get('score') : NULL,
				"isLive" => $isLive,
				"isMatch" => Input::get('isMatch') == 'true' ? 1 : 0,
				"session_id" => Input::get('userSessionId'),
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
			return array(
				'vue' => (string)$view,
				'bookmaker_id' => $bookmaker_select != '' ? $bookmaker_select->id : '',
				'msg' => $array_msg,
				'count' => $count
			);
		}

	}
