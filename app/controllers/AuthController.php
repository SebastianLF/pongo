<?php

use lib\validation\UserCreateValidator as UserCreateValidator;
use lib\validation\UserLoginValidator as UserLoginValidator;
use lib\gestion\UserGestion as UserGestion;

class AuthController extends Controller {

    protected $login_validation;
    protected $create_validation;
    protected $user_gestion;

	public function __construct(
		UserLoginValidator $login_validation,
		UserCreateValidator $create_validation,
		UserGestion $user_gestion
		)
	{
		$this->create_validation = $create_validation;
		$this->login_validation = $login_validation;
		$this->user_gestion = $user_gestion;
	}

	public function getLogin()
	{
		return View::make('pages.login');
	}

	public function postLogin()
	{
		if ($this->login_validation->fails()) {
		  return Redirect::to('auth/login')
		  ->withErrors($this->login_validation->errors())
		  ->withInput();
		} else {
			$user = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);
			if(Auth::attempt($user)) {

				return Redirect::to('dashboard');
			}
		    return Redirect::to('auth/login')
		    ->with('password', 'Le mot de passe n\'est pas correct !')
		    ->withInput();
		}
	}

	public function getInscription(){

		return View::make('pages.inscription');

	}

	public function postInscription(){

		if ($this->create_validation->fails()) {
		  return Redirect::to('auth/inscription')
		  ->withInput()
		  ->withErrors($this->create_validation->errors());
		} else {
			$this->user_gestion->store();
			$user = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);
			if(Auth::attempt($user)) {
				return Redirect::to('welcome/create');
			}
		}
	}

	public function getInscriptionok(){
		return View::make('pages/inscriptionok');
	}

	public function getLogout()
	{
		// supression des selections dans la table coupon correspondant à la session, avant de la quitter.
		$selectionsCoupon = Coupon::where('session_id', Session::getId())->delete();
		Auth::logout();
		return Redirect::to('auth/login');
	}



}