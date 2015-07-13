<?php

	use Carbon\Carbon;

	class BaseController extends Controller
	{
		protected $currentUser;
		public function __construct()
		{

			$this->currentUser = Auth::User();
			View::share(['user' => $this->currentUser]);
			View::share(['dt' => Carbon::now()]);

			$this->beforeFilter(function () {
				Event::fire('clockwork.controller.start');
				/*$getMetadataBag = Session::getMetadataBag();
				Clockwork::info(time());
				Clockwork::info(time() - $getMetadataBag->getLastUsed());*/
			});



			$this->afterFilter(function () {
				Event::fire('clockwork.controller.end');
			});
		}
	}
