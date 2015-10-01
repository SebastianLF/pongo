<?php

	//login page
	Route::get('/', function(){
		return View::make('pages.landing');
	});
	Route::controller('password', 'RemindersController');

	// Controlleur ou se situe toutes les infos relatives au parieur, ce qui n'est pas la meme chose que UserController.
	Route::controller('bettor', 'BettorController');

	// welcome page
	Route::resource('welcome', 'WelcomeController');
	Route::post('devise', 'DashboardController@postDevise');

	// dashboard page
	Route::get('dashboard', 'DashboardController@showDashboard');
	Route::post('encourspari/auto', 'EnCoursParisController@store');
	Route::post('cashout', 'EnCoursParisController@cashOut');
	Route::get('parisabcd', 'EnCoursParisController@getEnCoursABCD');
	Route::get('lettreabcd', 'EnCoursParisController@getlettreABCD');
	Route::get('recaps', 'DashboardController@showRecaps');
	Route::get('generalrecap', 'DashboardController@showGeneralRecap');

	//bookmakers page
	Route::get('bookmakers', 'BettorController@getMyBookmakers');
	Route::get('allbookmakers', 'BookmakerController@showAllBookmakers');

	//tipsters page
	Route::get('tipsters', 'BettorController@getMyTipsters');

	//config page
	Route::controller('config', 'ConfigController');

	//stats page
	Route::controller('stats', 'StatsController');

	//faq page
	Route::get('faq', 'FAQController@index');

	// markets page
	Route::resource('market', 'MarketController');

	// preferences page
	Route::controller('user', 'UserController');


// pour la recuperation du listing, en ajax, selon le type dans le lien, pour tipster,bookmaker ou transaction.
	Route::get('pagination/ajax/{type}', 'ConfigController@itemTypeCheck')->where('type', 'tipsters|bookmakers');
	Route::get('dashboard/ajax/{type}', 'DashboardController@itemTypeCheck')->where('type', 'parisencours|parislongterme|parisabcd|paristermine');

	Route::get('comptes', 'BookmakerController@showComptes');

	Route::controller('auth', 'AuthController');


	Route::resource('abcdparis', 'ABCDParisController');
	Route::resource('mtmoistipster', 'MtMoisTipsterController');
	Route::resource('profile', 'ProfileController');
	Route::resource('tipster', 'TipsterController');
	Route::resource('bookmaker', 'BookmakerController');
	Route::resource('transaction', 'TransactionController');
	Route::resource('encourspari', 'EnCoursParisController');
	Route::resource('historique', 'TermineParisController');


	// toujours routes post ou get apres la ressource route.
	Route::resource('coupon', 'CouponController');
	Route::post('coupon', 'CouponController@postAutomaticSelections');// route de reception des données
	Route::post('manualcoupon', 'CouponController@postManualSelections');
	Route::get('account', 'AccountController@showIndex');

	 Route::get('selections', 'CouponController@getSelections');
	 //Route::post('coupon', array('before' => 'session_check', 'uses' => 'CouponController@postSelections'));
//Route::get('selections', 'DashboardController@refreshSelections');


	/* accounts : ajax request for select input in 'transaction' form(config page) and 'manual add bet' form(dashboard page) */
	Route::get('accounts', 'BookmakerController@showMyAccounts');
	/* tipsters : ajax request for select input about showing id and name for all tipsters of the user auth, in the 'manual addbet' form */
	Route::get('ajax/tipsters', 'TipsterController@getMyTipsters');
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
	//Route::get('bookmakers', 'AjaxController@getBookmakers');
	Route::get('updateaccountform', 'BookmakerController@updateBookmakerAccountOnForm');


