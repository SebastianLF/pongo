<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paris', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('numero_pari'); // numero du pari
			$table->string('followtype',2);// type de suivi
			$table->string('type_profil',2); // simple ou combiné
			$table->decimal('cote',8,3);
			$table->decimal('cote_apres_status',8,3);
			$table->decimal('mt_par_unite', 8,2); // montant par unité
			$table->decimal('nombre_unites', 22,16);
			$table->decimal('mise_totale', 8,2); // mise totale du pari
			$table->decimal('unites_retour', 22,16); //  unites misées + unites gagnées ou perdues
			$table->decimal('unites_profit', 22,16);
			$table->decimal('montant_retour', 8,2); // montant misé + montant gagne ou perdu
			$table->decimal('montant_profit', 8,2);
			$table->tinyInteger('status'); // gagné , perdu , remboursé etc..
			$table->tinyInteger('result'); // 0 = en cours, 1 = cloturé.
			$table->boolean('pari_long_terme')->default('0');
			$table->boolean('pari_gratuit')->default('0');
			$table->boolean('pari_live')->default('0');
			$table->boolean('cashouted')->default('0');
			$table->boolean('pari_abcd')->default('0');
			$table->string('nom_abcd')->nullable();
			$table->string('lettre_abcd',2)->nullable();
			$table->integer('tipster_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('bookmaker_user_id')->nullable()->unsigned();
			$table->foreign('tipster_id')->references('id')->on('tipsters')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('bookmaker_user_id')->references('id')->on('bookmaker_user')
				->onDelete('restrict')
				->onUpdate('restrict');
			$table->foreign('user_id')->references('id')->on('users')
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
		Schema::drop('paris');
	}

}
