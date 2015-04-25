<?php

class MethodeABCD extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	protected $table = 'methode_abcd';

	public function user(){
		return $this->belongsTo('User');
	}

}
