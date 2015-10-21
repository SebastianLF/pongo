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
		Clockwork::info($tipsters);
		return View::make('tipsters.listeTipsters', array('tipsters' => $tipsters));
	}

	public function getMyTipstersOnAutoComplete()
	{
		$nom = Input::get('q');
		$tipsters = Auth::user()->tipsters()->where('name', 'LIKE', '%' . $nom . '%')->get(array('id', 'name AS text', 'montant_par_unite', 'followtype'));
		return Response::json($tipsters);
	}

	public function getMyBookmakersPage()
	{
		$allbookmakers = Bookmaker::all();
		return View::make('pages.bookmakers', array('allbookmakers' => $allbookmakers));
	}

	public function getMyBookmakersViewList()
	{
		// pour afficher les lignes non softdelete dans une table pivot il faut faire ca manuellement avec whereNull.
		$bookmakers = Auth::user()->bookmakers()->whereNull('deleted_at')->get();
		Clockwork::info($bookmakers);
		$view = View::make('bookmakers.listeBookmakers', array('bookmakers' => $bookmakers));
		return $view;
	}

	public function getMyTransactionsViewList()
	{
		$transactions = Auth::user()->transactions()->with(array('compte', 'compte.bookmaker'))->get();
		Clockwork::info($transactions);
		$view = View::make('transactions.listeTransactions', array('transactions' => $transactions));
		return $view;
	}

	// récuperer uniquement les bookmakers qui ont des comptes à moi, pour le formulaire d'ajout de transactions.
	public function getOnlyBookmakersWithAccounts(){
		return Response::json(Bookmaker::whereHas('comptes', function( $query ){
			$query->where('user_id', Auth::user()->id);
		})->get());
	}

	// récuperer les comptes de bookmakers pour le formulaire d'ajout de transactions.
	public function getMyBookmakersAccounts()
	{
		$book_id = Input::get('book_id');
		$accounts = Auth::user()->bookmakers()->where('bookmaker_user.bookmaker_id', '=', $book_id)->whereNull('deleted_at')->get(array('bookmaker_user.id', 'bookmaker_user.nom_compte AS text'));
		return Response::json($accounts);
	}

	// recuperer la vue et les bookmakers pour la page dashboard.
	public function getComptesForDashboard()
	{
		$bookmakers = Bookmaker::whereHas('comptes', function ($query) {
			$query->where('user_id', Auth::user()->id);
		})->with(array('comptes' => function ($query) {
			$query->where('bookmaker_user.user_id', Auth::user()->id);
		}))->get();
		$view = View::make('dashboard.bookmakers', array('bookmakers' => $bookmakers));
		return $view;
	}

	// actualise les comptes relatif au bookmaker, bookmaker correspondant aux selections actuellement dans le panier.
	function getUpdateBookmakerAccountOnForm(){
		$selections_coupon = Coupon::where('session_id', Session::getId())->get();
		if($selections_coupon->count() > 0){
			$bookmaker_id = Bookmaker::where('nom', $selections_coupon->first()->bookmaker)->first()->id;
			$comptes = Auth::user()->comptes()->where('bookmaker_user.bookmaker_id', $bookmaker_id)->get(array('id', 'bookmaker_user.nom_compte AS text'));
			return $comptes;
		}else{
			return '';
		}
	}


}
