<?php

class SelectionController extends BaseController {

	public function show($id)
	{

	}


	public function update($id)
	{
		$regles = array(
			'pari-id' => 'required|exists:tipsters,id,user_id,' . Auth::user()->id,
		);

		$validator = Validator::make(Input::all(), $regles, null);
		$validator->each('status', ['required', 'in:0,1,2,3,4,5,9']);

		if ($validator->fails()) {
			$array = $validator->getMessageBag()->toArray();
			Clockwork::info($array);
			return Response::json(array(
				'etat' => 0,
				'msg' => $array,
			));
		}

		$selection = Selection::find($id);
		$selection->status = Input::get('status');
		$selection->save();

		return Response::json($selection);
	}

}
