<?php

class Selection extends Eloquent{
	protected $table = 'selections';
	protected $guarded = array('id');
	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
	}

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

	public function market(){
		return $this->belongsTo('Market');
	}

}
