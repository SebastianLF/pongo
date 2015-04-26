<?php

class EquipeTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('equipes')->truncate();

		$equipe = array(
			array(
				'name' => 'atletico',
				'logo' => 'football/espagne/Clubs/normal/1661.png',
				'sport_id' => '1',
				'country_id' => '2',
			),
			array(
				'name' => 'almeria',
				'logo' => 'football/espagne/Clubs/normal/1666.png',
				'sport_id' => '1',
				'country_id' => '2',
			),
		);

		// Uncomment the below to run the seeder
		DB::table('equipes')->insert($equipe);
	}

}
