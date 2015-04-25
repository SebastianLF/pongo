<?php

use Carbon\Carbon;

class Transaction extends Eloquent {

    protected $table = 'transactions';
    protected $fillable = array('type', 'montant', 'description' );

    public function getCreatedAtAttribute($date)
	{
    	return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
	}

	public function getUpdatedAtAttribute($date)
	{
    	return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
	}

    public function compte(){
        return $this->belongsTo('BookmakerUser','bookmaker_user_id');
    }


}