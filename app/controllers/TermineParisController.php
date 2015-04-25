<?php

class TermineParisController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->beforeFilter('auth');
		$this->userid = Auth::id();
		$this->user = User::find($this->userid);
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
			'retour_montant' => 'required|regex:/^\d+(\.\d{1,2})?$/'
		);

		$messages = array(
			'retour_montant.regex' => 'probleme avec le montant calculé'
		);

		$validator = Validator::make(Input::all(), $regles);
		$validator->each('childrows',['sometimes','alpha']);

		if($validator->fails()){
			return Response::json(array(
				'etat' => 0,
				'msg' => $validator->getMessageBag()->toArray()
			));
		}else{
			$encoursparis = EnCoursParis::find(Input::get('id'));
			$status = Input::get('status');
			$mt_par_unite = $encoursparis->mt_par_unite;
			$mise = $encoursparis->mise_totale;
			$cote = $encoursparis->cote;
			$nombre_unites = $encoursparis->nombre_unites;
			$followtype = $encoursparis->followtype;
			$retour = Input::get('retour_montant');
			$retour_unites = null;
			$retour_devise = null;
			$profit_unites = null;
			$profit_devise = null;


			/*
				1 = gagné,
				2 = perdu,
				3 = 1/2 gagné,
				4 = 1/2 perdu,
				5 = annulé,
				6 = remboursé,
			*/

			// calcul suivant le status.
			switch ($status) {
				case 1:
					$retour_devise = $mise * $cote;
					$retour_unites = $retour_devise / $mt_par_unite;
					$profit_devise = $retour_devise - $mise;
					$profit_unites = $retour_unites - $nombre_unites;
					break;
				case 2:
					$retour_devise = 0;
					$retour_unites = 0;
					$profit_devise = 0 - $mise;
					$profit_unites = 0 - $nombre_unites;
					break;
				case 3:
					$retour_devise = (($mise / 2) * $cote) + $mise / 2;
					$retour_unites = (($nombre_unites / 2) * $cote) + $nombre_unites / 2;
					$profit_devise = $retour_devise - $mise ;
					$profit_unites = $retour_unites - $nombre_unites;

					break;
				case 4:
					$retour_devise = $mise / 2;
					$retour_unites = $nombre_unites / 2;
					$profit_devise = 0 - $retour_devise;
					$profit_unites = 0 - $retour_unites;
					break;
				case 5:
					$retour_devise = $mise;
					$retour_unites = $nombre_unites;
					$profit_devise = 0;
					$profit_unites = 0;
					break;
				case 6:
					$retour_devise = $mise;
					$retour_unites = $nombre_unites;
					$profit_devise = 0;
					$profit_unites = 0;
					break;
			}



			// creation du pari validé.
			$termine_paris = new TermineParis(array(
				'followtype' => $encoursparis->followtype,
				'type_profil' => $encoursparis->type_profil,
				'numero_pari' => $encoursparis->numero_pari,
				'cote' => $encoursparis->cote,
				'mt_par_unite' => $encoursparis->mt_par_unite,
				'nombre_unites' => $encoursparis->nombre_unites,
				'indice_unites' => $encoursparis->indice_unites,
				'mise_totale' => $encoursparis->mise_totale,
				'unites_retour' => $retour_unites,
				'unites_profit' => $profit_unites,
				'montant_retour' => $retour_devise,
				'montant_profit' => $profit_devise,
				'pari_long_terme' => $encoursparis->pari_long_terme,
				'pari_abcd' => $encoursparis->pari_abcd,
				'status' => $status,
				'tipster_id' => $encoursparis->tipster_id,
				'user_id' => $encoursparis->user_id,
				'bookmaker_user_id' => $encoursparis->bookmaker_user_id,
				'methode_abcd_id' => $encoursparis->methode_abcd_id,
			));

			// ajout du paris dans la table termine paris.
			$this->user->termineParis()->save($termine_paris);

			// suppression du pari en cours.
			$encoursparis->delete();

			// mis a jour des bankrolls des bookmakers uniquement si le followtype est de type normal.
			if($followtype == 'n'){
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
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('termines.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('termines.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

}
