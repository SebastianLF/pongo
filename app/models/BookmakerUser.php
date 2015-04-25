<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BookmakerUser extends Eloquent{
	use SoftDeletingTrait;


    protected $dates = ['deleted_at'];
	protected $table = 'bookmaker_user';

	public function bookmaker(){
		return $this->belongsTo('Bookmaker');
	}

    public function transactions(){
        return $this->hasMany('Transaction');
    }

	public function enCoursParis(){
		return $this->hasMany('EnCoursParis');
	}




}
