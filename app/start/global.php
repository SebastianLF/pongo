<?php

	/*
	|--------------------------------------------------------------------------
	| Register The Laravel Class Loader
	|--------------------------------------------------------------------------
	|
	| In addition to using Composer, you may use the Laravel class loader to
	| load your controllers and models. This is useful for keeping all of
	| your classes in the "global" namespace without Composer updating.
	|
	*/

	ClassLoader::addDirectories(array(

		app_path() . '/commands',
		app_path() . '/controllers',
		app_path() . '/models',
		app_path() . '/database/seeds',

	));

	/*
	|--------------------------------------------------------------------------
	| Application Error Logger
	|--------------------------------------------------------------------------
	|
	| Here we will configure the error logger setup for the application which
	| is built on top of the wonderful Monolog library. By default we will
	| build a basic log file setup which creates a single file for logs.
	|
	*/

	Log::useFiles(storage_path() . '/logs/laravel.log');

	/*
	|--------------------------------------------------------------------------
	| Application Error Handler
	|--------------------------------------------------------------------------
	|
	| Here you may handle any errors that occur in your application, including
	| logging them or displaying custom views for specific errors. You may
	| even register several error handlers to handle different types of
	| exceptions. If nothing is returned, the default error view is
	| shown, which includes a detailed stack trace during debug.
	|
	*/

	App::error(function (Exception $exception, $code) {
		Log::error($exception);
	});


	App::error(function (\Illuminate\Session\TokenMismatchException $exception) {
		return Redirect::route('login')->with('message', 'Your session has expired. Please try logging in again.');
	});


	// validator extension
	Validator::extend('european_odd', function ($attribute, $value, $parameters) {
		if (preg_match("/^\d+(\.\d{1,2})?$/", $value) && $value >= 1) {
			return true;
		}
		return false;
	});

	Validator::extend('decimal', function ($attribute, $value, $parameters) {
		if (preg_match("/^\d+(\.\d{1,2})?$/", $value)) {
			return true;
		}
		return false;
	});

	Validator::extend('decimal>0', function ($attribute, $value, $parameters) {
		if (preg_match("/^\d+(\.\d{1,2})?$/", $value) && $value > 0) {
			return true;
		}
		return false;
	});

	Validator::extend('unites', function ($attribute, $value, $parameters) {
		if (preg_match("/^\d+(\.\d{1,2})?$/", $value) && ctype_digit($value) && $value > 0) {
			return true;
		}
		return false;
	});

	Validator::extend('cashout', function ($attribute, $value, $parameters) {
		if (preg_match("/^\d+(\.\d{1,2})?$/", $value) && $value > 0) {
			return true;
		}
		return false;
	});

	// en cours paris's validation extension
	Validator::extend('mise_montant_en_unites<solde', function ($attribute, $value, $parameters) {
		if ($parameters[1] == 'n') {
			$montant_par_unite = Auth::user()->tipsters()->where('id', $parameters[2])->first()->montant_par_unite;
			$bankroll_actuelle = Auth::user()->comptes()->where('id', $parameters[0])->first()->bankroll_actuelle;
			if (($value*$montant_par_unite) < $bankroll_actuelle) {
				return true;
			}
		}else{
			return true;
		}
		return false;
	});

	Validator::extend('mise_montant_en_devise<solde', function ($attribute, $value, $parameters) {
		if ($parameters[1] == 'n') {
			$bankroll_actuelle = Auth::user()->comptes()->where('id', $parameters[0])->first()->bankroll_actuelle;
			if (($value) < $bankroll_actuelle) {
				return true;
			}
		}elseif ($parameters[1] == 'b') {
			return true;
		}
		return false;
	});


	// to decrypt hashed pass
	Validator::extend('checkHashedPass', function ($attribute, $value, $parameters) {
		if (Hash::check($value, $parameters[0])) {
			return true;
		}
		return false;
	});

	// manual selections's validation extension
	Validator::extend('pick_validation', function ($attribute, $value, $parameters) {
		$market = $parameters[0];

		if ($market == 7) { //Winner
			return true;
		} elseif ($market == 8) { //1x2 with european handicap
			return true;
		} elseif ($market == 9) { //1x2 with european handicap
			if (preg_match("(1X|X2|12)", $value)) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	});

	Validator::extend('oddParam_validation', function ($attribute, $value, $parameters) {
		$market = $parameters[0];

		if ($market == 7) { //Winner
			return true;
		} elseif ($market == 8) { //1x2 with european handicap
			if (preg_match("/^-?[0-9]\d*(\.\d+)?$/", $value)) {
				return true;
			} else {
				return false;
			}
		}

		return false;
	});

	Validator::extend('oddParam2_validation', function ($attribute, $value, $parameters) {
		$market = $parameters[0];
		return false;
	});

	Validator::extend('oddParam3_validation', function ($attribute, $value, $parameters) {
		$market = $parameters[0];
		return false;
	});

	Validator::extend('participantParameter_validation', function ($attribute, $value, $parameters) {
		$market = $parameters[0];

		if ($market == 8) { //1x2 with european handicap
			if (preg_match("(Home|Away)", $value)) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	});

	/*
	|--------------------------------------------------------------------------
	| Maintenance Mode Handler
	|--------------------------------------------------------------------------
	|
	| The "down" Artisan command gives you the ability to put an application
	| into maintenance mode. Here, you will define what is displayed back
	| to the user if maintenance mode is in effect for the application.
	|
	*/

	App::down(function () {
		return Response::make("Be right back!", 503);
	});

	/*
	|--------------------------------------------------------------------------
	| Require The Filters File
	|--------------------------------------------------------------------------
	|
	| Next we will load the filters file for the application. This gives us
	| a nice separate location to store our route and application filter
	| definitions instead of putting them all in the main routes file.
	|
	*/

	require app_path() . '/filters.php';
