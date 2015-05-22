<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupon', function(Blueprint $table) {
			$table->increments('id');
			$table->string('pick');
			$table->string('scope');
			$table->integer('equipe_id')->unsigned();
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('cascade')
				->onUpdate('restrict');
			$table->foreign('equipe_id')->references('id')->on('equipes')
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
		//
	}

}
