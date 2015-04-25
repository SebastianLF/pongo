<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmakerUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookmaker_user', function(Blueprint $table){
			$table->increments('id');
			$table->timestamps();
            $table->softDeletes();
			$table->string('nom_compte');
			$table->decimal('bankroll_totale',12,2)->default(0);
			$table->decimal('bonus',12,2)->default(0);
			$table->decimal('bankroll_actuelle',12,2)->default(0);
			$table->integer('bookmaker_id')->unsigned();
			$table->integer('user_id')->unsigned();
			});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookmaker_user');
	}

}
