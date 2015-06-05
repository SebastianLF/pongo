<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupon', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('pick');
			$table->string('scope');
			$table->integer('scope_id');
			$table->string('bookmaker');
			$table->integer('bookmaker_id');
			$table->decimal('odd_value');
			$table->double('odd_doubleParam');
			$table->double('odd_doubleParam2');
			$table->double('odd_doubleParam3');
			$table->integer('odd_participantParameter');
			$table->string('odd_participantParameterName');
			$table->integer('odd_participantParameter2');
			$table->string('odd_participantParameterName2');
			$table->integer('odd_participantParameter3');
			$table->string('odd_participantParameterName3');
			$table->double('odd_groupParam');
			$table->string('market');
			$table->integer('market_id');
			$table->date('game_time');
			$table->integer('game_id');
			$table->string('game_name');
			$table->integer('sport_id');
			$table->string('sport_name');
			$table->integer('league_id');
			$table->string('league_name');
			$table->string('home_team');
			$table->string('away_team');
			$table->string('score');
			$table->boolean('isLive');
			$table->string('session_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coupon');
	}

}
