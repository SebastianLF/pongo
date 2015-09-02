<?php

class ProfileController extends BaseController {
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
        return View::make('pages.profile');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'actuel_mdp' => 'required|checkHashedPass:'.Auth::user()->password,
			'nouveau_mdp' => 'required|min:6|max:20',
			'confirmation_mdp' => 'required|min:6|same:nouveau_mdp',
			);
		$messages = array(
			'actuel_mdp.required' => 'Le mot de passe actuel est obligatoire.',
			'actuel_mdp.checkHashedPass' => 'Mot de passe actuel incorrecte.',
			'nouveau_mdp.required' => 'Un nouveau mot de passe est obligatoire.',
			'nouveau_mdp.min' => 'Le nouveau mot de passe doit contenir au moins 6 caractères.',
			'nouveau_mdp.max' => 'Le nouveau mot de passe doit contenir au maximum 20 caractères.',
			'confirmation_mdp.required' => 'Le mot de passe de confirmation est obligatoire.',
			'confirmation_mdp.min' => 'Le mot de passe de confirmation doit contenir au moins 6 caractères.',
			'confirmation_mdp.max' => 'Le mot de passe de confirmation doit contenir au maximum 20 caractères.',
			'confirmation_mdp.same' => 'Le nouveau mot de passe et le mot de passe de confirmation doivent être identiques.',
			);

		$validator = Validator::make(Input::all(), $rules, $messages);
		if($validator->fails()){
			return Redirect::to('profile')->withErrors($validator)->withInput(Input::except('nouveau_mdp', 'confirmation_mdp'));
		}

		Auth::user()->password = Hash::make(Input::get('nouveau_mdp'));
		Auth::user()->save();

		Session::flash('mdp_updated', 'Mot de passe mis à jour avec succès!'); 

		return Redirect::to('profile');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
