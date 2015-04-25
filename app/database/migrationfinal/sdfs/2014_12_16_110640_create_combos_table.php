<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('combos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string('stakeunit');
            $table->string('stakeindicator');
            $table->decimal('amount');
            $table->decimal('odd');
            $table->string('bookmaker');
            $table->string('tipster');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('combos');
	}

}
