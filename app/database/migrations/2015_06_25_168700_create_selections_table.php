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
			$table->dateTime('date_match'); // date de la rencontre
			$table->decimal('cote',8,2);
			$table->decimal('cote_apres_status');
			$table->tinyInteger('status')->default(0); // gagné , perdu , remboursé etc..
			$table->string('pick');
			$table->integer('game_id');
			$table->string('game_name');
			$table->double('odd_doubleParam')->nullable();
			$table->double('odd_doubleParam2')->nullable();
			$table->double('odd_doubleParam3')->nullable();
			$table->string('odd_participantParameterName');
			$table->string('odd_participantParameterName2');
			$table->string('odd_participantParameterName3');
			$table->double('odd_groupParam')->nullable();
			$table->boolean('live')->default(0);
			$table->boolean('pari_long_terme')->default('0');
			$table->string('score');
			$table->unsignedInteger('market_id')->nullable();
			$table->unsignedInteger('scope_id')->nullable();
			$table->unsignedInteger('sport_id')->nullable();
			$table->integer('competition_id')->unsigned()->nullable();
			$table->integer('equipe1_id')->unsigned()->nullable();
			$table->integer('equipe2_id')->unsigned()->nullable();
			$table->integer('en_cours_pari_id')->unsigned()->nullable();
			$table->integer('termine_pari_id')->unsigned()->nullable();
			$table->foreign('market_id')->references('id')->on('markets')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('scope_id')->references('id')->on('scopes')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('sport_id')->references('id')->on('sports')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('competition_id')->references('id')->on('competitions')
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
		Schema::drop('selections');
	}

}
