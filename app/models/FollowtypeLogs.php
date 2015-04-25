<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class FollowtypeLogs extends Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('followtype');
    protected $table = 'followtype_logs';

    public function tipster(){
        return $this->belongsTo('Tipster');
    }
}
