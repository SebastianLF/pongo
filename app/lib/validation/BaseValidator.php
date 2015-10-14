<?php
 namespace lib\validation;

use Clockwork;
use Validator;
use Input;

abstract class BaseValidator implements ValidatorInterface {

    protected $regles = array();
	protected $errors = array();

	public function fails($id = null)
	{
		if(!is_null($id)) $this->regles = str_replace('id', $id, $this->regles);

		$message = array('email.required' => 'L\'email est obligatoire', 'email.exists' => 'Cet email est introuvable.');

		$validation = Validator::make(Input::all(), $this->regles, $message);

		if($validation->fails())
		{
			$this->errors = $validation->messages();
			return true;
		}
		return false;
	}

	public function errors()
	{
		return $this->errors;
	}

}