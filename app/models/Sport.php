<?php  

class Sport extends Eloquent {

    protected $table = 'sports';
    protected $fillable = array('id','name');

    public function markets(){
        return $this->belongsToMany('Market', 'sport_market', 'sport_id', 'market_id');
    }

    public function scopes(){
        return $this->belongsToMany('Scope', 'sport_scope', 'sport_id', 'scope_id');
    }

}