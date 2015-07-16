<?php

	use Carbon\Carbon;

	class ConfigController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$this->beforeFilter('ajax', array('only' => 'itemTypeCheck'));
		}

		public function getIndex()
		{
			Session::put('iterator', '1');
			$bookmakers = $this->showBookmakers();
			$allbookmakers = Bookmaker::all();
			$transactions = $this->showTransactions();
			$dt = Carbon::now();
			return View::make('pages/config', array(
				'allbookmakers' => $allbookmakers,
				'bookmakers' => $bookmakers,
				'transactions' => $transactions,
				'dt' => $dt,
			)
		);
		}

		public function showBookmakers()
		{
			// pour afficher les lignes non softdelete dans une table pivot il faut faire ca manuellement avec whereNull.
			$bookmakers = $this->currentUser->bookmakers()->orderBy('bookmaker_user.created_at', 'desc')->whereNull('deleted_at')->paginate(5);
			return $bookmakers;
		}

		public function showTransactions()
		{

		}

		/* afficher les comptes bookmaker dans la liste deroulante pour les transactions */
		public function showAllaccounts()
		{
			if (isset($_GET['book_id'])) {
				$accounts = $this->currentUser->bookmakers()->where('bookmaker_user.bookmaker_id', '=', Input::get('book_id'))->whereNull('deleted_at')->get();
				return Response::json($accounts);
			} else {
				return Response::json("aucun bookmaker n\'a ete selectionné", 500);
			}
		}

		public function itemTypeCheck($type)
		{
			switch ($type) {
				case 'tipsters':
					$tipsters = Auth::user()->tipsters()->orderBy('created_at', 'desc')->paginate(5);
					$view = View::make('tipsters.listeTipsters', array('tipsters' => $tipsters ));
					return $view;
					break;

				case 'bookmakers':
					$bookmakers = $this->showBookmakers();
					$view = View::make('bookmakers.listeBookmakers', array('bookmakers' => $bookmakers));
					return $view;
					break;

				default:
					throw new Exception('Invalid type(tipsters,bookmakers,transactions) passed');
			}


		}

	}
