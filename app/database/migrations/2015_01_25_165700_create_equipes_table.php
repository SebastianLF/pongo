<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('logo');
			$table->unsignedInteger('sport_id');
            $table->integer('country_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipes');
	}

}
