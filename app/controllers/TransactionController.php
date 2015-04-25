<?php

	class TransactionController extends BaseController
	{

		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$dt = Carbon::now();

		}


		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			//
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
				'amounttransinput' => 'required|regex:/^\d+(\.\d{1,2})?$/',
				'typetransinput' => 'in:depot,retrait,bonus',
				'booknametransselect' => 'required|exists:bookmakers,id',
				'accountnametransselect' => 'required|exists:bookmaker_user,id,user_id,' . $this->currentUserId,
				'describetranstext' => 'max:255'
			);
			$messages = array(
				'amounttransinput.required' => 'Vous devez specifier un montant',
				'amounttransinput.regex' => 'le type du montant n\'est pas bon',
				'typetransinput.in' => 'Ce type de transaction n\'existe pas',
				'booknametransselect.required' => 'Vous devez specifier un bookmaker',
				'booknametransselect.exists' => 'Ce bookmaker n\'existe pas',
				'accountnametransselect.required' => 'Un compte doit etre selectionné',
				'accountnametransselect.exists' => 'Ce compte n\'existe pas',
				'describetranstext.max' => 'Maximum : 255 caractéres',
			);


			// validation erronée des champs et renvoie.
			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				return Response::json(array(
					'success' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {
				// mise en variable des differentes informations.
				$type = Input::get('typetransinput');
				$amount = Input::get('amounttransinput');
				$describe = Input::get('describetranstext');
				// id du compte en question.
				$accountid = Input::get('accountnametransselect');
				// recherche du compte correspondant a la requete.
				$compte = BookmakerUser::find($accountid);


				// recherche de la bankroll actuelle du compte en question.
				if (Input::get('booknametransselect')) {
					$amountaccount = DB::table('bookmaker_user')->where('id', '=', $accountid)->first()->bankroll_actuelle;
				}
				if ($type == 'retrait') {

					// si le retrait est superieur au montant actuelle du compte.
					if ($amount <= $amountaccount) {

						// modification du montant actuelle du compte.
						$newamount = $amountaccount - $amount;
						$compte->bankroll_actuelle = $newamount;
						$compte->save();

						// insertion d'une nouvelle transaction.
						$transaction = new Transaction(array('type' => $type, 'montant' => $amount, 'description' => $describe));
						$compte->transactions()->save($transaction);

						return Response::json(array(
							'success' => true,
						));
					} else {

						// retour de l'erreur pour la requete en ajax.
						$error = array('retraitNonDispo' => 'le retrait est superieur au montant actuelle du compte.');

						// retour.
						return Response::json(array(
							'success' => false,
							'errors' => $error,
						));
					}
				} else if ($type == 'depot') {


					// ajout à la bankroll du compte.
					$newamount = $amountaccount + $amount;
					DB::table('bookmaker_user')
						->where('id', $accountid)
						->update(array('bankroll_actuelle' => $newamount));

					// insertion d'une nouvelle transaction.
					$transaction = new Transaction(array('type' => $type, 'montant' => $amount, 'description' => $describe));
					$compte->transactions()->save($transaction);

					// retour.
					return Response::json(array(
						'success' => true,
					));

				} else if ($type == 'bonus') {

					// insertion d'une nouvelle transaction.
					$transaction = new Transaction(array('type' => $type, 'montant' => $amount, 'description' => $describe));
					$compte->transactions()->save($transaction);

					// ajout à la bankroll du compte
					// recherche du montant bonus actuelle du compte.
					$bonusaccount = DB::table('bookmaker_user')->where('id', '=', $accountid)->first()->bonus;
					// calcul de la nouvelle bankroll actuelle.
					$newamount = $amountaccount + $amount;
					// calcul du nouveau bonus total du compte.
					$bonus = $amount + $bonusaccount;

					// mise a jour du compte avec les nouvelles données.
					DB::table('bookmaker_user')
						->where('id', $accountid)
						->update(array('bankroll_actuelle' => $newamount, 'bonus' => $bonus));

					// retour.
					return Response::json(array(
						'success' => true,
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
