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
			$table->string('pick');
			$table->string('scope');
			$table->integer('scope_id');
			$table->string('bookmaker');
			$table->integer('bookmaker_id');
			$table->integer('odd_value');
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
			$table->boolean('isLive');
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
