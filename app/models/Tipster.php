<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Tipster extends Eloquent {

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];
    protected $table = 'tipsters';
    protected $fillable = array('name','montant_par_unite','indice_unite','followtype');

	public static function boot()
	{
		// make the parent (Eloquent) boot method run
		parent::boot();

		// cause a soft delete of a product to cascade to children so they are also soft deleted
		static::deleted(function($tipster)
		{
			$tipster->mtUniteLogs()->delete();
			$tipster->followtypeLogs()->delete();
		});
	}

    public function user(){
		return $this->belongsTo('User');
	}

    public function mtUniteLogs(){
        return $this->hasMany('MtUniteLogs');
    }

    public function followtypeLogs(){
        return $this->hasMany('FollowtypeLogs');
    }

	public function termineParis(){
		return $this->hasMany('TermineParis');
	}

	public function enCoursParis(){
		return $this->hasMany('EnCoursParis');
	}

	public function recap(){
		return $this->hasMany('MtMoisTipster');
	}


}