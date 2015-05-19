<?php


Route::get('/','HomeController@showWelcome');
Route::get('home','HomeController@showWelcome');
 Route::controller('config', 'ConfigController');
 Route::get('stats', 'StatsController@index');


Route::get('dashboard', 'DashboardController@showDashboard');

// pour la recuperation du listing, en ajax, selon le type dans le lien, pour tipster,bookmaker ou transaction.
Route::get('pagination/ajax/{type}', 'ConfigController@itemTypeCheck')->where('type', 'tipsters|bookmakers|transactions');
Route::get('dashboard/ajax/{type}', 'DashboardController@itemTypeCheck')->where('type', 'parisencours|parislongterme|parisabcd|paristermine');

 Route::controller('auth', 'AuthController');
 Route::controller('password', 'RemindersController');
 Route::get('recaps', 'DashboardController@showRecaps');
 Route::resource('abcdparis', 'ABCDParisController');
 Route::resource('mtmoistipster', 'MtMoisTipsterController');
 Route::resource('preferences', 'PreferenceController');
 Route::resource('profile', 'ProfileController');
 Route::resource('tipster', 'TipsterController');
 Route::resource('bookmaker', 'BookmakerController');
 Route::resource('transaction', 'TransactionController');
 Route::resource('encourspari', 'EnCoursParisController');
 Route::resource('historique', 'TermineParisController');
 Route::get('comptes','BookmakerController@showComptes');
 Route::get('bookmakers','BookmakerController@getMyBookmakers');
 Route::get('parisabcd','EnCoursParisController@getEnCoursABCD');
 Route::get('lettreabcd','EnCoursParisController@getlettreABCD');
Route::get('devise', 'DashboardController@getDevise');
Route::post('devise', 'DashboardController@postDevise');

Route::get('account', 'AccountController@showIndex');
Route::post('coupon', 'DashboardController@getBetInformations');


/* accounts : ajax request for select input in 'transaction' form(config page) and 'manual add bet' form(dashboard page) */
Route::get('accounts', 'BookmakerController@showMyAccounts');
/* tipsters : ajax request for select input about showing id and name for all tipsters of the user auth, in the 'manual addbet' form */
Route::get('tipsters', 'TipsterController@getMyTipsters');
/* infosTipster : ajax request for select input about tipster infos in the 'manual addbet' form */
Route::get('infosTipster', 'TipsterController@infosTipster');

/* selections */
Route::post('selection', 'EnCoursParisController@updateSelection');

/* formulaire d'ajout de pari */
 Route::get('autocomplete/sports','AjaxController@getAutocompleteSports');
 Route::get('sports','AjaxController@getSports');
 Route::get('countries','AjaxController@getCountries');
 Route::get('equipes','AjaxController@getEquipes');
 Route::get('competitions','AjaxController@getCompetitions');