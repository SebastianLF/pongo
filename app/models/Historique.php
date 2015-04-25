<?php  

class Historique extends Eloquent {

    protected $table = 'histories';


     public function user()
    {
        return $this->belongsTo('User');
    }


    public function paritype()
	{
		return $this->BelongsTo('Paritype');
	}


	 public function bookmaker()
    {
        return $this->BelongsTo('Bookmaker');
    }

}