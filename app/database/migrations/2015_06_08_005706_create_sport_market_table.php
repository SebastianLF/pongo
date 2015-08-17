<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSportMarketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sport_market', function(Blueprint $table) {
			$table->increments('id');
			$table->boolean('display')->default(1);
			$table->unsignedInteger('sport_id');
			$table->unsignedInteger('market_id');
			$table->timestamps();
			$table->foreign('sport_id')->references('id')->on('sports')
				->onDelete('restrict')
				->onUpdate('cascade');
			$table->foreign('market_id')->references('id')->on('markets')
				->onDelete('restrict')
				->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('sport_market');
	}

}
