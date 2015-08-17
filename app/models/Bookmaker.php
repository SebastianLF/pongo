<?php  

class Bookmaker extends Eloquent {

    protected $table = 'bookmakers';
    protected $fillable = array('nom');

    public function comptes(){
        return $this->hasMany('BookmakerUser');
    }

}