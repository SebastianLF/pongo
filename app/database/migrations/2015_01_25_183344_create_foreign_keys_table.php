<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipsters', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });


        Schema::table('followtype_logs', function(Blueprint $table) {
            $table->foreign('tipster_id')->references('id')->on('tipsters')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('bookmaker_user', function(Blueprint $table) {
            $table->foreign('bookmaker_id')->references('id')->on('bookmakers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('bookmaker_user', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->foreign('bookmaker_user_id')->references('id')->on('bookmaker_user')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('mt_unite_logs', function(Blueprint $table) {
            $table->foreign('tipster_id')->references('id')->on('tipsters')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('en_cours_paris', function(Blueprint $table) {
            $table->foreign('tipster_id')->references('id')->on('tipsters')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('en_cours_paris', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('en_cours_paris', function(Blueprint $table) {
            $table->foreign('bookmaker_user_id')->references('id')->on('bookmaker_user')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('equipes', function(Blueprint $table) {
            $table->foreign('sport_id')->references('id')->on('sports')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('equipes', function(Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('competitions', function(Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('competitions', function(Blueprint $table) {
            $table->foreign('sport_id')->references('id')->on('sports')
                ->onDelete('restrict')
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
        // tipsters
        Schema::table('tipsters', function(Blueprint $table) {
            $table->dropForeign('tipsters_user_id_foreign');
        });

        // followtype_logs
        Schema::table('followtype_logs', function(Blueprint $table) {
            $table->dropForeign('followtype_logs_tipster_id_foreign');
        });

        // bookmaker_user
        Schema::table('bookmaker_user', function(Blueprint $table) {
            $table->dropForeign('bookmaker_user_bookmaker_id_foreign');
        });
        Schema::table('bookmaker_user', function(Blueprint $table) {
            $table->dropForeign('bookmaker_user_user_id_foreign');
        });

        // transactions
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign('transactions_bookmaker_user_id_foreign');
        });

        // mt_unite_logs
        Schema::table('mt_unite_logs', function(Blueprint $table) {
            $table->dropForeign('mt_unite_logs_tipster_id_foreign');
        });

        // en cours paris
        Schema::table('en_cours_paris', function(Blueprint $table) {
            $table->dropForeign('en_cours_paris_tipster_id_foreign');
        });

        Schema::table('en_cours_paris', function(Blueprint $table) {
            $table->dropForeign('en_cours_paris_user_id_foreign');
        });

        Schema::table('en_cours_paris', function(Blueprint $table) {
            $table->dropForeign('en_cours_paris_bookmaker_user_id_foreign');
        });



        // equipes
        Schema::table('equipes', function(Blueprint $table) {
            $table->dropForeign('equipes_sport_id_foreign');
        });
        Schema::table('equipes', function(Blueprint $table) {
            $table->dropForeign('equipes_country_id_foreign');
        });

        // competition
        Schema::table('competitions', function(Blueprint $table) {
            $table->dropForeign('competitions_sport_id_foreign');
        });
        Schema::table('competitions', function(Blueprint $table) {
            $table->dropForeign('competitions_country_id_foreign');
        });


    }

}
