<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class CompetitionEquipe extends Eloquent {

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('competition_id', 'equipe_id');
	protected $table = 'competition_equipe';

}
