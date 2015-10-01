<?php

class BettorController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('ajax', array('only' => array('getMyTipstersViewList','getMyTipstersOnAutoComplete','getMyBookmakersViewList')));

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

	public function getMyBookmakers()
	{
		$allbookmakers = Bookmaker::all();
		return View::make('pages.bookmakers', array('allbookmakers' => $allbookmakers));
	}

	public function getMyBookmakersViewList()
	{
		// pour afficher les lignes non softdelete dans une table pivot il faut faire ca manuellement avec whereNull.
			$bookmakers = Auth::user()->bookmakers()->orderBy('nom', 'asc')->whereNull('deleted_at')->get();
		Clockwork::info($bookmakers);
		$view = View::make('bookmakers.listeBookmakers', array('bookmakers' => $bookmakers));
		return $view;
	}



}
