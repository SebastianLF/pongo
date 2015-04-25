<?php

class DeviseTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('devises')->delete();

        DB::table('devises')->insert(
            array('nom' => 'US Dollar', 'initiales' => 'USD', 'sigle' => '$')
        );

        DB::table('devises')->insert(
            array('nom' => 'Euro' , 'initiales' => 'EUR','sigle' => '€')
        );

        DB::table('devises')->insert(
            array('nom' => 'British Pound', 'initiales' => 'GBP', 'sigle' => '£')
        );
		// Uncomment the below to run the seeder
		// DB::table('devise')->insert($devise);
        
	}

}
