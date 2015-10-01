<?php

	class TipsterController extends BaseController
	{
		public function __construct()
		{
			parent::__construct();
		}


		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			return App::abort('404');
		}


		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
		}


		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			$regles = array(
				'name_tipster' => 'required|max:20|unique:tipsters,name,NULL,id,user_id,' . Auth::user()->id . ',deleted_at,NULL',
				'suivi_tipster' => 'required|in:n,b',
				'amount_tipster' => 'required|decimal>0',
			);
			$messages = array(
				'name_tipster.required' => 'Un nom est nécéssaire',
				'name_tipster.max' => 'Nom trop long, 20 caracteres maximum',
				'name_tipster.unique' => 'Ce tipster existe deja',
				'suivi_tipster.required' => "Un type de suvi est nécéssaire",
				'suivi_tipster.alpha' => "Le type de suivi ne doit comporter que des lettres",
				'amount_tipster.required' => 'Un montant par unité est requis.',
				'amount_tipster.regex' => "Le montant par unité doit etre au format: 17.65",
			);

			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				return Response::json(array(
					'success' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {
				$name = Input::get('name_tipster');
				$stakeamount = Input::get('amount_tipster');
				$followtype = Input::get('suivi_tipster');

				/*crée le tipster dans la table tipsters (create() fonctionne que si on a renseigné
					fillable ou guarded dans le modele*/
				$tipster = new Tipster(array(
					'name' => $name,
					'montant_par_unite' => $stakeamount,
					'followtype' => $followtype,
				));

				$mtunitelogs = new MtUniteLogs(array(
					'montant_par_unite' => $stakeamount,
					'followtype' => $followtype,
				));

				$followtypelogs = new FollowtypeLogs(array(
					'followtype' => $followtype
				));

				// enregistrement du tipster.
				$tipsterfinal = Auth::user()->tipsters()->save($tipster);

				// creation d'un log montant unité.
				$tipsterfinal->mtUniteLogs()->save($mtunitelogs);

				// creation d'un log montant unité.
				$tipsterfinal->FollowtypeLogs()->save($followtypelogs);

				/* données qui doivent etre traitées par le callback ajax */
				return Response::json(array(
					'success' => true,
					'tipster' => $tipsterfinal,
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

		}

		public function update($id)
		{

			$regles = array(
				'name_tipster' => 'required|max:20|unique:tipsters,name,' . $id . ',id,user_id,' . Auth::user()->id . ',deleted_at,NULL',
				'amount_tipster' => 'required|decimal>0',
				'suivi_tipster' => 'required|in:n,b',
			);
			$messages = array(
				'name_tipster.required' => 'Un nom est nécéssaire',
				'name_tipster.max' => 'Nom trop long, 20 caracteres maximum',
				'name_tipster.unique' => 'Ce tipster existe deja',
				'amount_tipster.required' => 'Une unité de mise est nécéssaire',
				'suivi_tipster.required' => "Un type de suvi est nécéssaire",
				'suivi_tipster.in' => 'Le suivi doit etre normal ou à blanc'
			);
			$validator = Validator::make(Input::all(), $regles, $messages);
			if ($validator->fails()) {
				return Response::json(array(
					'state' => false,
					'errors' => $validator->getMessageBag()->toArray()
				));
			} else {
				// récuperation des entrées
				$name = Input::get('name_tipster');
				$stakeamount = Input::get('amount_tipster');
				$followtype = Input::get('suivi_tipster');

				// trouver le tipster
				$tipsterfinal = Tipster::find($id);

				// gestion du montant_par_unite
				// creation d'un nouveau montant_par_unite
				$mtunitelogs = new MtUniteLogs(array(
					'montant_par_unite' => $stakeamount,
				));

				// uniquement si la nouvelle valeur est differente de celle du tipster actuellement.
				if ($tipsterfinal->montant_par_unite != $stakeamount) {
					// creation d'un nouveau mt unite logs
					$tipsterfinal->mtUniteLogs()->save($mtunitelogs);
				}

				// creation d'un nouveau log de type de suivi.
				$followtypelogs = new FollowtypeLogs(array(
					'followtype' => $followtype,
				));

				// uniquement si la nouvelle valeur est differente de celle du tipster actuellement.
				if ($tipsterfinal->followtype != $followtype) {
					// creation d'un nouveau followtype log
					$tipsterfinal->followtypeLogs()->save($followtypelogs);
				}


				// mis a jour du tipster apres toutes les gestions effectuées.
				Tipster::where('id', '=', $id)->update(array('name' => $name, 'montant_par_unite' => $stakeamount, 'followtype' => $followtype));

				return Response::json(array(
					'state' => true,
				));
			}
		}


		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return Response
		 */

		public function destroy($id)
		{
			$tipster = Auth::user()->tipsters()->where('id', $id)->first();
			// si il y a un pari ou plus en cours associé a ce tipster, il faut d'abord les supprimer.
			if (is_null($tipster)) {
				return Response::json(array(
					'state' => 0,
				));
			} else {
				if ($tipster->enCoursParis()->count() > 0) {
					return Response::json(array(
						'state' => 2,
					));
				} else {
					$tipster->delete();
					return Response::json(array(
						'state' => 1,
					));
				}
			}
		}

		public function mtUniteLogs()
		{

			$id = Input::get('id');
			$tipster = Tipster::find($id);
			$mtunitelogs = $tipster->mtUniteLogs()->lists('created_at', 'montant_par_unite');
			//$mtunitelogs->offsetSet(0, array('devise' => $devise));

			return $mtunitelogs;
		}

		public function getMyTipsters()
		{
			$nom = Input::get('q');
			$tipsters = Auth::user()->tipsters()->where('name', 'LIKE', '%' . $nom . '%')->get(array('id', 'name AS text', 'montant_par_unite', 'followtype'));
			return Response::json($tipsters);
		}

		public function infosTipster()
		{
			$tipster_id = Input::get('tipster_id');
			$tipster = Auth::user()->tipsters()->where('id', '=', $tipster_id)->first(array('montant_par_unite', 'followtype'));
			return Response::json($tipster);
		}


	}
