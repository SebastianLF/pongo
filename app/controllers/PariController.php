<?php

	use Illuminate\Exception;

	class PariController extends \BaseController
	{
		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			// récuperation des selections dans le coupon.
			$selections_coupon = Coupon::where('session_id', Session::getId())->get();

			// nombre de selections dans le coupon.
			$count = $selections_coupon->count();


			// verification de présence d'une selection, au moins dans le coupon.
			if ($count <= 0) {
				return Response::json(array(
					'etat' => 0,
					'msg' => 'Aucune selection.',
				));
			} else {

				// verifier que le bookmaker soit le meme pour toutes les selections.
				$bookmaker_temp = $selections_coupon->first()->bookmaker;

				$bookmaker = '';
				$bookmakers_differents = false;

				foreach ($selections_coupon as $selection_coupon) {
					$bookmaker = $selection_coupon->bookmaker;

					if ($bookmaker_temp != $bookmaker) {
						$bookmakers_differents = true; // booléen necessaire pour l'etape suivant.
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Le bookmaker doit etre le meme pour toutes les selections.',
						));
					} else {
						$bookmakers_differents = false;
					}
				}
				if (!$bookmakers_differents && (Input::get('followtypeinputdashboard') == 'n')) {

					// vérification si il existe au moins un compte bookmaker correspondant au bookmaker des selections.
					$comptes = Auth::user()->comptes()->whereHas('bookmaker', function ($query) use ($bookmaker) {
						$query->where('nom', $bookmaker);
					})->where('deleted_at', NULL)->get();

					$bookmakers_count = $comptes->count();
					if ($bookmakers_count == 0) {
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Ce bookmaker n\'a pas de compte associé, rendez vous dans la page configuration pour le créer.',
						));
					}
				}
				$regles = array(
					'tipstersinputdashboard' => 'required|exists:tipsters,id,user_id,' . Auth::id(), // la validation du tipster doit etre en premiere position.
					'followtypeinputdashboard' => 'required|in:n,b',
					'typestakeinputdashboard' => 'required|in:u,f',
					'accountsinputdashboard' => 'required_if:followtypeinputdashboard,n|exists:bookmaker_user,id,user_id,' . Auth::id(),
					'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|unites|mise_montant_en_unites<solde:' . Input::get('accountsinputdashboard') . ',' . Input::get('followtypeinputdashboard') . ',' . Input::get('tipstersinputdashboard'),
					'amountinputdashboard' => 'required_if:typestakeinputdashboard,f|mise_montant_en_devise<solde:' . Input::get('accountsinputdashboard') . ',' . Input::get('followtypeinputdashboard'),
					'total-cote-combine' => 'cote_generale_if_combine:' . $count . '|european_odd',
					'ticketABCD' => 'required|in:0,1',
					'ticketLongTerme' => 'required|in:0,1',
					'serieinputdashboard' => 'required_if:ticketABCD,1',
					'letterinputdashboard' => 'required_if:ticketABCD,1|in:A,B,C,D',
				);
				$messages = array(
					'tipstersinputdashboard.required' => 'Choisissez un tipster, si il n\'y a pas de tipster dans la liste, veuillez en créer un dans la page configuration',
					'tipstersinputdashboard.exists' => 'Ce tipster n\'existe pas dans votre liste.',
					'typestakeinputdashboard.in' => 'ce type de mise n\'existe pas.',
					'stakeunitinputdashboard.required_if' => 'Vous devez mettre une mise (en unités).',
					'amountinputdashboard.required_if' => 'Vous devez mettre une mise (en devise).',
					'accountsinputdashboard.required_if' => 'Vous devez choisir un compte de bookmaker quand le suivi est de type normal. Si vous n\'avez pas de compte de bookmaker, veuillez en créer un, dans la page configuration',
					'accountsinputdashboard.exists' => 'Ce compte bookmaker n\'existe pas dans votre liste.',
					'serieinputdashboard.required_if' => 'Un n° ou nom de serie est nécéssaire',
					'letterinputdashboard.required_if' => 'Une lettre (ABCD) est nécéssaire',
					'letterinputdashboard.in' => 'la lettre pour l\'option abcd ne correspond pas',
				);

				$validator = Validator::make(Input::all(), $regles, $messages);
				$validator->each('automatic-selection-cote', ['required', 'european_odd']);

				if ($validator->fails()) {
					$array = $validator->getMessageBag()->first();
					return Response::json(array(
						'etat' => 0,
						'msg' => $array,
					));
				} else {

					$suivi = Input::get('followtypeinputdashboard');
					$tipster = Auth::user()->tipsters()->where('id', Input::get('tipstersinputdashboard'))->firstOrFail();
					$type_stake = Input::get('typestakeinputdashboard');

					// verification si ce numero de pari n'existe pas deja.
					$numero_pari = Auth::user()->compteur_pari += 1;
					if( ! Auth::user()->allParis()->where('numero_pari', $numero_pari)->exists()){Auth::user()->save();}

					// mise
					$mise_unites = $mise_devise = 0;
					if ($type_stake == 'u') {
						$mise_unites = Input::get('stakeunitinputdashboard');
						$mise_devise = round($mise_unites * $tipster->montant_par_unite, 2);
					} elseif ($type_stake == 'f') {
						$mise_devise = Input::get('amountinputdashboard');
						$mise_unites = $mise_devise / $tipster->montant_par_unite;
					}

					// creation du pari dans le modele PARI.
					$pari_model = new Pari(array(
						'followtype' => $suivi,
						'type_profil' => $count > 1 ? 'c' : 's',
						'numero_pari' => $numero_pari,
						'mt_par_unite' => $tipster->montant_par_unite,
						'nombre_unites' => $mise_unites,
						'mise_totale' => $mise_devise,
						'pari_abcd' => Input::get('ticketABCD'),
						'pari_long_terme' => Input::get('ticketLongTerme'),
						'nom_abcd' => Input::get('serieinputdashboard'),
						'lettre_abcd' => Input::get('letterinputdashboard'),
						'result' => 0,
						'tipster_id' => $tipster->id,
						'user_id' => Auth::user()->id,
						'bookmaker_user_id' => $suivi == 'n' ? Input::get('accountsinputdashboard') : null
					));

					$pari_model->save();

					$cotes = 1;
					$odds_iterator = 0;
					$odds_array = Input::get('automatic-selection-cote');
					$count_live = 0;

					Clockwork::info($odds_array);

					foreach ($selections_coupon as $selection_coupon) {

						// compteur, si superieur a 0 l'en cours pari est live.
						$count_live = $selection_coupon->isLive == null ? $count_live + 0 : $count_live + 1;

						$selection = new Selection(array(
							'date_match' => new Carbon($selection_coupon->game_time),
							'cote' => $odds_array[$odds_iterator],
							'pick' => $selection_coupon->pick,
							'game_id' => $selection_coupon->game_id,
							'game_name' => $selection_coupon->game_name,
							'odd_doubleParam' => $selection_coupon->odd_doubleParam,
							'odd_doubleParam2' => $selection_coupon->odd_doubleParam2,
							'odd_doubleParam3' => $selection_coupon->odd_doubleParam3,
							'odd_participantParameterName' => $selection_coupon->odd_participantParameterName,
							'odd_participantParameterName2' => $selection_coupon->odd_participantParameterName2,
							'odd_participantParameterName3' => $selection_coupon->odd_participantParameterName3,
							'odd_groupParam' => $selection_coupon->odd_groupParam,
							'isLive' => $selection_coupon->isLive,
							'isOutright' => 0,
							'isMatch' => $selection_coupon->isMatch,
							'score' => $selection_coupon->score,
							'market_id' => $selection_coupon->market_id,
							'scope_id' => $selection_coupon->scope_id,
							'sport_id' => $selection_coupon->sport_id,
							'competition_id' => $selection_coupon->league_id,
							'equipe1_id' => is_null($selection_coupon->home_team) ? null : Equipe::where('name', $selection_coupon->home_team)->first()->id,
							'equipe2_id' => is_null($selection_coupon->away_team) ? null : Equipe::where('name', $selection_coupon->away_team)->first()->id,
							'pari_id' => $pari_model->id,
						));

						// si une des selections n'a pas été ajoutée correctement on supprime le pari + toutes ses selections.
						if ( ! $selection->save()) {
							$pari_model->forceDelete();
						}

						$cotes *= $odds_array[$odds_iterator];
						$odds_iterator += 1;
					}

					$pari_model->pari_live = $count_live > 0 ? 1 : 0;

					// mis a jour de la cote general.
					if ($pari_model->type_profil == 's') {$pari_model->cote = $cotes;} else {$pari_model->cote = Input::get('total-cote-combine');}

					if ( ! $pari_model->save()) {

						$pari_model->forceDelete();
					}

					// supression des selections dans le coupon apres creation du pari.
					$selections_coupon->delete();


					// deduction du montant dans le bookmaker correspondant uniquement si le suivi est de type normal.
					if ($suivi == 'n') {

						$compte_to_deduct = Auth::user()->comptes()->where('id', Input::get('accountsinputdashboard'))->firstOrFail();
						$compte_to_deduct->bankroll_actuelle -= $mise_devise;

						if (!$compte_to_deduct->save()) {

							return Response::json(array(
								'etat' => 0,
								'msg' => 'La mise n\'a pas été déduite correctement du solde du bookmaker.',
							));
						}
					}

					return Response::json(array(
						'etat' => 1,
						'msg' => 'Pari ajouté',
					));
				}
			}
		}

		/**
		 * Pass bet to closed (result = 1).
		 *
		 * @param  int $id
		 * @return Response
		 */
		public function update($id)
		{
			$regles = array(
				'amount-returned' => 'required|amount_returned',
			);

			$messages = array(
				'amount-returned.required' => 'Le montant retourné est obligatoire.',
			);

			$validator = Validator::make(Input::all(), $regles, $messages);

			if ($validator->fails()) {
				return Response::json(array(
					'etat' => 0,
					'msg' => $validator->getMessageBag()->toArray()
				));
			} else {
				$encoursparis = Auth::user()->enCoursParis()->where('numero_pari', $id)->firstOrFail();

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
				$status_array = [];

				Clockwork::info($status_array);

				$status_termine_pari = null;
				$all_status_array = [];
				$cote_general = 1;
				$nb = $encoursparis->selections()->count();
				$selections = $encoursparis->selections()->get();
				if (is_null($selections)) {
					return Response::json(array(
						'etat' => 0,
						'msg' => 'Erreur (2)',
					));
				}

				//calcul cote apres status.
				for ($i = 0; $i < $nb; $i++) {
					$status_s = $selections[$i]->status;
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

					array_push($all_status_array, $status_s);

					$selections[$i]->status = $status_s;
					$selections[$i]->cote_apres_status = $cote_selection;

					if (!$selections[$i]->save()) {
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Erreur (3)',
						));
					}
				}

				// calculs des différents montants à partir du montant retourné.
				$retour_devise = Input::get('amount-returned');
				$profit_devise = $retour_devise - $mise;
				$retour_unites = $retour_devise / $mt_par_unite;
				$profit_unites = $retour_unites - $nombre_unites;

				// affectation du status generale du pari selon le type de pari.
				if ($encoursparis->type_profil == 's') {
					$status_termine_pari = $selections[0]->status;
				} else if ($encoursparis->type_profil == 'c') {
					if ($profit_devise > 0) {
						$status_termine_pari = 1;
					} else if ($profit_devise == 0) {
						$status_termine_pari = 5;
					} else if (in_array(2, $all_status_array)) {
						$status_termine_pari = 2;
					}
				}

				$encoursparis->cote_apres_status = $cote_general;
				$encoursparis->unites_retour = $retour_unites;
				$encoursparis->unites_profit = $profit_unites;
				$encoursparis->montant_retour = $retour_devise;
				$encoursparis->montant_profit = $profit_devise;
				$encoursparis->status = $status_termine_pari;
				$encoursparis->result = 1;

				if ($encoursparis->save()) {
					// mis a jour des bankrolls des bookmakers uniquement si le followtype est de type normal.
					if ($followtype == 'n') {
						$book_id = $encoursparis->bookmaker_user_id;
						$book = BookmakerUser::find($book_id);
						$book->bankroll_actuelle += $retour_devise;
						$book->save();
						if (!$book) {
							return Response::json(array(
								'etat' => 0,
								'msg' => 'Erreur (4)',
							));
						}
					}

					return Response::json(array(
						'etat' => 1,
						'msg' => 'pari validé',
					));
				}

				return Response::json(array(
					'etat' => 0,
					'msg' => 'Erreur, ce pari ne peut pas être cloturé.',
				));
			}
		}



		public function deletePendingBet($id){

			$pari = Auth::user()->enCoursParis()->where('numero_pari', $id)->firstOrFail();

			// forcedelete car si un paris en cours est supprimé, il n'y a aucun interet a garder une trace.
			if (Clockwork::info($pari->forceDelete())) {

				if ($pari->followtype == 'n') {
					//mis à jour du solde du compte-bookmaker correspondant.
					$compte = $pari->compte()->first();
					$compte->bankroll_actuelle += $pari->mise_totale;
					$compte->save();
				}

				//on rend le numero de pari de nouveau disponible.
				Auth::user()->numero_pari -= 1;
				Auth::user()->save();

				return Response::json(array(
					'etat' => 1,
					'msg' => 'Pari supprimé !'
				));

			}

			throw new BetNotDeletedCorrectlyException();
		}



		public function deleteClosedBet($id){

			$pari = Auth::user()->termineParis()->where('numero_pari', $id)->firstOrFail();

			if ($pari->delete()) {

				if ($pari->followtype == 'n') {
					//mis à jour du solde du compte-bookmaker correspondant.
					$compte = $pari->compte()->first();
					$compte->bankroll_actuelle += $pari->montant_retour;
					$compte->save();
				}

				return Response::json(array(
					'etat' => 1,
					'msg' => 'Pari supprimé !'
				));
			}

			throw new BetNotDeletedCorrectlyException();
		}

	}
