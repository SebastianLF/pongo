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
            $table->softDeletes();
			$table->string('name', 50);
			$table->decimal('montant_par_unite',8,2)->default('0.00'); // max: 999 999,99
			$table->tinyInteger('indice_unite')->default('10'); // 0 à 255
            $table->string('followtype',2 ); // type de suivi
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
