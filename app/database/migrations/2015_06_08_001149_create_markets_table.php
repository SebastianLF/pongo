<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('markets', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->boolean('odd_doubleParam')->nullable();
			$table->boolean('odd_doubleParam2')->nullable();
			$table->boolean('odd_doubleParam3')->nullable();
			$table->boolean('odd_participantParameterName')->nullable();
			$table->boolean('odd_participantParameterName2')->nullable();
			$table->boolean('odd_participantParameterName3')->nullable();
			$table->boolean('odd_groupParam')->nullable();
			$table->boolean('isMatch')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('markets');
	}

}
