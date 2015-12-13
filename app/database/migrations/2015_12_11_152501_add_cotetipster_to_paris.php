<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

	class AddCotetipsterToParis extends Migration {

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::table('paris', function(Blueprint $table) {
				$table->decimal('cote_tipster',10,3)->after('cote');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::table('paris', function(Blueprint $table) {
				$table->dropColumn('cote_tipster');
			});
		}

	}