<?php


	class BookmakerController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('ajax', array('only' => array('showComptes')));
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			// pour afficher les lignes non softdelete dans une table pivot il faut faire ca manuellement avec whereNull.
			$bookmakers = Auth::user()->bookmakers()->orderBy('bookmaker_user.created_at', 'desc')->whereNull('deleted_at')->get();
			return View::make('pages.bookmakers', array('bookmakers' => $bookmakers));
		}


		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			//
		}


		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			$regles = array(
				'name_bookmaker' => 'required|exists:bookmakers,id',
				'name_account' => 'required|max:20|unique:bookmaker_user,nom_compte,NULL,id,user_id,' . Auth::user()->id,
				'amount_bookmaker' => 'required|decimal>0',
			);
			$messages = array(
				'name_bookmaker.required' => 'Le bookmaker doit être obligatoire.',
				'name_bookmaker.exists' => "Ce bookmaker n'existe pas.",
				'name_account.required' => 'Vous devez specifier un nom ou un n° de compte.',
				'name_account.max' => 'Taille maximum : 20 caractères.',
				'name_account.unique' => 'Ce nom ou n° de compte existe déja ou à deja existé.',
				'amount_bookmaker.required' => "Vous devez entrer un montant actuel. ",
			);

			$validator = Validator::make(Input::all(), $regles, $messages);

			if ($validator->fails()) {
				return Response::json(array(
					'state' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {
				$book = Bookmaker::find(Input::get('name_bookmaker'));

				// ajout dans la table pivot.
				Auth::user()->bookmakers()->attach($book->id, array('nom_compte' => Input::get('name_account'), 'bankroll_actuelle' => Input::get('amount_bookmaker')));

				return Response::json(
					array(
						'state' => true
					)
				);
			}
		}


		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function show($id)
		{
			//
		}


		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function edit($id)
		{
			$allbookmakers = $this->showBookmakers();
			$bookmaker = Auth::user()->bookmakers()->where('bookmaker_user.id', '=', $id)->first();
			return View::make('bookmakers.bookmakeredit', array('bookmaker' => $bookmaker, 'allbookmakers' => $allbookmakers));
		}


		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function update($id)
		{
			$regles = array(
				'idAccountEditInput' => 'required|exists:bookmaker_user,id,user_id,' . Auth::user()->id,
				'name_account' => 'required|unique:bookmaker_user,nom_compte,' . $id . ',id,user_id,' . Auth::user()->id,
			);

			$messages = array(
				'name_account.required' => 'Vous devez entrer un nom ou un n° de compte.',
				'name_account.unique' => 'Ce nom ou n° de compte existe déja ou à deja existé.',
				'idAccountEditInput.required' => 'L\'id du compte n\'est pas renseigné.',
				'idAccountEditInput.exists' => 'Ce compte ne vous appartient pas.',
			);

			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				return Response::json(array(
					'state' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {

				$account = Auth::user()->comptes()->where('id', Input::get('idAccountEditInput'))->first();
				$account->nom_compte = Input::get('name_account');
				$account->save();

				return Response::json(array(
					'state' => true
				));
			}
		}


		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function destroy($id)
		{
			$compte = Auth::user()->comptes()->where('id', $id)->first();
			if (!is_null($compte)) {
				if ($compte->enCoursParis()->count() >= 1) {
					return Response::json(array(
						'state' => 0,
						'compte' => $compte
					));
				} else {
					$compte->delete();
					return Response::json(array(
						'state' => 1,
						'compte' => $compte
					));
				}
			}else{
				return Response::json(array(
					'state' => 0,
				));
			}

		}

		public function showAllBookmakers()
		{
			$bookmakers = Bookmaker::all(array('bookmakers.id', 'bookmakers.nom AS text'));
			return Response::json($bookmakers);
		}

		public function getMyBookmakers()
		{
			$nom = Input::get('q');
			$allbookmakers = Auth::user()->bookmakers()->whereHas('comptes', function ($query) {
				$query->where('user_id', Auth::user()->id);
			})->where('nom', 'LIKE', '%' . $nom . '%')->groupBy('nom')->get(array('bookmakers.id', 'bookmakers.nom AS text'));
			return Response::json($allbookmakers);
		}

		public function showComptes()
		{
			$bookmakers = Bookmaker::whereHas('comptes', function ($query) {
				$query->where('user_id', Auth::user()->id);
			})->with(array('comptes' => function ($query) {
				$query->where('bookmaker_user.user_id', Auth::user()->id);
			}))->get();
			$view = View::make('dashboard.bookmakers', array('bookmakers' => $bookmakers));
			return $view;
		}

		public function showMyAccounts()
		{
			$book_id = Input::get('book_id');
			$accounts = Auth::user()->bookmakers()->where('bookmaker_user.bookmaker_id', '=', $book_id)->whereNull('deleted_at')->get(array('bookmaker_user.id', 'bookmaker_user.nom_compte AS text'));
			return Response::json($accounts);

		}

		function updateBookmakerAccountOnForm(){
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
