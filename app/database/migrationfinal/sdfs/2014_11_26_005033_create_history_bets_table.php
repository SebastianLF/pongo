<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryBetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('history_bets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('typename'); // simple ou combiné
			$table->date('matchdate'); // date de la rencontre
			$table->integer('numeroserie'); // numero pour combiné
			$table->string('sport'); 
			$table->string('country');
			$table->string('competition'); // Ligue 1 , Ligue des champions , coupe du monde
			$table->string('matchname'); // nom de la rencontre
			$table->string('pickname'); // nom du paris : under 2.5 etc..
			$table->string('bookname');
			$table->decimal('odd');
			$table->decimal('stakeamount'); // montant par unité
			$table->string('stakeunit'); // le 1 de 1/10
			$table->string('stakeindicator'); // le 10 de 1/10
			$table->string('result'); // gagné , perdu , remboursé etc.. 
			$table->decimal('profitunit'); //  4 unités
			$table->string('profitsign'); // + ou - (qui va s'afficher devant profitunit)
			$table->decimal('profitamount'); // 80 €
			$table->integer('tipster_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('sport_id')->unsigned();
			$table->integer('country_id')->unsigned();
			$table->integer('competition_id')->unsigned();
			$table->integer('bookmaker_user_id')->unsigned();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('history_bets');
	}

}
