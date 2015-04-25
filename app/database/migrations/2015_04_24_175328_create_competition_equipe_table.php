<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompetitionEquipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('competition_equipe', function(Blueprint $table) {
			$table->increments('id');
			$table->boolean('active');
			$table->integer('competition_id')->unsigned();
			$table->integer('equipe_id')->unsigned();
			$table->timestamps();
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('equipe_id')->references('id')->on('equipes')
				->onDelete('cascade')
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
		Schema::drop('competition_equipe');
	}

}
