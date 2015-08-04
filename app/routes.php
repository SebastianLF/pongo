<?php

	//login page
	Route::get('/', function(){
		return Redirect::to('auth/login');
	});
	Route::controller('password', 'RemindersController');

	// welcome page
	Route::get('welcome', 'DashboardController@welcome');
	Route::post('devise', 'DashboardController@postDevise');

	// dashboard page
	Route::get('dashboard', 'DashboardController@showDashboard');
	Route::post('encourspari/auto', 'EnCoursParisController@automatic_store');
	Route::post('cashout', 'EnCoursParisController@cashOut');
	Route::get('parisabcd', 'EnCoursParisController@getEnCoursABCD');
	Route::get('lettreabcd', 'EnCoursParisController@getlettreABCD');
	Route::get('recaps', 'DashboardController@showRecaps');

	//config page
	Route::controller('config', 'ConfigController');

	//stats page
	Route::controller('stats', 'StatsController');





// pour la recuperation du listing, en ajax, selon le type dans le lien, pour tipster,bookmaker ou transaction.
	Route::get('pagination/ajax/{type}', 'ConfigController@itemTypeCheck')->where('type', 'tipsters|bookmakers');
	Route::get('dashboard/ajax/{type}', 'DashboardController@itemTypeCheck')->where('type', 'parisencours|parislongterme|parisabcd|paristermine');




	Route::get('comptes', 'BookmakerController@showComptes');
	Route::get('bookmakers', 'BookmakerController@getMyBookmakers');
	Route::get('allbookmakers', 'BookmakerController@showAllBookmakers');

	Route::controller('auth', 'AuthController');


	Route::resource('abcdparis', 'ABCDParisController');
	Route::resource('mtmoistipster', 'MtMoisTipsterController');
	Route::resource('preferences', 'PreferenceController');
	Route::resource('profile', 'ProfileController');
	Route::resource('tipster', 'TipsterController');
	Route::resource('bookmaker', 'BookmakerController');
	Route::resource('transaction', 'TransactionController');
	Route::resource('encourspari', 'EnCoursParisController');
	Route::resource('historique', 'TermineParisController');


	// toujours routes post ou get apres la ressource route.
	Route::resource('coupon', 'CouponController');
	Route::post('coupon', 'CouponController@postAutomaticSelections');
	Route::get('account', 'AccountController@showIndex');

	 Route::get('selections', 'CouponController@getSelections');
	 //Route::post('coupon', array('before' => 'session_check', 'uses' => 'CouponController@postSelections'));
//Route::get('selections', 'DashboardController@refreshSelections');


	/* accounts : ajax request for select input in 'transaction' form(config page) and 'manual add bet' form(dashboard page) */
	Route::get('accounts', 'BookmakerController@showMyAccounts');
	/* tipsters : ajax request for select input about showing id and name for all tipsters of the user auth, in the 'manual addbet' form */
	Route::get('tipsters', 'TipsterController@getMyTipsters');
	/* infosTipster : ajax request for select input about tipster infos in the 'manual addbet' form */
	Route::get('infosTipster', 'TipsterController@infosTipster');

	/* selections */
	Route::post('selection', 'EnCoursParisController@updateSelection');

	/* formulaire d'ajout de pari */
	Route::get('autocomplete/sports', 'AjaxController@getAutocompleteSports');
	Route::get('sports', 'AjaxController@getSports');
	Route::get('countries', 'AjaxController@getCountries');
	Route::get('equipes', 'AjaxController@getEquipes');
	Route::get('competitions', 'AjaxController@getCompetitions');
	Route::get('markets', 'AjaxController@getMarkets');
	Route::get('scopes', 'AjaxController@getScopes');
	Route::get('totalprofit', 'DashboardController@getTotalProfit');
	Route::get('bookmakers', 'AjaxController@getBookmakers');


