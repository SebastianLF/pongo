<?php

	class BookmakerController extends BaseController
	{


		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth', array('only' => array('store', 'edit', 'update', 'destroy')));

		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{

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

			//$typeaccount = Input::get('typeAccountInput');

			Clockwork::info(Input::get('bankrollamountinput'));

			// recherche de l'id du bookmaker.
			$bookname_id = Input::get('booknameselect');
			$bookmaker = DB::table('bookmakers')->where('id', $bookname_id)->first();


			$regles = array(
				'booknameselect' => 'required|exists:bookmakers,id',
				'accountnameinput' => 'required|unique:bookmaker_user,nom_compte,null,id,bookmaker_id,' . $bookmaker->id . ',user_id,' . $this->currentUser->id,
				'bankrollamountinput' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			);
			$messages = array(
				'booknameselect.required' => 'Vous devez specifier un bookmaker',
				'booknameselect.exists' => "ce bookmaker n'existe pas",
				'accountnameinput.required' => 'Vous devez specifier un nom ou un n° de compte',
				'accountnameinput.unique' => 'Ce compte existe deja pour ce bookmaker',
				'bankrollamountinput.required' => "Vous devez specifier une bankroll actuelle",
				'bankrollamountinput.regex' => "la bankroll actuelle doit etre un entier ou un nombre decimal de type 0.00",
			);

			/*Clockwork::info($typeaccount);
			if($typeaccount == 'new'){
				Clockwork::info($validator = Validator::make(Input::except(array('bankrollamountinput')), $regles, $messages));
			}else{
				Clockwork::info($validator = Validator::make(Input::except(array('bankrollinvestedinput','bonusinput')), $regles, $messages));
			}*/

			$validator = Validator::make(Input::all(), $regles, $messages);

			if ($validator->fails()) {
				return Response::json(array(
					'success' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {

				$accountname = Input::get('accountnameinput');
				$bankrollamount = Input::get('bankrollamountinput');

				/*$bankrollinvested = Input::get('bankrollinvestedinput');
				$bonus = Input::get('bonusinput');*/

				/*if($typeaccount == 'new'){$bankrollamount=$bankrollinvested+$bonus;}
				else{$bankrollinvested=$bankrollamount;$bonus=0;}*/

				// ajout dans la table pivot.
				$this->currentUser->bookmakers()->attach($bookmaker->id, array('nom_compte' => $accountname, 'bankroll_actuelle' => $bankrollamount));

				return Response::json(
					array(
						'success' => true
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
			$bookmaker = $this->currentUser->bookmakers()->where('bookmaker_user.id', '=', $id)->first();
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
			$bookmakerid = Input::get('idBookmakerEditInput');

			$regles = array(
				'nameAccountEditInput' => 'required|unique:bookmaker_user,nom_compte,' . $id . ',id,user_id,' . $this->currentUser . ',bookmaker_id,' . $bookmakerid,
			);

			$messages = array(
				'nameAccountEditInput.required' => 'Vous devez specifier un nom ou un n° de compte',
				'nameAccountEditInput.unique' => 'Ce nom ou n° de compte existe deja',
			);

			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				return Response::json(array(
					'success' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {

				$nom_compte = Input::get('nameAccountEditInput');
				DB::table('bookmaker_user')->where('id', $id)->update(array('nom_compte' => $nom_compte));


				return Response::json(array(
					'success' => true
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
			$compte = BookmakerUser::find($id);
			if ($compte->enCoursParis()->count() >= 1) {
				return Response::json(array(
					'success' => 0,
					'compte' => $compte
				));
			} else {
				$compte->delete();
				return Response::json(array(
					'success' => 1,
					'compte' => $compte
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
			$allbookmakers = $this->currentUser->bookmakers()->whereNull('deleted_at')->where('nom', 'LIKE', '%' . $nom . '%')->groupBy('nom')->get(array('bookmakers.id', 'bookmakers.nom AS text'));
			return Response::json($allbookmakers);
		}

		public function showComptes()
		{
			$bookmakers = Bookmaker::whereHas('comptes', function ($query) {
				$query->where('user_id', $this->currentUser->id);
			})->with(array('comptes' => function ($query) {
				$query->where('bookmaker_user.user_id', $this->currentUser->id);
			}))->get();
			$view = View::make('dashboard.bookmakers', array('bookmakers' => $bookmakers));
			return $view;
		}

		public function showMyAccounts()
		{
			$book_id = Input::get('book_id');
			$accounts = $this->currentUser->bookmakers()->where('bookmaker_user.bookmaker_id', '=', $book_id)->whereNull('deleted_at')->get(array('bookmaker_user.id', 'bookmaker_user.nom_compte AS text'));
			return Response::json($accounts);

		}
	}
