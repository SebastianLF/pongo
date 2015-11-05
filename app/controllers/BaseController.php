<?php

	use Jenssegers\Date\Date;

	class BaseController extends Controller
	{
		public function __construct()
		{
			$this->beforeFilter('auth', array('except' => array('getLogin', 'postAutomaticSelections')));
			$this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
			$this->beforeFilter('devise_missing', array('except' => array('postAutomaticSelections')));

			$this->beforeFilter(function () {
				Event::fire('clockwork.controller.start');
			});

			Date::setLocale('fr');

			// date se trouvant dans le header top bar
			$date = Date::now()->format('l j F Y');
			$month = Date::now()->format('F');

			View::share('date', $date);
			View::share('month', $month);

			/*$getMetadataBag = Session::getMetadataBag();
			Clockwork::info(time());
			Clockwork::info(time() - $getMetadataBag->getLastUsed());*/

			$this->afterFilter(function () {
				Event::fire('clockwork.controller.end');
			});
		}
	}
