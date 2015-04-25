<?php 
namespace lib\validation;

class UserCreateValidator extends BaseValidator {

    public function __construct()
	{
		$this->regles = array(
			'name' => 'required|max:30|alpha|unique:users',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6|same:Confirmation_mot_de_passe',
		);
	}

}