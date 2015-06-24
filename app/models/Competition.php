<?php  

class Competition extends Eloquent {
    protected $table = 'competitions';
    protected $fillable = array('name', 'sport_id', 'country_id');

    public function equipes(){
        return $this->belongsToMany('Equipe','competition_equipe');
    }
}