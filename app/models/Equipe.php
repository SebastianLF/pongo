<?php  

class Equipe extends Eloquent {

    protected $table = 'equipes';
    protected $guarded = array('id');

    public function competitions(){
        return $this->belongsToMany('Competition','competition_equipe');
    }

    public function country(){
        return $this->belongsTo('Country', 'country_id');
    }
}