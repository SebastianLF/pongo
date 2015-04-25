<?php 
namespace lib\validation;

interface ValidatorInterface {

    public function fails($id = null);
	public function errors();

}