<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	use SoftDeletingTrait;

	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');
	protected $guarded = array('id');

	public function isAdmin()
	{
		return $this->admin === 1;
	}

	public function tipsters(){
		return $this->hasMany('Tipster');
	}
	
	public function bookmakers(){
		return $this->belongsToMany('Bookmaker', 'bookmaker_user', 'user_id', 'bookmaker_id')
				->withPivot('id', 'nom_compte', 'bonus', 'bankroll_actuelle')->withTimestamps();
	}
	public function comptes(){
		return $this->hasMany('BookmakerUser');
	}

	public function transactions(){
		return $this->hasManyThrough('Transaction', 'BookmakerUser');
	}
	
	public function enCoursParis(){
		return $this->hasMany('Pari')->where('result', 0);
	}

	public function termineParis(){
		return $this->hasMany('Pari')->where('result', 1);
	}

	public function allParis(){
		return $this->hasMany('Pari');
	}

	public function recaps(){
		return $this->hasManyThrough('MtMoisTipster','Tipster');
	}
}
