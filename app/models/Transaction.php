<?php

class Transaction extends Eloquent {

    protected $table = 'transactions';
    protected $fillable = array('type', 'montant', 'description' );

    public function compte(){
        return $this->belongsTo('BookmakerUser','bookmaker_user_id');
    }


}