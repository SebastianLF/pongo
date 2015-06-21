<?php  

class Equipe extends Eloquent {

    protected $table = 'equipes';
    protected $guarded = array();

    public function competitions(){
        return $this->belongsToMany('Competition','competition_equipe');
    }
}