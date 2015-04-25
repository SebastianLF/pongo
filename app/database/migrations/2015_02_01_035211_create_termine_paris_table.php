<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermineParisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('termine_paris', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('followtype',2);// type de suivi
			$table->string('type_profil',2); // simple ou combiné
			$table->integer('numero_pari'); // numero du pari
			$table->decimal('cote',8,2);
			$table->decimal('mt_par_unite',8,2); // montant par unité
			$table->decimal('nombre_unites',5,2); // le 1 de 1/10
			$table->tinyInteger('indice_unites'); // le 10 de 1/10
			$table->decimal('mise_totale', 8,2); // mise totale du pari
			$table->decimal('unites_retour',8,2); //  unites misées + unites gagnées ou perdues
			$table->decimal('unites_profit', 8,2);
			$table->decimal('montant_retour',8,2); // montant misé + montant gagne ou perdu
			$table->decimal('montant_profit', 8,2);
			$table->boolean('pari_long_terme')->default('0');
			$table->boolean('pari_abcd')->default('0');
			$table->string('nom_abcd')->default('0');
			$table->tinyInteger('status'); // gagné , perdu , remboursé etc..
			$table->integer('tipster_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('bookmaker_user_id')->nullable()->unsigned();
			$table->integer('methode_abcd_id')->nullable()->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('termine_paris');
	}

}
