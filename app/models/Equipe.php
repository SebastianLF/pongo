<?php  

class Equipe extends Eloquent {

    protected $table = 'equipes';

    public function competitions(){
        return $this->belongsToMany('Competition','competition_equipe');
    }
}