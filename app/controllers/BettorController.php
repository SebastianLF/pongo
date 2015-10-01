<?php

class BettorController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getMyTipsters()
	{
		return View::make('pages.tipsters');
	}

	public function getMyTipstersViewList(){
		$tipsters = $tipsters = Auth::user()->tipsters;
		return View::make('tipsters.listeTipsters', array('tipsters' => $tipsters));
	}

	public function getMyTipstersOnAutoComplete()
	{
		$nom = Input::get('q');
		$tipsters = Auth::user()->tipsters()->where('name', 'LIKE', '%' . $nom . '%')->get(array('id', 'name AS text', 'montant_par_unite', 'followtype'));
		return Response::json($tipsters);
	}

}
