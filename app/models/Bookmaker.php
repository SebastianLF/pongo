<?php  

class Bookmaker extends Eloquent {

    protected $table = 'bookmakers';

    public function comptes(){
        return $this->hasMany('BookmakerUser');
    }

}