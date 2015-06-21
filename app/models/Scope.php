<?php

class Scope extends Eloquent {
	protected $fillable = array('id','name');
	protected $table = 'scopes';
	public static $rules = array();
}
