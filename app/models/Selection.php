<?php

class Selection extends Eloquent{
	protected $table = 'selections';
	protected $guarded = array('id');

	public function equipe1(){
		return $this->belongsTo('Equipe','equipe1_id');
	}

	public function equipe2(){
		return $this->belongsTo('Equipe','equipe2_id');
	}

	public function competition(){
		return $this->belongsTo('Competition');
	}

	public function sport(){
		return $this->belongsTo('Sport');
	}

	public function country(){
		return $this->belongsTo('Country');
	}

	public function typePari(){
		return $this->belongsTo('Paritype','type_pari_id');
	}


}
