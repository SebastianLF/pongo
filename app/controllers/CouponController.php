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

		public function setAffichage($market_id, $pick = null, $odd_doubleParam = null){
			// affectation du numero d'affichage selon le type de pari.
			// 1 , 'pick'
			// 2 , 'pick doubleparam'
			// 3 , 'pick, parametername1 doubleparam1
			// 4 , 'pick, doubleparam1-doubleparam2 minutes'
			// 5 , 'parametername1 doubleparam1' avec '+'
			// 6 , 'pick Top doubleparam1'
			$affichage_num = '';
			if ($market_id == '43') {
				return $affichage_num = 1;
			}elseif ($market_id == '7') {
				return $affichage_num = 6;
			}elseif ($market_id == '28') {
				return $affichage_num = 6;
			}  elseif ($market_id == '48') {
				return $affichage_num = 2;
			} elseif ($market_id == '46') {
				return $affichage_num = 1;
			} elseif ($market_id == '47') {
				return $affichage_num = 7;
			} elseif ($market_id == '8') {
				if ($pick == $odd_doubleParam) {
					return $affichage_num = 2;
				} else {
					return $affichage_num = 3;
				}
			} elseif ($market_id == '158') {
				return $affichage_num = 1;
			} elseif ($market_id == '145') {
				return $affichage_num = 1;
			} elseif ($market_id == '77') {
				return $affichage_num = 8;
			} elseif ($market_id == '79') {
				return $affichage_num = 1;
			} elseif ($market_id == '150') {
				return $affichage_num = 1;
			} elseif ($market_id == '151') {
				return $affichage_num = 1;
			} elseif ($market_id == '118') {
				return $affichage_num = 2;
			} elseif ($market_id == '112') {
				return $affichage_num = 1;
			} elseif ($market_id == '24') {
				return $affichage_num = 1;
			} elseif ($market_id == '12') {
				return $affichage_num = 1;
			} elseif ($market_id == '140') {
				return $affichage_num = 1;
			} elseif ($market_id == '94') {
				return $affichage_num = 4;
			} elseif ($market_id == '39') {
				return $affichage_num = 5;
			} elseif ($market_id == '9') {
				return $affichage_num = 1;
			}
		}

		public function postSelections()
		{
			$pick = Input::get('pick');
			$scope = Scope::firstOrCreate(array('name' => Input::get('scope')));
			$bookmaker = Bookmaker::firstOrCreate(array('nom' => Input::get('bookmaker')));
			$odd_value = Input::get('odd_value');
			$odd_doubleParam = Input::get('odd_doubleParam');
			$odd_doubleParam2 = Input::get('odd_doubleParam2');
			$odd_doubleParam3 = Input::get('odd_doubleParam3');
			$odd_participantParameterName = Input::get('odd_participantParameterName');
			$odd_participantParameterName2 = Input::get('odd_participantParameterName2');
			$odd_participantParameterName3 = Input::get('odd_participantParameterName3');
			$odd_groupParam = Input::get('odd_groupParam');
			$market = Market::firstOrCreate(array('name' => Input::get('market')));
			$game_time = Input::get('game_time');
			$game_name = Input::get('game_name');
			$sport_name = Input::get('sport_Name');
			$league_name = Input::get('league_name');
			$isMatch = Input::get('isMatch') == 'false' ? false : true;;
			$event_country_name = Input::get('event_country_name');
			$isLive = Input::get('isLive') == 'false' ? false : true;
			if($isMatch == 'true'){
				$home_team = Input::get('home_team');
				$home_team_country_name = Input::get('home_team_country_name');
				$away_team = Input::get('away_team');
				$away_team_country_name = Input::get('away_team_country_name');
				$score = Input::get('score');
			}else{
				$home_team = null;
				$home_team_country_name = null;
				$away_team = null;
				$away_team_country_name = null;
				$score = null;
			}
			$session_id = Input::get('userSessionId');


			$coupon = new Coupon(array(
				'pick' => $pick,
				'scope' => $scope,
				'bookmaker' => $bookmaker,
				'odd_value' => $odd_value,
				'odd_doubleParam' => $odd_doubleParam,
				'odd_doubleParam2' => $odd_doubleParam2,
				'odd_doubleParam3' => $odd_doubleParam3,
				'odd_participantParameterName' => $odd_participantParameterName,
				'odd_participantParameterName2' => $odd_participantParameterName2,
				'odd_participantParameterName3' => $odd_participantParameterName3,
				'odd_groupParam' => $odd_groupParam,
				'market' => $market,
				'game_time' => $game_time,
				'game_name' => $game_name,
				'sport_name' => $sport_name,
				'league_name' => $league_name,
				'event_country_name' => $event_country_name,
				'home_team' => $home_team,
				'home_team_country_name' => $home_team_country_name,
				'away_team' => $away_team,
				'away_team_country_name' => $away_team_country_name,
				'score' => $score,
				'isLive' => $isLive == 'true' ? true : false,
				'isMatch' => $isMatch == 'true' ? true : false,
				'session_id' => $session_id,
				'affichage' => setAffichage($market, $pick, $odd_doubleParam)
			));
			$coupon->save();

			file_put_contents('log_index.txt', json_encode(Input::all()) . "\n\n", FILE_APPEND | LOCK_EX);

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
			if($count > 0){
				$bookmaker_temp = $selections_coupon->first()->bookmaker;
				$bookmaker_select = Bookmaker::where('nom', $bookmaker_temp)->first();
				/*$bookmaker_comptes = $comptes_count = $this->currentUser->comptes()->whereHas('bookmaker', function ($query) use($bookmaker_temp){
					$query->where('nom', $bookmaker_temp);
				})->where('deleted_at', NULL)->count();*/

				if(!$bookmaker_select){

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
					if($game_id_temp == $game_id){
						$game_error_count += 1;
					}

					// verification des bookmakers soit le meme si il y a plusieurs selections.
					if ($bookmaker_temp != $bookmaker) {
						$bookmaker_error_count += 1;
					}
					$game_id_temp = $selection_coupon->game_id;
				}
				if($game_error_count > 0){
					array_push($array_msg, 'Il n\'est pas possible de selectionner deux fois le meme pari');
				}
				if($bookmaker_error_count > 0){
					array_push($array_msg, 'Le bookmaker doit etre le meme pour toutes les selections');
				}
				if($bookmaker_error_count > 0 || $game_error_count > 0){
					array_push($array_msg, 'Veuillez supprimer les selections concernées');
				}
			}

			// return
			return Response::json(array(
				'vue' => $view->render(),
				'bookmaker_id' => $bookmaker_select != '' ? $bookmaker_select->id : '' ,
				'msg' => $array_msg,
				'count' => $count
			));
		}

	}
