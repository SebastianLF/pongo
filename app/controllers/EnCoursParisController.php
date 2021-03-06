<?php
	use Carbon\Carbon;

	class EnCoursParisController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
		}

		public function create()
		{

		}

		public function store()
		{
			// récuperation des selections choisies.
			$selections_coupon = Coupon::where('session_id', Session::getId())->get();

			// nombre de selections.
			$count = $selections_coupon->count();


			// verification de présence d'une selection, au moins.
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
					// mise en base de données, les verifs ont toutes été faites plus haut.

					// type de suivi
					$suivi = Input::get('followtypeinputdashboard');

					// tipster
					$tipster = Auth::user()->tipsters()->where('id', Input::get('tipstersinputdashboard'))->first();

					// type stake
					$type_stake = Input::get('typestakeinputdashboard');

					// numero de pari par utilisateur + incrementation de celui-ci.
					Auth::user()->compteur_pari += 1;
					Auth::user()->save();
					$numero_pari = Auth::user()->compteur_pari;

					// mise en unités.
					$mise_unites = 0;
					$mise_devise = 0;
					if ($type_stake == 'u') {
						$mise_unites = Input::get('stakeunitinputdashboard');
						$mise_devise = round($mise_unites * $tipster->montant_par_unite, 2);
					} elseif ($type_stake == 'f') {
						$mise_devise = Input::get('amountinputdashboard');
						$mise_unites = $mise_devise / $tipster->montant_par_unite;
					}


					// creation du pari.
					$encourparis = new EnCoursParis(array(
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
						'tipster_id' => $tipster->id,
						'user_id' => Auth::user()->id,
						'bookmaker_user_id' => $suivi == 'n' ? Input::get('accountsinputdashboard') : null
					));

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

					if (!$encourparis->save()) {
						$encourparis->delete();
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Le pari n\'a pas été crée correctement.',
						));
					}

					$cotes = 1;
					$odds_iterator = 0;
					$odds_array = Input::get('automatic-selection-cote');
					$count_live = 0;

					Clockwork::info(Input::get('optionlt'));
					Clockwork::info($odds_array);


					foreach ($selections_coupon as $selection_coupon) {
						// sport = id de betbrain
						// market  = id de betbrain
						// scope  = id de pongo
						// competition  = id de pongo
						// equipe1  = id de pongo
						// equipe2  = id de pongo

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
							'en_cours_pari_id' => $encourparis->id
						));

						$selection_saved = $selection->save();
						if (!$selection_saved) {
							$encourparis->delete();
							return Response::json(array(
								'etat' => 0,
								'msg' => 'Une des selections n\'a pas été enregistré correctement.',
							));
						}

						$cotes *= $odds_array[$odds_iterator];
						$odds_iterator += 1;
					}


					// mis a jour de la cote general.
					if ($encourparis->type_profil == 's') {
						$encourparis->cote = $cotes;
						$pari_model->cote = $cotes;
					} else {
						$encourparis->cote = Input::get('total-cote-combine');
						$pari_model->cote = Input::get('total-cote-combine');
					}
					$encourparis->pari_live = $count_live > 0 ? 1 : 0;
					$pari_model->pari_live = $count_live > 0 ? 1 : 0;
					$encourparis->save();
					$pari_model->save();
					if (!$encourparis->save()) {
						$encourparis->delete();
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Le pari n\'a pas été mise à jour correctement.',
						));
					}

					// supression des coupons.,
					foreach ($selections_coupon as $selection_coupon) {
						$selection_coupon->delete();
						if (!$selection_coupon) {
							return Response::json(array(
								'etat' => 0,
								'msg' => 'Une des selections n\'a pas été supprimé correctement.',
							));
						}
					}

					// deduction du montant dans le bookmaker correspondant uniquement si le suivi est de type normal.
					if ($suivi == 'n') {
						$compte_to_deduct = Auth::user()->comptes()->where('id', Input::get('accountsinputdashboard'))->first();
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


		public function update($id)
		{
			$validator = Validator::make(Input::all(), array(), array());
			$validator->each('status', ['required', 'in:0,1,2,3,4,5,9']);

																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																									if ($validator->fails()) {
				$array = $validator->getMessageBag()->first();
				return Response::json(array(
					'etat' => 0,
					'msg' => $array,
				));
			}

			$encourspari = Auth::user()->enCoursParis()->where('id', $id)->first();
			$status = Input::get('status');

			Clockwork::info(Input::get('status'));

			$selections = $encourspari->selections()->get();

			foreach ($selections as $key => $selection){
				Clockwork::info( $status[$key]);
				$selection->status = intval($status[$key]);
				$selection->save();
			}
			Clockwork::info($selections);

			$encourspari->montant_retour = Input::get('montant_retour');
			$encourspari->cote_apres_status = Input::get('cote_generale_apres_status');
			$encourspari->save();
			Clockwork::info($encourspari);

			return Response::json('ok');
		}

		public function destroy($id)
		{

			$pari = Auth::user()->enCoursParis()->find($id);
			if (is_null($pari)) {
				return Response::json(array(
					'etat' => 0,
					'msg' => 'ce pari n\'existe pas',
				));
			}

			if ($pari->followtype == 'n') {
				$pari_deleted = $pari->delete();
				Clockwork::info($pari_deleted);

				if (!$pari_deleted) {
					return Response::json(array(
						'etat' => 0,
						'msg' => 'Le pari n\'a pas été supprimé correctement.'
					));
				}
				$compte = $pari->compte()->first();
				$compte->bankroll_actuelle += $pari->mise_totale;
				$compte->save();
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

		}

		public function getEnCoursABCD()
		{
			$nom = Input::get('q');
			$parisabcd = Auth::user()->enCoursParis()->orderBy('created_at', 'desc')->groupBy('nom_abcd')->where('pari_abcd', '1')->where('nom_abcd', 'LIKE', '%' . $nom . '%')->get(array('nom_abcd AS id', 'nom_abcd AS text'));
			/*$result = array();
			foreach($result as $one){
				array_push($result, $one->id);
			}*/
			return Response::json($parisabcd);
		}

		public function getlettreABCD()
		{
			$nom = Input::get('serie_nom');
			$result = [];
			if (!empty($nom)) {
				$lettreabcd = Auth::user()->enCoursParis()->where('nom_abcd', $nom)->get(array('lettre_abcd'));
				$liste_reponse = array();
				foreach ($lettreabcd as $one) {
					array_push($liste_reponse, $one->lettre_abcd);
				}
				$liste = array('A', 'B', 'C', 'D');
				$result = array_diff($liste, $liste_reponse);
				Clockwork::info($lettreabcd);
				Clockwork::info($liste_reponse);
				Clockwork::info($liste);
				Clockwork::info($result);
				return Response::json($result);
			} else {
				Clockwork::info($result);
				return Response::json($result);

			}

		}

		public function automatic_store()
		{

		}

		public function cashOut()
		{
			$regles = array(
				'cashout-select' => 'required|in:c,p',
				'amount-cash-out' => 'required|cashout',
			);
			$messages = array(
				'cashout-select.in' => 'Ce type de cashout n\'existe pas.',
				'cashout-select.required' => 'Un type de cashout est nécessaire.',
				'amount-cash-out.required' => 'Un montant retiré est nécessaire.',
			);
			$validator = Validator::make(Input::all(), $regles, $messages);

			if ($validator->fails()) {
				$errors = $validator->getMessageBag()->toArray();
				return Response::json(array(
					'etat' => 0,
					'msg' => $errors,
				));
			} else {
				$encourspari_id = Input::get('ticket-id');
				$cashout_type = Input::get('cashout-select');
				$montant = Input::get('amount-cash-out');
				$encourspari = Auth::user()->enCoursParis()->where('id', $encourspari_id)->firstOrFail();
				if ($cashout_type == 'c') {

					$retour_unites = round($montant / $encourspari->mt_par_unite, 2);
					$profit_unites = round($retour_unites - $encourspari->nombre_unites, 2);
					$retour_devise = $montant;
					$profit_devise = round($montant - $encourspari->mise_totale, 2);

					$this->creation_termine_pari_de_type_cash_out($encourspari, $retour_unites, $profit_unites, $retour_devise, $profit_devise);

					return Response::json(array(
						'etat' => 1,
						'msg' => 'Montant retourné: ' . floatval($retour_devise) . ' ' . Auth::user()->devise,
						'head' => 'Ticket cloturé',
					));

				} elseif ($cashout_type == 'p') {
					if ($encourspari->$montant > $encourspari->mise_totale) {
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Le montant retiré du Partial Cash Out est supérieur à la mise de départ. Le montant doit être inférieur.',
						));
					} else if ($encourspari->$montant == $encourspari->mise_totale) {
						$this->creation_termine_pari_de_type_cash_out($encourspari, $encourspari->retour_unites, $encourspari->profit_unites, $encourspari->retour_devise, $encourspari->profit_devise);
					} else if ($encourspari->$montant < $encourspari->mise_totale) {

						//modification de la mise totale dans l encourspari
						$mise_totale = round($encourspari->mise_totale - $montant, 2);
						$nombre_unites = round($mise_totale / $encourspari->mt_par_unite, 2);
						$encourspari->mise_totale = $mise_totale;
						$encourspari->nombre_unites = $nombre_unites;
						$encourspari->save();

						// creation d'une transaction de type cash out
						$transaction = new Transaction();
						$transaction->type = 'pc';
						$transaction->montant = $montant;
						$transaction->description = 'Partial Cash Out - Ticket #' . $encourspari->id;
						$transaction->bookmaker_user_id = $encourspari->bookmaker_user_id;
						$transaction->save();

						$compte = BookmakerUser::find($encourspari->bookmaker_user_id);

						return Response::json(array(
							'etat' => 1,
							'msg' => 'nouvelle mise = ' . floatval($mise_totale) . ' ' . Auth::user()->devise . '<br> montant transaction (' . $compte->nom_compte . ') = ' . floatval($montant) . ' ' . Auth::user()->devise,
							'head' => 'Ticket msie à jour',
						));
					}
				}
			}
		}


		public function creation_termine_pari_de_type_cash_out($encourspari, $retour_unites, $profit_unites, $retour_devise, $profit_devise)
		{

			// creation du pari validé.
			$termine_pari = new TermineParis(array(
				'followtype' => $encourspari->followtype,
				'type_profil' => $encourspari->type_profil,
				'numero_pari' => $encourspari->numero_pari,
				'cote' => $encourspari->cote,
				'cote_apres_status' => $encourspari->cote,
				'status' => 6,
				'mt_par_unite' => $encourspari->mt_par_unite,
				'nombre_unites' => $encourspari->nombre_unites,
				'mise_totale' => $encourspari->mise_totale,
				'unites_retour' => $retour_unites,
				'unites_profit' => $profit_unites,
				'montant_retour' => $retour_devise,
				'montant_profit' => $profit_devise,
				'pari_long_terme' => $encourspari->pari_long_terme,
				'cashouted' => 1,
				'pari_abcd' => $encourspari->pari_abcd,
				'nom_abcd' => $encourspari->nom_abcd,
				'lettre_abcd' => $encourspari->lettre_abcd,
				'tipster_id' => $encourspari->tipster_id,
				'user_id' => $encourspari->user_id,
				'bookmaker_user_id' => $encourspari->bookmaker_user_id,
			));

			// ajout du paris dans la table termine paris.
			$termine_paris_ajoute = Auth::user()->termineParis()->save($termine_pari);

			// uniquemenent si le type de suivi est normal.
			if ($encourspari->followtype == 'n') {
				$book = $encourspari->compte->where('id', $encourspari->bookmaker_user_id)->firstOrFail();

				// verification si le bookmaker a une bankroll suffisante en cas de perte.
				$book->bankroll_actuelle += $retour_devise;
				$book->save();
			}

			// lier à a l'id du pari terminé et délier le pari en cours.
			$selections = $encourspari->selections()->get();
			foreach ($selections as $selection) {
				$selection->termine_pari_id = $termine_paris_ajoute->id;
				$selection->en_cours_pari_id = NULL;
				$selection->status = 6;
				$selection->save();
			}

			// suppression du pari en cours.
			$encourspari->delete();

		}

		// formulaire d'ajout manuel
		public function manual_store()
		{

			$regles = array(
				'tipstersinputdashboard' => 'required|exists:tipsters,id,user_id,' . Auth::user()->id,
				'typestakeinputdashboard' => 'required|in:u,f',
				'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|unites',
				'amountinputdashboard' => 'required_if:typestakeinputdashboard,f|decimal>0',
				'accountsinputdashboard' => 'required_if:followtypeinputdashboard,normal|exists:bookmaker_user,id,user_id,' . Auth::user()->id,
				'ticketABCD' => 'required|in:0,1',
				'ticketGratuit' => 'required|in:0,1',
				'ticketLongTerme' => 'required|in:0,1',
				'serieinputdashboard' => 'required_if:ticketABCD,1',
				'letterinputdashboard' => 'required_if:ticketABCD,1|in:A,B,C,D',
				'followtypeinputdashboard' => 'required|in:normal,à blanc',
			);
			$messages = array();

			$validator = Validator::make(Input::all(), $regles, $messages);
			$validator->each('datematchinputdashboard', ['required', 'date']);
			$validator->each('sportinputdashboard', ['required', 'exists:sports,id']);
			$validator->each('competitioninputdashboard', ['required', 'exists:competitions,id']);
			$validator->each('marketinputdashboard', ['required', 'exists:markets,id']);
			$validator->each('pick', ['required', 'max:20']);
			$validator->each('oddParam1', ['sometimes']);
			$validator->each('oddParam2', ['sometimes']);
			$validator->each('oddParam3', ['sometimes']);
			$validator->each('parametreName1', ['sometimes']);
			$validator->each('parametreName2', ['sometimes']);
			$validator->each('parametreName3', ['sometimes']);
			$validator->each('team1inputdashboard', ['sometimes', 'exists:equipes,id']);
			$validator->each('team2inputdashboard', ['sometimes', 'exists:equipes,id']);
			$validator->each('oddinputdashboard', ['required', 'european_odd']);
			$validator->each('selectionsLive', ['sometimes', 'in:0,1']);
			$validator->each('selectionsLongterme', ['sometimes', 'in:0,1']);

			if ($validator->fails()) {
				$array = $validator->getMessageBag()->toArray();
				Clockwork::info($array);
				return Response::json(array(
					'etat' => 0,
					'msg' => $array,
				));
			} else {
				// mise en variables.
				$tipster_id = Input::get('tipstersinputdashboard');
				$tipster = Tipster::find($tipster_id);
				$compte_id = Input::get('accountsinputdashboard');
				$compte = Auth::user()->comptes()->where('id', $compte_id)->first();

				// ajout de la date du jour pour la date de creation du pari.
				$date_ajout = Carbon::now();

				// numero de pari par utilisateur + incrementation de celui-ci.
				Auth::user()->compteur_pari += 1;
				Auth::user()->save();
				$numero_pari = Auth::user()->compteur_pari;

				// calcul de la cote generale avec le type de cote 1.00 .
				$cotes = Input::get('oddinputdashboard');
				$cote_general = 1;
				foreach ($cotes as $cote) {
					$cote_general *= $cote;
				}

				// simple = 1 , combiné = superieur à 1
				$type_profil = Input::get('linesnum');
				if ($type_profil > 1) {
					$type_profil = 'c';
				} else if ($type_profil == 1) {
					$type_profil = 's';
				}

				// u = unités , f = flat
				if (Input::get('typestakeinputdashboard') == 'u') {
					$nombre_unites = Input::get('stakeunitinputdashboard');
					$mise_totale = $tipster->montant_par_unite * $nombre_unites;
				} else if (Input::get('typestakeinputdashboard') == 'f') {
					$mise_totale = Input::get('amountinputdashboard');
					$nombre_unites = round($mise_totale / $tipster->montant_par_unite, 2);
				}

				//gestion des options ( paris long terme , systeme abcd )
				$option = Input::get('RadioOptions');
				$nom_abcd = '';
				$lettre_abcd = '';
				$pari_long_terme = 0;
				$pari_abcd = 0;
				if ($option == 'parislongterme') {
					$pari_long_terme = 1;
				} else if ($option == 'systemeABCD') {
					$pari_abcd = 1;
					$nom_abcd = Input::get('serieinputdashboard');
					$lettre_abcd = Input::get('letterinputdashboard');
				}

				// creation du nouveau pari
				$en_cours_pari = New EnCoursParis(array(
					'followtype' => $tipster->followtype,
					'type_profil' => $type_profil,
					'numero_pari' => $numero_pari,
					'mt_par_unite' => $tipster->montant_par_unite,
					'nombre_unites' => $nombre_unites,
					'mise_totale' => $mise_totale,
					'cote' => $cote_general,
					'pari_long_terme' => $pari_long_terme,
					'pari_abcd' => $pari_abcd,
					'nom_abcd' => $nom_abcd,
					'lettre_abcd' => $lettre_abcd,
					'tipster_id' => $tipster_id,
					'bookmaker_user_id' => $compte_id != NULL ? $compte_id : NULL
				));
				Clockwork::info($en_cours_pari);

				// ajout du nouveau pari.
				$pari = Auth::user()->enCoursParis()->save($en_cours_pari);

				// processus pour ceer les selecions.
				for ($i = 0; $i < Input::get('linesnum'); $i++) {

					if (Input::get('datematchinputdashboard') != '') {
						$datematch = Input::get('datematchinputdashboard');
					} else {
						$datematch = null;
					}
					$cote = Input::get('oddinputdashboard');
					$cote_final = $cote[$i];


					$sport = Input::get('sportinputdashboard');
					if (Input::get('sportinputdashboard') != '') {
						$sport = Sport::where('name', strtolower($sport[$i]))->first();
					} else {
						$sport = NULL;
					}
					$pays = Input::get('countryinputdashboard');
					if (Input::get('countryinputdashboard') != '') {
						$pays = Country::where('name', strtolower($pays[$i]))->first();
					} else {
						$pays = NULL;
					}
					$competition = Input::get('competitioninputdashboard');
					if (Input::get('competitioninputdashboard') != '') {
						$competition = Competition::where('name', strtolower($competition[$i]))->first();
					} else {
						$competition = NULL;
					}
					$type_pari = Input::get('picknameinputdashboard');
					if (Input::get('picknameinputdashboard') != '') {
						$type_pari = Paritype::where('name', strtolower($type_pari[$i]))->first();
					} else {
						$type_pari = NULL;
					}
					$equipe1 = Input::get('team1inputdashboard');
					if (Input::get('team1inputdashboard') != '') {
						$equipe1 = Equipe::where('name', strtolower($equipe1[$i]))->first();
					} else {
						$equipe1 = NULL;
					}
					$equipe2 = Input::get('team2inputdashboard');
					if (Input::get('team1inputdashboard') != '') {
						$equipe2 = Equipe::where('name', strtolower($equipe2[$i]))->first();
					} else {
						$equipe2 = NULL;
					}

					// creaion des selections.
					$selection = New Selection(array(
						'date_match' => $datematch[$i],
						'cote' => $cote_final,
						'sport_id' => $sport,
						'country_id' => $pays,
						'competition_id' => $competition,
						'type_pari_id' => $type_pari,
						'equipe1_id' => $equipe1,
						'equipe2_id' => $equipe2,
					));
					Clockwork::info($selection);

					// ajout des selections.
					$pari->selections()->save($selection);
				}

				// deduction du montant dans le bookmaker correspondant uniquement si le suivi est de type normal.
				if ($compte_id != NULL) {
					$compte_to_deduct = Auth::user()->comptes()->where('id', $compte_id)->firstOrfail();
					$compte_to_deduct->bankroll_actuelle -= $mise_totale;
					$compte_to_deduct->save();
				}


				return Response::json(array(
					'etat' => 1,
					'msg' => 'pari ajouté'
				));
			}
		}

		public function recupererStatusSelectionsPourCombine($id){
			$encoursparis = Auth::user()->enCoursParis()->where('id', $id)->with('selections.equipe1', 'selections.equipe1.country', 'selections.equipe2', 'selections.equipe2.country', 'selections.competition', 'selections.sport', 'selections.market', 'selections.scope', 'compte.bookmaker', 'tipster')->first();
			;
			if( ! $encoursparis){
				return Response::json('');
			}

			$selections_final = $encoursparis->selections;

			$pari_affichage = App::make('pari_affichage');
			foreach ($selections_final as $selections) {
				$pariAffichage = $pari_affichage->display($selections->market_id, $selections->scope_id, $selections->pick, $selections->odd_doubleParam, $selections->odd_doubleParam2, $selections->odd_doubleParam3, $selections->odd_participantParameterName, $selections->odd_participantParameterName2, $selections->odd_participantParameterName3, $selections->equipe1['name'], $selections->equipe2['name']);
				$selections['pariAffichage'] = $pariAffichage;
			}
			return Response::json($selections_final->toJson());
		}

	}
