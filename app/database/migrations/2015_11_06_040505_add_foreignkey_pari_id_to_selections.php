<?php

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class AddForeignkeyPariIdToSelections extends Migration
	{

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::table('selections', function ($table) {
				$table->integer('pari_id')->unsigned();
				$table->foreign('pari_id')->references('id')->on('paris')
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

		}

	}
