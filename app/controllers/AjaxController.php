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

			$sports = Sport::select('id', 'name AS text', 'logo')->where('name', 'LIKE', '%' . $q . '%')->get();
			return Response::json($sports);
		}


		public function getCompetitions()
		{
			$q = Input::get('q');
			$sport_id = Input::get('sport_id');
			Clockwork::info($sport_id);
			if (isset($sport_id)) {
				$competitions = Competition::select('id', 'name AS text', 'logo')->where('sport_id', $sport_id)->where('name', 'LIKE', '%' . $q . '%')->get();
				return Response::json($competitions);
			} else {
				return Response::json([]);
			}
		}

		public function getMarkets()
		{
			$sport_id = Input::get('sport_id');
			if (isset($sport_id)) {
				$sport = Sport::find($sport_id);
				$markets = isset($sport) ? $sport->markets()->select('markets.id', 'markets.name AS text')->where('name', 'LIKE', '%' . Input::get('q') . '%')->get() : '';
				return Response::json($markets);
			} else {
				return Response::json([]);
			}
		}

		public function getScopes()
		{
			$sport_id = Input::get('sport_id');
			if (isset($sport_id)) {
				$sport = Sport::find($sport_id);
				$markets = isset($sport) ? $sport->scopes()->select('scopes.id', 'scopes.name AS text')->where('name', 'LIKE', '%' . Input::get('q') . '%')->get() : '';
				return Response::json($markets);
			} else {
				return Response::json([]);
			}
		}

		public function getPick()
		{
			$market_id = Input::get('market_id');
			if (isset($market_id)) {
				$market = Sport::find($market_id);
				$markets = isset($market) ? $market->scopes()->select('scopes.id', 'scopes.name AS text')->where('name', 'LIKE', '%' . Input::get('q') . '%')->get() : '';
				return Response::json($markets);
			} else {
				return Response::json([]);
			}
		}


		public function getEquipes()
		{
			$q = Input::get('q');
			$sport_id = Input::get('sport_id');

			if (!empty($sport_id)) {
				$equipes = Equipe::where('sport_id', $sport_id)->where('name', 'LIKE', '%' . $q . '%')->get(array('id', 'equipes.name AS text'));
				return Response::json($equipes);
			} else {
				return Response::json([]);
			}
		}

		public function getBookmakers()
		{
			$bookmakers = Bookmaker::where('nom', 'LIKE', '%' . Input::get('q') . '%')->get(array('bookmakers.id', 'bookmakers.nom AS text'));
			return Response::json($bookmakers);
		}

	}