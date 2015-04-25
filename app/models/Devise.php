<?php

class Devise extends Eloquent {

    protected $table = 'devises';
    protected $guarded = array('id');

	public static $rules = array();


}
