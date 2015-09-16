<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddActifToCompetitions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('competitions', function(Blueprint $table) {
			$table->boolean('actif', 1)->after('logo')->default(1);
		});
		Schema::table('competition_equipe', function(Blueprint $table) {
			$table->boolean('actif', 1)->after('equipe_id')->default(1);
		});
		Schema::table('sports', function(Blueprint $table) {
			$table->tinyInteger('priorite', 1)->after('categorie')->default(4);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('competitions', function(Blueprint $table) {
			
		});
	}

}
