<?php

	class TermineParisController extends BaseController
	{

		public function __construct()
		{
			parent::__construct();
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

			$status_array = explode(',', Input::get('status')[0]);
			foreach($status_array as $status){
				if( ! preg_match("(0|1|2|3|4|5|)", $status)){
					return Response::json(array(
						'etat' => 0,
						'msg' => 'status invalide(s).',
					));
				}
			}


			$regles = array(
				'pari-id' => 'required|exists:en_cours_paris,id,user_id,' . Auth::user()->id,
				'amount-returned' => 'required|amount_returned',
			);

			$messages = array(
				'pari-id.required' => 'Un identifiant de pari doit être envoyé.',
				'pari-id.exists' => 'Ce pari n\'existe pas.',
				'amount-returned.required' => 'Le montant retourné est obligatoire.',
			);

			$validator = Validator::make(Input::all(), $regles, $messages);

			if ($validator->fails()) {
				return Response::json(array(
					'etat' => 0,
					'msg' => $validator->getMessageBag()->toArray()
				));
			} else {
				$id = Input::get('pari-id');
				$encoursparis = Auth::user()->enCoursParis()->where('id', $id)->first();
				if(is_null($encoursparis)){
					return Response::json(array(
						'etat' => 0,
						'msg' => 'pari en cours introuvable.',
					));
				}
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

				$status_array = explode(',', Input::get('status')[0]);
				Clockwork::info($status_array);

				/*
					1 = gagné,
					2 = perdu,
					3 = 1/2 gagné,
					4 = 1/2 perdu,
					5 = remboursé,
					6 = cashouted,
				*/

				$status_termine_pari = null;
				$cote_general = 1;
				$nb = $encoursparis->selections()->count();
				$selections = $encoursparis->selections()->get();
				if(is_null($selections)){
					return Response::json(array(
						'etat' => 0,
						'msg' => 'Les selections du pari en cours sont introuvables.',
					));
				}

				for ($i = 0; $i < $nb; $i++) {
					$status_s = $status_array[$i];
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
					$selections[$i]->status = $status_s;
					$selection_saved_correctly = $selections[$i]->save();
					if(!$selection_saved_correctly){
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Erreur dans la définition du status de la ou les selections du pari n°'.$selections[$i]->id,
						));
					}

					// calculs des différents montants à partir du montant retourné.
					$retour_devise = Input::get('amount-returned');
					$profit_devise = $retour_devise - $mise;
					$retour_unites = $retour_devise / $mt_par_unite;
					$profit_unites = $retour_unites - $nombre_unites;

					// affectation du status du pari selon le type de pari.
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
				$termine_paris_ajoute = Auth::user()->termineParis()->save($termine_pari);
				if(!$termine_paris_ajoute){
					return Response::json(array(
						'etat' => 0,
						'msg' => 'Erreur, ce pari n\'a pas été crée correctement dans l\'historique',
					));
				}


				// mise en global pour que la variable soit accessible dans la boucle ci-dessous.
				$id_termine = $termine_paris_ajoute->id;


				// attacher les selections au pari termine et détacher le pari en cours.
				$iterator_resultats = 0;
				if($termine_paris_ajoute){
					foreach ($selections as $selection) {
						$selection->termine_pari_id = $id_termine;
						$selection->en_cours_pari_id = NULL;
						$selection->save();
						if(!$selection){
							return Response::json(array(
								'etat' => 0,
								'msg' => 'La ou les selections n \'ont pas été sauvegardé correctement. au moment de l\'affectation de l\'historique.',
							));
						}
					}

					// suppression du pari en cours.
					$encoursparis_delete_correctly = $encoursparis->delete();
					if(!$encoursparis_delete_correctly){
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Ce pari en cours n\' a pas été supprimé correctement.',
						));
					}


					// mis a jour des bankrolls des bookmakers uniquement si le followtype est de type normal.
					if ($followtype == 'n') {
						$book_id = $encoursparis->bookmaker_user_id;
						$book = BookmakerUser::find($book_id);
						$book->bankroll_actuelle += $retour_devise;
						$book->save();
						if(!$book){
							return Response::json(array(
								'etat' => 0,
								'msg' => 'La mise à jour du solde du bookmaker n\'a pas fonctionné.',
							));
						}
					}

					return Response::json(array(
						'etat' => 1,
						'msg' => 'pari validé',
					));
				}

			}

			return Response::json(array(
				'etat' => 0,
				'msg' => 'Erreur, ce pari ne peut pas être cloturé.',
			));
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
			$pari = Auth::user()->termineParis()->where('id', $id)->first();
			Clockwork::info($pari);

			if(!is_null($pari)){
				if(!$pari->cashouted){
					if ($pari->followtype == 'n') {
						$compte = $pari->compte()->first();
						$compte->bankroll_actuelle += $pari->mise_totale;
						$saved = $compte->save();
						if($saved){
							$pari->delete();
						}
						return Response::json(array(
							'etat' => 1,
							'msg' => 'Pari supprimé !'
						));
					} else {
						$pari->delete();
						return Response::json(array(
							'etat' => 1,
							'msg' => 'Pari supprimé !'
						));
					}
				}else{
					return Response::json(array(
						'etat' => 0,
						'msg' => 'Pour l\'instant, les paris cash-out ne peuvent pas être supprimés.  .'
					));
				}
			}

			return Response::json(array(
				'etat' => 0,
				'msg' => 'Erreur, ce pari ne peut pas être supprimé.'
			));
		}
	}
