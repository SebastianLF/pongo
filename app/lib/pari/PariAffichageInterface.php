<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 07/09/2015
 * Time: 15:28
 */

namespace lib\pari;

interface PariAffichageInterface {
	public function display($market_id, $pick, $oddParameter1, $oddParameter2, $oddParameter3, $parameterName1, $parameterName2, $parameterName3);
}

