<?php

class CompetitionEquipe extends Eloquent {
	protected $fillable = array('competition_id', 'equipe_id');
	protected $table = 'competition_equipe';
	public static $rules = array();
}
