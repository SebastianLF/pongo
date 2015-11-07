<?php

	use Illuminate\Database\Eloquent\SoftDeletingTrait;


	class Pari extends Eloquent {

	use SoftDeletingTrait;
	protected $dates = ['deleted_at'];

	protected $table = 'paris';
	protected $guarded = array('id');

	public function user(){
		return $this->belongsTo('User');
	}

	public function selections(){
		return $this->hasMany('Selection','pari_id');
	}

	public function compte(){
		return $this->belongsTo('BookmakerUser','bookmaker_user_id');
	}

	public function tipster(){
		return $this->belongsTo('Tipster');
	}
}
