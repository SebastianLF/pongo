<?php

class Market extends Eloquent {
	protected $fillable = array('id','name','description');
	protected $table = 'markets';
	public static $rules = array();
}
