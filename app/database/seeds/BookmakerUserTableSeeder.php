<?php

class BookmakerUserTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('bookmakeruser')->truncate();

		$bookmakeruser = array(
			array(
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'nom_compte' => 'sdfyu',
				'bankroll_totale' => '500',
				'bonus' => '0',
				'bankroll_actuelle' => '100',
				'bookmaker_id' => '1',
				'user_id' => '2',
			),
			array(
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'nom_compte' => 'zefd',
				'bankroll_totale' => '500',
				'bonus' => '0',
				'bankroll_actuelle' => '589',
				'bookmaker_id' => '1',
				'user_id' => '2',
			),
			array(
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'nom_compte' => 'oiu',
				'bankroll_totale' => '500',
				'bonus' => '0',
				'bankroll_actuelle' => '154.12',
				'bookmaker_id' => '1',
				'user_id' => '2',
			),
		);

		// Uncomment the below to run the seeder
		DB::table('bookmaker_user')->insert($bookmakeruser);
	}

}
