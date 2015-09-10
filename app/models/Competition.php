<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Competition extends Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'competitions';
    protected $fillable = array('name', 'sport_id', 'country_id');

    public function equipes(){
        return $this->belongsToMany('Equipe','competition_equipe');
    }
}