<?php

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

			/*$getMetadataBag = Session::getMetadataBag();
			Clockwork::info(time());
			Clockwork::info(time() - $getMetadataBag->getLastUsed());*/

			$this->afterFilter(function () {
				Event::fire('clockwork.controller.end');
			});
		}
	}
