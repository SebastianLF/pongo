<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSportScopeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sport_scope', function(Blueprint $table) {
			$table->increments('id');
			$table->boolean('display')->default(1);
			$table->tinyInteger('pirorite')->default(3);
			$table->integer('sport_id')->unsigned();
			$table->integer('scope_id')->unsigned();
			$table->timestamps();
			$table->foreign('sport_id')->references('id')->on('sports')
				->onDelete('cascade')
				->onUpdate('restrict');
			$table->foreign('scope_id')->references('id')->on('scopes')
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
		Schema::drop('sport_scope');
	}

}
