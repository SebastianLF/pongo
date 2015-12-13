<?php

class CountryTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('countries')->truncate();

		$country = new Country(array(
			array(
				'name' => 'Unknown',
				'shortname' => 'xx',
			)
		));

		// Uncomment the below to run the seeder
		DB::table('countries')->insert($country);
	}

}
