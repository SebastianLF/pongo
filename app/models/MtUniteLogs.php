<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MtUniteLogs extends Eloquent {
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
    protected $table = 'mt_unite_logs';


    public function tipster(){
        return $this->belongsTo('Tipster');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

}
