<?php
	use Carbon\Carbon;
	use Maatwebsite\Excel\Facades\Excel;

	class EnCoursParisController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$this->timezone = $this->currentUser->timezone;
		}

		public function index()
		{
		}

		public function create()
		{
			Excel::load('xls/BettingTypes.xls', function ($reader) {
				// Getting all results
				$results = $reader->get();
				Clockwork::info($results);
			});

			Excel::load('xls/bookmakers.xls', function ($reader) {
				// Getting all results
				$results = $reader->get();
				foreach ($results as $result) {
					DB::table('bookmakers')->insert(array('nom' => $result->name));
				}
			});
		}


		public function store()
		{




		}

		public function show($id)
		{
			//
		}

		public function edit($id)
		{
			//
		}

		public function update($id)
		{
			//
		}

		public function destroy($id)
		{
			$pari = EnCoursParis::find($id);
			if ($pari->followtype == 'n') {
				$compte = $pari->compte()->first();
				$compte->bankroll_actuelle += $pari->mise_totale;
				$compte->save();
				$pari->delete();
				return Response::json(array(
					'etat' => 1,
					'msg' => 'Ticket Supprimé'
				));
			} else {
				$pari->delete();
				return Response::json(array(
					'etat' => 1,
					'msg' => 'Ticket Supprimé'
				));
			}

		}

		public function getEnCoursABCD()
		{
			$nom = Input::get('q');
			$parisabcd = $this->currentUser->enCoursParis()->orderBy('created_at', 'desc')->groupBy('nom_abcd')->where('pari_abcd', '1')->where('nom_abcd', 'LIKE', '%' . $nom . '%')->get(array('nom_abcd AS id', 'nom_abcd AS text'));
			/*$result = array();
			foreach($result as $one){
				array_push($result, $one->id);
			}*/
			Clockwork::info($parisabcd);
			return Response::json($parisabcd);
		}

		public function getlettreABCD()
		{
			$nom = Input::get('serie_nom');
			Clockwork::info($nom);
			Clockwork::info(empty($nom));
			$result = [];
			if (!empty($nom)) {
				$lettreabcd = $this->currentUser->enCoursParis()->where('nom_abcd', $nom)->get(array('lettre_abcd'));
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

		/*public function updateSelection(){
			$id = Input::get('id');
			$status = Input::get('status');
			$info = Input::get('info');
			$selection = $this->currentUser->selections()->where('selections.id', $id)->first(array('selections.id','selections.status','selections.infos_pari'));

			if(!$selection){
				return Response::json(array(
					'etat' => 0,
					'message' => 'cette selection n\'existe pas.'
				));
			}else{
				$selection->status = $status;
				$selection->infos_pari = $info;
				$selection->save();
				return Response::json(array(
					'etat' => 1,
					'message' => 'Changements enregistrés',
				));
			}
		}*/

		public function automatic_store()
		{
			// récuperation des selections choisies.
			$selections_coupon = Coupon::where('session_id', Session::getId())->get();

			// nombre de selections.
			$count = $selections_coupon->count();


			// verification cote serveur de présence d'une selection, au moins.
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
				if (!$bookmakers_differents) {

					// vérification si il existe au moins un compte bookmaker correspondant au bookmaker des selections.
					$comptes = $this->currentUser->comptes()->whereHas('bookmaker', function ($query) use ($bookmaker) {
						$query->where('nom', $bookmaker);
					})->where('deleted_at', NULL)->get();

					$bookmakers_count = $comptes->count();
					if ($bookmakers_count == 0) {
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Aucun compte n\'a été crée pour ce bookmaker, rendez vous dans la page configuration pour le créer.',
						));
					}
				}
				$regles = array(
					'tipstersinputdashboard' => 'required|exists:tipsters,id,user_id,' . $this->currentUser->id,
					'typestakeinputdashboard' => 'required|in:u,f',
					'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|unites',
					'amountinputdashboard' => 'required_if:typestakeinputdashboard,f|decimal>0',
					'accountsinputdashboard' => 'required_if:followtypeinputdashboard,normal|exists:bookmaker_user,id,user_id,' . $this->currentUser->id,
					'ticketABCD' => 'required|in:0,1',
					'ticketGratuit' => 'required|in:0,1',
					'ticketLongTerme' => 'required|in:0,1',
					'serieinputdashboard' => 'required_if:ticketABCD,1',
					'letterinputdashboard' => 'required_if:ticketABCD,1|in:A,B,C,D',
					'followtypeinputdashboard' => 'required|in:normal,à blanc',
				);
				$messages = array(
					'typestakeinputdashboard.in' => 'ce type de mise n\'existe pas.',
					'stakeunitinputdashboard.required_if' => 'Vous devez mettre une mise (en unités).',
					'amountinputdashboard.required_if' => 'Vous devez mettre une mise (en devise).',
					'tipstersinputdashboard.required' => 'Choisissez un tipster, si il n\'y a pas de tipster dans la liste, veuillez en créer un dans la page configuration',
					'tipstersinputdashboard.exists' => 'Ce tipster n\'existe pas dans votre liste.',
					'accountsinputdashboard.required_if' => 'Vous devez choisir un compte de bookmaker quand le suivi est de type normal. Si vous n\'avez pas de compte de bookmaker, veuillez en créer un, dans la page configuration',
					'accountsinputdashboard.exists' => 'Ce compte bookmaker n\'existe pas dans votre liste.',
					'serieinputdashboard.required_if' => 'Un n° ou nom de serie est nécéssaire',
					'letterinputdashboard.required_if' => 'Une lettre (ABCD) est nécéssaire',
					'letterinputdashboard.in' => 'la lettre pour l\'option abcd ne correspond pas',
				);

				$validator = Validator::make(Input::all(), $regles, $messages);
				$validator->each('automatic-selection-cote', ['required', 'european_odd']);
				if ($validator->fails()) {
					$array = $validator->getMessageBag()->toArray();
					return Response::json(array(
						'etat' => 0,
						'msg' => $array,
					));
				} else {
					// mise en base de données, les verifs ont toutes été faites plus haut.

					// type de suivi
					$suivi = Input::get('followtypeinputdashboard');
					if ($suivi == 'normal') {
						$suivi = 'n';
					} else {
						$suivi = 'b';
					}

					// tipster
					$tipster = $this->currentUser->tipsters(Input::get('tipstersinputdashboard'))->first();

					// type stake
					$type_stake = Input::get('typestakeinputdashboard');

					// numero de pari par utilisateur + incrementation de celui-ci.
					$this->currentUser->compteur_pari += 1;
					$this->currentUser->save();
					$numero_pari = $this->currentUser->compteur_pari;

					// mise en unités.
					$mise_unites = 0;
					$mise_devise = 0;
					if ($type_stake == 'u') {
						$mise_unites = Input::get('stakeunitinputdashboard');
						$mise_devise = round($mise_unites * $tipster->montant_par_unite, 2);
					} elseif ($type_stake == 'f') {
						$mise_devise = Input::get('amountinputdashboard');
						$mise_unites = round($mise_devise / $tipster->montant_par_unite, 2);
					}

					// market id correspondant a des paris long terme.

					// creation du pari.
					$encourparis = new EnCoursParis(array(
						'followtype' => $suivi,
						'type_profil' => $count > 1 ? 'c' : 's',
						'numero_pari' => $numero_pari,
						'mt_par_unite' => $tipster->montant_par_unite,
						'nombre_unites' => $mise_unites,
						'mise_totale' => $mise_devise,
						'pari_long_terme' => Input::get('ticketLongTerme'),
						'pari_gratuit' => Input::get('ticketGratuit'),
						'pari_live' => Input::get('ticketGratuit'),
						'pari_abcd' => Input::get('ticketABCD'),
						'nom_abcd' => Input::get('serieinputdashboard'),
						'lettre_abcd' => Input::get('letterinputdashboard'),
						'tipster_id' => $tipster->id,
						'user_id' => $this->currentUser->id,
						'bookmaker_user_id' => $suivi == 'n' ? Input::get('accountsinputdashboard') : null
					));
					Clockwork::info($encourparis);

					$encourparis->save();

					$cotes = 1;
					$odds_iterator = 0;
					$odds_array = Input::get('automatic-selection-cote');
					$count_live = 0;

					foreach ($selections_coupon as $selection_coupon) {
						// sport = id de betbrain
						// market  = id de betbrain
						// scope  = id de betbrain
						// competition  = id de pongo
						// equipe1  = id de pongo
						// equipe2  = id de pongo

						// compteur, si superieur a 0 l'en cours pari est live.
						$count_live = $selection_coupon->isLive == null ? $count_live + 0 : $count_live + 1;

						// (on attribue l'id)
						$sport = Sport::firstOrNew(array('id' => $selection_coupon->sport_id, 'name' => $selection_coupon->sport_name));
						$sport->save();

						// (on attribue l'id)
						$market = Market::firstOrNew(array('id' => $selection_coupon->market_id, 'name' => $selection_coupon->market, 'isMatch' => $selection_coupon->isMatch));
						$market->save();

						// creation pour le formulaire manuel.
						$sport_market = SportMarket::firstOrNew(array('sport_id' => $sport->id, 'market_id' => $market->id));
						$sport_market->save();

						// id ajouté manuellement.
						$scope = Scope::find(intval($selection_coupon->scope_id));

						// creation pour le formulaire manuel. ( !! sport_scope !! )
						$sport->scopes()->save($scope);

						if(is_null($scope)){
							$scope = new Scope(); $scope->id = $selection_coupon->scope_id; $scope->name = $selection_coupon->scope; $scope->save();
						}
						Clockwork::info($scope);
						$competition_country = Country::firstOrNew(array('name' => $selection_coupon->event_country_name));
						$competition_country->save();
						$competition = Competition::firstOrNew(array('name' => $selection_coupon->league_name, 'sport_id' => $sport->id, 'country_id' => $competition_country->id));
						$competition->save();

						if ($selection_coupon->isMatch) {
							$equipe1_country = Country::firstOrNew(array('name' => $selection_coupon->home_team_country_name));
							$equipe1_country->save();
							$equipe2_country = Country::firstOrNew(array('name' => $selection_coupon->away_team_country_name));
							$equipe2_country->save();
							$competition_de_equipe1 = Competition::firstOrNew(array('name' => $selection_coupon->league_name, 'sport_id' => $sport->id, 'country_id' => $equipe1_country->id));
							$competition_de_equipe1->save();
							$equipe1 = Equipe::firstOrNew(array('name' => $selection_coupon->home_team, 'sport_id' => $sport->id)); // home team
							$equipe1->save();
							$competition_de_equipe2 = Competition::firstOrNew(array('name' => $selection_coupon->league_name, 'sport_id' => $sport->id, 'country_id' => $equipe2_country->id));
							$competition_de_equipe2->save();
							$equipe2 = Equipe::firstOrNew(array('name' => $selection_coupon->away_team, 'sport_id' => $sport->id)); // away team
							$equipe2->save();
							$competition_equipe1 = CompetitionEquipe::firstOrNew(array('competition_id' => $competition->id, 'equipe_id' => $equipe1->id));
							$competition_equipe1->save();
							$competition_equipe2 = CompetitionEquipe::firstOrNew(array('competition_id' => $competition->id, 'equipe_id' => $equipe2->id));
							$competition_equipe2->save();
						}

						$selection = new Selection(array(
							'date_match' => new Carbon($selection_coupon->game_time),
							'cote' => $odds_array[$odds_iterator],
							'pick' => $selection_coupon->pick,
							'game_id' => $selection_coupon->game_id,
							'game_name' => $selection_coupon->game_name,
							'odd_doubleParam' => $selection_coupon->odd_doubleParam == '-999.888' ? null : $selection_coupon->odd_doubleParam,
							'odd_doubleParam2' => $selection_coupon->odd_doubleParam2 == '-999.888' ? null : $selection_coupon->odd_doubleParam2,
							'odd_doubleParam3' => $selection_coupon->odd_doubleParam3 == '-999.888' ? null : $selection_coupon->odd_doubleParam3,
							'odd_participantParameterName' => $selection_coupon->odd_participantParameterName == 'null' ? null : $selection_coupon->odd_participantParameterName,
							'odd_participantParameterName2' => $selection_coupon->odd_participantParameterName2 == 'null' ? null : $selection_coupon->odd_participantParameterName2,
							'odd_participantParameterName3' => $selection_coupon->odd_participantParameterName3 == 'null' ? null : $selection_coupon->odd_participantParameterName3,
							'odd_groupParam' => $selection_coupon->odd_groupParam == '-999.888' ? null : $selection_coupon->odd_groupParam,
							'isLive' => $selection_coupon->isLive ? true : false,
							'isMatch' => $selection_coupon->isMatch ? true : false,
							'score' => $selection_coupon->score,
							'affichage' => $selection_coupon->affichage,
							'market_id' => $market->id,
							'market_id' => $market->id,
							'scope_id' => $scope->id,
							'sport_id' => $sport->id,
							'competition_id' => $competition->id,
							'equipe1_id' => isset($equipe1) ? $equipe1->id : null,
							'equipe2_id' => isset($equipe2) ? $equipe2->id : null,
							'en_cours_pari_id' => $encourparis->id
						));

						$market->odd_doubleParam = $selection->odd_doubleParam ? 1 : 0;
						$market->odd_doubleParam2 = $selection->odd_doubleParam2 ? 1 : 0;
						$market->odd_doubleParam3 = $selection->odd_doubleParam3 ? 1 : 0;
						$market->odd_participantParameterName = $selection->odd_participantParameterName ? 1 : 0;
						$market->odd_participantParameterName2 = $selection->odd_participantParameterName2 ? 1 : 0;
						$market->odd_participantParameterName3 = $selection->odd_participantParameterName3 ? 1 : 0;
						$market->odd_groupParam = $selection->odd_groupParam ? 1 : 0;
						$market->save();
						Clockwork::info($selection);

						$selection->save();
						$cotes *= $odds_array[$odds_iterator];
					}


					// mis a jour de la cote general.
					$encourparis->cote = $cotes;
					$encourparis->pari_live = $count_live > 0 ? 1 : 0;
					$encourparis->save();

					// supression des coupons.
					foreach ($selections_coupon as $selection_coupon) {
						$selection_coupon->delete();
					}

					// deduction du montant dans le bookmaker correspondant uniquement si le suivi est de type normal.
					if ($suivi == 'n') {
						$compte_to_deduct = $this->currentUser->comptes()->where('id', Input::get('accountsinputdashboard'))->first();
						$compte_to_deduct->bankroll_actuelle -= $mise_devise;
						$compte_to_deduct->save();
					}

					return Response::json(array(
						'etat' => 1,
						'msg' => 'Ticket ajouté',
					));
				}
			}
		}

		public function cashOut()
		{
			$regles = array(
				'cashout-select' => 'required|in:c,p',
				'classic-cash-out' => 'required_if:cashout-select,c|cashout',
				'partial-cash-out' => 'required_if:cashout-select,p|cashout',
			);
			$messages = array(
				'cashout-select.in' => 'Ce type de cashout n\'existe pas.',
				'cashout-select.required' => 'Un type de cashout est nécessaire.',
				'classic-cash-out.required_if' => 'Vous devez spécifier un montant quand le type de suivi est "classic cash out".',
				'partial-cash-out.required_if' => 'Vous devez spécifier un montant quand le type de suivi est "partial cash out".',
			);
			$validator = Validator::make(Input::all(), $regles, $messages);

			if ($validator->fails()) {
				$errors = $validator->getMessageBag()->toArray();
				return Response::json(array(
					'etat' => 0,
					'msg' => $errors,
				));
			} else {
				$encourspari_id = Input::get('id');
				$cashout_type = Input::get('cashout-select');
				$montant = Input::get('classic-cash-out');
				$encourspari = $this->currentUser->enCoursParis()->where('id', $encourspari_id)->firstOrFail();
				if ($cashout_type == 'c') {

					$retour_unites = round($montant / $encourspari->mt_par_unite, 2);
					$profit_unites = round($retour_unites - $encourspari->nombre_unites, 2);
					$retour_devise = $montant;
					$profit_devise = round($montant - $encourspari->mise_totale, 2);

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
						'pari_abcd' => $encourspari->pari_abcd,
						'nom_abcd' => $encourspari->nom_abcd,
						'lettre_abcd' => $encourspari->lettre_abcd,
						'tipster_id' => $encourspari->tipster_id,
						'user_id' => $encourspari->user_id,
						'bookmaker_user_id' => $encourspari->bookmaker_user_id,
					));

					// ajout du paris dans la table termine paris.
					$termine_paris_ajoute = $this->currentUser->termineParis()->save($termine_pari);

					// uniquemenent si le type de suivi est normal.
					if ($encourspari->followtype == 'n') {
						$book = $encourspari->compte->where('id', $encourspari->bookmaker_user_id)->firstOrFail();

						// verification si le bookmaker a une bankroll suffisante en cas de perte.
						$book->bankroll_actuelle += $retour_devise;
						$book->save();
					}

					// lier à a l'id du pari terminé et delier le pari en cours.
					$selections = $encourspari->selections()->get();
					foreach ($selections as $selection) {
						$selection->termine_pari_id = $termine_paris_ajoute->id;
						$selection->en_cours_pari_id = NULL;
						$selection->save();
					}

					// suppression du pari en cours.
					$encourspari->delete();

					return Response::json(array(
						'etat' => 1,
						'msg' => 'pari validé',
					));

				} elseif ($cashout_type == 'p') {

				}
			}
		}


		// formulaire d'ajout manuel
		public function manual_store(){

			$regles = array(
				'tipstersinputdashboard' => 'required|exists:tipsters,id,user_id,' . $this->currentUser->id,
				'typestakeinputdashboard' => 'required|in:u,f',
				'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|unites',
				'amountinputdashboard' => 'required_if:typestakeinputdashboard,f|decimal>0',
				'accountsinputdashboard' => 'required_if:followtypeinputdashboard,normal|exists:bookmaker_user,id,user_id,' . $this->currentUser->id,
				'ticketABCD' => 'required|in:0,1',
				'ticketGratuit' => 'required|in:0,1',
				'ticketLongTerme' => 'required|in:0,1',
				'serieinputdashboard' => 'required_if:ticketABCD,1',
				'letterinputdashboard' => 'required_if:ticketABCD,1|in:A,B,C,D',
				'followtypeinputdashboard' => 'required|in:normal,à blanc',
			);
			$messages = array(

			);

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
				//$array = array_merge($validator->getMessageBag()->toArray(),$validator_selections->getMessageBag()->toArray());
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
				$compte = $this->currentUser->comptes()->where('id', $compte_id)->first();

				// ajout de la date du jour pour la date de creation du pari.
				$date_ajout = Carbon::now();

				// numero de pari par utilisateur + incrementation de celui-ci.
				$this->currentUser->compteur_pari += 1;
				$this->currentUser->save();
				$numero_pari = $this->currentUser->compteur_pari;

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
				$pari = $this->currentUser->enCoursParis()->save($en_cours_pari);

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
					$compte_to_deduct = $this->currentUser->comptes()->where('id', $compte_id)->firstOrfail();
					$compte_to_deduct->bankroll_actuelle -= $mise_totale;
					$compte_to_deduct->save();
				}


				return Response::json(array(
					'etat' => 1,
					'msg' => 'pari ajouté avec succes'
				));
			}
		}

	}
