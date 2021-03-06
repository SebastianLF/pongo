<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

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
			$table->integer('scope_id');
			$table->string('scope');
			$table->integer('bookmaker_id');
			$table->string('bookmaker');
			$table->decimal('odd_value',8,3);
			$table->double('odd_doubleParam')->nullable();
			$table->double('odd_doubleParam2')->nullable();
			$table->double('odd_doubleParam3')->nullable();
			$table->string('odd_participantParameterName')->nullable();
			$table->string('odd_participantParameterName2')->nullable();
			$table->string('odd_participantParameterName3')->nullable();
			$table->double('odd_groupParam')->nullable();
			$table->integer('market_id');
			$table->string('market');
			$table->dateTime('game_time');
			$table->string('game_name')->nullable();
			$table->integer('game_id')->nullable(); // null = manual
			$table->string('sport_id');
			$table->string('sport_name');
			$table->string('league_id');
			$table->string('league_name');
			$table->string('event_country_name');
			$table->string('home_team')->nullable();
			$table->string('home_team_country_name')->nullable();
			$table->string('away_team')->nullable();
			$table->string('away_team_country_name')->nullable();
			$table->string('score')->nullable();
			$table->boolean('isLive');
			$table->boolean('isOutright');
			$table->boolean('isMatch'); // si true, sport co et sinon sport individuel.
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
