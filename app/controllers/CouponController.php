<?php

class CouponController extends BaseController {

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
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('coupons.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('coupons.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

	public function postSelections(){
		$pick = Input::get('pick');
		$scope = Input::get('scope');
		$scope_id = Input::get('scope_id');
		$bookmaker = Input::get('bookmaker');
		$bookmaker_id = Input::get('bookmaker_id');
		$odd_value = Input::get('odd_value');
		$market = Input::get('market');
		$market_id = Input::get('market_id');
		$game_time = Input::get('game_time');
		$game_id = Input::get('game_id');
		$game_name = Input::get('game_name');
		$sport_id = Input::get('sport_id');
		$sport_name = Input::get('sport_name');
		$league_id = Input::get('league_id');
		$league_name = Input::get('league_name');
		$home_team = Input::get('home_team');
		$away_team = Input::get('away_team');
		$isLive = Input::get('isLive');

		$coupon = new Coupon(array(
			'pick' => $pick,
			'scope' => $scope,
			'scope_id' => $scope_id,
			'bookmaker' => $bookmaker,
			'bookmaker_id' => $bookmaker_id,
			'odd_value' => $odd_value,
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
			'isLive' => $isLive
		));

		$coupon->save();

		{{file_put_contents('log_index.txt', json_encode(Input::all()) . "\n" , FILE_APPEND | LOCK_EX) ;}}
		/*$view = View::make('bet.auto_form_selections', array('inputs' => $infos));
		return $view;*/
	}

	public function getSelections(){

	}

}
