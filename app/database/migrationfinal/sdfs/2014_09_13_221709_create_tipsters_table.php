<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipstersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipsters', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->decimal('montant_par_unite',8,2); // max: 999 999,99
            $table->tinyInteger('nombre_unite'); // 0 à 255
			$table->tinyInteger('indice_unite'); // 0 à 255
            $table->string('followtype',2 ); //
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
		Schema::drop('tipsters');
	}

}
