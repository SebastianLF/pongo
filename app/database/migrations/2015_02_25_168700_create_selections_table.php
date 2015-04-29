<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('selections', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('date_match'); // date de la rencontre
			$table->decimal('cote',8,2);
			$table->string('status'); // gagné , perdu , remboursé etc..
			$table->string('resultat_pari'); // le score final par exemple.
			$table->integer('sport_id')->unsigned()->nullable();
			$table->integer('country_id')->unsigned()->nullable();
			$table->integer('competition_id')->unsigned()->nullable();
			$table->integer('type_pari_id')->unsigned()->nullable();
			$table->integer('equipe1_id')->unsigned()->nullable();
			$table->integer('equipe2_id')->unsigned()->nullable();
			$table->integer('en_cours_pari_id')->unsigned()->nullable();
			$table->integer('termine_pari_id')->unsigned()->nullable();
			$table->foreign('sport_id')->references('id')->on('sports')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('country_id')->references('id')->on('countries')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('type_pari_id')->references('id')->on('type_paris')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('equipe1_id')->references('id')->on('equipes')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('equipe2_id')->references('id')->on('equipes')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('en_cours_pari_id')->references('id')->on('en_cours_paris')
				->onDelete('cascade')
				->onUpdate('restrict');
			$table->foreign('termine_pari_id')->references('id')->on('termine_paris')
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

		Schema::table('selections', function(Blueprint $table) {
			$table->dropForeign('selections_sport_id_foreign');
			$table->dropForeign('selections_country_id_foreign');
			$table->dropForeign('selections_competition_id_foreign');
			$table->dropForeign('selections_type_pari_id_foreign');
			$table->dropForeign('selections_equipe1_id_foreign');
			$table->dropForeign('selections_equipe2_id_foreign');
			$table->dropForeign('selections_en_cours_pari_id_foreign');
		});
		Schema::drop('selections');
	}

}
