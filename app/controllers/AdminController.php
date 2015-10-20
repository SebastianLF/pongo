<?php


class AdminController extends BaseController {


	public function __construct(){
		$this->beforeFilter('admin');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

        return View::make('admin.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admins.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('admins.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('admins.edit');
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
	public function getAfficheruser()
	{
		$user = User::where('email', Input::get('email'))->first();
		return $user;
	}


	public function postDeleteuser(){
		$user = User::where('email', Input::get('email'))->delete();
		return $user;
	}

	public function postForcedeleteuser(){
		$user = User::where('email', Input::get('email'))->first();
		$user->enCoursParis()->delete();
		$user->termineParis()->forceDelete();
		$user->tipsters()->forceDelete();
		$user->transactions()->forceDelete();
		$user->comptes()->forceDelete();
		$user->forceDelete();
		return $user;
	}

}
