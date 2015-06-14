<?php  

class Bookmaker extends Eloquent {

    protected $table = 'bookmakers';
    protected $guarded = array('id');

    public function comptes(){
        return $this->hasMany('BookmakerUser');
    }

}