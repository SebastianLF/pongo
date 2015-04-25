<?php

	class AjaxController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$this->userid = Auth::user()->id;
			$this->user = User::find($this->userid);
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */

		public function getAllSports()
		{
			$q = Input::get('q');
			$sports = Sport::select('id', 'name AS text','logo')->where('name', 'LIKE', '%' . $q . '%')->orderBy('name')->get();
			return Response::json($sports);
		}


		public function getAllCompetitions()
		{
			$q = Input::get('q');
			$competitions = Competition::select('id', 'name AS text')->where('name', 'LIKE', '%' . $q . '%')->get();
			return Response::json($competitions);
		}

		public function getAutocompleteSports()
		{
			$term = Input::get('term');
			$sports = Sport::where('name', 'LIKE', "%$term%")->get();
			Clockwork::info($sports);
			foreach ($sports as $sport) {
				$sportsfinal[] = ["value" => $sport->name, "desc" => $sport->name];
			}
			Clockwork::info($sportsfinal);
			return Response::json($sportsfinal);
		}


	}