<?php  

class Competition extends Eloquent {
    protected $table = 'competitions';
    protected $guarded = array();

    public function equipes(){
        return $this->belongsToMany('Equipe','competition_equipe');
    }
}