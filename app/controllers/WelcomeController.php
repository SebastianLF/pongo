<?php

class WelcomeController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->beforeFilter('welcome_verification', array('only' => array('create')));
		$this->beforeFilter('csrf');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('pages.welcome');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'devise' => 'required|exists:devises,id'
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->passes()){
			$sigle = Devise::find(Input::get('devise'))->sigle;
			Auth::user()->devise = $sigle;
			Auth::user()->save();
			return Redirect::to('dashboard');
		}else{

			return Redirect::back()->withErrors($validator);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('welcomes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('welcomes.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
