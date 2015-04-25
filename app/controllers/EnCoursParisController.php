<?php
	use Carbon\Carbon;

	class EnCoursParisController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
			$this->beforeFilter('auth');
			$this->userid = Auth::user()->id;
			$this->user = User::find($this->userid);
			$this->timezone = Auth::user()->timezone;
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
			// mise en variables.
			$tipster_id = Input::get('tipstersinputdashboard');
			$montant_par_unite = Input::get('amountperunit');

			// verification de l'existence d'un suivi valide pour eviter tout piratage.
			if (Input::get('followtypeinputdashboard') == 'à blanc') {
				$suivi = 'b';
			} else if (Input::get('followtypeinputdashboard') == 'normal') {
				$suivi = 'n';
			}

			// verification si le tipster et le compte existent pour eviter tout piratage.
			/*Clockwork::info($suivi);
			Clockwork::info($tipster_id);
			Clockwork::info($compte_id);
			$var = count($this->user->tipsters()->where('id', $tipster_id)->first());
			$var2 = count($this->user->comptes()->where('id', $compte_id)->first());
			Clockwork::info($var);
			Clockwork::info($var2);*/


			$bankroll_actuelle = NULL;
			$compte_id = NULL;
			if ($suivi == 'b') {
				$compte_id = NULL;
			} else if ($suivi == 'n') {
				$compte_id = Input::get('accountsinputdashboard');
				$compte = $this->user->comptes()->where('id', $compte_id)->first();
				if(!$compte){
				}else{
					$bankroll_actuelle = $compte->bankroll_actuelle;
				}

			}

			//validation
			$regles = array(
				'followtypeinputdashboard' => 'required|in:normal,à blanc',
				'typestakeinputdashboard' => 'required|in:u,f',
				'linesnum' => 'required|numeric|min:1',
				'stakeunitinputdashboard' => 'required_if:typestakeinputdashboard,u|integer|min:1|max:' . Input::get('stakeindicatorinputdashboard'),
				'amountperunit' => 'required|regex:/^\d+(\.\d{1,2})?$/',
				'amountinputdashboard' => array('required_if:typestakeinputdashboard,f', 'numeric', 'max:' . $bankroll_actuelle, 'regex:/^\d+(\.\d{1,2})?$/'),
				'tipstersinputdashboard' => 'required|exists:tipsters,id,user_id,' . $this->userid,
				'accountsinputdashboard' => 'required_if:followtypeinputdashboard,normal|exists:bookmaker_user,id,user_id,' . $this->userid,
				'RadioOptions' => 'required|in:systemeABCD,parislongterme,aucun',
				'serieinputdashboard' => 'required_if:RadioOptions,systemeABCD',
				'letterinputdashboard' => 'required_if:RadioOptions,systemeABCD|in:A,B,C,D',

			);

			$messages = array(
				'followtypeinputdashboard.required' => 'Un type de suivi est nécéssaire.',
				'followtypeinputdashboard.in' => 'Ce type de suivi n\'existe pas.',
				'typestakeinputdashboard.in' => 'ce type de mise n\'existe pas.',
				'stakeunitinputdashboard.required_if' => 'Vous devez mettre une mise (en unités).',
				'stakeunitinputdashboard.integer' => 'la mise en unités doit etre un nombre entier.',
				'stakeunitinputdashboard.min' => 'mise en unités minimun : 1',
				'stakeunitinputdashboard.max' => 'unités maximum : ' . Input::get('stakeindicatorinputdashboard'),
				'amountperunit.required' => 'Un montant par unité est nécéssaire.',
				'amountperunit.regex' => 'le montant par unité doit etre un nombre entier positif ou decimal positif(avec 2 chiffres apres la virgule maximum).',
				'amountinputdashboard.required_if' => 'Vous devez mettre une mise (en devise).',
				'amountinputdashboard.regex' => 'la mise doit etre un nombre entier positif ou decimal positif(avec 2 chiffres apres la virgule maximum).',
				'amountinputdashboard.max' => 'mise maximum : ' . $bankroll_actuelle . ' (correspond à l\'argent disponible sur ce compte bookmaker)',
				'tipstersinputdashboard.required' => 'Choisissez un tipster, si il n\'y a pas de tipster dans la liste, veuillez en créer un dans la page configuration',
				'tipstersinputdashboard.exists' => 'Ce tipster n\'existe pas dans votre liste.',
				'accountsinputdashboard.required_if' => 'Vous devez choisir un compte de bookmaker quand le suivi est de type normal. Si vous n\'avez pas de compte de bookmaker, veuillez en créer un, dans la page configuration',
				'accountsinputdashboard.exists' => 'Ce compte bookmaker n\'existe pas dans votre liste.',
				'linesnum.min' => 'Remplissez au moins une selection pour pouvoir valider le pari.',
			);
			$validator = Validator::make(Input::all(), $regles, $messages);
			$validator->each('datematchinputdashboard', ['sometimes', 'date']);
			$validator->each('sportinputdashboard', ['sometimes', 'exists:sports,id']);
			$validator->each('competitioninputdashboard', ['sometimes', 'exists:competitions,id']);
			$validator->each('team1inputdashboard', ['sometimes', 'exists:equipes,id']);
			$validator->each('team2inputdashboard', ['sometimes', 'exists:equipes,id']);
			$validator->each('picknameinputdashboard', ['sometimes', 'exists:type_paris,id']);
			$validator->each('choiceinputdashboard', ['sometimes', 'exists:competitions,id']);
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
				// ajout de la date du jour pour la date de creation du pari.
				$date_ajout = Carbon::now();

				// numero de pari par utilisateur + incrementation de celui-ci.
				$this->user->compteur_pari += 1;
				$this->user->save();
				$numero_pari = $this->user->compteur_pari;

				// calcul de la cote generale avec le type de cote 1.00 .
				$cotes = Input::get('oddinputdashboard');
				$cote_general = 1;
				foreach ($cotes as $cote) {
					$cote_general *= $cote;
				}
				Clockwork::info($cote_general);

				// simple = 1 , combiné = superieur à 1
				$type_profil = Input::get('linesnum');
				if ($type_profil > 1) {
					$type_profil = 'c';
				} else if ($type_profil == 1) {
					$type_profil = 's';
				}

				// u = unités , f = flat
				$indice_unites = Input::get('stakeindicatorinputdashboard');
				if (Input::get('typestakeinputdashboard') == 'u') {
					$nombre_unites = Input::get('stakeunitinputdashboard');
					$mise_totale = $montant_par_unite * $nombre_unites;
				} else if (Input::get('typestakeinputdashboard') == 'f') {
					$mise_totale = Input::get('amountinputdashboard');
					$nombre_unites = round($mise_totale / $montant_par_unite, 2);
					Clockwork::info($nombre_unites);
				} else {
					return Response::json(array(
						'etat' => 0,
						'msg' => "ce type de mise n\'existe pas"
					));
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
					'followtype' => $suivi,
					'type_profil' => $type_profil,
					'numero_pari' => $numero_pari,
					'mt_par_unite' => $montant_par_unite,
					'nombre_unites' => $nombre_unites,
					'indice_unites' => $indice_unites,
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
				$pari = $this->user->enCoursParis()->save($en_cours_pari);

				// processus pour ceer les selecions.
				for ($i = 0; $i < Input::get('linesnum'); $i++) {

					if (Input::get('datematchinputdashboard') != '') {
						$datematch = Input::get('datematchinputdashboard');
					} else {
						$datematch = null;
					}
					$cote = Input::get('oddinputdashboard');
					$cote_final = $cote[$i];

					$choix = Input::get('choiceinputdashboard');
					if (Input::get('choiceinputdashboard') != '') {
						$choix1 = $choix[$i];
						$choix = $choix1;
					} else {
						$choix = NULL;
					}
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
						'choix_pari' => $choix,
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
					$compte_to_deduct = $this->user->comptes()->where('id', $compte_id)->firstOrfail();
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
			$var = EnCoursParis::find($id);
			$var->delete();
		}

		public function getEnCoursABCD()
		{
			$nom = Input::get('q');
			$parisabcd = $this->user->enCoursParis()->orderBy('created_at', 'desc')->groupBy('nom_abcd')->where('pari_abcd', '1')->where('nom_abcd', 'LIKE', '%' . $nom . '%')->get(array('nom_abcd AS id', 'nom_abcd AS text'));
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
			Clockwork::info(Input::all());
			$lettreabcd = $this->user->enCoursParis()->where('nom_abcd', $nom)->get(array('lettre_abcd'));
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
		}


	}
