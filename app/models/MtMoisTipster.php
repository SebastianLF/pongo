<?php

class MtMoisTipster extends Eloquent {
	protected $guarded = array('id');
	protected $table = 'mt_mois_tipster';

	public function tipster(){
		return $this->belongsTo('Tipster');
	}
}
