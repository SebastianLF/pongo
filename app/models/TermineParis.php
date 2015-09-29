<?php

	use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TermineParis extends Eloquent {
	use SoftDeletingTrait;
	protected $dates = ['deleted_at'];

	protected $guarded = array('id');

	public static $rules = array();
	protected $table = 'termine_paris';

	/*public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
	}*/

	public function user(){
		return $this->belongsTo('User');
	}

	public function selections(){
		return $this->hasMany('Selection','termine_pari_id');
	}

	public function compte(){
		return $this->belongsTo('BookmakerUser','bookmaker_user_id')->withTrashed();
	}

	public function tipster(){
		return $this->belongsTo('Tipster')->withTrashed();
	}

	public function tipsterWithTrashed(){
		return $this->belongsTo('Tipster');
	}
}
