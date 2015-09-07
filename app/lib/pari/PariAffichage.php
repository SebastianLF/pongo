<?php

namespace lib\pari;

use Market;

class PariAffichage implements PariAffichageInterface{

	public function display($market_id, $pick, $oddParameter1, $oddParameter2, $oddParameter3, $parameterName1, $parameterName2, $parameterName3){
		$market = Market::find($market_id);
		// affectation du numero d'affichage selon le type de pari.
		// 1 , 'pick'
		// 2 , 'pick doubleparam'
		// 3 , 'pick, parametername1 doubleparam1
		// 4 , 'pick, doubleparam1-doubleparam2 minutes'
		// 5 , 'parametername1 doubleparam1' avec '+'
		// 6 , 'pick Top doubleparam1'
		// 7 , 'pick (optional + )doubleparam'
		// 8 , 'parametername1 pick doubleparam1
		$affichage_num = '';
		if ($market_id == '7') {$affichage_num = 1;}
		elseif ($market_id == '8') {$affichage_num = 3;}
		elseif ($market_id == '9') {$affichage_num = 1;}
		elseif ($market_id == '43') {$affichage_num = 1;}
		/*elseif ($market_id == '28') {
			return 6;
		} elseif ($market_id == '48') {
			return 2;
		} elseif ($market_id == '46') {
			return 1;
		} elseif ($market_id == '47') {
			return 7;
		} elseif ($market_id == '158') {
			return 1;
		} elseif ($market_id == '145') {
			return 1;
		} elseif ($market_id == '77') {
			return 8;
		} elseif ($market_id == '79') {
			return 1;
		} elseif ($market_id == '150') {
			return 1;
		} elseif ($market_id == '151') {
			return 1;
		} elseif ($market_id == '118') {
			return 2;
		} elseif ($market_id == '112') {
			return 1;
		} elseif ($market_id == '24') {
			return 1;
		} elseif ($market_id == '12') {
			return 1;
		} elseif ($market_id == '140') {
			return 1;
		} elseif ($market_id == '94') {
			return 4;
		} elseif ($market_id == '39') {
			return 5;
		}  else {
			return 0;
		}*/

		if($affichage_num == 1){return $market->name.' : '.$pick;}
		elseif($affichage_num == 2){return $market->name.' : '.$pick.' '.$oddParameter1;}
		elseif($affichage_num == 3){return $market->name.' : '.$pick.', '.$parameterName1.' '.$oddParameter1;}
		elseif($affichage_num == 4){return $market->name.' : '.$pick.', '.$oddParameter1.'-'.$oddParameter2.' minutes';}
		elseif($affichage_num == 5){
			if($oddParameter1 > 0){
				return $market->name.' : '.$pick.', '.$parameterName1.' +'.$oddParameter1;
			}else{
				return $market->name.' : '.$pick.', '.$parameterName1.' '.$oddParameter1;
			}}
		elseif($affichage_num == 6){return $market->name.' : '.$pick.' Top '.$oddParameter1;}
		elseif($affichage_num == 7){
			if($oddParameter1 > 0){
				return $market->name.' : '.$pick.' +'.$oddParameter1;
			}else{
				return $market->name.' : '.$pick.' '.$oddParameter1;
		}}
		elseif($affichage_num == 8){return $market->name.' : '.$parameterName1.', '.$pick.' '.$oddParameter1;}

		return 'non connu';
	}
}


