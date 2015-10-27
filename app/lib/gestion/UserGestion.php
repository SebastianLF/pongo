<?php 
namespace lib\gestion;

use User;
use Input;
use Hash;
use Tipster;
use Mail;

class UserGestion implements UserGestionInterface {

    private function save($user)
	{
		$user->name = Input::get('name');
		$user->email = Input::get('email');		
		$user->abonnement = 'free';
		$user->devise = 'aucun';
		$user->timezone = 'Europe/Paris';
		$user->langue = 'fr';
		$user->type_cote = 'decimal';
		$user->compteur_pari = 0;

        $id = $user->id;

		if($user->save()){
			Mail::queue('emails.inscription.inscription', array(), function($message) use ($user)
			{
				$message->to($user->email)
					->subject('Bienvenue sur pongo');
			});
		}


        //creation du tipster par defaut
		$tispter = new Tipster;
		$tispter->name = 'Tipster Exemple #1';
		$tispter->montant_par_unite = 20;
		$tispter->followtype = 'n';
        $user->tipsters()->save($tispter);
	}

	public function index($n)
	{
		$users = User::paginate($n);
		return compact('users');
	}

	public function store()
	{
		$user = new User;		
		$user->password = Hash::make(Input::get('password'));
		$this->save($user);
	}

	public function show($id)
	{
		$user = User::find($id);
		return compact('user');
	}

	public function edit($id)
	{
		$user = User::find($id);
		return compact('user');
	}

	public function update($id)
	{
		$user = User::find($id);
		$this->save($user);
	}

	public function destroy($id)
	{
		User::find($id)->delete();
	}

}