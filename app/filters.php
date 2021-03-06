<?php

	/*
	|--------------------------------------------------------------------------
	| Application & Route Filters
	|--------------------------------------------------------------------------
	|
	| Below you will find the "before" and "after" events for the application
	| which may be used to do any work before or after a request into your
	| application. Here you may also register your custom route filters.
	|
	*/


	/*App::after(function ($request, $response) {
		$response->headers->set('Access-Control-Allow-Origin', '*');
		return $response;
	});*/

	/*
	|--------------------------------------------------------------------------
	| Authentication Filters
	|--------------------------------------------------------------------------
	|
	| The following filters are used to verify that the user of the current
	| session is logged into this application. The "basic" filter easily
	| integrates HTTP Basic authentication for quick, simple checking.
	|
	*/

	Route::filter('auth', function () {
		if ($quest = Auth::guest()) {
			if (Request::ajax()) {
				return Response::make('Unauthorized', 401);
			} else {
				return Redirect::guest('auth/login');
			}
		}
	});


	Route::filter('auth.basic', function () {
		return Auth::basic();
	});

	/*
	|--------------------------------------------------------------------------
	| Guest Filter
	|--------------------------------------------------------------------------
	|
	| The "guest" filter is the counterpart of the authentication filters as
	| it simply checks that the current user is not logged in. A redirect
	| response will be issued if they are, which you may freely change.
	|
	*/

	Route::filter('guest', function () {
		if (Auth::check()) return Redirect::to('/');
	});

	/*
	|--------------------------------------------------------------------------
	| CSRF Protection Filter
	|--------------------------------------------------------------------------
	|
	| The CSRF filter is responsible for protecting your application against
	| cross-site request forgery attacks. If this special token in a user
	| session does not match the one given in this request, we'll bail.
	|
	*/

	Route::filter('admin', function($route, $request)
	{
		if ( ! Auth::user()->isAdmin()) {
			return App::abort(401, 'You are not authorized.');
		}
	});



	Route::filter('csrf', function () {

		$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');

		if (Session::token() != $token) {
			throw new Illuminate\Session\TokenMismatchException;
		}
	});

	/*
	|--------------------------------------------------------------------------
	| Custom Filter
	|--------------------------------------------------------------------------
	|
	| The CSRF filter is responsible for protecting your application against
	| cross-site request forgery attacks. If this special token in a user
	| session does not match the one given in this request, we'll bail.
	|
	*/


	Route::filter('expired', function () {
		$bag = Session::getMetadataBag();
		$max = Config::get('session.lifetime') * 60;
		if ($bag && $max < (time() - $bag->getLastUsed())) {
			return Redirect::route('auth/login');
		}
	});


	Route::filter('ajax', function () {
		if (!Request::ajax()) App::abort(404);
	});

	// lorsque la devise n'est pas specifié
	Route::filter('devise_missing', function () {
		if (Auth::user()->devise == 'aucun' && Request::path() != 'welcome/create' && Request::path() != 'welcome') {
			return Redirect::route('welcome.create');
		}elseif(Auth::user()->devise != 'aucun' && Request::path() == 'welcome/create'){
			return Redirect::to('dashboard');
		}
	});



