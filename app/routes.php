<?php

	//login page
	Route::get('/', function(){
		return View::make('pages.landing');
	});

	Route::controller('admin', 'AdminController');

	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
	Route::controller('password', 'RemindersController');

	//session timeout pop up
	Route::post('timeout-keep-alive', 'UserController@timeoutKeepAlive');

	// Controlleur ou se situe toutes les infos relatives du parieur, ce qui n'est pas la meme chose que UserController.
	Route::controller('bettor', 'BettorController');

	// welcome page
	Route::resource('welcome', 'WelcomeController');
	Route::post('devise', 'DashboardController@postDevise');



	// dashboard page
	Route::resource('pari', 'PariController');
	Route::resource('encourspari/selection', 'SelectionController');
	Route::get('encourspari/selectionpourcombine/{id}', 'EnCoursParisController@recupererStatusSelectionsPourCombine'); // recupere les status des selections pour chaque select input correspondants au moment d ouvrir le combiné des paris en cours.
	Route::get('dashboard', 'DashboardController@showDashboard');
	Route::post('encourspari/auto', 'EnCoursParisController@store');
	Route::post('cashout', 'EnCoursParisController@cashOut');
	Route::get('parisabcd', 'EnCoursParisController@getEnCoursABCD');
	Route::get('lettreabcd', 'EnCoursParisController@getlettreABCD');
	Route::get('generalrecap', 'DashboardController@showGeneralRecap');
	Route::get('releve', 'DashboardController@showReleve');
	Route::get('releve-details', 'DashboardController@showDetailsReleve');
	Route::get('all-bookmakers-on-autocomplete', 'BookmakerController@getAllBookmakersOnAutocomplete');

	//bookmakers page
	Route::get('bookmakers', 'BettorController@getMyBookmakersPage');
	Route::get('allbookmakers', 'BookmakerController@getAllBookmakers');

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


	// Pari controller
	Route::delete('pari/pending/{id}', 'PariController@deletePendingBet');
	Route::delete('pari/closed/{id}', 'PariController@deleteClosedBet');