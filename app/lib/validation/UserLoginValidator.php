<?php 
namespace lib\validation;

class UserLoginValidator extends BaseValidator {

    public function __construct()
	{
		$this->regles = array(
			'email' => 'required|email|exists:users',
			'password' => 'required'
		);
	}

}