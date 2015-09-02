<?php 
namespace lib\validation;

class UserCreateValidator extends BaseValidator {

    public function __construct()
	{
		$this->regles = array(
			'name' => 'required|alpha_num|min:6|max:20|unique:users,name',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6|max:20',
			'password_confirmation' => 'required|min:6|same:password',
		);
	}

}