<?php

	class TransactionController extends BaseController
	{

		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('ajax', array('only' => array('store')));
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
			$regles = array(
				'type' => 'required|in:d,r,b',
				'book' => 'required|exists:bookmakers,id',
				'account' => 'required|exists:bookmaker_user,id,user_id,' . Auth::user()->id,
				'amount' => 'required|decimal>0',
				'description' => 'sometimes|max:50'
			);
			$messages = array(
				'type.required' => 'Un type de transaction est obligatoire',
				'type.in' => 'Ce type de transaction n\'existe pas',
				'book.required' => 'Vous devez specifier un bookmaker',
				'book.exists' => 'Ce bookmaker n\'existe pas',
				'account.required' => 'Un compte doit etre selectionné',
				'account.exists' => 'Ce compte n\'existe pas',
				'amount.required' => 'Vous devez specifier un montant',
				'description.max' => 'Maximum : 50 caractères',
			);


			// validation erronée des champs et renvoie.
			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				return Response::json(array(
					'state' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {
				// mise en variable des differentes informations.
				$type = Input::get('type');
				$book_id = Input::get('book');
				$account_id = Input::get('account');
				$amount = Input::get('amount');
				$description = Input::get('description');

				$compte = Auth::user()->comptes()->where('id', $account_id)->first();

				if($type == 'd'){

					// insertion d'une nouvelle transaction.
					$transaction = new Transaction(array('type' => $type, 'montant' => $amount, 'description' => $description));
					$compte->transactions()->save($transaction);

					$compte->bankroll_actuelle += $amount;
					$compte->save();

					return Response::json(array(
						'state' => true,
					));

				}elseif($type == 'r'){

					// si le retrait est superieur au montant actuelle du compte.
					if ($amount <= $compte->bankroll_actuelle) {

						// insertion d'une nouvelle transaction.
						$transaction = new Transaction(array('type' => $type, 'montant' => $amount, 'description' => $description));
						$compte->transactions()->save($transaction);

						$compte->bankroll_actuelle -= $amount;
						$compte->save();

						return Response::json(array(
							'state' => true,
						));
					} else{

						// retour de l'erreur pour la requete en ajax.
						$error = array('amount' => 'le montant du retrait est supérieur au montant actuelle du compte.');

						// retour.
						return Response::json(array(
							'state' => false,
							'errors' => $error,
						));
					}
				}elseif($type == 'b'){

					// insertion d'une nouvelle transaction.
					$transaction = new Transaction(array('type' => $type, 'montant' => $amount, 'description' => $description));
					$compte->transactions()->save($transaction);

					$compte->bankroll_actuelle += $amount;
					$compte->save();

					return Response::json(array(
						'state' => true,
					));
				}
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
			//
		}


		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function update($id)
		{
			//
		}


		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function destroy($id)
		{
			//
		}




	}
