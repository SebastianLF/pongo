<?php  

class Competition extends Eloquent {
    protected $table = 'competitions';

    public function equipes(){
        return $this->belongsToMany('Equipe','competition_equipe');
    }
}