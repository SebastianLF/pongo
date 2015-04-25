<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevisesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devises', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 10);
            $table->string('initiales', 5);
            $table->string('sigle', 5);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('devises');
    }

}
