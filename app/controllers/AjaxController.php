<?php

	class AjaxController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */

		public function getSports()
		{
			$q = Input::get('q');


			$sports = Sport::select('id', 'name AS text', 'logo')->where('name', 'LIKE', '%' . $q . '%')->orderBy('name')->get();
			return Response::json($sports);


		}


		public function getCompetitions()
		{
			$q = Input::get('q');
			$sport_id = Input::get('sport_id');
			if (empty($sport_id)) {
				$competitions = Competition::select('id', 'name AS text', 'logo')->where('name', 'LIKE', '%' . $q . '%')->get();
				return Response::json($competitions);
			} else {
				$competitions = Competition::select('id', 'name AS text', 'logo')->where('sport_id',$sport_id)->where('name', 'LIKE', '%' . $q . '%')->get();
				return Response::json($competitions);
			}
		}

		public function getMarkets()
		{
			$q = Input::get('q');
			$sport_id = Input::get('sport_id');
			Clockwork::info($sport_id);
			if(!is_null($sport_id)){
				$sport = Sport::find($sport_id);
				$markets = isset($sport) ? $sport->markets()->select('markets.id', 'markets.name AS text')->where('name', 'LIKE', '%' . $q . '%')->get() : '';
				return Response::json($markets);
			}
		}

		public function getEquipes()
		{
			$q = Input::get('q');
			return Response::json('');
			/*$adversaire_id = Input::get('adversaire_id');
			$competition_id = Input::get('competition_id');
			$competition = Competition::find($competition_id);
			if (isset($competition_id)) {
				$equipes = '';
				return Response::json($equipes);
			} else {
				if(empty($adversaire_id)){
					$equipes = $competition->equipes()->where('name', 'LIKE', '%' . $q . '%')->get(array('equipes.id', 'equipes.name AS text', 'equipes.logo'));
					return Response::json($equipes);
				}else{
					$equipes = $competition->equipes()->where('equipes.id', '!=', $adversaire_id)->where('name', 'LIKE', '%' . $q . '%')->get(array('equipes.id', 'equipes.name AS text', 'equipes.logo'));
					return Response::json($equipes);
				}

			}*/
		}



	}