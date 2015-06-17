<?php
	use Carbon\Carbon;

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
			//validation
			$regles = array(
				'typestakeinputdashboard' => 'required|in:u,f',
				'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|integer|min:1',
				'amountinputdashboard' => array('required_if:typestakeinputdashboard,f', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'),
				'tipstersinputdashboard' => 'required|exists:tipsters,id,user_id,' . $this->currentUser->id,
				'accountsinputdashboard' => 'required_if:followtypeinputdashboard,normal|exists:bookmaker_user,id,user_id,' . $this->currentUser->id,
				'RadioOptions' => 'required|in:systemeABCD,parislongterme,aucun',
				'serieinputdashboard' => 'required_if:RadioOptions,systemeABCD',
				'letterinputdashboard' => 'required_if:RadioOptions,systemeABCD|in:A,B,C,D',
			);
			$messages = array(
				'typestakeinputdashboard.in' => 'ce type de mise n\'existe pas.',
				'stakeunitinputdashboard.required_if' => 'Vous devez mettre une mise (en unités).',
				'stakeunitinputdashboard.integer' => 'la mise en unités doit etre un nombre entier.',
				'stakeunitinputdashboard.min' => 'mise en unités minimun : 1',
				'amountinputdashboard.required_if' => 'Vous devez mettre une mise (en devise).',
				'amountinputdashboard.numeric' => 'La mise (en devise) doit etre un nombre.',
				'amountinputdashboard.regex' => 'la mise doit etre un nombre entier positif ou decimal positif(avec 2 chiffres apres la virgule maximum).',
				'tipstersinputdashboard.required' => 'Choisissez un tipster, si il n\'y a pas de tipster dans la liste, veuillez en créer un dans la page configuration',
				'tipstersinputdashboard.exists' => 'Ce tipster n\'existe pas dans votre liste.',
				'accountsinputdashboard.required_if' => 'Vous devez choisir un compte de bookmaker quand le suivi est de type normal. Si vous n\'avez pas de compte de bookmaker, veuillez en créer un, dans la page configuration',
				'accountsinputdashboard.exists' => 'Ce compte bookmaker n\'existe pas dans votre liste.',
			);
			$validator = Validator::make(Input::all(), $regles, $messages);
			$validator->each('datematchinputdashboard', ['sometimes', 'date']);
			$validator->each('sportinputdashboard', ['sometimes', 'exists:sports,id']);
			$validator->each('competitioninputdashboard', ['sometimes', 'exists:competitions,id']);
			$validator->each('team1inputdashboard', ['sometimes', 'exists:equipes,id']);
			$validator->each('team2inputdashboard', ['sometimes', 'exists:equipes,id']);
			$validator->each('picknameinputdashboard', ['sometimes', 'exists:type_paris,id']);
			$validator->each('oddinputdashboard', ['required', 'min:1', 'regex:/^\d+(\.\d{1,2})?$/']);

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
			}else{

				// verifier que le bookmaker soit le meme pour toutes les selections.
				$bookmaker_temp = $selections_coupon->first()->bookmaker;
				$game_id_temp = -1;
				$bookmaker = '';
				$bookmakers_differents = false;

				foreach ($selections_coupon as $selection_coupon) {
					$bookmaker = $selection_coupon->bookmaker;
					$game_id = $selection_coupon->game_id;

					// verification que le game id soit differents si il y a plusieurs selections.
					if($game_id_temp == $game_id){
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Il n\'est pas possible de selectionner deux fois le meme pari.' ,
						));
					}
					if ($bookmaker_temp != $bookmaker) {
						$bookmakers_differents = true; // booléen necessaire pour l'etape suivant.
						return Response::json(array(
							'etat' => 0,
							'msg' => 'Le bookmaker doit etre le meme pour toutes les selections.',
						));
					}else{
						$bookmakers_differents = false;
					}
					$game_id_temp = $selection_coupon->game_id;
				}
				if(!$bookmakers_differents){

					// vérification si il existe au moins un compte bookmaker correspondant au bookmaker des selections.
					$comptes = $this->currentUser->comptes()->whereHas('bookmaker', function ($query) use($bookmaker){
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
					'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|integer|min:1',
					'amountinputdashboard' => array('required_if:typestakeinputdashboard,f', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'),
					'accountsinputdashboard' => 'required_if:followtypeinputdashboard,normal|exists:bookmaker_user,id,user_id,' . $this->currentUser->id,
					'ticketABCD' => 'required|in:0,1',
					'ticketGratuit' => 'required|in:0,1',
					'serieinputdashboard' => 'required_if:ticketABCD,1',
					'letterinputdashboard' => 'required_if:ticketABCD,1|in:A,B,C,D',
				);
				$messages = array(
					'typestakeinputdashboard.in' => 'ce type de mise n\'existe pas.',
					'stakeunitinputdashboard.required_if' => 'Vous devez mettre une mise (en unités).',
					'stakeunitinputdashboard.integer' => 'la mise en unités doit etre un nombre entier.',
					'stakeunitinputdashboard.min' => 'mise en unités minimun : 1',
					'amountinputdashboard.required_if' => 'Vous devez mettre une mise (en devise).',
					'amountinputdashboard.numeric' => 'La mise (en devise) doit etre un nombre.',
					'amountinputdashboard.regex' => 'la mise doit etre un nombre entier positif ou decimal positif(avec 2 chiffres apres la virgule maximum).',
					'tipstersinputdashboard.required' => 'Choisissez un tipster, si il n\'y a pas de tipster dans la liste, veuillez en créer un dans la page configuration',
					'tipstersinputdashboard.exists' => 'Ce tipster n\'existe pas dans votre liste.',
					'accountsinputdashboard.required_if' => 'Vous devez choisir un compte de bookmaker quand le suivi est de type normal. Si vous n\'avez pas de compte de bookmaker, veuillez en créer un, dans la page configuration',
					'accountsinputdashboard.exists' => 'Ce compte bookmaker n\'existe pas dans votre liste.',
					'serieinputdashboard.required_if' => 'Un n° ou nom de serie est nécéssaire',
					'letterinputdashboard.required_if' => 'Une lettre (ABCD) est nécéssaire',
					'letterinputdashboard.in' => 'la lettre ne correspond pas',
				);

				$validator = Validator::make(Input::all(), $regles, $messages);
				$validator->each('automatic-selection-cote', ['required', 'regex:/^\d+(\.\d{1,2})?$/']);
				if ($validator->fails()) {
					$array = $validator->getMessageBag()->toArray();
					return Response::json(array(
						'etat' => 0,
						'msg' => $array,
					));
				} else {

					// mise en base de données, les verifs ont toutes été faites plus haut.
					foreach ($selections_coupon as $selection_coupon) {
						$market = Market::find($selection_coupon->market_id);
						Clockwork::info($market);
						$selection = new Selection(array(
							'date_match' => new Carbon($selection_coupon->game_time),
							'cote' => $selection_coupon->odd_value,
						));
					}




					return Response::json(array(
						'etat' => 1,
						'msg' => 'Ticket ajouté',
					));
				}
			}


		}


	}
