<?php

class Market extends Eloquent {
	protected $fillable = array('id','name','representation','description');
	protected $table = 'markets';
	public static $rules = array();
}
