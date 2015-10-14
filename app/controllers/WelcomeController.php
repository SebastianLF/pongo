<?php

class WelcomeController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf', array('only' => array('store')));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        App::abort(404);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return Response::view('pages.welcome')->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
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
