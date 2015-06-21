<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnCoursParisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('en_cours_paris', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('followtype',2);// type de suivi
            $table->string('type_profil',2); // simple ou combiné
            $table->integer('numero_pari'); // numero du pari
            $table->decimal('cote',8,2);
			$table->decimal('cote_apres_status');
            $table->decimal('mt_par_unite',8,2); // montant par unité
            $table->decimal('nombre_unites',5,2);
            $table->decimal('mise_totale', 8,2); // mise totale du pari
            $table->boolean('pari_long_terme')->default('0');
            $table->boolean('pari_gratuit')->default('0');
            $table->boolean('pari_live')->default('0');
            $table->boolean('pari_abcd')->default('0');
            $table->string('nom_abcd')->nullable();
            $table->string('lettre_abcd',2)->nullable();
            $table->tinyInteger('status'); // gagné , perdu , remboursé etc..
            $table->integer('tipster_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('bookmaker_user_id')->nullable()->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('en_cours_paris');
	}

}
