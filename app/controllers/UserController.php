<?php


class UserController extends BaseController {

	public function _construct(){
		parent::__construct();
		$this->beforeFilter('ajax', array('only' => 'getTimezone'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

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

	public function getPreferences(){
		return View::make('pages.preferences');
	}

	public function postPreferences(){

		$rules = array(
			'timezone' => 'required|timezone'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}

		Auth::user()->timezone = Input::get('timezone');
		Auth::user()->save();

		return Redirect::back()->with('flash_success', 'Les préfèrences ont été modifiées avec succès.');
}

	public function getTimezone(){
		$timezone = Auth::user()->timezone;
		return Response::json($timezone);
	}


}
