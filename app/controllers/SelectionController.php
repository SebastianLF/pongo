<?php

class SelectionController extends BaseController {

	public function show($id)
	{
		return Selection::find($id);
	}


	public function update($id)
	{
		/*$regles = array(
			'pari-id' => 'required|exists:tipsters,id,user_id,' . Auth::user()->id,
			'selection-id' => 'required|in:u,f',
		);
		$messages = array();
		$validator = Validator::make(Input::all(), $regles, $messages);
		if ($validator->fails()) {
			$array = $validator->getMessageBag()->toArray();
			Clockwork::info($array);
			return Response::json(array(
				'etat' => 0,
				'msg' => $array,
			));
		}*/

		$selection = Selection::find($id);
		$selection->status = Input::get('status');
		$selection->save();

		return Response::json($selection);
	}

}
