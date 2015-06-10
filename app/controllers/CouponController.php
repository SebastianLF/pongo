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

		public function postSelections()
		{

			$pick = Input::get('pick');
			$scope = Input::get('scope');
			$scope_id = Input::get('scope_id');
			$bookmaker = Input::get('bookmaker');
			$bookmaker_id = Input::get('bookmaker_id');
			$odd_value = Input::get('odd_value');
			$odd_doubleParam = Input::get('odd_doubleParam');
			$odd_doubleParam2 = Input::get('odd_doubleParam2');
			$odd_doubleParam3 = Input::get('odd_doubleParam3');
			$odd_participantParameter = Input::get('odd_participantParameter');
			$odd_participantParameter2 = Input::get('odd_participantParameter2');
			$odd_participantParameter3 = Input::get('odd_participantParameter3');
			$odd_participantParameterName = Input::get('odd_participantParameterName');
			$odd_participantParameterName2 = Input::get('odd_participantParameterName2');
			$odd_participantParameterName3 = Input::get('odd_participantParameterName3');
			$odd_groupParam = Input::get('odd_groupParam');
			$market = Input::get('market');
			$market_id = Input::get('market_id');
			$game_time = Input::get('game_time');
			$game_id = Input::get('game_id');
			$game_name = Input::get('game_name');
			$sport_id = Input::get('sport_id');
			$sport_name = Input::get('sport_Name');
			$league_id = Input::get('league_id');
			$league_name = Input::get('league_name');
			$home_team = Input::get('home_team');
			$away_team = Input::get('away_team');
			$score = Input::get('score');
			$isLive = Input::get('isLive');
			$session_id = Input::get('userSessionId');

			// affectation du numero d'affichage selon le type de pari.
			// 1 , 'pick'
			// 2 , 'pick doubleparam'
			// 3 , 'pick, parametername1 doubleparam
			// 4 , 'pick, doubleparam1 - doubleparam2 minutes'
			$affichage_num = '';
			if ($market_id == '43') {
				$affichage_num = 1;
			} elseif ($market_id == '48') {
				$affichage_num = 2;
			} elseif ($market_id == '47') {
				$affichage_num = 2;
			} elseif ($market_id == '8') {
				if ($pick == $odd_doubleParam) {
					$affichage_num = 2;
				} else {
					$affichage_num = 3;
				}
			} elseif ($market_id == '158') {
				$affichage_num = 1;
			} elseif ($market_id == '145') {
				$affichage_num = 1;
			} elseif ($market_id == '79') {
				$affichage_num = 1;
			} elseif ($market_id == '150') {
				$affichage_num = 1;
			} elseif ($market_id == '151') {
				$affichage_num = 1;
			} elseif ($market_id == '118') {
				$affichage_num = 2;
			} elseif ($market_id == '112') {
				$affichage_num = 1;
			} elseif ($market_id == '24') {
				$affichage_num = 1;
			} elseif ($market_id == '12') {
				$affichage_num = 1;
			} elseif ($market_id == '140') {
				$affichage_num = 1;
			} elseif ($market_id == '94') {
				$affichage_num = 4;
			}


			$coupon = new Coupon(array(
				'pick' => $pick,
				'scope' => $scope,
				'scope_id' => $scope_id,
				'bookmaker' => $bookmaker,
				'bookmaker_id' => $bookmaker_id,
				'odd_value' => $odd_value,
				'odd_doubleParam' => $odd_doubleParam,
				'odd_doubleParam2' => $odd_doubleParam2,
				'odd_doubleParam3' => $odd_doubleParam3,
				'odd_participantParameter' => $odd_participantParameter,
				'odd_participantParameter2' => $odd_participantParameter2,
				'odd_participantParameter3' => $odd_participantParameter3,
				'odd_participantParameterName' => $odd_participantParameterName,
				'odd_participantParameterName2' => $odd_participantParameterName2,
				'odd_participantParameterName3' => $odd_participantParameterName3,
				'odd_groupParam' => $odd_groupParam,
				'market' => $market,
				'market_id' => $market_id,
				'game_time' => $game_time,
				'game_id' => $game_id,
				'game_name' => $game_name,
				'sport_id' => $sport_id,
				'sport_name' => $sport_name,
				'league_id' => $league_id,
				'league_name' => $league_name,
				'home_team' => $home_team,
				'away_team' => $away_team,
				'score' => $score,
				'isLive' => $isLive,
				'session_id' => $session_id,
				'affichage' => $affichage_num
			));
			$coupon->save();

			file_put_contents('log_index.txt', json_encode(Input::all()) . "\n", FILE_APPEND | LOCK_EX);
			file_put_contents('log_index.txt', json_encode($coupon) . "\n\n", FILE_APPEND | LOCK_EX);

			return 1;
		}

		public function getSelections()
		{
			$selections_coupon = Coupon::where('session_id', Session::getId())->get();
			return View::make('bet/auto_form_selections', array(
				'selections' => $selections_coupon
			));
		}

	}
