<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentBetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_bets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string('followtype',2);
			$table->string('type_profil',2); // simple ou combiné
			$table->date('date_match'); // date de la rencontre
			$table->integer('numero_pari'); // numero pour combiné
			$table->string('nom_match', 100); // nom de la rencontre
            $table->string('equipe1', 50);
            $table->string('equipe2', 50);
			$table->decimal('cote',8,2);
            $table->decimal('cote_multiple',8,2);
			$table->decimal('mt_par_unite',8,2); // montant par unité
			$table->decimal('nombre_unites',5,2); // le 1 de 1/10
			$table->tinyInteger('indice_unites'); // le 10 de 1/10
            $table->decimal('mise_totale', 8,2); // mise totale du pari
			$table->decimal('unites_retour',8,2); //  unites misées + unites gagnées ou perdues
            $table->decimal('unites_profit', 8,2);
			$table->decimal('montant_retour',8,2); // montant misé + montant gagne ou perdu
            $table->decimal('montant_profit', 8,2);
			$table->integer('tipster_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('sport_id')->unsigned();
			$table->integer('country_id')->unsigned();
			$table->integer('competition_id')->unsigned();
			$table->integer('bookmaker_user_id')->unsigned();
            $table->integer('resultat_id')->unsigned(); // gagné , perdu , remboursé etc..
            $table->integer('type_pari_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_bets');
	}

}
