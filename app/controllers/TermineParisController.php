<?php

	class TermineParisController extends BaseController
	{

		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
		}

		/**
		 * Display a listing of the  resource.
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
			$validator->each('resultatSelectionDashboardInput', ['between:1,6']);

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

				$resultats_array = Input::get('childrowsinput');
				$status_array = Input::get('resultatSelectionDashboardInput');
				Clockwork::info($resultats_array);
				Clockwork::info($status_array);

				/*
					1 = gagné,
					2 = perdu,
					3 = 1/2 gagné,
					4 = 1/2 perdu,
					5 = remboursé,
					6 = cashouted
				*/

				$status_termine_pari = null;
				$cote_general = 1;
				$nb = $encoursparis->selections()->count();
				$selections = $encoursparis->selections()->get();
				for ($i = 0; $i < $nb; $i++) {
					$status_s = $status_array[$i];
					$resultat_s = $resultats_array[$i];
					$cote = $selections[$i]->cote;
					$cote_selection = 1;
					switch ($status_s) {
						case 1:
							$cote_general *= $cote;
							$cote_selection = $cote;
							break;
						case 2:
							$cote_general *= 0;
							$cote_selection = 0;
							break;
						case 3:
							$cote_general = $cote_general * (($cote - 1) / 2 + 1);
							$cote_selection = [($cote - 1) / 2 + 1];
							break;
						case 4:
							$cote_general = $cote_general * 0.5;
							$cote_selection = 0.5;
							break;
						case 5:
							$cote_general += 0;
							$cote_selection = 1;
							break;
					}
					$selections[$i]->resultat = $resultat_s;
					$selections[$i]->status = $status_s;
					$selections[$i]->save();

					// les calculs pour termine paris
					$retour_devise = $mise * $cote_general;
					$profit_devise = $retour_devise - $mise;
					$retour_unites = $nombre_unites * $cote_general;
					$profit_unites = $retour_unites - $nombre_unites;

					if ($encoursparis->type_profil == 's') {
						$status_termine_pari = $selections[0]->status;
					} else if ($encoursparis->type_profil == 'c') {
						if ($profit_devise > 0) {
							$status_termine_pari = 1;
						} else if ($profit_devise == 0) {
							$status_termine_pari = 5;
						} else if ($profit_devise < 0) {
							$status_termine_pari = 2;
						}
					}
				}

				// creation du pari validé.
				$termine_pari = new TermineParis(array(
					'followtype' => $encoursparis->followtype,
					'type_profil' => $encoursparis->type_profil,
					'numero_pari' => $encoursparis->numero_pari,
					'cote' => $encoursparis->cote,
					'cote_apres_status' => $cote_general,
					'status' => $status_termine_pari,
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
					'tipster_id' => $encoursparis->tipster_id,
					'user_id' => $encoursparis->user_id,
					'bookmaker_user_id' => $encoursparis->bookmaker_user_id,
				));

				// ajout du paris dans la table termine paris.
				$termine_paris_ajoute = $this->currentUser->termineParis()->save($termine_pari);

				// mise en global pour que la variable soit accessible dans la boucle ci-dessous.
				$id_termine = $termine_paris_ajoute->id;

				$iterator_resultats = 0;
				foreach ($selections as $selection) {
					$selection->termine_pari_id = $id_termine;
					$selection->en_cours_pari_id = NULL;
					$selection->save();
				}

				// suppression du pari en cours.
				$encoursparis->delete();

				// mis a jour des bankrolls des bookmakers uniquement si le followtype est de type normal.
				if ($followtype == 'n') {
					$book_id = $encoursparis->bookmaker_user_id;
					$book = BookmakerUser::find($book_id);
					$book->bankroll_actuelle += $retour_devise;
					$book->save();
				}

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
			$pari = $this->currentUser->termineParis()->where('id', $id)->first();

			if(!$pari->cashouted){

				if ($pari->followtype == 'n') {
					$compte = $pari->compte()->first();
					$compte->bankroll_actuelle += $pari->profit_devise;
					$compte->save();
					$pari->delete();
					return Response::json(array(
						'etat' => 1,
						'msg' => 'Pari Supprimé'
					));
				} else {
					$pari->delete();
					return Response::json(array(
						'etat' => 1,
						'msg' => 'Pari Supprimé'
					));
				}
			}
		}

		public function recaps()
		{

		}

	}
