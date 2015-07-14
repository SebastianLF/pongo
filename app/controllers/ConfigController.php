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
			$transactions = DB::table('transactions')
				->join('bookmaker_user', 'transactions.bookmaker_user_id', '=', 'bookmaker_user.id')
				->join('users', 'bookmaker_user.user_id', '=', 'users.id')
				->join('bookmakers', 'bookmaker_user.bookmaker_id', '=', 'bookmakers.id')
				->where('users.id', '=', $this->currentUser->id)
				->orderBy('transactions.created_at', 'desc')
				->select('transactions.created_at', 'bookmakers.logo', 'bookmakers.nom' , 'bookmaker_user.nom_compte', 'transactions.type', 'transactions.montant', 'transactions.description')
				->paginate(8);
			Clockwork::info($transactions);
			return $transactions;
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
					$tipsters = User::find($this->currentUser->id)->tipsters()->orderBy('created_at', 'desc')->paginate(5);
					$view = View::make('tipsters.listeTipsters', array('tipsters' => $tipsters ));
					return $view;
					break;

				case 'bookmakers':
					$bookmakers = $this->showBookmakers();
					$view = View::make('bookmakers.listeBookmakers', array('bookmakers' => $bookmakers));
					return $view;
					break;

				case 'transactions':
					$transactions = $this->showTransactions();
					$view = View::make('transactions.listeTransactions', array('transactions' => $transactions));
					return $view;
					break;

				default:
					throw new Exception('Invalid type(tipsters,bookmakers,transactions) passed');
			}


		}

	}
