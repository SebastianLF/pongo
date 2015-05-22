<?php

class Coupon extends Eloquent {
	protected $guarded = array('id');
	protected $table = 'coupon';
	public static $rules = array();
}
