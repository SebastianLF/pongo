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

	/* Afficher l'historique*/
	public function histories(){
		return $this->hasMany('History');
	}

	public function tipsters(){
		return $this->hasMany('Tipster');
	}
	
	public function bookmakers(){
		return $this->belongsToMany('Bookmaker', 'bookmaker_user', 'user_id', 'bookmaker_id')
				->withPivot('id', 'nom_compte', 'bankroll_totale', 'bonus', 'bankroll_actuelle')->withTimestamps();
	}
	public function comptes(){
		return $this->hasMany('BookmakerUser');
	}

	public function transactions(){
		return $this->hasManyThrough('Transaction', 'BookmakerUser');
	}
	
	public function enCoursParis(){
		return $this->hasMany('EnCoursParis')->orderBy('numero_pari','desc');
	}

	public function termineParis(){
		return $this->hasMany('TermineParis');
	}

	public function recaps(){
		return $this->hasManyThrough('MtMoisTipster','Tipster');
	}

	public function selections()
	{
		return $this->hasManyThrough('Selection', 'EnCoursParis', 'user_id' , 'en_cours_pari_id');
	}
}
