<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMtMoisTipsterTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_mois_tipster', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('annee');
            $table->integer('mois');
            $table->decimal('unites_profit',12,2)->default(0);
            $table->decimal('montant_profit',12,2)->default(0);
            $table->string('followtype', 2);
            $table->integer('nombre_paris');
            $table->decimal('mt_investi', 12, 2)->default(0);
            $table->integer('tipster_id')->unsigned();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mt_mois_tipster');
    }

}
