<?php

	class TermineParisController extends BaseController
	{

		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			return View::make('termines.index');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			return View::make('termines.create');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{

			$regles = array(
				'ticket-id' => 'required|exists:en_cours_paris,id,user_id,' . $this->currentUser->id,
			);

			$messages = array(
				'ticket-id.required' => 'Un numero de ticket est obligatoire.',
				'ticket-id.exists' => 'Ce ticket n\'existe dans votre compte.',
			);

			$validator = Validator::make(Input::all(), $regles, $messages);
			$validator->each('childrowsinput', ['sometimes']);
			$validator->each('childrowsstatus', ['between:1,5']);

			if ($validator->fails()) {
				return Response::json(array(
					'etat' => 0,
					'msg' => $validator->getMessageBag()->toArray()
				));
			} else {
				$id = Input::get('ticket-id');
				$encoursparis = $this->currentUser->enCoursParis()->where('id', $id)->first();
				$mt_par_unite = $encoursparis->mt_par_unite;
				$mise = $encoursparis->mise_totale;
				$cote = $encoursparis->cote;
				$nombre_unites = $encoursparis->nombre_unites;
				$followtype = $encoursparis->followtype;
				$retour_unites = null;
				$retour_devise = null;
				$profit_unites = null;
				$profit_devise = null;
				$nom_abcd = null;
				$lettre_abcd = null;
				$status_array = Input::get('childrowsstatus');
				$infos_array = Input::get('childrowsinput');
				/*
					1 = gagné,
					2 = perdu,
					3 = 1/2 gagné,
					4 = 1/2 perdu,
					5 = remboursé,
				*/

				$cotes = 1;

				// calcul suivant le status.
				if($encoursparis->type_profil == 's'){
					$status_s = $status_array[0];
					$info_s  = $infos_array[0];
				}else{

				}
				foreach ($status_array as $status) {
					switch ($status) {
						case 1:

							break;
						case 2:
							$retour_devise = 0;
							$profit_devise = 0 - $mise;
							break;
						case 3:
							$retour_devise = (($mise / 2) * $cote) + $mise / 2;
							$profit_devise = $retour_devise - $mise;
							break;
						case 4:
							$retour_devise = $mise / 2;
							$profit_devise = 0 - $retour_devise;
							break;
						case 5:
							$retour_devise = $mise;
							$profit_devise = 0;
							break;
					}
				}
				// creation du pari validé.
				$termine_pari = new TermineParis(array(
					'followtype' => $encoursparis->followtype,
					'type_profil' => $encoursparis->type_profil,
					'numero_pari' => $encoursparis->numero_pari,
					'cote' => $encoursparis->cote,
					'mt_par_unite' => $encoursparis->mt_par_unite,
					'nombre_unites' => $encoursparis->nombre_unites,
					'mise_totale' => $encoursparis->mise_totale,
					'unites_retour' => $retour_unites,
					'unites_profit' => $profit_unites,
					'montant_retour' => $retour_devise,
					'montant_profit' => $profit_devise,
					'pari_long_terme' => $encoursparis->pari_long_terme,
					'pari_abcd' => $encoursparis->pari_abcd,
					'nom_abcd' => $encoursparis->nom_abcd,
					'lettre_abcd' => $encoursparis->lettre_abcd,
					'status' => $status,
					'tipster_id' => $encoursparis->tipster_id,
					'user_id' => $encoursparis->user_id,
					'bookmaker_user_id' => $encoursparis->bookmaker_user_id,
				));

				// ajout du paris dans la table termine paris.
				$termine_paris_ajoute = $this->currentUser->termineParis()->save($termine_pari);

				// mise en global pour que la variable soit accessible dans la boucle ci-dessous.
				$this->id = $termine_paris_ajoute->id;

				// ajout de la clé etrangere termineparis dans la ou les selections correspondantes.
				$nb = $encoursparis->selections()->count();
				Clockwork::info($nb);
				$selections = $encoursparis->selections()->get();
				for ($i = 0; $i < $nb; $i++) {
					$selections[$i]->status = $status_array[$i];
					$selections[$i]->infos_pari = $infos_array[$i];
					$selections[$i]->termine_pari_id = $this->id;
					$selections[$i]->en_cours_pari_id = null;
					$selections[$i]->save();
				}

				// suppression du pari en cours.
				$encoursparis->delete();

				// mis a jour des bankrolls des bookmakers uniquement si le followtype est de type normal.
				if ($followtype == 'n') {
					$book_id = $encoursparis->bookmaker_user_id;
					$book = BookmakerUser::find($book_id);
					$book->bankroll_actuelle += $profit_devise;
					$book->save();
					Clockwork::info($book);
				}

				Clockwork::info($encoursparis);
				return Response::json(array(
					'etat' => 1,
					'msg' => 'pari validé',
				));
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
			return View::make('termines.show');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function edit($id)
		{
			return View::make('termines.edit');
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

		}

	}
