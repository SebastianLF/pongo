<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

	class CreateUsersTable extends Migration {

    public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 30)->unique()->nullable();
			$table->string('email', 100)->unique();
			$table->string('password', 64);
			$table->string('abonnement')->default('free');
            $table->string('devise', 5)->default('non');
            $table->string('timezone')->default('Europe/Paris');
            $table->string('langue');
            $table->string('type_cote');
			$table->integer('compteur_pari')->default(0);
			$table->string('remember_token', 100)->nullable();
			$table->boolean('admin')->default(false);
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}