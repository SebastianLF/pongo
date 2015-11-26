<?php

	namespace lib\pari;

	use Market;
	use Scope;

	class PariAffichage implements PariAffichageInterface
	{


		public function display($market_id, $scope_id, $pick, $oddParameter1, $oddParameter2, $oddParameter3, $parameterName1, $parameterName2, $parameterName3, $home_team = null, $away_team = null)
		{
			$market = Market::find($market_id);
			$scope = Scope::find($scope_id);
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
			if ($market_id == '7') {
				$affichage_num = 2;
			} elseif ($market_id == '8') {
				$affichage_num = 8;
			} elseif ($market_id == '9') {
				$affichage_num = 3;
			} elseif ($market_id == '11') {
				$affichage_num = 3;
			} elseif ($market_id == '30') {
				$affichage_num = 4;
			} elseif ($market_id == '37') {
				$affichage_num = 5;
			} elseif ($market_id == '43') {
				$affichage_num = 1;
			} elseif ($market_id == '45') {
				$affichage_num = 6;
			} elseif ($market_id == '46') {
				$affichage_num = 1;
			} elseif ($market_id == '47') {
				$affichage_num = 2;
			} elseif ($market_id == '48') {
				$affichage_num = 9;
			}
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

			if ($affichage_num == 1) {
				return $this->UniformiserNomEquipe($pick, $home_team, $away_team);
			} elseif ($affichage_num == 8) {
				$pick = $this->UniformiserNomEquipe($pick, $home_team, $away_team);
				$parameterName1 = $this->UniformiserNomEquipe($parameterName1, $home_team, $away_team);
				$oddParameter1 = $oddParameter1 > 0 ? '+' . $oddParameter1 : $oddParameter1;
				if ($pick == 'Nul') {
					return $pick . ' - (' . $parameterName1 . ' ' . $oddParameter1 . ')';
				} else {
					return $pick . ' (' . $oddParameter1 . ')';
				}
			} elseif ($affichage_num == 2) {
				if ($pick == 'Over') {
					return 'Plus de ' . $oddParameter1 . ' Buts';
				} elseif ($pick == 'Under') {
					return 'Moins de ' . $oddParameter1 . ' Buts';
				}
				return $pick . ' ' . $oddParameter1 . ' Total Goals';
			} elseif ($affichage_num == 3) {
				return $pick;
			} elseif ($affichage_num == 4) {
				return ' Buteur Match: ' . $pick;
			} elseif ($affichage_num == 5) {
				$pick = $this->UniformiserNomEquipe($pick, $home_team, $away_team);
				return 'Se qualifie: ' . $pick;
			} elseif ($affichage_num == 6) {
				return 'Score Exact: ' . $pick;
			} elseif ($affichage_num == 9) {
				if ($oddParameter1 >= 0) {
					return $this->UniformiserNomEquipe($pick, $home_team, $away_team) . ' +' . $oddParameter1;
				}
				return $this->UniformiserNomEquipe($pick, $home_team, $away_team) . ' ' . $oddParameter1;
			}


			/*if($affichage_num == 1){return $market->name.' ('.$scope->representation.') : '.$this->UniformiserNomEquipe($pick, $home_team, $away_team);}
			elseif($affichage_num == 2){return $market->name.' ('.$scope->representation.') : '.$pick;}
			elseif($affichage_num == 3){return $market->name.' ('.$scope->representation.') : '.$this->UniformiserNomEquipe($pick, $home_team, $away_team).' '.$oddParameter1;}
			elseif($affichage_num == 4){return $market->name.' ('.$scope->representation.') : '.$this->UniformiserNomEquipe($pick, $home_team, $away_team).', '.$this->UniformiserNomEquipe($parameterName1,$home_team, $away_team);}
			elseif($affichage_num == 5){return $market->name.' ('.$scope->representation.') : '.$pick.', '.$oddParameter1.'-'.$oddParameter2.' minutes';}
			elseif($affichage_num == 6){
				if($oddParameter1 > 0){
					return $market->name.' ('.$scope->representation.') : '.$pick.', '.$parameterName1.' +'.$oddParameter1;
				}else{
					return $market->name.' ('.$scope->representation.') : '.$pick.', '.$parameterName1.' '.$oddParameter1;
				}}
			elseif($affichage_num == 7){return $market->name.' ('.$scope->representation.') : '.$pick.' Top '.$oddParameter1;}
			elseif($affichage_num == 8){
				if($oddParameter1 > 0){
					return $market->name.' ('.$scope->representation.') : '.$this->UniformiserNomEquipe($pick, $home_team, $away_team).' +'.$oddParameter1;
				}else{
					return $market->name.' ('.$scope->representation.') : '.$this->UniformiserNomEquipe($pick, $home_team, $away_team).' '.$oddParameter1;
				}
			}
			elseif($affichage_num == 9){return $market->name.' ('.$scope->representation.') : '.$parameterName1.', '.$pick.' '.$oddParameter1;}
			elseif($affichage_num == 10){return $market->name.' ('.$scope->representation.') : '.$pick.' '.$oddParameter1;}
			*/
			return 'Erreur affichage pari';
		}

		// fonction pour afficher le nom de l'equipe plutot que 1 ou Home par exemple. (uniquement pour les paris avec 2 equipes qui se confrontent)
		function UniformiserNomEquipe($var, $home_team, $away_team)
		{
			if (!is_null($home_team) && ($var == '1' || $var == 'Home' || $var == $home_team)) {
				return $home_team;
			}
			if (!is_null($away_team) && ($var == '2' || $var == 'Away' || $var == $away_team)) {
				return $away_team;
			}
			if (!is_null($home_team) && !is_null($away_team) && ($var == 'X' || $var == 'Draw')) {
				return 'Nul';
			}
			return $var;
		}
	}



