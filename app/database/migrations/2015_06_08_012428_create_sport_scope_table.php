<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSportScopeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sport_scope', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('sport_id')->unsigned();
			$table->integer('scope_id')->unsigned();
			$table->timestamps();
			$table->foreign('sport_id')->references('id')->on('sports')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('scope_id')->references('id')->on('scopes')
				->onDelete('restrict')
				->onUpdate('restrict');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sport_scope');
	}

}
