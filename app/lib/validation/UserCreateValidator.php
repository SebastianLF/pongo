<?php 
namespace lib\validation;

class UserCreateValidator extends BaseValidator {

    public function __construct()
	{
		$this->regles = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6',
			'password_confirmation' => 'required|same:password',
		);
	}

}