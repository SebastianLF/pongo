<?php 
namespace lib\gestion;

use User;
use Input;
use Hash;
use Tipster;

class UserGestion implements UserGestionInterface {

    private function save($user)
	{
		$user->name = Input::get('name');
		$user->email = Input::get('email');		
		$user->admin = Input::get('admin') ? 1 : 0;
		$user->save();
        $id = $user->id;

        //creation du tipster par defaut
        $tipster = Tipster::create(array(
            'name' => $user->name, // le nom du tipster sera le meme nom que le pseudo de l'utilisateur
            'montant_par_unite' => '0.00',
            'indice_unite' => '10',
            'followtype' => 'n', // on considere que le followtype demarre en normal
            'user_id' => $id
        ));
        $user->tipsters()->save($tipster);

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